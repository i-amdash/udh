<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

if (!function_exists('adminUserId')) {
    function adminUserId() {
        //        dd($firgure);
        return Auth::guard('admin')->user()->id;
    }
}
if (!function_exists('vendorUserId')) {
    function vendorUserId() {
        //        dd($firgure);
        return Auth::guard('vendor')->user()->id;
    }
}
if (!function_exists('vendorIdByAuthUser')) {
    function vendorIdByAuthUser() {
        //        dd($firgure);
        return Auth::guard('vendor')->user()->vendor_id;
    }
}
if (!function_exists('isVendorAdminUser')) {
    function isVendorAdminUser()
    {
        $usr = Auth::guard('vendor')->user();
        if($usr->is_admin !=1){
            return false;
        }
        return true;
    }
}
if (!function_exists('adminUser')) {
    function adminUser() {
        //        dd($firgure);
        return Auth::guard('admin')->user();
    }
}
if (!function_exists('logAdminActivity')) {
    function logAdminActivity($model,$msg) {
        try{
            $admin = Auth::guard('admin')->user();
            activity()->causedBy($admin)->performedOn($model)->log($msg);
        }catch(\Exception $e){

        }
    }
}
