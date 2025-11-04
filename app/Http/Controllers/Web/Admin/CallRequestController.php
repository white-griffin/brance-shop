<?php

namespace App\Http\Controllers\Web\Admin;

use App\Filters\CallRequestFilter;
use App\Http\Controllers\Controller;
use App\Models\CallRequest;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class CallRequestController extends Controller
{
    public function list()
    {
        $callRequests = CallRequest::filter(new CallRequestFilter())
            ->orderby('created_at','ASC')
            ->paginate()
            ->withQueryString();
        return view('admin.call-requests.list',compact('callRequests'));
    }

    public function updateStatus(CallRequest $callRequest)
    {
        DB::beginTransaction();
        try {
            $callRequest->update([
                'status' => request('status')
            ]);

            DB::commit();

            return redirect()->route('admin.call-requests.list')->with("success", "عملیات شما با موفقیت انجام شد ");
        }catch (Exception $e){
            DB::rollBack();
            return redirect()->back()->with("error", "خظا در انجام عملیات ");
        }
    }
}
