<?php

namespace App\Http\Controllers;
use App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;

class Controller_adresse_livraison extends Controller
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

    public function get_adresses (){
      //  $this->change_l();
      $this->actualiser_user();
        if (Session::get('user')){
            $user=Session::get('user');
            $id=$user['IDUtilisateurs'];
        } else{
          return redirect()->back()->with('message', __('favoris.message_connection'));
        }


        $response5 = Http::post('http://51.68.36.192/REST_BeldiLook/RécupérerTout_AdresseLIvraison', [
            'IDUser' => $id,
        ]);
        $adresses=null;
        if ($response5->successful()){
            $adresses = $response5->json();
           //dd($adresses);
          
            return view('adresse_livraison.mes_adresses',[
                'adresses' => $adresses
            ]);
            
        }else{
         
        
            return view('adresse_livraison.mes_adresses',[
                'adresses' => $adresses
            ])->with('message', __('favoris.erreur'));
        }


        return view('adresse_livraison.mes_adresses',[
            'adresses' => $adresses
        ]);
    }

    public function get_add_adresse (){
      //  $this->change_l();
      $this->actualiser_user();
        if (Session::get('user')){
            $user=Session::get('user');
            $id=$user['IDUtilisateurs'];
        } else{
          return redirect()->back()->with('message', __('favoris.message_connection'));
        }

        $villes = Http::get('http://51.68.36.192/REST_BeldiLook/getVilles');
        if ($villes->successful()){
            $villes2 = $villes->json();
            //dd($tags2);
        }else{
            return redirect(url()->previous())->with('message', __('favoris.erreur'));
        }
//dd($villes2);
        Session::put('villes',$villes2['data']);


        return view('adresse_livraison.add_adresse',[
            'villes' => $villes2['data']
        ]);
    }

    public function add_adresse (Request $request){
      //  $this->change_l();
      $this->actualiser_user();
        if (Session::get('user')){
            $user=Session::get('user');
            $id=$user['IDUtilisateurs'];
        } else{
          return redirect()->back()->with('message', __('favoris.message_connection'));
        }

        $validated = $request->validate([
            'adresse' => 'required',
            'ville' => 'required',
            'secteur' => 'required',
            'code_postal' => 'required'
        ]);

        $adresse=$request->input('adresse');
        $ville=$request->input('ville');
        $code_postal=$request->input('code_postal');
        $secteur=$request->input('secteur');

        $villes = Session::get('villes');

        $found_key = array_search($ville, array_column($villes, 'id'));

        $ville_name=$villes[$found_key]['displayName'];

        $secteurs=$villes[$found_key]['sectors'];
        $found_key=array_search($secteur, array_column($secteurs, 'id'));

        $secteur_name=$secteurs[$found_key]['name'];

        $response5 = Http::post('http://51.68.36.192/REST_BeldiLook/Ajout_AdresseLivraison', [
            'sAdresse' => $adresse,
            'sVille' => $ville_name,
            'id_ville' => $ville,
            'id_secteur' => $secteur,
            'sSecteur' => $secteur_name,
            'sCodePostal' => $code_postal,
            'sIDutilisateurs' => $id
        ]);
        if ($response5->successful()){
          
            $message = $response5->json();
            if($message['message']=="ok"){
            return redirect()->route('get_adresses')->with('success', __('adresses_livraison.message_success'));
            }
            else{
                return redirect()->back()->with('message', __('favoris.erreur'))->withInput();
            }
            
        }else{
             return redirect()->back()->with('message',__('favoris.erreur'))->withInput();
        }

    }
    public function get_update_adresse($idadresse){
      //  $this->change_l();
      $this->actualiser_user();
        if (Session::get('user')){
            $user=Session::get('user');
            $id=$user['IDUtilisateurs'];
        } else{
          return redirect(url()->previous())->with('message', __('favoris.message_connection'));
        }

        $villes = Http::get('http://51.68.36.192/REST_BeldiLook/getVilles');
        if ($villes->successful()){
            $villes2 = $villes->json();
            //dd($tags2);
        }else{
            return redirect(url()->previous())->with('message', __('favoris.erreur'));
        }
//dd($villes2);
        Session::put('villes',$villes2['data']);


        
        $response5 = Http::post('http://51.68.36.192/REST_BeldiLook/recuperer_adresse_livraison_web', [
            'id' => $idadresse,
            'idutilisateur' => $id
        ]);
        if ($response5->successful()){
            $message = $response5->json();
            if($message['message']=="ok"){


            $villes=$villes2['data'];


                $found_key = array_search($message['id_ville'], array_column($villes, 'id'));

              //  $ville_name=$villes[$found_key]['displayName'];
        
                $secteurs=$villes[$found_key]['sectors'];
                
        
                




              return view('adresse_livraison.update_adresse',[
                'adresse' => $message,
                'villes' => $villes,
                'secteurs' => $secteurs
              ]);
            }else{
                return redirect(url()->previous())->with('message', __('favoris.erreur'));
            }
        }else{
            return redirect(url()->previous())->with('message', __('favoris.erreur'));
        }

    }
    public function update_adresse (Request $request,$idadresse){
      //  $this->change_l();
      $this->actualiser_user();
        if (Session::get('user')){
            $user=Session::get('user');
            $id=$user['IDUtilisateurs'];
        } else{
          return redirect()->back()->with('message', __('favoris.message_connection'));
        }
       

        $validated = $request->validate([
            'adresse' => 'required',
            'ville' => 'required',
            'secteur' => 'required',
            'code_postal' => 'required'
        ]);

        $adresse=$request->input('adresse');
        $ville=$request->input('ville');
        $code_postal=$request->input('code_postal');
        $secteur=$request->input('secteur');

        $villes = Session::get('villes');

        $found_key = array_search($ville, array_column($villes, 'id'));

        $ville_name=$villes[$found_key]['displayName'];

        $secteurs=$villes[$found_key]['sectors'];
        $found_key=array_search($secteur, array_column($secteurs, 'id'));

        $secteur_name=$secteurs[$found_key]['name'];


        $response5 = Http::post('http://51.68.36.192/REST_BeldiLook/modifier_adresselivraison_web', [
            'sAdresse' => $adresse,
            'sVille' => $ville_name,
            'sCodePostal' => $code_postal,
            'idutilisateur' => $id,
            'sIdadress' => $idadresse,
            'id_secteur' => $secteur,
            'sSecteur' => $secteur_name,
            'id_ville' => $ville
        ]);
        if ($response5->successful()){
          
            $message = $response5->json();
            //dd($message);
            if($message['message']=="ok"){
            return redirect()->route('get_adresses')->with('success', __('adresses_livraison.message_success_modifier'));
            }
            else{
                return redirect()->back()->with('message', __('favoris.erreur'))->withInput();
            }
            
        }else{
             return redirect()->back()->with('message', __('favoris.erreur'))->withInput();
        }


    }
    public function delete_adresse(Request $request)
    {
       // $this->change_l();
       $this->actualiser_user();
        if (Session::get('user')){
            $user=Session::get('user');
            $id=$user['IDUtilisateurs'];
        } else{
          return redirect()->back()->with('message', __('favoris.message_connection'));
        }
        $validated = $request->validate([
            'id_delete' => 'required'
        ]);
        $id_delete=$request->input('id_delete');

        $response5 = Http::post('http://51.68.36.192/REST_BeldiLook/suppression_adresse_livraison_web', [
            'id' => $id_delete,
            'idutilisateur' => $id,
        ]);
        if ($response5->successful()){
         $message = $response5->json();
        
          if($message['message']=="ok")
          {
            return redirect(route('get_adresses'))->with('success', __('adresses_livraison.message_success_supprimer'));
          }else{
            return redirect(route('get_adresses'))->with('message', __('favoris.erreur'));
          }
        }else{
            return redirect(route('get_adresses'))>with('message', __('favoris.erreur'));
        }

    }
    public function select_ville(Request $request)
    {

        $id_ville=$request->input('id_ville');
        $villes = Session::get('villes');
        if($villes!=null)
        {
            //return $id_ville;
            $found_key = array_search($id_ville, array_column($villes, 'id'));
           $secteurs=$villes[$found_key]['sectors'];
            return $secteurs;
        }else{
           return 'erreur';
        }
    }

}
