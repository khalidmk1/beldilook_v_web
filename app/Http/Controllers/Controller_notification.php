<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;
use App;

class Controller_notification extends Controller
{
    public function change_l(){
        $language = Session::get('lang');
        if ($language){
           App::setlocale($language);
        }
    }
    public function actualiser_user()
    {
        if (Session::get('user')){
            $user=Session::get('user');
            $id=$user['IDUtilisateurs'];
            $response = Http::post('http://51.68.36.192/REST_BeldiLook/Rechercher_utilisateur', [
                'sPar_type' => 'IDUtilisateurs',
                'sValeur' => $id,
            ]);
            if ($response->successful()){
                $reponse2 = $response->json();
                Session::put('user',$reponse2);
     
            }
        }
    }

    public function get_notifications(){
       // $this->change_l();
       $this->actualiser_user();
        if (Session::get('user')){
            $user=Session::get('user');
            $id=$user['IDUtilisateurs'];
        } else{
          return redirect('login')->with('message', __('favoris.message_connection'));
        }



        $response_notif = Http::post('http://51.68.36.192/REST_BeldiLook/liste_notification_web', [
            'id_utilisateur' => $id
          ]);
    
          if ($response_notif->successful()){
                $response_notif2=$response_notif->json();
                return view('notifications',[
                    'liste_notif' => $response_notif2
                ]);
          }else{
            return redirect(url()->previous())->with('message', __('favoris.erreur'));
          }

       
    }
}
