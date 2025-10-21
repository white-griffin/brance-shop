<?php

namespace App\Http\Controllers\Api;

use App\Constants\Constant;
use App\Helpers\Api\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\CartItem;
use App\Models\DiscountCode;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderReceiver;
use App\Models\Payment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public int $discountAmount =0;

    public function createOrder()
    {
        DB::beginTransaction();
        try {
            $user = request()->user();
            $discount_code = request('discount_code');
            if (!is_null($discount_code)){
                $discount_code = $this->checkDiscountCode($user);
                if ($discount_code['code']==500){
                    return ApiResponse::Fail('500',$discount_code['message']);
                }
            }
            $cart = $this->getCart();
            $this->setDiscountCodeAmount($discount_code,$cart['total_amount']);
            $order = $this->createOrderRecord($user,$discount_code,$cart);

            $this->createOrderItems($cart['items'],$order->id);
            $payment = $this->createPaymentRecord($user,$order);
            $sendToGateway = $this->sendToGateway($payment);
            if ($sendToGateway['code']==200){
                DB::commit();
                return ApiResponse::Success('عملیات موفق',[
                    'pay_url' => $sendToGateway['url']
                ]);
            }else{
                return ApiResponse::Fail(500,$sendToGateway['message']);
            }
        }catch (\Exception $e){
            DB::rollBack();

            return  ApiResponse::Fail(Response::HTTP_INTERNAL_SERVER_ERROR,'خطا در عملیات');

        }
    }

    private function createOrderItems($items,$orderId): void
    {

        foreach ($items as $item){
            OrderItem::create([
                'order_id' => $orderId,
                'product_id' => $item->product->id,
                'price' => $this->getItemPrice($item->product),
                'quantity' => $item->quantity,

            ]);
        }
    }

    private function getItemPrice($item)
    {

        if ($item->discount_status == Constant::ACTIVE){

            $price = $item->price - ($item->price * $item->discount_percent /100);

            $this->discountAmount += ($item->price * $item->discount_percent /100);
        }else{

            $price = $item->price;
        }

        return $price;
    }

    private function getCart()
    {
        $cartItems = CartItem::where('user_id', request()->user()->id)
            ->with('product')
            ->get();
        $itemsAmount = $cartItems->sum(function ($item) {
            return $item->quantity * $this->getItemPrice($item->product);
        });

        $deliveryAmount = $cartItems->sum(function ($item) {
            return $item->quantity * $item->delivery_amount;
        });

        return[
            'items' => $cartItems,
            'items_amount' => $itemsAmount,
            'delivery_amount' => $deliveryAmount,
            'total_amount' => $itemsAmount+$deliveryAmount
        ];
    }

    private function checkDiscountCode($user)
    {

        $discount_code = DiscountCode::where('code',request('discount_code'))->first();
        $usedDiscountCode = $user->usedDiscountCodes()->wherePivot('discount_code_id',$discount_code->id)->first();
        if (!is_null($usedDiscountCode)){
            return [
                'code' => 500,
                'message' => 'شما قبلا از این کد تخفیف استفاده کرده اید'
            ];
        }
        if (is_null($discount_code)){
            return [
                'code' => 500,
                'message' => 'کد تخفیف  وارد شده صحیح نیست'
            ];
        }
        if (!is_null($discount_code->user_id) && $discount_code->user_id != $user->id){

            return [
                'code' => 500,
                'message' => 'کد  تخفیف وارد شده مربوط به کاربر دیگری است'
            ];
        }

        if (Carbon::now()->greaterThan($discount_code->expire_date) || $discount_code->status == Constant::IN_ACTIVE || $discount_code->capacity <=0){
            $discount_code->update(['status'=>Constant::IN_ACTIVE]);
            return [
                'code' => 500,
                'message' => 'کد تخفیف  وارد شده منقضی شده است'
            ];
        }

        return $discount_code;
    }

    private function setDiscountCodeAmount($discount_code,$total_amount)
    {

        if (!is_null($discount_code)){
            if ($discount_code->discount_type == Constant::AMOUNT){
                $this->discountAmount = $discount_code->discount_amount;
            }else{
                $this->discountAmount = ($total_amount * $discount_code->discount_percent / 100);
            }
        }


    }

    private function createOrderRecord($user,$discount_code,$cart)
    {
        $order = Order::create([
            'user_id' => $user->id,
            'discount_code_id' => !is_null($discount_code) ? $discount_code->id : null,
            'order_amount' => $cart['items_amount'] *10,
            'delivery_amount' => $cart['delivery_amount'],
            'discount_amount' => $this->discountAmount,
            'total_amount' => $cart['total_amount'] * 1.1 /* اضافه شدن 10 درصد مبلغ مالیات به جمع مبلغ خرید*/,
			'description' => request('description')
        ]);

        $orderReceiver = OrderReceiver::create([
            'order_id' => $order->id,
            'first_name' => request('first_name'),
            'last_name' => request('last_name'),
            'national_code' => request('national_code'),
            'mobile' => request('mobile'),
            'email' => request('email'),
            'address' => request('address'),
            'zip_code' => request('zip_code')
        ]);
        return  $order;
    }

    private function createPaymentRecord($user,$order)
    {
        return Payment::create([
            'user_id' => $user->id,
            'order_id' => $order->id,
            'amount' => $order->total_amount
        ]);
    }

    private function sendToGateway($payment)
    {

        $payRequest = Http::post('https://payment.zarinpal.com/pg/v4/payment/request.json', [
            'merchant_id' => env('ZARINPAL_MERCHANT_ID'),
            'amount' => (int)$payment->amount *10,
            'callback_url' => route('payment.callback'),
            'description' => 'خرید محصول',
        ]);

        $payData = $payRequest->json();
        if ($payRequest->successful()) {

            $transactionId = $payData['data']['authority'];
            // Store created transaction details for verification
            $payment->update([
                'transaction_id' => $transactionId
            ]);


            return [
                'code' => 200,
                'url' => 'https://payment.zarinpal.com/pg/StartPay/'. $transactionId
            ];
        }

        if ($payRequest->failed()) {
            return [
                'code' => 500,
                'message' => $payData['errors'],
            ];
        }
    }

    public function callBackPayment(Request $request)
    {

        DB::beginTransaction();
        try {
            $paymentRecord = Payment::where('transaction_id',$request['Authority'])->first();
			CartItem::where('user_id', $paymentRecord->user_id)->delete();
            if ($request['Status'] == 'OK'){
                $paymentVerify = $this->verifyPayment($paymentRecord);
                if ($paymentVerify['data']['code'] == 100) {
                    // Store the successful transaction details
                    $paymentRecord->update([
                        'payment_token' => $paymentVerify['data']['ref_id'],
                        'status' => Constant::CONFIRMED
                    ]);
                    $paymentRecord->order->update([
                        'status' => Constant::PURCHASED
                    ]);
                    if (!is_null($paymentRecord->discount_code_id)){
                        $user = User::find($paymentRecord->user_id);
                        $discount_code = DiscountCode::find($paymentRecord->discount_code_id);
                        $user->usedDiscountCodes()->attach($discount_code);

                    }
                    DB::commit();
                    $reciver = $this->getReceiverData($paymentRecord->order->receiver);
                    $sendOrderSms = $this->sendSmsWithPattern(3526,$reciver['fullName'],$reciver['mobile']);
                    Log::info($sendOrderSms);
                    return view('user.payments.success-pay');
                }elseif ($paymentVerify['data']['code'] == 101){
                    DB::commit();
                    return view('user.payments.already-payed');
                }else{
                    $paymentRecord->update([
                        'status' => Constant::REJECTED
                    ]);
                    $paymentRecord->order->update([
                        'status' => Constant::REJECTED
                    ]);
                    DB::commit();
                    return view('user.payments.failed-pay');
                }
            }else{
                $paymentRecord->update([
                    'status' => Constant::REJECTED
                ]);
                $paymentRecord->order->update([
                    'status' => Constant::REJECTED
                ]);
                DB::commit();
                return view('user.payments.failed-pay');
            }
        }catch (\Exception $e){
            DB::rollBack();
            Log::error($paymentVerify);
            return view('user.payments.failed-pay');
        }


    }

    private function verifyPayment($payment)
    {
        $verifyRequest = Http::post('https://payment.zarinpal.com/pg/v4/payment/verify.json', [
            'merchant_id' => env('ZARINPAL_MERCHANT_ID'),
            'amount' => $payment->amount *10,
            'authority' => $payment->transaction_id,
        ]);
        Log::error($verifyRequest->json());
        return $verifyRequest->json();
    }

    public function getUserOrders()
    {
        $user = request()->user();
        $orders = OrderResource::collection($user->orders()->latest('created_at')->get());
        return ApiResponse::Success('عملیات موفق',$orders);
    }

    private function getReceiverData($receiver)
    {
        return [
            'fullName' => $receiver->first_name." ".$receiver->last_name,
            'mobile' => $receiver->mobile,
        ];
    }

}
