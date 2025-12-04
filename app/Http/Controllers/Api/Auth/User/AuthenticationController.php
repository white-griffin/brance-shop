<?php

namespace App\Http\Controllers\Api\Auth\User;

use App\Constants\Constant;
use App\Helpers\Api\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class AuthenticationController extends Controller
{
    public function loginUser()
    {
        try {
            $validateUser = Validator::make(request()->all(),
                [
                    'mobile' => 'required|numeric|min:7',
                ],[
                    'mobile.required' => 'شماره تماس را وارد کنید',
                    'mobile.numeric' => 'فرمت شماره تلفن صحیح نیست ',
                ]);

            if($validateUser->fails()){

                foreach ($validateUser->errors()->messages() as $error){
                    $errors[] = $error[0];
                }
                return ApiResponse::Fail(500,$errors);
            }


            $user = User::firstOrCreate(
                [
                    'mobile' => request('mobile')
                ],[
                    'mobile' => request('mobile')
                ]
            );
            if (is_null($user)){
                return ApiResponse::Success('شماره مورد نظر وجود ندارد');
            }
            $otp_code = mt_rand(1000, 9999);
            $user->otp_code = $otp_code;
            $user->save();
            $sendOtp = $this->sendOtp($otp_code,request('mobile'));
            if ($sendOtp == 'Success'){
                return ApiResponse::Success($sendOtp);
            }else{
                return ApiResponse::Fail(500,'خطا در ارسال پیام');
            }

        } catch (Exception $e) {
            return ApiResponse::Fail(500,'خطا در برقراری ارتباط');
        }
    }

    public function checkCode()
    {
        try {
            //Validated
            $validateUser = Validator::make(request()->all(),
                [
                    'otp_code' => 'required',
                ],[
                    'otp_code.required' => 'وارد کردن کد تایید الزامی است ',
                ]);

            if($validateUser->fails()){
                return ApiResponse::Fail(Response::HTTP_NOT_ACCEPTABLE,'validation error',$validateUser->errors());
            }

            $user = User::whereMobile(request('mobile'))->first();
            if (is_null($user)){
                return ApiResponse::Fail(500,'خطا در یافتن اطلاعات کاربر،لطفا با پشتیبانی درتماس باشید');
            }

            if ($user->otp_code == request('otp_code')){
                $user->status = Constant::ACTIVE;
                $user->save();

                return ApiResponse::Success('با موفقیت وارد شدید',
                    [
                        'token' => $user->createToken("API TOKEN")->plainTextToken,
                    ]);


            }else{
                return ApiResponse::Fail(403,'کد تایید صحیح نیست');

            }


        } catch (\Throwable $th) {
            return ApiResponse::Fail(500,$th->getMessage());
        }
    }
}
