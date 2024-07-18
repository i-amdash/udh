<?php
namespace App\Traits;

use App\Models\ExternalServiceLog;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use PhpParser\Node\Stmt\TryCatch;

trait ConsumeApiTrait{


    public function makeRequestTwo($base,$method, $requestUrl, $queryParams = [], $formParams = [], $headers = [])
    {
        try {

            $client = new Client([
                'base_uri' => $base,
            ]);

            $bodyType = 'form_params';
            $response = $client->request($method, $requestUrl, [
                        'query' => $queryParams,
                        $bodyType => $formParams,
                        'headers' => $headers,
                    ]);

            $res = $response->getBody()->getContents();

            return json_decode($res);
        } catch (\Exception $e) {
            //throw $th;

            Log::debug($e->getMessage());
            return $e->getMessage();
            // return false;
        }
    }
    public function makeRequest($method, $requestUrl, $queryParams = [], $formParams = [], $headers = [])
    {
        try {
            $bodyType = 'form_params';
            if($method=="POST"){
                $response = Http::withHeaders($headers)->post($requestUrl,$formParams);
            }else if($method=="GET"){
                $response = Http::withHeaders($headers)->get($requestUrl);
            }
            $response = $response->getBody()->getContents();

            return json_decode($response);
        } catch (\Exception $e) {
            //throw $th;

            Log::debug($e->getMessage());
            return $e->getMessage();
            // return false;
        }

    }

    public function paymentRequest(){}


}

