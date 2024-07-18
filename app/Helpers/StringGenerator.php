<?php

namespace App\Helpers;
class StringGenerator{

    public static function generateNumber($length) {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    public static function generateMembershipNumber($phone=null) {

        if($phone != null){
            $first = substr($phone, 3);

            $last = substr($phone, 0, 3);
            return $first.$last;
        }
        return mt_rand(100000,999999). substr(time(),6,5);
    }

    public static function generateTranxNumber($length) {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'.time();
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public static function generateRandomCode(){
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        return substr(str_shuffle($permitted_chars), 0, 28);
    }
    public static function generateBookingReferenceCode($user_id){
        $length = 10;
        $ref = "";
        $add = $length - strlen($user_id);
        $more = "";
        // echo StringGenerator::generateTranxNumber(6);
        if ($add > 0) {
            $more = self::generateTranxNumber($add);
        }else{
            $more = self::generateTranxNumber(10);
        }
        $m = $more . $user_id;
        $t = str_shuffle($m);
        return $t;
    }
    
}
