<?php


namespace App\Helpers\Hash;


class HashGenerator
{

    public static function make($length = 10)
    {
        try {
            return bin2hex(random_bytes($length / 2));
        } catch (\Exception $e) {
            return self::randomToken($length);
        }
    }

    private static function randomToken($length = 20) {
        $token = "";
        $characters = array_merge(range('A','Z'), range('a','z'), range('0','9'));
        $max = count($characters) - 1;
        for ($i = 0; $i < $length; $i++) {
            $rand = mt_rand(0, $max);
            $token .= $characters[$rand];
        }
        return $token;
    }

}
