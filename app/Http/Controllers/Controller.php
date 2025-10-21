<?php

namespace App\Http\Controllers;

use App\Helpers\Hash\HashGenerator;
use DateTime;
use DateTimeZone;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;

abstract class Controller
{
    public function uploadFile($uploadedFile, $uploadPath)
    {
        $uploaded_file_name = rand(1,9999).$uploadedFile->getClientOriginalName();
        $fileNameToStore = HashGenerator::make(10) . time() . '_' . $uploaded_file_name;
        // check dir exist
        if(!File::exists($uploadPath)){
            File::makeDirectory($uploadPath,0777,true,true);
        }

        $fileUploaded = $uploadedFile->move(public_path($uploadPath), $fileNameToStore);
        if ($fileUploaded) {
            return $fileNameToStore;
        } else {
            return null;
        }
    }


    public function sendOtp($otp_code,$receptor)
    {
        try {
            $url = "https://portal.amootsms.com/rest/SendQuickOTP";

            $url = $url."?"."Token=".urlencode(Env('AMOOT_OTP_SERVICE_TOKEN'));
            $url = $url."&"."Mobile=".$receptor;
            $url = $url."&"."CodeLength=4";
            $url = $url."&"."OptionalCode=".$otp_code;

            $json = file_get_contents($url);

            $result = json_decode($json);

            return $result->Status;
        }catch (\Exception $e){
            return $e->getMessage();
        }
    }

    public function sendSmsWithPattern($patternCode,$receptorName,$receptorNumber){
        try {
            $response = Http::get('https://portal.amootsms.com/rest/SendWithPattern', [
                'Token'         => env('AMOOT_OTP_SERVICE_TOKEN'),
                'Mobile'        => $receptorNumber,
                'PatternCodeID' => $patternCode,
                'PatternValues' => $receptorName
            ]);

            $data = $response->json();

            if ($response->successful()) {
                return $data['Status'] ?? 'No Status';
            } else {
                return 'خطا در پاسخ سرور: ' . ($data['Message'] ?? 'خطای ناشناخته');
            }

        } catch (\Exception $e) {
            return 'خطای استثنا: ' . $e->getMessage();
        }

    }
}
