<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
class Controller_api_lading extends Controller
{
    //
    public function inscription(Request $request){

     if($request->input('email')=="")
     {
        return 'email is required';
     }
     if($request->input('name')=="")
     {
        return 'name is required';
     }
     if($request->input('prenom')=="")
     {
        return 'prenom is required';
     }
     if($request->input('password')=="")
     {
        return 'password is required';
     }
$email=$request->input('email');
$name=$request->input('name');
$prenom=$request->input('prenom');
$password=$request->input('password');

 $response55 = Http::post('http://51.68.36.192/REST_BeldiLook/inscription_popup_lading_page', [
            'email' => $email,
            'name' => $name,
            'prenom' => $prenom,
            'password' => $password
        ]);
        if ($response55->successful()){
            $response556 = $response55->json();

            if($response556['message']=="erreur")
            {
                return "erreur";
            }
            if($response556['message']=="ok")
            {
                return json_encode($response556);
            }
            if($response556['message']=="email used")
            {
                return "email used";
            }
        }else{
            return "erreur";
        }

        

    }
    public function verification_code_lading(Request $request)
    {
        if($request->input('token')=="")
        {
           return 'token is required';
        }
        if($request->input('code')=="")
        {
           return 'code is required';
        }


        $token=$request->input('token');
$code=$request->input('code');

        $response55 = Http::post('http://51.68.36.192/REST_BeldiLook/verification_code_lading_web', [
            'code' => $code,
            'token' => $token
        ]);
        if ($response55->successful()){
            $response556 = $response55->json();
            return json_encode($response556);
        }else{
            $response556 = $response55->json();
            return json_encode($response556);
        }

    }
}
