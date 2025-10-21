<?php

namespace App\Http\Controllers\Api;

use App\Constants\Constant;
use App\Helpers\Api\ApiResponse;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class ProfileController extends Controller
{
    public function profileData()
    {
        $user = request()->user();
        $userData = $this->userData($user);

        return ApiResponse::Success('',$userData);

    }

    private function userData($user)
    {
        return [
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'avatar' => $user->apiPresent()->avatar,
            'mobile' => $user->mobile,
            'auth_status' => $user->auth_status,
            'national_code' => $user->national_code,
            'email' => $user->email
        ];
    }

    public function updateProfileData()
    {
        $user = request()->user();
        DB::beginTransaction();
        try {

            $profileData = $this->getProfileData();
            $user->update($profileData);
            DB::commit();

            return ApiResponse::Success('اطلاعات با موفقیت وارد شد');
        }catch (Exception $e){
            DB::rollBack();
            return ApiResponse::Fail(ResponseAlias::HTTP_INTERNAL_SERVER_ERROR,'خطا در عملیات');
        }
    }

    private function getProfileData()
    {
        if (request()->hasFile('avatar')) {
            $data['avatar'] = $this->uploadFile(request()->file('avatar'), Constant::USERS_AVATAR_PATH);
        }
        if (request()->has('first_name')) {
            $data['first_name'] = request('first_name');
        }
        if (request()->has('last_name')) {
            $data['last_name'] = request('last_name');
        }
        if (request()->has('email')) {
            $data['email'] = request('email');
        }
        if (request()->has('national_code')) {
            $data['national_code'] = request('national_code');
        }

        return $data;
    }
}
