<?php

namespace App\Http\Controllers\Web\Admin;

use App\Constants\Constant;
use App\Filters\OrdersFilter;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function list()
    {

        $orders = Order::filter(new OrdersFilter())
            ->orderBy('created_at','desc')
            ->paginate()
            ->withQueryString();
        $orderStatuses = Constant::getOrderStatusesViewer();
        return view('admin.orders.list',compact('orders','orderStatuses'));
    }

    public function downloadInvoice($id)
    {
        $order = Order::findOrFail($id);

        $pdf = PDF::loadView('admin.orders.invoice', compact('order'))
            ->setPaper('a5')
            ->setOptions([
                'defaultFont' => 'IRANSansWeb',
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled' => true,
            ]);

        return $pdf->download("invoice-{$order->id}.pdf");
    }

    public function changeStatus(Order $order)
    {
        DB::beginTransaction();
        try {
            $order->update([
                'status' => request('status')
            ]);
            DB::commit();
            return redirect()->route('admin.orders.list')->with("success", "عملیات شما با موفقیت انجام شد ");
        }catch (\Exception $e){
            DB::rollBack();
            return redirect()->back()->with("error", "خظا در انجام عملیات ");
        }
    }

    public function updateDeliveryStatus()
    {
        try {
            $order = Order::findOrFail(request()->order_id);
            $order->delivery_status = request()->delivery_status;
            $order->save();
            
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}
