<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;
use Laravel\Socialite\Facades\Socialite;
use App;

class Controller_facebook extends Controller
{
    public function change_l(){
        $language = Session::get('lang');
        if ($language){
           App::setlocale($language);
        }
    }

    public function login()
    {
        //$this->change_l();
        return Socialite::driver('facebook')->redirect();
    }
    public function callback()
    {
        $user = Socialite::driver('facebook')->user();
        //dd($user->attributes['avatar_original']);
        
        $response = Http::post('http://51.68.36.192/REST_BeldiLook/inscription_facebook_web_laravel', [
            'id' => $user->user['id'],
            'sNomAffichage' => $user->attributes['name'],
            'email' => $user->attributes['email'],
            'user_image' => $user->attributes['avatar_original']
        ]);
            if($response->successful()) {
                $reponse = $response->json();
                $id=$reponse['message'];

                if($id=='erreur')
                {
                    return redirect('login')->with('message', __('favoris.erreur'));
                }

                $response33 = Http::post('http://51.68.36.192/REST_BeldiLook/Rechercher_utilisateur', [
                    'sPar_type' => 'IDUtilisateurs',
                    'sValeur' => $id,
                ]);
                if ($response33->successful()){
                    $reponse332 = $response33->json();
                    Session::put('user',$reponse332);
                    return redirect('home');
                }else{
                    return redirect('login')->with('message', __('favoris.erreur'));
                }



            }else{
                return redirect('login')->with('message', __('favoris.erreur'));
            }


    }
}
