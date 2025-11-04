<?php

namespace App\Http\Controllers\Web\Admin;

use App\Constants\Constant;
use App\Filters\PaymentsFilter;
use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function list()
    {
        $payments = Payment::filter(new PaymentsFilter())
            ->orderBy('updated_at','desc')
            ->paginate()
            ->withQueryString();
        $paymentStatuses = Constant::getPaymentStatusesViewer();
        return view('admin.payments.list',compact('payments','paymentStatuses'));
    }
}
