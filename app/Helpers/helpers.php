<?php

use App\Helpers\StringGenerator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

if (!function_exists('appService')) {
    function appService($class)
    {
        return app($class);
    }
}
if (!function_exists('getAppSetting')) {
    function getAppSetting($type)
    {
        $setting = DB::table('app_settings')->where('name', $type)->first();
        if ($setting) {
            return $setting->value;
        }
        return false;
    }
}
if (!function_exists('addSeconds')) {
    function addSeconds($time = 10)
    {
        return Carbon::now()->addSeconds($time);
    }
}
if (!function_exists('getVendor')) {
    function getVendor($call)
    {
        $vendor = DB::table('vendors')->where('call_value', $call)->first();
        if (!$vendor) {

            return false;
        }
        return $vendor;
    }
}

if (!function_exists('getUserId')) {
    function getUserId()
    {
        //        dd($firgure);
        return Auth::user()->id;
    }
}
if (!function_exists('formatStringToInt')) {
    function formatStringToInt($num)
    {
        $intValue = (int) str_replace(',', '', $num);
        //        dd($firgure);
        return $intValue;
    }
}
if (!function_exists('generateQRCode')) {
    function generateQRCode($value, $ref, $location)
    {
        $fileName = $ref . '.png';
        $pngAbsoluteFilePath = $location . '/' . $fileName;
        // dd($pngAbsoluteFilePath);
        if (!file_exists($pngAbsoluteFilePath)) {
            //   $t =   QRcode::png($value, $pngAbsoluteFilePath);
            // dd($t);
            return asset('qrcodes/' . $fileName);
        } else {
            return asset('qrcodes/' . $fileName);
        }
    }
}
if (!function_exists('deleteGenerateQRCode')) {
    function deleteGenerateQRCode($ref)
    {
        $path = public_path('qrcodes');
        $fileName = $path . '/' . $ref . '.png';

        if (file_exists($fileName)) {
            unlink($fileName);
        } else {
            return false;
        }
    }
}
if (!function_exists('formatDateToYMD')) {
    function formatDateToYMD($date)
    {
        return  Carbon::parse($date)->format("Y-m-d");
    }
}
if (!function_exists('formatDateToDMY')) {
    function formatDateToDMY($date)
    {
        return  Carbon::parse($date)->format("Y-m-d");
    }
}
if (!function_exists('replaceSpString')) {
    function replaceSpString($str)
    {
        return  preg_replace('/\W+/', '_', $str);
    }
}
if (!function_exists('getHolidayDates')) {
    function getHolidayDates()
    {
        $setting = DB::table('app_settings')->where('name', 'holidays')->first();
        $holidays = explode(',', $setting->value);

        return $holidays;
    }
}
if (!function_exists('determineWeekendOrHoliday')) {
    function determineWeekendOrHoliday($date)
    {
        $dt = Carbon::parse($date);
        $normal = formatDateToDMY($date);
        $holidays = getHolidayDates();
        $is_weekend = $dt->isWeekend();
        if ($is_weekend || in_array($normal, $holidays)) {
            return true;
        }
        return false;
    }
}
if (!function_exists('getFurnitureNameFromId')) {
    function getFurnitureNameFromId($id)
    {
        $item = DB::table('beach_items')->where('id', $id)->first();

        return $item->beach_item_name;
    }
}
if (!function_exists('getZoneNameFromId')) {
    function getZoneNameFromId($id)
    {
        $item = DB::table('beach_zones')->where('id', $id)->first();

        return $item->zone_name;
    }
}
if (!function_exists('generateBookingReferenceCode')) {
    function generateBookingReferenceCode($user_id)
    {
        $length = 10;
        $ref = "";
        $add = $length - strlen($user_id);
        $more = "";
        // echo StringGenerator::generateTranxNumber(6);
        if ($add > 0) {
            $more = StringGenerator::generateTranxNumber($add);
        } else {
            $more = StringGenerator::generateTranxNumber(10);
        }
        $m = $more . $user_id;
        $t = str_shuffle($m);
        return $t;
    }
}
if (!function_exists('generateWalletId')) {
    function generateWalletId($name, $nuban = null)
    {
        $length = 10;
        $ref =  StringGenerator::generateTranxNumber(15);
        if ($nuban) {
            $ref = $ref . $nuban;
            return $ref;
        }
        $chars = $name . $ref;
        return substr(str_shuffle($chars), 0, 20);
    }
}
if (!function_exists('generateUUID')) {
    function generateUUID()
    {
        // $data = $data ?? random_bytes(16);
        // return $data;
        return sprintf(
            '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            // 32 bits for "time_low"
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),

            // 16 bits for "time_mid"
            mt_rand(0, 0xffff),

            // 16 bits for "time_hi_and_version",
            // four most significant bits holds version number 4
            mt_rand(0, 0x0fff) | 0x4000,

            // 16 bits, 8 bits for "clk_seq_hi_res",
            // 8 bits for "clk_seq_low",
            // two most significant bits holds zero and one for variant DCE1.1
            mt_rand(0, 0x3fff) | 0x8000,

            // 48 bits for "node"
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff)
        );
    }
}
if (!function_exists('isJson')) {
    function isJson($string)
    {
        // $decoded = json_decode($string); // decode our JSON string
        // if (!is_object($decoded) && !is_array($decoded)) {
        //     /*
        //     If our string doesn't produce an object or array
        //     it's invalid, so we should return false
        //     */
        //     return false;
        // }
        // /*
        // If the following line resolves to true, then there was
        // no error and our JSON is valid, so we return true.
        // Otherwise it isn't, so we return false.
        // */
        // return (json_last_error() == JSON_ERROR_NONE);
        return !empty($string) && is_string($string) && is_array(json_decode($string, true)) && json_last_error() == 0;
    }
}
