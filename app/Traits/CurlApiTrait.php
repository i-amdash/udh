<?php
namespace App\Traits;

use App\Models\BasicSettings\PageHeading;
use App\Models\Language;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

trait CurlApiTrait
{
    public static function callCurlApi($url, $method,$total_amount,$email,$callback,$key, $ref_no){

        $fields_string = http_build_query([
            'amount' => $total_amount,
            'email' => $email,
            'reference' => $ref_no,
            'callback_url' => $callback
        ]);

        try {
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL            => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_CUSTOMREQUEST  => $method,
                CURLOPT_POSTFIELDS     => json_encode([
                    'amount'       => $total_amount,
                    'email'        => $email,
                    'reference'    => $ref_no,
                    'callback_url' => $callback
                ]),
                CURLOPT_HTTPHEADER     => [
                    'authorization: Bearer ' . $key,
                    'content-type: application/json',
                    'cache-control: no-cache'
                ]
            ));
            // $curl = curl_init();

            // //set the url, number of POST vars, POST data
            // curl_setopt($curl, CURLOPT_URL, $url);
            // curl_setopt($curl, CURLOPT_POST, true);
            // curl_setopt($curl, CURLOPT_POSTFIELDS, $fields_string);
            // curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            //     "Authorization: Bearer ".$key,
            //     "Cache-Control: no-cache",
            // )
            // );
            // curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($curl);
            curl_close($curl);

            $transaction = json_decode($response, true);
            return $transaction;
        } catch (\Exception $th) {
            Log::debug('processing paystack  ' . $th->getMessage());
            return false;
        }
    }
}
