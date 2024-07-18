<?php
namespace App\Traits;

// use App\Models\BeachItemTag;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

trait ClassReturnTrait{


  public function fail($msg,$logMsg='App Error', $log=null,$code = 404){
        $feedback = [];
        $feedback['status'] = false;
        $feedback['msg'] = $msg;
        $feedback['code']=$code;
       if($log != null){ Log::debug($logMsg.' : '.$log->getMessage());}
        return $feedback;
    }
    public function success($msg,$data,$code=200){
         $feedback = [];
        $feedback['status'] = true;
        $feedback['msg'] = $msg;
        $feedback['data'] = $data;
         $feedback['code']=$code;
        return $feedback;
    }
}
