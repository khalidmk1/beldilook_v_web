<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;
use Laravel\Socialite\Facades\Socialite;
use App;

class Controller_google extends Controller
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
        return Socialite::driver('google')->redirect();
    }
    public function callback()
    {
        $user = Socialite::driver('google')->user();
       // dd($user);
        //dd($user->user['family_name']);

        $response = Http::post('http://51.68.36.192/REST_BeldiLook/inscription_google_java', [
            'id' => $user->user['id'],
            'user_last_name' => $user->user['family_name'],
            'user_first_name' => $user->user['given_name'],
            'email' => $user->user['email'],
            'user_image' => $user->user['picture']
        ]);
            if($response->successful()) {
                $reponse = $response->json();

                //dd($reponse['message']);

                $id=$reponse['message'];
             
                // commenté pour lading page

               // if($id=='erreur')
              //  {
               //     return redirect('login')->with('message', __('favoris.erreur'));
              //  }

               if($id=='erreur')
                {
                    return redirect('https://www.beldilook.ma/');
                }else{
                    return redirect(route('felicitation_google'));
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
    public function felicitation_google(){
        return view('felicitation_google');
    }
}
