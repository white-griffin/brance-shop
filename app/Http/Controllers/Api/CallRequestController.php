<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Api\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\CallRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use PHPUnit\Exception;

class CallRequestController extends Controller
{
    public function storeCallRequest()
    {
        DB::beginTransaction();
        try {
            $callRequestData = $this->getCallRequestData();
            $callRequest = CallRequest::create($callRequestData);
            DB::commit();
            return ApiResponse::Success('درخواست با موفقیت ثبت شد');
        }catch (Exception $e){
            DB::rollBack();
            return  ApiResponse::Fail(Response::HTTP_INTERNAL_SERVER_ERROR,'خطا در عملیات');
        }
    }

    private function getCallRequestData()
    {
        return [
            'client_first_name' => request('first_name'),
            'client_last_name' => request('last_name'),
            'phone_number' => request('phone_number'),
            'email' => request('email'),
            'title' => request('title'),
            'description' => request('description'),
        ];
    }
}
