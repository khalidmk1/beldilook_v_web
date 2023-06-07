<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;
use App;

class Controller_favoris extends Controller
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

    public function get_favoris()
    {
        //$this->change_l();
        $this->actualiser_user();
        if (Session::get('user')){
            $user=Session::get('user');
            $id=$user['IDUtilisateurs'];
        } else{
          return redirect(route('login'))->with('message', __('favoris.message_connection'));
        }


        $response = Http::post('http://51.68.36.192/REST_BeldiLook/recuperer_favoris', [
            'id_utilisateur' => $id
        ]);
        if ($response->successful()){
            $articles = $response->json();
        }

        
        $response2 = Http::post('http://51.68.36.192/REST_BeldiLook/recuperer_favoris_boutique', [
            'id_utilisateur' => $id
        ]);
        if ($response2->successful()){
            $boutiques = $response2->json();
        }
//dd($boutiques);
        return view('mes_favoris',[
            'articles' => $articles,
            'boutiques' => $boutiques
        ]);
    }
    public function delete_favoris_article(Request $request)
    {
        //$this->change_l();
        $this->actualiser_user();
        if (Session::get('user')){
            $user=Session::get('user');
            $id=$user['IDUtilisateurs'];
        } else{
          return redirect(route('login'))->with('message', __('favoris.message_connection'));
        }
        $validated = $request->validate([
            'idarticle' => 'required'
        ]);

        $idarticle = $request->input('idarticle');
        
        $response = Http::post('http://51.68.36.192/REST_BeldiLook/supprimer_favoris_article_web', [
            'nId_utilisateur' => $id,
            'nId_article' => $idarticle,
        ]);
         if($response->successful()) {
            $message = $response->json();
            if($message['message']=="ok"){
                return redirect()->route('get_favoris')->with('success', __('favoris.message_success_article'));
                }else{
                    return redirect(route('get_favoris'))->with('message', __('favoris.erreur'));
                }
           }else{
            return redirect(route('get_favoris'))->with('message', __('favoris.erreur'));
           }
    }
    public function delete_favoris_boutique(Request $request)
    {
        //$this->change_l();
        $this->actualiser_user();
        if (Session::get('user')){
            $user=Session::get('user');
            $id=$user['IDUtilisateurs'];
        } else{
          return redirect(route('login'))->with('message', __('favoris.message_connection'));
        }

        $validated = $request->validate([
            'idboutique' => 'required'
        ]);

        $idboutique = $request->input('idboutique');

        $response = Http::post('http://51.68.36.192/REST_BeldiLook/supprimer_favoris_boutique_web', [
            'id_utilisateur' => $id,
            'id_boutique' => $idboutique,
        ]);
         if($response->successful()) {
            $message = $response->json();
            if($message['message']=="ok"){
                return redirect()->route('get_favoris')->with('success', __('favoris.message_success_boutique'));
                }else {
                    return redirect(route('get_favoris'))->with('message', __('favoris.erreur'));
                }
           }else{
            return redirect(route('get_favoris'))->with('message', __('favoris.erreur'));
           }
    }
}
