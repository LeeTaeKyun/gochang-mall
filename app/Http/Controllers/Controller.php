<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Http;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index(){

        print_r($_GET);
        $url = "https://noblegochang.cafe24api.com/api/v2/oauth/authorize?response_type=code&client_id=RqSe9wsSbaPVz3DzKtt9GA&state=kyun6654&redirect_uri=https://www.gochang-mall.com/api&scope=";
        // $curl = curl_init($url);
        // curl_setopt($curl, CURLOPT_URL, $url);
        // curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        // $resp = curl_exec($curl);
        // curl_close($curl);
        // var_dump($resp);
        $response = Http::withHeaders(['Content-Type' => 'application/json'])->get($url)->json();
            
        print_r($response);
    }
    public function test(){

        $data = array(
            'name' => '',
            'email' => 'tk.lee@banco.id',
            'password' => '',
            'password_confirmation' => '',
        );
        $url = "https://www.gochang-mall.com/api/auth/register";

        $method = "POST";
        $ch = curl_init($url);
        $headers = array(
            "Content-Type: application/json",
         );
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);        
        curl_setopt($ch, CURLOPT_URL, $url);               //URL 지정하기
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);    //요청 결과를 문자열로 반환 
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);      //connection timeout 10초 
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);   //원격 서버의 인증서가 유효한지 검사 안함
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);       //POST data
        curl_setopt($ch, CURLOPT_POST, true);              //true시 post 전송 

        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);
        
        return $response;
    }
}
