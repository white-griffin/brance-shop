<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Api\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function addToCart()
    {
        DB::beginTransaction();
        try {
            $product = Product::findOrFail(\request('product_id'));
            $quantity = \request('qty', 1);

            // چک کردن مقدار quantity
            if (!is_numeric($quantity) || $quantity <= 0) {
                return ApiResponse::Fail('500','تعداد باید ار صفر بیشتر باشه');
            }

            // چک کن اگه محصول قبلاً توی سبد کاربر هست، فقط تعدادش رو آپدیت کن
            $cartItem = CartItem::where('user_id', auth()->id())
                ->where('product_id', $product->id)
                ->first();

            if ($cartItem) {
                $cartItem->quantity += $quantity;
                $cartItem->save();
            } else {
                // اضافه کردن آیتم جدید به سبد
                $cartItem = CartItem::create([
                    'user_id' => auth()->id(), // فرض می‌کنم کاربر لاگین کرده
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'options' => [], // اگه گزینه داری، اینجا پر کن
                ]);
            }
            DB::commit();
            return ApiResponse::Success('محصول به سبد خرید اضافه شد');
        }catch (\Exception $e){
            DB::rollBack();
            return  ApiResponse::Fail(Response::HTTP_INTERNAL_SERVER_ERROR,'خطا در عملیات');
        }

    }

    public function showCart()
    {

        $cartItems = CartItem::where('user_id', auth()->id())->with('product')->get();
//        $total = $cartItems->sum(function ($item) {
//            return $item->quantity * $item->price;
//        });

        return ApiResponse::Success('',$cartItems);
    }

    public function removeFromCart()
    {
        DB::beginTransaction();
        try {
            $cartItem = CartItem::where('user_id', auth()->id())->findOrFail(request('cart_item_id'));
            $cartItem->delete();

            DB::commit();
            return ApiResponse::Success('محصول از سبد خرید حذف شد');
        } catch (\Exception $e) {
            DB::rollBack();
            return ApiResponse::Fail(Response::HTTP_INTERNAL_SERVER_ERROR, 'خطا در عملیات');
        }
    }

    public function updateCart()
    {
        DB::beginTransaction();
        try {
            $quantity = \request('qty');
            if (!is_numeric($quantity) || $quantity <= 0) {
                return ApiResponse::Fail('500','تعداد باید ار صفر بیشتر باشه');
            }

            $cartItem = CartItem::where('user_id', auth()->id())->findOrFail(request('cart_item_id'));
            $cartItem->quantity = $quantity;
            $cartItem->save();

            DB::commit();
            return ApiResponse::Success('سبد خرید به‌روزرسانی شد');
        } catch (\Exception $e) {
            DB::rollBack();
            return ApiResponse::Fail(Response::HTTP_INTERNAL_SERVER_ERROR, 'خطا در عملیات');
        }
    }

    public function clearCart()
    {
        DB::beginTransaction();
        try {
            // حذف همه آیتم‌های سبد خرید کاربر فعلی
            CartItem::where('user_id', auth()->id())->delete();

            DB::commit();
            return ApiResponse::Success('سبد خرید با موفقیت خالی شد');
        } catch (\Exception $e) {
            DB::rollBack();
            return ApiResponse::Fail(Response::HTTP_INTERNAL_SERVER_ERROR, 'خطا در عملیات: ' . $e->getMessage());
        }
    }
}
