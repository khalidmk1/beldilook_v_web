<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use \Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
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
    public function get_home(Request $request){


       
        $this->actualiser_user();
        $id=0;
        $search = $request->input('search');
        $page=$request->input('page');

        $taille=$request->input('taille');

        $taille_filtre='';
        if($taille!=null){
            for($i=1;$i<=count($taille);$i++)
            {
               if($i<>count($taille))
               {
                  $taille_filtre.=$taille[$i-1].';';
               }else{
                  $taille_filtre.=$taille[$i-1];
               }
            }
        }
        
          //dd($taille_filtre);

       
        //dd($request->all());
        if ($search==null)
        {
            $search ='';
        }
        if (Session::get('user')){
            $user=Session::get('user');
            $id=$user['IDUtilisateurs'];
            //dd($user);
        }
        $page=intval($page);
        if($page==0){
            $page=1;
        }
        $response = Http::post('http://51.68.36.192/REST_BeldiLook/recuperer_articles', [
            'id_utilisateur' => $id,
            'par_categories' => '',
            'par_tags' => '',
            'par_couleurs' => '',
            'par_tailles' => $taille_filtre,
            'sort' => '',
            'par_lib_articles' => $search,
            'page' => $page,
            'type_operation' => '',


        ]);

          $jsonData = $response->json();



          $categories = Http::get('http://51.68.36.192/REST_BeldiLook/recuperer_categories');
          if ($categories->successful()){
              $categories2 = $categories->json();
          }else{
              return redirect(url()->previous())->with('message', __('favoris.erreur'));
          }
  
  
          $etat_tenues = Http::get('http://51.68.36.192/REST_BeldiLook/recuperer_etat_tenue');
          if ($etat_tenues->successful()){
              $etat_tenues2 = $etat_tenues->json();
          }else{
              return redirect(url()->previous())->with('message', __('favoris.erreur'));
          }


$colors=["#EFEFF4","#E6D0C5","#E2E2E2","#F0E6CC","#DCE6F1","#DAE8E3","#F44336","#E91E63","#673AB7","#2196F3","#00BCD4","#4CAF50","#CDDC39","#FFEB3B","#FF9800","#795548","#808000","#C0C000","#E6E600","#E1FF00","#E4F37E","#F3F1B4","#FAFECD","#4F7800","#6DA600","#008000","#00FF00","#99FF99","#C1FECA","#000080","#0000C0","#0000FF","#004FA0","#0080FF","#81BFFF","#B7EEFE","#800080","#8000FF","#A800FF","#C000C0","#FF00FF","#C040FF","#FF99FF","#000000","#303030","#505050","#808080","#E0E0E0","#FFFFFF","#800000","#C00000","#FF0000","#D74F00","#FF8000","#FFC040","#FFC080","#C0C0C0","#FFD700"];

          //dd($jsonData);


          $popups = Http::get('http://51.68.36.192/REST_BeldiLook/recuperer_popup');
          if ($popups->successful()){
              $popups2 = $popups->json();
          }else{
            $popups2=[];
          }



        return view('home',[
            'articles' => $jsonData,
            'page' => $page,
            'request' => $request,
            'taille' => $taille,
            'categories' => $categories2,
            'etats_tenues' => $etat_tenues2,
            'colors' => $colors,
            'popups' => $popups2

        ]);
    }
    public function get_welcome(){
        //$this->change_l();
        $this->actualiser_user();
        return view('welcome');
    }
   
    public function change_langue($lang)
    {
       // $this->change_l();
      //Session::put('lang',$lang);
      $this->actualiser_user();
      LaravelLocalization::setLocale($lang);
      $url = \LaravelLocalization::getLocalizedURL(App::getLocale(), \URL::previous());
return redirect($url);
      //return redirect(url()->previous());
    }

    public function change_favoris(Request $request){
       // $this->change_l();
       $this->actualiser_user();
        if (Session::get('user')){
            $user=Session::get('user');
            $id=$user['IDUtilisateurs'];
        } else{
return __('favoris.message_connection');
        }
        $idarticle = $request->input('idarticle');
        $response = Http::post('http://51.68.36.192/REST_BeldiLook/change_favoris_web', [
            'nId_article' => $idarticle,
            'nId_utilisateur' => $id,
        ]);
        if ($response->successful()){
            $reponse2 = $response->json();
            
            if ( $reponse2['message']=="like")
            {
                return __('favoris.like');
            }else{
                return __('favoris.dislike');
            }

            return __('favoris.erreur');
        }else {
            return __('favoris.erreur');
        }
        return __('favoris.erreur');
    }

    function get_boutique($page=1){
       // $this->change_l();
       $this->actualiser_user();
        $id=0;

        if (Session::get('user')){
            $user=Session::get('user');
            $id=$user['IDUtilisateurs'];
        }
        $page=intval($page);
        $response = Http::post('http://51.68.36.192/REST_BeldiLook/liste_boutiques', [
            'id_utilisateur' => $id,
            'page' => $page,

        ]);
        $jsonData = $response->json();

        return view('boutique',[
            'boutiques' => $jsonData,
            'page' => $page
        ]);
    }

    public function change_favoris_boutique(Request $request){
       // $this->change_l();
       $this->actualiser_user();
        if (Session::get('user')){
            $user=Session::get('user');
            $id=$user['IDUtilisateurs'];
        } else{
          return __('favoris.message_connection');
        }
        $idboutique = $request->input('idboutique');
        $response = Http::post('http://51.68.36.192/REST_BeldiLook/change_favoris_boutique_web', [
            'id_boutique' => $idboutique,
            'id_utilisateur' => $id,
        ]);
      
        if ($response->successful()){
            $reponse2 = $response->json();
            
            if ( $reponse2['message']=="like")
            {
                return __('favoris.like_boutique');
            }else{
                return __('favoris.dislike_boutique');
            }

            return __('favoris.erreur');
        }else {
            return __('favoris.erreur');
        }
        return __('favoris.erreur');
    }
    public function get_home_search()
    {
        //$this->change_l();

    }

    public function get_myaccount()
    {
        //$this->change_l();
        $this->actualiser_user();
        if (Session::get('user')){
            $user=Session::get('user');
            $id=$user['IDUtilisateurs'];
        } else{
          return redirect()->back()->with('message', __('favoris.message_connection'));
        }
//dd($user);
        $response = Http::post('http://51.68.36.192/REST_BeldiLook/Rechercher_utilisateur', [
            'sPar_type' => 'IDUtilisateurs',
            'sValeur' => $user['IDUtilisateurs'],
        ]);
        if ($response->successful()){
            $reponse2 = $response->json();

            
            $pays = Http::post('http://51.68.36.192/REST_BeldiLook/Afficher_Pays_web', [
                'page' => 0,
                'nom' => '',
            ]);

             $pays2=$pays->json();


             $villes = Http::get('http://51.68.36.192/REST_BeldiLook/getVilles');
             if ($villes->successful()){
                 $villes2 = $villes->json();
                 //dd($tags2);
             }else{
                 return redirect(url()->previous())->with('message', __('favoris.erreur'));
             }
     //dd($villes2);
             Session::put('villes',$villes2['data']);


             $secteurs=[];
            // dd($reponse2['id_secteur']);
             if($reponse2['id_secteur']!=''){
                $found_key = array_search($reponse2['id_ville'], array_column($villes2['data'], 'id'));

                //  $ville_name=$villes[$found_key]['displayName'];
          
                  $secteurs=$villes2['data'][$found_key]['sectors'];
             }
           

//dd($pays2);

            //dd($reponse2);
            return view('myaccount',[
                'data' => $reponse2 ,
                'pays' => $pays2,
                'villes' => $villes2['data'],
                'secteurs' => $secteurs
            ]);
        }

        return view('myaccount');
    }

    public function test (Request $request)
    {
        $name = $request->input('name');
        dd($name);
    }

    public function modifier_compte(Request $request)
    {
        //$this->change_l();
        $this->actualiser_user();
        if (Session::get('user')){
            $user=Session::get('user');
            $id=$user['IDUtilisateurs'];
        } else{
          return redirect('home')->with('message', __('favoris.message_connection'));
        }

        $validated = $request->validate([
            'image' => 'image',
            'prenom' => 'required',
            'nom' => 'required',
            'telephone' => 'required',
            'pays' => 'required',
            'ville' => 'required',
            'adresse' => 'required',
            'secteur' => 'required'
        ]);
        
if($request->input('adresse2')==null)
{
    $adresse2="";
}else{
    $adresse2= $request->input('adresse2');
}
        $secteur=$request->input('secteur');

        $villes = Session::get('villes');

        $found_key = array_search(request('ville'), array_column($villes, 'id'));

        $ville_name=$villes[$found_key]['displayName'];

        $secteurs=$villes[$found_key]['sectors'];
        $found_key=array_search($secteur, array_column($secteurs, 'id'));

        $secteur_name=$secteurs[$found_key]['name'];







if (request('image')==null)
{
    $base64='';
    $path='';
}else{
    $path=request('image')->store('profile','public');

    $path=str_replace('/','\\',$path);
$type = pathinfo($path, PATHINFO_EXTENSION);
$data = file_get_contents(public_path('\storage\\'.$path));
$base64 = base64_encode($data);
}
       



//dd($base64);


$response = Http::post('http://51.68.36.192/REST_BeldiLook/modifier_profile_web', [
    'IDUtilisateurs' => $id,
    'Nom' => request('nom'),
    'Prenom' => request('prenom'),
    'adresse1' => request('adresse'),
    'adresse2' => $adresse2,
    'Telephone' => request('telephone'),
    'Ville' => $ville_name,
    'Pays_Langue' => request('pays'),
    'Sexe' => request('sexe'),
    'sPhoto_Logo' => $base64,
    'Secteur' => $secteur_name,
    'id_secteur' => $secteur,
    'id_ville' => request('ville')
]);
if ($response->successful()){
    if($path!='')
    {
        unlink(public_path('\storage\\'.$path));
    }
    $reponse2 = $response->json();
   
    if ($reponse2['message']=="Erreur")
    {
        if($path!='')
        {
            unlink(public_path('\storage\\'.$path));
        }
        return redirect()->back()->with('message', __('favoris.erreur'))->withInput();
    }
    if ($reponse2['message']=="Utilisateur non trouve.")
    {
        if($path!='')
        {
            unlink(public_path('\storage\\'.$path));
        }
        return redirect()->back()->with('message', __('favoris.erreur'))->withInput();
    }
   

    $response3 = Http::post('http://51.68.36.192/REST_BeldiLook/Rechercher_utilisateur', [
        'sPar_type' => 'IDUtilisateurs',
        'sValeur' => $id,
    ]);
   
    if ($response3->successful()){
        $reponse4 = $response3->json();
        Session::put('user',$reponse4);
        return redirect('home')->with('success', __('myaccount.success'));
    }else{
        return redirect()->back()->with('message', __('favoris.erreur'))->withInput();
    }


    //dd($reponse2);
}else{
    if($path!='')
    {
        unlink(public_path('\storage\\'.$path));
    }
    return redirect()->back()->with('message', __('favoris.erreur'))->withInput();
}

    }

    public function details_produit($id){
       // $this->change_l();
       $this->actualiser_user();
        $response = Http::post('http://51.68.36.192/REST_BeldiLook/afficher_details_produit_web', [
            'sID_Produit' => $id,
        ]);
         if($response->successful()) {
            $reponse2 = $response->json();
            //dd($reponse2);
            if( $reponse2['publier']=="non")
            {
                return redirect(Route('home'));
            }
            $response_rate = Http::post('http://51.68.36.192/REST_BeldiLook/rate_etoile', [
                'id_article' => $id,
            ]);
             if($response_rate->successful()) {
                $response_rate2 = $response_rate->json();
                //dd($response_rate2);
             }else{
                return redirect(url()->previous())->with('message', __('favoris.erreur'));
             }


             $response_commentaire = Http::post('http://51.68.36.192/REST_BeldiLook/récupére_tout_commentaires', [
                'id_article' => $id,
            ]);
             if($response_commentaire->successful()) {

                $response_commentaire2 = $response_commentaire->json();
                //dd($response_commentaire2);
                
             }else{
                return redirect(url()->previous())->with('message', __('favoris.erreur'));
             }


            //dd($reponse2);
            return view('details_produit',[
                'article' => $reponse2,
                'idarticle' => $id,
                'rate' => $response_rate2,
                'commentaires' => $response_commentaire2
            ]);
         }else{
            return redirect(url()->previous())->with('message', __('favoris.erreur'));
         }

    }
    public function recuperer_couleur(Request $request){
        //$this->change_l();
        $this->actualiser_user();
        $validated = $request->validate([
            'id_article' => 'required',
            'taille' => 'required'
        ]);
        $taille_choisi=$request->input('taille');
        $id_produit = $request->input('id_article');
        $response = Http::post('http://51.68.36.192/REST_BeldiLook/afficher_details_tailles_web', [
            'sID_Produit' => $id_produit,
        ]);
         if($response->successful()) {
            $reponse2 = $response->json();

           $tailles=$reponse2['tabTaille_produit'];

           foreach($tailles as $taille)
           {
             if($taille['sLib_taille']==$taille_choisi)
             {
                $reponse2=$taille['tabCouleur'];
                return $reponse2;
             }
           }

            return $reponse2;
         }
    }
    public function news($page=1){
       // $this->change_l();
       $this->actualiser_user();
       $id='';
        if (Session::get('user')){
            $user=Session::get('user');
            $id=$user['IDUtilisateurs'];
        }
        $response = Http::post('http://51.68.36.192/REST_BeldiLook/nouveaute', [
            'id_utilisateur' => $id,
            'par_categories' => '',
            'par_couleurs' => '',
            'par_tailles' => '',
            'sort' => '',
            'par_lib_articles' => '',
            'page' => intval($page),
            'type_operation' => 'V'
        ]);
         if($response->successful()) {
            $reponse2 = $response->json();
           
         }else{
            return redirect(url()->previous())->with('message', __('favoris.erreur'));
         }
        

        return view('nouveaute',[
            'articles' =>$reponse2,
            'page' => $page
        ]);
    }

    public function achats()
    {
        $this->actualiser_user();
       // $this->change_l();
        if (Session::get('user')){
            $user=Session::get('user');
            $id=$user['IDUtilisateurs'];
        } else{
          return redirect()->back()->with('message', __('favoris.message_connection'));
        }
        
        $response = Http::post('http://51.68.36.192/REST_BeldiLook/Produit_Acheter_web', [
            'sIDUtilisateur' => $id
        ]);
         if($response->successful()) {
            $reponse2 = $response->json();
            //dd($reponse2);
         }else{
            return redirect(url()->previous())->with('message', __('favoris.erreur'));
         }


         
        return view('mes_achats',[
            'achats' => $reponse2
        ]);
    }
    public function commandes(){
       // $this->change_l();
       $this->actualiser_user();
        if (Session::get('user')){
            $user=Session::get('user');
            $id=$user['IDUtilisateurs'];
            if($user['Type']=='A')
            {
                return redirect(url()->previous())->with('message', __('favoris.erreur'));
            }
        } else{
          return redirect()->back()->with('message', __('favoris.message_connection'));
        }

        $response = Http::post('http://51.68.36.192/REST_BeldiLook/Produit_Acheter_vendeur_web', [
            'sIDUtilisateur' => $id,
            'date_debut' => '',
            'date_fin' => '',
            'statut' => ''
        ]);
         if($response->successful()) {
            $reponse2 = $response->json();
            //dd($reponse2);
         }else{
            return redirect(url()->previous())->with('message', __('favoris.erreur'));
         }


         
        return view('mes_commandes',[
            'commandes' => $reponse2
        ]);
    }
    public function annuler_commande(Request $request){
      //  $this->change_l();
      $this->actualiser_user();
        if (Session::get('user')){
            $user=Session::get('user');
            $id=$user['IDUtilisateurs'];
        } else{
          return redirect('login')->with('message', __('favoris.message_connection'));
        }
        $validated = $request->validate([
            'id_cancel' => 'required'
        ]);
        $id_commande=$request->input('id_cancel');
        $response = Http::post('http://51.68.36.192/REST_BeldiLook/annuler_commande_web', [
            'sIDUtilisateur' => $id,
            'id_commande' => $id_commande
        ]);
         if($response->successful()) {
            $reponse2 = $response->json();
            if($reponse2['message']=='erreur'){
                return redirect(url()->previous())->with('message', __('favoris.erreur'));
            }
            if($reponse2['message']=='no'){
                return redirect(url()->previous())->with('message', __('favoris.erreur'));
            }
            if($reponse2['message']=='ok'){
                return redirect(url()->previous())->with('success', __('mes_achats.success_annulation'));
            }
         }else{
            return redirect(url()->previous())->with('message', __('favoris.erreur'));
         }


    }
    public function ajouter_reclamation(Request $request){
       // $this->change_l();
       $this->actualiser_user();
        if (Session::get('user')){
            $user=Session::get('user');
            $id=$user['IDUtilisateurs'];
        } else{
          return redirect('login')->with('message', __('favoris.message_connection'));
        }
        $validated = $request->validate([
            'id_commande' => 'required',
            'sujet' => 'required',
            'description' => 'required'
        ]);
        $id_commande=$request->input('id_commande');
        $sujet=$request->input('sujet');
        $description=$request->input('description');
        $response = Http::post('http://51.68.36.192/REST_BeldiLook/ajouter_reclamation_web', [
            'idutilisateur' => $id,
            'idcommande' => $id_commande,
            'sujet' => $sujet,
            'description' => $description
        ]);
         if($response->successful()) {
            $reponse2 = $response->json();
            if($reponse2['message']=='erreur'){
                return redirect(url()->previous())->with('message', __('favoris.erreur'));
            }
            if($reponse2['message']=='ok'){
                return redirect(url()->previous())->with('success', __('mes_achats.success_reclamation'));
            }
         }else{
            return redirect(url()->previous())->with('message', __('favoris.erreur'));
         }

    }
    public function suivi_achat($id_commande){
        $this->actualiser_user();
        if (Session::get('user')){
            $user=Session::get('user');
            $id=$user['IDUtilisateurs'];
        } else{
          return redirect('login')->with('message', __('favoris.message_connection'));
        }

        $response = Http::post('http://51.68.36.192/REST_BeldiLook/Suivi_Commande_web', [
            'id_utilisateur' => $id,
            'IDCommande' => $id_commande,
            'iduser' => $id
        ]);
         if($response->successful()) {
            $reponse2 = $response->json();
            //dd($reponse2);
            if($reponse2['message']=='erreur'){
                return redirect(url()->previous())->with('message', __('favoris.erreur'));
            }
            if($reponse2['message']=='ok'){


                $response3 = Http::post('http://51.68.36.192/REST_BeldiLook/Détailles_SuiviLivraison_web', [
                    'id_utilisateur' => $id,
                    'IDCommande' => $id_commande
                ]);


                if($response3->successful()) {
                    $reponse4 = $response3->json();
                    //dd($reponse4);
                    if(count($reponse4)==0){
                        return redirect(url()->previous())->with('message', __('favoris.erreur'));
                    }
                    if(count($reponse4)>0){
                        //dd($reponse4);
                        return view('suivi_achats',[
                            'commande' => $reponse2,
                            'details_commande' => $reponse4,
                            'IDCommande' => $id_commande
                        ]);
                    }
                }
                    else{
                        return redirect(url()->previous())->with('message', __('favoris.erreur'));
                    }
               
            }
         }else{
           
            return redirect(url()->previous())->with('message', __('favoris.erreur'));
         }



    }

    public function ajouter_avis(Request $request){
        $this->actualiser_user();
        if (Session::get('user')){
            $user=Session::get('user');
            $id=$user['IDUtilisateurs'];
        } else{
          return redirect('login')->with('message', __('favoris.message_connection'));
        }
         

        $validated = $request->validate([
            'id_commande' => 'required',
            'nb_etoile' => 'required|integer|between:1,5',
            'id_article' => 'required',
            'commentaire' => 'required'
        ]);
        $id_commande=$request->input('id_commande');
        $nb_etoile=$request->input('nb_etoile');
        $id_article=$request->input('id_article');
        $commentaire=$request->input('commentaire');
       
        $response = Http::post('http://51.68.36.192/REST_BeldiLook/Ajouter_commentaire_web', [
            'sIDutilisateurs' => $id,
            'commande' => $id_commande,
            'commentaire' => $commentaire,
            'id_article' => $id_article,
            'nb_etoile' => $nb_etoile
        ]);
         if($response->successful()) {
            $reponse2 = $response->json();
            if($reponse2['message']=='erreur'){
                return redirect(url()->previous())->with('message', __('favoris.erreur'));
            }
            if($reponse2['message']=='ok'){
                return redirect(url()->previous())->with('success', __('mes_achats.success_reclamation'));
            }
         }else{
            return redirect(url()->previous())->with('message', __('favoris.erreur'));
         } 

    }
    public function page_vendeur($id_vendeur,Request $request)
    {
        $this->actualiser_user();
        $id=0;
        if (Session::get('user')){
            $user=Session::get('user');
            $id=$user['IDUtilisateurs'];
        }
        $page=$request->input('page');
        $page=intval($page);
        if($page==0){
            $page=1;
        }


        $response55 = Http::post('http://51.68.36.192/REST_BeldiLook/recuperer_nom_vendeur_2_web', [
            'id_utilisateur' => $id_vendeur
        ]);

        if($response55->successful()) {
            $reponse59 = $response55->json();
         }else{
            return redirect(url()->previous())->with('message', __('favoris.erreur'));
         }



        $response = Http::post('http://51.68.36.192/REST_BeldiLook/Produit_Vendeur', [
            'id_utilisateur' => $id_vendeur,
            'iduser' => $id,
            'par_categories' => '',
            'par_couleurs' => '',
            'par_tailles' => '',
            'sort' => '',
            'par_lib_articles' => '',
            'page' => $page,
            'type_operation' => ''
        ]);
         if($response->successful()) {
            $reponse2 = $response->json();
         }else{
            return redirect(url()->previous())->with('message', __('favoris.erreur'));
         }

       return view('page_vendeur',[
        'articles' => $reponse2,
        'page' => $page,
        'request' => $request,
        'vendeur' => $reponse59
       ]);
    }


    public function suivi_commande($id_commande){
        $this->actualiser_user();
        if (Session::get('user')){
            $user=Session::get('user');
            $id=$user['IDUtilisateurs'];
        } else{
          return redirect('login')->with('message', __('favoris.message_connection'));
        }

        $response = Http::post('http://51.68.36.192/REST_BeldiLook/suivi_commande_web_vendeur', [
            'id_utilisateur' => $id,
            'IDCommande' => $id_commande,
            'iduser' => $id
        ]);
         if($response->successful()) {
            $reponse2 = $response->json();
            //dd($reponse2);
            if($reponse2['message']=='erreur'){
               
                return redirect(url()->previous())->with('message', __('favoris.erreur'));
            }
            if($reponse2['message']=='ok'){

                
                $response3 = Http::post('http://51.68.36.192/REST_BeldiLook/Détailles_SuiviLivraison_Vendeur_web', [
                    'IDVendeur' => $id,
                    'IDCommande' => $id_commande
                ]);


                if($response3->successful()) {
                    $reponse4 = $response3->json();
                    //dd($reponse4);
                    
                    if(count($reponse4)==0){
                        
                        return redirect(url()->previous())->with('message', __('favoris.erreur'));
                    }
                    if(count($reponse4)>0){
                        //dd($reponse4);
                        return view('suivi_commande',[
                            'commande' => $reponse2,
                            'details_commande' => $reponse4,
                            'IDCommande' => $id_commande
                        ]);
                    }
                }
                    else{
                        //$reponse4 = $response3->json();
                        //dd($reponse4);
                        return redirect(url()->previous())->with('message', __('favoris.erreur'));
                    }
               
            }
         }else{
           
            return redirect(url()->previous())->with('message', __('favoris.erreur'));
         }



    }

    public function chat_support(){
        $this->actualiser_user();
        if (Session::get('user')){
            $user=Session::get('user');
            $id=$user['IDUtilisateurs'];
        } else{
          return redirect('login')->with('message', __('favoris.message_connection'));
        }

        
        $response = Http::post('http://51.68.36.192/REST_BeldiLook/liste_message_support', [
            'id_utilisateur' => $id
        ]);
         if($response->successful()) {
            $reponse2 = $response->json();
            //dd($reponse2);
         }else{
            return redirect(url()->previous())->with('message', __('favoris.erreur'));
         }


        return view('chat_support',[
            'messages' => $reponse2
        ]);
    }

    public function chat_support_api(){
      
        if (Session::get('user')){
            $user=Session::get('user');
            $id=$user['IDUtilisateurs'];
        } else{
          return "erreur";
        }

        
        $response = Http::post('http://51.68.36.192/REST_BeldiLook/liste_message_support', [
            'id_utilisateur' => $id
        ]);
         if($response->successful()) {
            $reponse2 = $response->json();
            return $reponse2;
         }else{
            return $reponse2;
         }


        
    }

    public function send_message(Request $request){
        if (Session::get('user')){
            $user=Session::get('user');
            $id=$user['IDUtilisateurs'];
        } else{
          return "erreur";
        }

        $validated = $request->validate([
            'msg' => 'required'
        ]);
    
$msg=$request->input('msg');


$response = Http::post('http://51.68.36.192/REST_BeldiLook/envoyer_message_support', [
    'expediteur' => $id,
    'msg' => $msg,
    'image2' => ''
]);
 if($response->successful()) {
    $reponse2 = $response->json();
    return 'succes';
 }else{
    return 'echec';
 }

    }


    public function send_message_image(Request $request){
        if (Session::get('user')){
            $user=Session::get('user');
            $id=$user['IDUtilisateurs'];
        } else{
          return "erreur";
        }

        $validated = $request->validate([
            'imagemsg' => 'required|image'
        ]);
    
$msg=$request->input('commentaire');

    $path=request('imagemsg')->store('profile','public');

    $path=str_replace('/','\\',$path);
$type = pathinfo($path, PATHINFO_EXTENSION);
$data = file_get_contents(public_path('\storage\\'.$path));
$base64 = base64_encode($data);


$response = Http::post('http://51.68.36.192/REST_BeldiLook/envoyer_message_support', [
    'expediteur' => $id,
    'msg' => $msg,
    'image2' => $base64
]);
 if($response->successful()) {
    if($path!='')
    {
        unlink(public_path('\storage\\'.$path));
    }
    $reponse2 = $response->json();
    return 'succes';
 }else{
    if($path!='')
    {
        unlink(public_path('\storage\\'.$path));
    }
    return 'echec';
 }

    }

    public function mes_offres_ventes(Request $request){
        $this->actualiser_user();
        if (Session::get('user')){
            $user=Session::get('user');
            $id=$user['IDUtilisateurs'];
        } else{
          return redirect(Route('login'))->with('message', __('favoris.message_connection'));
        }

        $page=$request->input('page');
        $page=intval($page);
        if($page==0){
            $page=1;
        }

        $response = Http::post('http://51.68.36.192/REST_BeldiLook/mes_offres', [
            'id_utilisateur' => $id,
            'par_categories' => '',
            'par_couleurs' => '',
            'par_tailles' => '',
            'sort' => '',
            'par_lib_articles' => '',
            'page' => $page,
            'type_operation' => 'V'
        ]);
         if($response->successful()) {

            $reponse2 = $response->json();
            return view('mes_offres_ventes',[
                'articles' => $reponse2,
                'page' => $page,
                'request' => $request
            ]);
         }else{
            return redirect(url()->previous())->with('message', __('favoris.erreur'));
         }

    }

    public function delete_article(Request $request){
        $this->actualiser_user();
        if (Session::get('user')){
            $user=Session::get('user');
            $id=$user['IDUtilisateurs'];
        } else{
          return redirect(Route('login'))->with('message', __('favoris.message_connection'));
        }
        $validated = $request->validate([
            'idarticle' => 'required'
        ]);
        $id_article=$request->input('idarticle');
        $response = Http::post('http://51.68.36.192/REST_BeldiLook/supprimer_produit_web', [
            'id_utilisateur' => $id,
            'id_article' => $id_article
        ]);
         if($response->successful()) {

            $reponse2 = $response->json();
            if($reponse2['message']=='ok'){
                return redirect(url()->previous())->with('success', __('offre_vente.suppression_success'));
            }else{
                return redirect(url()->previous())->with('message', __('favoris.erreur'));
            }
         }else{
            return redirect(url()->previous())->with('message', __('favoris.erreur'));
         }
    }
    public function boutique_une()
    {
        $this->actualiser_user();
        $reponse4;
        $response556;
        $response = Http::get('http://51.68.36.192/REST_BeldiLook/boutique_a_la_une_web');
         if($response->successful()) {
            $reponse2 = $response->json();
            //dd($reponse2);
            
if(count($reponse2)>0){
            $response3 = Http::post('http://51.68.36.192/REST_BeldiLook/Articles_Utilisateur_Une_web', [
                'id' => $reponse2[0]['id_utilisateur'],
            ]);
            if($response3->successful()) {
                $reponse4 = $response3->json();

            }else{
                return redirect(url()->previous())->with('message', __('favoris.erreur'));
            }


                $response55 = Http::post('http://51.68.36.192/REST_BeldiLook/Rechercher_utilisateur', [
                    'sPar_type' => 'IDUtilisateurs',
                    'sValeur' => $reponse2[0]['id_utilisateur'],
                ]);
                if ($response55->successful()){
                    $response556 = $response55->json();
                }

            }


                return view('boutique_une',[
                    'boutiques' => $reponse2,
                    'articles' => $reponse4,
                    'user' => $response556
                ]);
           

         }else{
            return redirect(url()->previous())->with('message', __('favoris.erreur'));
         }
    }
    public function produit_story(Request $request)
    {
        //$this->actualiser_user();
        $validated = $request->validate([
            'id_utilisateur' => 'required'
        ]);
        $id=$request->input('id_utilisateur');
        $response = Http::post('http://51.68.36.192/REST_BeldiLook/produit_story', [
            'id_utilisateur' => $id
        ]);
         if($response->successful()) {

            $reponse2 = $response->json();
            return $reponse2;
         }

    }

    public function get_produit_story(Request $request)
    {
        $this->actualiser_user();
       // $response556;
        $validated = $request->validate([
            'id_utilisateur' => 'required'
        ]);
        $id=$request->input('id_utilisateur');
        $response = Http::post('http://51.68.36.192/REST_BeldiLook/Articles_Utilisateur_Une_web', [
            'id' => $id
        ]);
         if($response->successful()) {

            $reponse2 = $response->json();


    $response55 = Http::post('http://51.68.36.192/REST_BeldiLook/Rechercher_utilisateur', [
        'sPar_type' => 'IDUtilisateurs',
        'sValeur' => $id,
    ]);
    if ($response55->successful()){
        $response556 = $response55->json();
    }



            return view('details_produit_story',[
                'articles' => $reponse2,
                'user' => $response556
            ]);
         }
    }
    public function boutiqua($id_boutique)
    {
        $this->actualiser_user();
        $response55 = Http::post('http://51.68.36.192/REST_BeldiLook/recuperer_nom_vendeur_2_web', [
            'id_utilisateur' => $id_boutique
        ]);
        if ($response55->successful()){
            $response556 = $response55->json();
            //dd($response556);
            if($response556['message']=='vendeur'){
                return redirect(route('page_vendeur',$id_boutique));
            }
            if($response556['message']=='acheteur'){
                return redirect(route('home'));
            }
            
            if($response556['message']=='user not found'){
                return redirect(route('home'));
            }
            if($response556['message']=='boutique'){
                if($response556['pack']==''){
                    return redirect(route('page_vendeur',$id_boutique));
                }
            }
        }else{
           
            return redirect(url()->previous())->with('message', __('favoris.erreur'));
        }




        
        $response1 = Http::post('http://51.68.36.192/REST_BeldiLook/trois_produit_vendeur', [
            'id_utilisateur' => $id_boutique,
            'par_type_operation' => 'V',
            'iduser' => $id_boutique
        ]);
        if ($response1->successful()){
            $response2 = $response1->json();
          
        }else{
         
            return redirect(url()->previous())->with('message', __('favoris.erreur'));
        }
          
        $response3 = Http::post('http://51.68.36.192/REST_BeldiLook/rate_Utilisateur', [
            'IDUtilisateurs' => $id_boutique
        ]);
        if ($response3->successful()){
            $response4 = $response3->json();
          
        }else{
         
            return redirect(url()->previous())->with('message', __('favoris.erreur'));
        }


        $response6 = Http::post('http://51.68.36.192/REST_BeldiLook/Récupérer_BoutiqueInfo', [
            'sIDUtilisateur' => $id_boutique
        ]);
        if ($response6->successful()){
            $response8 = $response6->json();
          
        }else{
         
            return redirect(url()->previous())->with('message', __('favoris.erreur'));
        }


//dd($response2);
       return view('boutiqua',[
        'boutique' => $response556,
        'produits' => $response2,
        'rate_user' => $response4,
        'boutique_info' => $response8,
        'id_boutique' => $id_boutique
       ]);
    }

    public function commentaires($id_boutique,Request $request){


        $this->actualiser_user();
        $page=$request->input('page');
        $page=intval($page);
        if($page==0){
            $page=1;
        }



        $response55 = Http::post('http://51.68.36.192/REST_BeldiLook/recuperer_nom_vendeur_2_web', [
            'id_utilisateur' => $id_boutique
        ]);
        if ($response55->successful()){
            $response556 = $response55->json();
            //dd($response556);
            if($response556['message']=='vendeur'){
                return redirect(route('home'));
            }
            if($response556['message']=='acheteur'){
                return redirect(route('home'));
            }
            
            if($response556['message']=='user not found'){
                return redirect(route('home'));
            }
            if($response556['message']=='boutique'){
                if($response556['pack']==''){
                    return redirect(route('home'));
                }
            }
        }else{
           
            return redirect(url()->previous())->with('message', __('favoris.erreur'));
        }


        $response1 = Http::post('http://51.68.36.192/REST_BeldiLook/recuperer_tout_commentaire_vendeur', [
            'id_article' => $id_boutique,
            'page' => $page
        ]);
        if ($response1->successful()){
            $response2 = $response1->json();
        }else{
           
            return redirect(url()->previous())->with('message', __('favoris.erreur'));
        }



        return view('commentaire_boutique',[
            'request' => $request,
            'commentaires' => $response2,
            'page' => $page
        ]);


    }
    public function actualites($id_boutique,Request $request)
    {
        $this->actualiser_user();
        $page=$request->input('page');
        $page=intval($page);
        if($page==0){
            $page=1;
        }



        $response55 = Http::post('http://51.68.36.192/REST_BeldiLook/recuperer_nom_vendeur_2_web', [
            'id_utilisateur' => $id_boutique
        ]);
        if ($response55->successful()){
            $response556 = $response55->json();
            //dd($response556);
            if($response556['message']=='vendeur'){
                return redirect(route('home'));
            }
            if($response556['message']=='acheteur'){
                return redirect(route('home'));
            }
            
            if($response556['message']=='user not found'){
                return redirect(route('home'));
            }
            if($response556['message']=='boutique'){
                if($response556['pack']==''){
                    return redirect(route('home'));
                }
            }
        }else{
           
            return redirect(url()->previous())->with('message', __('favoris.erreur'));
        }


        $response1 = Http::post('http://51.68.36.192/REST_BeldiLook/Afficher_LesBlogs', [
            'sIDUtilisateur' => $id_boutique,
            'page' => $page
        ]);
        if ($response1->successful()){
            $response2 = $response1->json();
        }else{
           
            return redirect(url()->previous())->with('message', __('favoris.erreur'));
        }

        return view('actualites',[
           'actualites' => $response2,
           'request' => $request,
           'page' => $page
        ]);

    }
    public function ajout_produit()
    {
        //$this->actualiser_user();

        $text_terme="";
        if (Session::get('user')){
            $user=Session::get('user');
            if($user['Type']=='A')
            {
              return redirect(Route('home'));
            }
            $id=$user['IDUtilisateurs'];
        } else{
          return redirect(Route('login'))->with('message', __('favoris.message_connection'));
        }

        $response1 = Http::get('http://51.68.36.192/REST_BeldiLook/recuperer_categories');
        if ($response1->successful()){
            $response2 = $response1->json();
        }else{
            return redirect(url()->previous())->with('message', __('favoris.erreur'));
        }

        $response3 = Http::get('http://51.68.36.192/REST_BeldiLook/recuperer_tissus');
        if ($response3->successful()){
            $response4 = $response3->json();
        }else{
            return redirect(url()->previous())->with('message', __('favoris.erreur'));
        }

        $response5 = Http::get('http://51.68.36.192/REST_BeldiLook/recuperer_etat_tenue');
        if ($response5->successful()){
            $response6 = $response5->json();
        }else{
            return redirect(url()->previous())->with('message', __('favoris.erreur'));
        }

        $response_tag = Http::get('http://51.68.36.192/REST_BeldiLook/recuperer_tag');
        if ($response_tag->successful()){
            $response_tag2 = $response_tag->json();
        }else{
            return redirect(url()->previous())->with('message', __('favoris.erreur'));
        }

        $response_comission = Http::get('http://51.68.36.192/REST_BeldiLook/taux_comission');
        if ($response_comission->successful()){
            $response_comission2 = $response_comission->json();
        }else{
            return redirect(url()->previous())->with('message', __('favoris.erreur'));
        }

        $response_terme = Http::post('http://51.68.36.192/REST_BeldiLook/Utilisateur_TermsCondition',[
            'sIdUtilisateur' => $id
        ]);
        if ($response_terme->successful()){
            $response_terme2 = $response_terme->json();

            $recupere_terme2="";
            if($response_terme2['message']=="non")
            {

                if(App::getlocale()=="ar")
                {
                    $langue ="ar";
                }
                if(App::getlocale()=="fr")
                {
                    $langue ="fr";
                }
                if(App::getlocale()=="en")
                {
                    $langue ="an";
                }
                $recupere_terme = Http::post('http://51.68.36.192/REST_BeldiLook/recupere_terme',[
                    'lg' => $langue
                ]);
                if ($recupere_terme->successful()){
                    $recupere_terme2 = $recupere_terme->json();
                    $text_terme=$recupere_terme2['terme'];

                }else{
                    return redirect(url()->previous())->with('message', __('favoris.erreur'));
                }



            }

        }else{
            return redirect(url()->previous())->with('message', __('favoris.erreur'));
        }



        return view('ajout_produit',[
            'categories' => $response2,
            'tissues' => $response4,
            'etats' => $response6,
            'tags1' => $response_tag2['tag1'],
            'tags2' => $response_tag2['tag2'],
            'tags3' => $response_tag2['tag3'],
            'tags4' => $response_tag2['tag4'],
            'taux' => $response_comission2,
            'terme' => $response_terme2,
            'text_terme' => $text_terme
        ]);
    }

    public function ajouter_produit_api(Request $request)
    {
        $this->actualiser_user();
        if (Session::get('user')){
            $user=Session::get('user');
            $id=$user['IDUtilisateurs'];
        } else{
          return ( __('favoris.message_connection'));
        }

        $validated = $request->validate([
            'data' => 'required'
        ]);
         $data=$request->input('data');


         $response1 = Http::post('http://51.68.36.192/REST_BeldiLook/ajouter_produit_web', [
            'nId_utilisateur' => $id,
            'data' => $data
        ]);
        if ($response1->successful()){
            $response2 = $response1->json();
            return  $response2['message'];
        }else{
           
            $response2 = $response1->json();
            return  $response2;
        }


    }

    public function api_accepte_terme()
    {
      
        if (Session::get('user')){
            $user=Session::get('user');
            $id=$user['IDUtilisateurs'];
        } else{
          return ( __('favoris.message_connection'));
        }

        $response1 = Http::post('http://51.68.36.192/REST_BeldiLook/Update_UtilisateurTerms', [
            'sIdUtilisateur' => $id
        ]);
        if ($response1->successful()){
            $response2 = $response1->json();
            return  $response2['message'];
        }else{
           
            $response2 = $response1->json();
            return  $response2;
        }
    }
    public function gerer_ma_boutique()
    {
        $this->actualiser_user();
        if (Session::get('user')){
            $user=Session::get('user');
            if($user['Type']=='A')
            {
              return redirect(Route('home'));
            }
            $id=$user['IDUtilisateurs'];
        } else{
          return redirect(Route('login'))->with('message', __('favoris.message_connection'));
        }


        $pack = Http::post('http://51.68.36.192/REST_BeldiLook/notif_finabonne',[
            'sIDUtilisateur' => $id
        ]);
        if ($pack->successful()){
            $pack2 = $pack->json();
          if($pack2['pack']=='aucun')
          {
           // return redirect(Route('home'));
          }

        }else{
            return redirect(url()->previous())->with('message', __('favoris.erreur'));
        }

        $response1 = Http::post('http://51.68.36.192/REST_BeldiLook/trois_produit_vendeur', [
            'id_utilisateur' => $id,
            'par_type_operation' => 'V',
            'iduser' => $id
        ]);
        if ($response1->successful()){
            $response2 = $response1->json();
          
        }else{
         
            return redirect(url()->previous())->with('message', __('favoris.erreur'));
        }


        $response55 = Http::post('http://51.68.36.192/REST_BeldiLook/recuperer_nom_vendeur_2_web', [
            'id_utilisateur' => $id
        ]);
        if ($response55->successful()){
            $response556 = $response55->json();
            //dd($response556);
        }else{
           
            return redirect(url()->previous())->with('message', __('favoris.erreur'));
        }

        $info_social = Http::post('http://51.68.36.192/REST_BeldiLook/recupere_infosocial', [
            'iduser' => $id
        ]);
        if ($info_social->successful()){
            $info_social2 = $info_social->json();
            //dd($info_social2);
        }else{
           
            return redirect(url()->previous())->with('message', __('favoris.erreur'));
        }



        $rate_user = Http::post('http://51.68.36.192/REST_BeldiLook/rate_Utilisateur', [
            'IDUtilisateurs' => $id
        ]);
        if ($rate_user->successful()){
            $rate_user2 = $rate_user->json();
          
        }else{
         
            return redirect(url()->previous())->with('message', __('favoris.erreur'));
        }





        return view('gerer_ma_boutique',[
            'pack' => $pack2,
            'produits' => $response2,
            'iduser' => $id,
            'boutique' => $response556,
            'info_social' => $info_social2,
            'rate_user' => $rate_user2
        ]);
    }
    public function modifier_ma_boutique(Request $request)
    {
        $this->actualiser_user();

        if (Session::get('user')){
            $user=Session::get('user');
            if($user['Type']=='A')
            {
              return redirect(Route('home'));
            }
            $id=$user['IDUtilisateurs'];
        } else{
          return redirect(Route('login'))->with('message', __('favoris.message_connection'));
        }

        $pack = Http::post('http://51.68.36.192/REST_BeldiLook/notif_finabonne',[
            'sIDUtilisateur' => $id
        ]);
        if ($pack->successful()){
            $pack2 = $pack->json();
          if($pack2['pack']=='aucun')
          {
           // return redirect(Route('home'));
          }

        }else{
            return redirect(url()->previous())->with('message', __('favoris.erreur'));
        }


        if($pack2['pack']=='GOLD')
        {
            $facebook=$request->input('facebook');
            $youtube=$request->input('youtube');
            $snapshat=$request->input('snapshat');
            $linkdin=$request->input('linkdin');
            $instagram=$request->input('instagram');
            $tiktok=$request->input('tiktok');
            $visite=$request->input('visite');
        }
        if($pack2['pack']=='GOLD' || $pack2['pack']=='SILVER')
        {
        $photol1 =$request->input('photol1');
        $photol2 =$request->input('photol2');
        $photol3 =$request->input('photol3');
        }


        if($pack2['pack']=='GOLD')
        {
        $modifgold = Http::post('http://51.68.36.192/REST_BeldiLook/ajout_details_gold_web',[
            'id_utilisateur' => $id,
            'image1' => $photol1,
            'image2' => $photol2,
            'image3' => $photol3,
            'facebook' => $facebook,
            'instagram' => $instagram,
            'linkdin' => $linkdin,
            'snapshat' => $snapshat,
            'youtube' => $youtube,
            'tiktok' => $tiktok,
            'visite_3d' => $visite
        ]);
        if ($modifgold->successful()){
            $modifgold2 = $modifgold->json();
            return redirect(url()->previous())->with('success', 'Les modifications effectuées sont en cours de modération');

        }else{
            return redirect(url()->previous())->with('message', __('favoris.erreur'));
        }
    }



    if($pack2['pack']=='SILVER')
    {
    $modifsilver = Http::post('http://51.68.36.192/REST_BeldiLook/ajout_images_bronzesilver_web',[
        'id_utilisateur' => $id,
        'image1' => $photol1,
        'image2' => $photol2,
        'image3' => $photol3
    ]);
    if ($modifsilver->successful()){
        $modifsilver2 = $modifsilver->json();
        return redirect(url()->previous())->with('success', __('boutiqua.message_success'));

    }else{
        $modifsilver2 = $modifsilver->json();
        //dd($modifsilver2);
        return redirect(url()->previous())->with('message', __('favoris.erreur'));
    }
}





}
public function gestion_actualites(Request $request)
{
    $this->actualiser_user();
    $page=$request->input('page');
    $page=intval($page);
    if($page==0){
        $page=1;
    }

    if (Session::get('user')){
        $user=Session::get('user');
        $id=$user['IDUtilisateurs'];
    } else{
        return redirect(Route('login'))->with('message', __('favoris.message_connection'));
    }

 

    $pack = Http::post('http://51.68.36.192/REST_BeldiLook/notif_finabonne',[
        'sIDUtilisateur' => $id
    ]);
    if ($pack->successful()){
        $pack2 = $pack->json();
      if($pack2['pack']=='aucun')
      {
        return redirect(Route('home'));
      }

    }else{
        return redirect(url()->previous())->with('message', __('favoris.erreur'));
    }


    $response1 = Http::post('http://51.68.36.192/REST_BeldiLook/Afficher_LesBlogs', [
        'sIDUtilisateur' => $id,
        'page' => $page
    ]);
    if ($response1->successful()){
        $response2 = $response1->json();
    }else{
       
        return redirect(url()->previous())->with('message', __('favoris.erreur'));
    }

    return view('gestion_actualites',[
       'actualites' => $response2,
       'request' => $request,
       'page' => $page
    ]);
}
public function add_blog(Request $request){
    
    if (Session::get('user')){
        $user=Session::get('user');
        $id=$user['IDUtilisateurs'];
    } else{
      return ( __('favoris.message_connection'));
    }
    $validated = $request->validate([
        'image' => 'required',
        'type' => 'required',
        'lien' => 'required'
    ]);
     $image=$request->input('image');
     $type=$request->input('type');
     $lien=$request->input('lien');

     if($type=="Aucun")
     {
        return "erreur";
     }



    $response1 = Http::post('http://51.68.36.192/REST_BeldiLook/ajout_blog_web', [
        'id_utilisateur' => $id,
        'image' => $image,
        'type' => $type,
        'lien' => $lien
    ]);
    if ($response1->successful()){
        $response2 = $response1->json();
        return $response2['message'];
    }else{
        return "erreur";
    }


}
public function gestion_actualites_api(Request $request)
{

    $page=$request->input('page');
    $page=intval($page);
    if($page==0){
        $page=1;
    }

    if (Session::get('user')){
        $user=Session::get('user');
        $id=$user['IDUtilisateurs'];
    } else{
        return  'erreur';
    }

 

    $pack = Http::post('http://51.68.36.192/REST_BeldiLook/notif_finabonne',[
        'sIDUtilisateur' => $id
    ]);
    if ($pack->successful()){
        $pack2 = $pack->json();
      if($pack2['pack']=='aucun')
      {
        return redirect(Route('home'));
      }

    }else{
        return  'erreur';
    }


    $response1 = Http::post('http://51.68.36.192/REST_BeldiLook/Afficher_LesBlogs', [
        'sIDUtilisateur' => $id,
        'page' => $page
    ]);
    if ($response1->successful()){
        $response2 = $response1->json();
    }else{
       
        return  'erreur';
    }

    return view('gestion_actualites_api',[
       'actualites' => $response2,
       'request' => $request,
       'page' => $page
    ]);
}


public function edit_blog(Request $request){

    if (Session::get('user')){
        $user=Session::get('user');
        $id=$user['IDUtilisateurs'];
    } else{
      return ( __('favoris.message_connection'));
    }
    $validated = $request->validate([
        'image' => 'required',
        'type' => 'required',
        'lien' => 'required',
        'idblog' => 'required'
    ]);
     $image=$request->input('image');
     $type=$request->input('type');
     $lien=$request->input('lien');
     $idblog=$request->input('idblog');

     if($type=="Aucun")
     {
        return "erreur";
     }



    $response1 = Http::post('http://51.68.36.192/REST_BeldiLook/modifier_blog_web', [
        'id_utilisateur' => $id,
        'image' => $image,
        'type' => $type,
        'lien' => $lien,
        'idblog' => $idblog
    ]);
    if ($response1->successful()){
        $response2 = $response1->json();
        return $response2['message'];
    }else{
        return "erreur";
    }


}
public function delete_blog(Request $request)
{
    if (Session::get('user')){
        $user=Session::get('user');
        $id=$user['IDUtilisateurs'];
    } else{
      return ( __('favoris.message_connection'));
    }
    $validated = $request->validate([
        'id_blog' => 'required'
    ]);
   
     $idblog=$request->input('id_blog');

  



    $response1 = Http::post('http://51.68.36.192/REST_BeldiLook/supprimer_blog_web', [
        'id_utilisateur' => $id,
        'idblog' => $idblog
    ]);
    if ($response1->successful()){
        $response2 = $response1->json();
        return $response2['message'];
    }else{
        return "erreur";
    }
}

     public function get_modifier_produit($id_produit)
     {
       
          //$this->actualiser_user();
        if (Session::get('user')){
            $user=Session::get('user');
            if($user['Type']=='A')
            {
              return redirect(Route('home'));
            }
            $id=$user['IDUtilisateurs'];
        } else{
          return redirect(Route('login'))->with('message', __('favoris.message_connection'));
        }

        $response1 = Http::get('http://51.68.36.192/REST_BeldiLook/recuperer_categories');
        if ($response1->successful()){
            $response2 = $response1->json();
        }else{
            return redirect(url()->previous())->with('message', __('favoris.erreur'));
        }

        $response3 = Http::get('http://51.68.36.192/REST_BeldiLook/recuperer_tissus');
        if ($response3->successful()){
            $response4 = $response3->json();
        }else{
            return redirect(url()->previous())->with('message', __('favoris.erreur'));
        }

        $response5 = Http::get('http://51.68.36.192/REST_BeldiLook/recuperer_etat_tenue');
        if ($response5->successful()){
            $response6 = $response5->json();
        }else{
            return redirect(url()->previous())->with('message', __('favoris.erreur'));
        }

        $response_tag = Http::get('http://51.68.36.192/REST_BeldiLook/recuperer_tag');
        if ($response_tag->successful()){
            $response_tag2 = $response_tag->json();
        }else{
            return redirect(url()->previous())->with('message', __('favoris.erreur'));
        }

        $response_comission = Http::get('http://51.68.36.192/REST_BeldiLook/taux_comission');
        if ($response_comission->successful()){
            $response_comission2 = $response_comission->json();
        }else{
            return redirect(url()->previous())->with('message', __('favoris.erreur'));
        }

      


        $details_produit = Http::post('http://51.68.36.192/REST_BeldiLook/recuperer_details_article_modification_web', [
            'id_utilisateur' => $id,
            'IDArticle' => $id_produit
        ]);
        if ($details_produit->successful()){
            $details_produit2 = $details_produit->json();
            if($details_produit2['sMessage']=='erreur')
            {
                return redirect(route('home'));
            }
        }else{
            return redirect(url()->previous())->with('message', __('favoris.erreur'));
        }





        return view('modifier_produit',[
            'categories' => $response2,
            'tissues' => $response4,
            'etats' => $response6,
            'tags1' => $response_tag2['tag1'],
            'tags2' => $response_tag2['tag2'],
            'tags3' => $response_tag2['tag3'],
            'tags4' => $response_tag2['tag4'],
            'taux' => $response_comission2,
            'details_produit' => $details_produit2,
            'id_produit' => $id_produit
        ]);

     }


     public function modifier_produit_api(Request $request)
     {
        
         if (Session::get('user')){
             $user=Session::get('user');
             $id=$user['IDUtilisateurs'];
         } else{
           return ( __('favoris.message_connection'));
         }
 
         $validated = $request->validate([
             'data' => 'required',
             'id_product' => 'required'
         ]);
          $data=$request->input('data');
          $id_product=$request->input('id_product');
 
          $response1 = Http::post('http://51.68.36.192/REST_BeldiLook/modifier_produit_web', [
             'nId_utilisateur' => $id,
             'id_articles' => $id_product,
             'data' => $data
         ]);
         if ($response1->successful()){
             $response2 = $response1->json();
             return  $response2['message'];
         }else{
            
             $response2 = $response1->json();
             return  $response2;
         }
 
 
     }

     public function explorer()
     {
        $this->actualiser_user();
        $tags = Http::get('http://51.68.36.192/REST_BeldiLook/recuperer_type_tag');
        if ($tags->successful()){
            $tags2 = $tags->json();
            //dd($tags2);
        }else{
            return redirect(url()->previous())->with('message', __('favoris.erreur'));
        }
        return view('explorer',[
            'collection' => $tags2
        ]);
     }

     public function decouvrez_formulaire()
     {
        $this->actualiser_user();
        if (Session::get('user')){
            $user=Session::get('user');
            if($user['Type']=='A')
            {
              return redirect(Route('home'));
            }
            $id=$user['IDUtilisateurs'];
        } else{
          return redirect(Route('login'))->with('message', __('favoris.message_connection'));
        }
  

        if($user['pack_user']!='aucun')
        {
            return redirect(Route('home'));
        }

    

        $avantage_pack = Http::get('http://51.68.36.192/REST_BeldiLook/recuperer_avantage_pack');
        if ($avantage_pack->successful()){
            $avantage_pack2 = $avantage_pack->json();
            //dd($tags2);
        }else{
            return redirect(url()->previous())->with('message', __('favoris.erreur'));
        }
//dd($avantage_pack2);
        return view('decouvrez_formulaire',[
            'avantage_pack' => $avantage_pack2
        ]);
     }

     public function devenir_vendeur()
     {
        $this->actualiser_user();
        if (Session::get('user')){
            $user=Session::get('user');
            if($user['Type']!='A')
            {
              return redirect(Route('home'));
            }
        } else{
          return redirect(Route('login'))->with('message', __('favoris.message_connection'));
        }


     



        return view('devenir_vendeur');
     }

     public function filtre_home(Request $request)
     {



        $id=0;
        $search = $request->input('search');
        $page=$request->input('page');

        $tailles=$request->input('taille');
        $categories=$request->input('categorie');
        $colors=$request->input('color');
        $etats=$request->input('etat');
        $prix_min=$request->input('prix_min');
        $prix_max=$request->input('prix_max');
        $sort=$request->input('sort');
          //dd($taille_filtre);

       
        //dd($request->all());
        if ($tailles==null)
        {
            $tailles ='';
        }
        if ($categories==null)
        {
            $categories ='';
        }
        if ($colors==null)
        {
            $colors ='';
        }
        if ($etats==null)
        {
            $etats ='';
        }
        if ($search==null)
        {
            $search ='';
        }
        if ($sort==null)
        {
            $sort ='';
        }
        if (Session::get('user')){
            $user=Session::get('user');
            $id=$user['IDUtilisateurs'];
            //dd($user);
        }
        $page=intval($page);
        if($page==0){
            $page=1;
        }
        $response = Http::post('http://51.68.36.192/REST_BeldiLook/recuperer_articles', [
            'id_utilisateur' => $id,
            'par_categories' => $categories,
            'par_tags' => '',
            'par_couleurs' => $colors,
            'par_tailles' => $tailles,
            'sort' => '',
            'par_lib_articles' => $search,
            'page' => $page,
            'type_operation' => '',
            'par_etat_tenue' => $etats,
            'prix_min' => $prix_min,
            'prix_max' => $prix_max,
            'sort' => $sort,
            'platform' => 'web'
        ]);

          $jsonData = $response->json();



      



          //dd($jsonData);

        return view('home_api',[
            'articles' => $jsonData,
            'page' => $page
        ]);











     }

     public function completer_profile_demande()
     {
        $this->actualiser_user();
        if (Session::get('user')){
            $user=Session::get('user');
            $id=$user['IDUtilisateurs'];
        } else{
          return redirect()->back()->with('message', __('favoris.message_connection'));
        }
//dd($user);
        $response = Http::post('http://51.68.36.192/REST_BeldiLook/Rechercher_utilisateur', [
            'sPar_type' => 'IDUtilisateurs',
            'sValeur' => $user['IDUtilisateurs'],
        ]);
        if ($response->successful()){
            $reponse2 = $response->json();

            if($reponse2['demande']=='V' || $reponse2['demande']=='E' || $reponse2['demande']=='B')
            {
                return redirect(route('home'));
            }
          //  dd($reponse2);
            
            $pays = Http::post('http://51.68.36.192/REST_BeldiLook/Afficher_Pays_web', [
                'page' => 0,
                'nom' => '',
            ]);

             $pays2=$pays->json();


             $villes = Http::get('http://51.68.36.192/REST_BeldiLook/getVilles');
             if ($villes->successful()){
                 $villes2 = $villes->json();
                 //dd($tags2);
             }else{
                 return redirect(url()->previous())->with('message', __('favoris.erreur'));
             }
     //dd($villes2);
             Session::put('villes',$villes2['data']);


             $secteurs=[];
            // dd($reponse2['id_secteur']);
             if($reponse2['id_secteur']!=''){
                $found_key = array_search($reponse2['id_ville'], array_column($villes2['data'], 'id'));

                //  $ville_name=$villes[$found_key]['displayName'];
          
                  $secteurs=$villes2['data'][$found_key]['sectors'];
             }
           

//dd($pays2);

           // dd($secteurs);
            return view('completer_profile_demande',[
                'data' => $reponse2 ,
                'pays' => $pays2,
                'villes' => $villes2['data'],
                'secteurs' => $secteurs
            ]);
        }

        return view('completer_profile_demande');
     }

     public function demande_vendeur(Request $request)
     {





        $this->actualiser_user();
        if (Session::get('user')){
            $user=Session::get('user');
            $id=$user['IDUtilisateurs'];
        } else{
          return redirect('home')->with('message', __('favoris.message_connection'));
        }

        $validated = $request->validate([
            'image' => 'image',
            'prenom' => 'required',
            'nom' => 'required',
            'telephone' => 'required',
            'pays' => 'required',
            'ville' => 'required',
            'adresse' => 'required',
            'adresse2' => 'required',
            'secteur' => 'required'
        ]);
        

        $secteur=$request->input('secteur');

        $villes = Session::get('villes');

        $found_key = array_search(request('ville'), array_column($villes, 'id'));

        $ville_name=$villes[$found_key]['displayName'];

        $secteurs=$villes[$found_key]['sectors'];
        $found_key=array_search($secteur, array_column($secteurs, 'id'));

        $secteur_name=$secteurs[$found_key]['name'];







if (request('image')==null)
{
    $base64='';
    $path='';
}else{
    $path=request('image')->store('profile','public');

    $path=str_replace('/','\\',$path);
$type = pathinfo($path, PATHINFO_EXTENSION);
$data = file_get_contents(public_path('\storage\\'.$path));
$base64 = base64_encode($data);
}
       



//dd($base64);


$response = Http::post('http://51.68.36.192/REST_BeldiLook/Demande_Vendeur', [
    'IDUtilisateurs' => $id,
    'Nom' => request('nom'),
    'Prenom' => request('prenom'),
    'adresse1' => request('adresse'),
    'adresse2' => request('adresse2'),
    'Telephone' => request('telephone'),
    'Ville' => $ville_name,
    'Pays_Langue' => request('pays'),
    'Sexe' => request('sexe'),
    'sPhoto_Logo' => $base64,
    'Secteur' => $secteur_name,
    'id_secteur' => $secteur,
    'id_ville' => request('ville')
]);
if ($response->successful()){
    if($path!='')
    {
        unlink(public_path('\storage\\'.$path));
    }
    $reponse2 = $response->json();
   
    if ($reponse2['message']=="Erreur")
    {
        if($path!='')
        {
            unlink(public_path('\storage\\'.$path));
        }
        return redirect()->back()->with('message', __('favoris.erreur'))->withInput();
    }
    if ($reponse2['message']=="Utilisateur non trouve.")
    {
        if($path!='')
        {
            unlink(public_path('\storage\\'.$path));
        }
        return redirect()->back()->with('message', __('favoris.erreur'))->withInput();
    }
   

    $response3 = Http::post('http://51.68.36.192/REST_BeldiLook/Rechercher_utilisateur', [
        'sPar_type' => 'IDUtilisateurs',
        'sValeur' => $id,
    ]);
   
    if ($response3->successful()){
        $reponse4 = $response3->json();
        Session::put('user',$reponse4);
        return redirect('home')->with('success', __('myaccount.demande_success'));
    }else{
        return redirect()->back()->with('message', __('favoris.erreur'))->withInput();
    }


    //dd($reponse2);
}else{
    if($path!='')
    {
        unlink(public_path('\storage\\'.$path));
    }
    return redirect()->back()->with('message', __('favoris.erreur'))->withInput();
}




     }

     public function completer_profile_boutique()
     {
        $this->actualiser_user();
        if (Session::get('user')){
            $user=Session::get('user');
            $id=$user['IDUtilisateurs'];
        } else{
          return redirect()->back()->with('message', __('favoris.message_connection'));
        }
//dd($user);
        $response = Http::post('http://51.68.36.192/REST_BeldiLook/Rechercher_utilisateur', [
            'sPar_type' => 'IDUtilisateurs',
            'sValeur' => $user['IDUtilisateurs'],
        ]);
        if ($response->successful()){
            $reponse2 = $response->json();

            if($reponse2['demande']=='V' || $reponse2['demande']=='E' || $reponse2['demande']=='B')
            {
                return redirect(route('home'));
            }
          //  dd($reponse2);
            
            $pays = Http::post('http://51.68.36.192/REST_BeldiLook/Afficher_Pays_web', [
                'page' => 0,
                'nom' => '',
            ]);

             $pays2=$pays->json();


             $villes = Http::get('http://51.68.36.192/REST_BeldiLook/getVilles');
             if ($villes->successful()){
                 $villes2 = $villes->json();
                 //dd($tags2);
             }else{
                 return redirect(url()->previous())->with('message', __('favoris.erreur'));
             }
     //dd($villes2);
             Session::put('villes',$villes2['data']);


             $secteurs=[];
            // dd($reponse2['id_secteur']);
             if($reponse2['id_secteur']!=''){
                $found_key = array_search($reponse2['id_ville'], array_column($villes2['data'], 'id'));

                //  $ville_name=$villes[$found_key]['displayName'];
          
                  $secteurs=$villes2['data'][$found_key]['sectors'];
             }
           

//dd($pays2);

           // dd($secteurs);
            return view('completer_profile_boutique',[
                'data' => $reponse2 ,
                'pays' => $pays2,
                'villes' => $villes2['data'],
                'secteurs' => $secteurs
            ]);
        }

        return view('completer_profile_boutique');

     }

     public function demande_boutique()
     {
        $this->actualiser_user();
        if (Session::get('user')){
            $user=Session::get('user');
            $id=$user['IDUtilisateurs'];
        } else{
          return redirect('home')->with('message', __('favoris.message_connection'));
        }

        $validated = $request->validate([
            'image' => 'image',
            'prenom' => 'required',
            'nom' => 'required',
            'telephone' => 'required',
            'pays' => 'required',
            'ville' => 'required',
            'adresse' => 'required',
            'adresse2' => 'required',
            'secteur' => 'required',
            'ice' => 'required',
            'raison_sociale' => 'required'
        ]);
        

        $secteur=$request->input('secteur');

        $villes = Session::get('villes');

        $found_key = array_search(request('ville'), array_column($villes, 'id'));

        $ville_name=$villes[$found_key]['displayName'];

        $secteurs=$villes[$found_key]['sectors'];
        $found_key=array_search($secteur, array_column($secteurs, 'id'));

        $secteur_name=$secteurs[$found_key]['name'];







if (request('image')==null)
{
    $base64='';
    $path='';
}else{
    $path=request('image')->store('profile','public');

    $path=str_replace('/','\\',$path);
$type = pathinfo($path, PATHINFO_EXTENSION);
$data = file_get_contents(public_path('\storage\\'.$path));
$base64 = base64_encode($data);
}
       



//dd($base64);


$response = Http::post('http://51.68.36.192/REST_BeldiLook/Demande_Boutique', [
    'IDUtilisateurs' => $id,
    'Nom' => request('nom'),
    'Prenom' => request('prenom'),
    'adresse1' => request('adresse'),
    'adresse2' => request('adresse2'),
    'Telephone' => request('telephone'),
    'Ville' => $ville_name,
    'Pays_Langue' => request('pays'),
    'Sexe' => request('sexe'),
    'sPhoto_Logo' => $base64,
    'Secteur' => $secteur_name,
    'id_secteur' => $secteur,
    'id_ville' => request('ville'),
    'ICE' => request('ice'),
    'Raison_sociale' => request('raison_sociale')
]);
if ($response->successful()){
    if($path!='')
    {
        unlink(public_path('\storage\\'.$path));
    }
    $reponse2 = $response->json();
   
    if ($reponse2['message']=="Erreur")
    {
        if($path!='')
        {
            unlink(public_path('\storage\\'.$path));
        }
        return redirect()->back()->with('message', __('favoris.erreur'))->withInput();
    }
    if ($reponse2['message']=="Utilisateur non trouve.")
    {
        if($path!='')
        {
            unlink(public_path('\storage\\'.$path));
        }
        return redirect()->back()->with('message', __('favoris.erreur'))->withInput();
    }
   

    $response3 = Http::post('http://51.68.36.192/REST_BeldiLook/Rechercher_utilisateur', [
        'sPar_type' => 'IDUtilisateurs',
        'sValeur' => $id,
    ]);
   
    if ($response3->successful()){
        $reponse4 = $response3->json();
        Session::put('user',$reponse4);
        return redirect('home')->with('success', __('myaccount.demande_success'));
    }else{
        return redirect()->back()->with('message', __('favoris.erreur'))->withInput();
    }


    //dd($reponse2);
}else{
    if($path!='')
    {
        unlink(public_path('\storage\\'.$path));
    }
    return redirect()->back()->with('message', __('favoris.erreur'))->withInput();
}


     }

     public function produit_collection($id)
     {

        $this->actualiser_user();
$id_user=0;
        if (Session::get('user')){
            $user=Session::get('user');
            $id_user=$user['IDUtilisateurs'];
            //dd($user);
        }





        $details_collection = Http::post('http://51.68.36.192/REST_BeldiLook/remplir_details_collection', [
            'id_utilisateur' => $id_user,
            'id_categorie' => '',
            'id_collection' => $id,
            'filtre_couleur' => '',
            'filtre_taille' => '',
            'filtre_etat_tenue' => '',
            'page' => 1,
            'type' => '',
            'id_sous_categorie' => 0,
            'prix_min' => 0,
            'prix_max' => 0
        ]);



        if ($details_collection->successful()){
            $details_collection2 = $details_collection->json();
            //dd($details_collection2);
        }else{
            return redirect()->back()->with('message', __('favoris.erreur'))->withInput();
        }

       
        $categories = Http::get('http://51.68.36.192/REST_BeldiLook/recuperer_categories');
        if ($categories->successful()){
            $categories2 = $categories->json();
        }else{
            return redirect(url()->previous())->with('message', __('favoris.erreur'));
        }


        $etat_tenues = Http::get('http://51.68.36.192/REST_BeldiLook/recuperer_etat_tenue');
        if ($etat_tenues->successful()){
            $etat_tenues2 = $etat_tenues->json();
        }else{
            return redirect(url()->previous())->with('message', __('favoris.erreur'));
        }


$colors=["#EFEFF4","#E6D0C5","#E2E2E2","#F0E6CC","#DCE6F1","#DAE8E3","#F44336","#E91E63","#673AB7","#2196F3","#00BCD4","#4CAF50","#CDDC39","#FFEB3B","#FF9800","#795548","#808000","#C0C000","#E6E600","#E1FF00","#E4F37E","#F3F1B4","#FAFECD","#4F7800","#6DA600","#008000","#00FF00","#99FF99","#C1FECA","#000080","#0000C0","#0000FF","#004FA0","#0080FF","#81BFFF","#B7EEFE","#800080","#8000FF","#A800FF","#C000C0","#FF00FF","#C040FF","#FF99FF","#000000","#303030","#505050","#808080","#E0E0E0","#FFFFFF","#800000","#C00000","#FF0000","#D74F00","#FF8000","#FFC040","#FFC080","#C0C0C0","#FFD700"];


        return view('produit_collection',[
            'details' => $details_collection2,
            'id_collection' => $id,
            'categories' => $categories2,
            'etats_tenues' => $etat_tenues2,
            'colors' => $colors
        ]);
     }



     public function produit_collection_apî(Request $request)
     {

        //$this->actualiser_user();
         $id_user=0;
        if (Session::get('user')){
            $user=Session::get('user');
            $id_user=$user['IDUtilisateurs'];
            //dd($user);
        }


       

        $tailles=$request->input('taille');
        $categories=$request->input('categorie');
        $colors=$request->input('color');
        $etats=$request->input('etat');
        $prix_min=$request->input('prix_min');
        $prix_max=$request->input('prix_max');
       
          //dd($taille_filtre);

       
        //dd($request->all());
        if ($tailles==null)
        {
            $tailles ='';
        }
        if ($categories==null)
        {
            $categories ='';
        }
        if ($colors==null)
        {
            $colors ='';
        }
        if ($etats==null)
        {
            $etats ='';
        }
    




$page=$request->input('page');
$id_sous_categorie=$request->input('id_sous_categorie');


$id=$request->input('id_collection');

        $details_collection = Http::post('http://51.68.36.192/REST_BeldiLook/remplir_details_collection', [
            'id_utilisateur' => $id_user,
            'id_categorie' => $categories,
            'id_collection' => $id,
            'filtre_couleur' => $colors,
            'filtre_taille' => $tailles,
            'filtre_etat_tenue' => $etats,
            'page' => intval($page),
            'type' => 'S',
            'id_sous_categorie' => intval($id_sous_categorie),
            'prix_min' => $prix_min,
            'prix_max' => $prix_max
        ]);



        if ($details_collection->successful()){
            $details_collection2 = $details_collection->json();
            //dd($details_collection2);
        }else{
            return 'erreur';
        }

        if($details_collection2['nbr_articles']=='1')
        {
            $nb_article=$details_collection2['nbr_articles'].' '.__('produit_collection.article');
        }

else
{
    $nb_article=$details_collection2['nbr_articles'].' '.__('produit_collection.articles');

}

      

        return view('produit_collection_api',[
            'articles' => $details_collection2['tab_articles'],
            'page' => $page,
            'nb_article' => $nb_article
           ]);
     }




          public function solde_user()
          {

            $this->actualiser_user();

            if (Session::get('user')){
                $user=Session::get('user');
                $id=$user['IDUtilisateurs'];
                if($user['solde']==0)
                {
                    return redirect(route('home'));
                }
            } else{
              return redirect(route('home'))->with('message', __('favoris.message_connection'));
            }

            $details_solde = Http::post('http://51.68.36.192/REST_BeldiLook/Detail_Solde_Utilisateur', [
                'idutilisateur' => $id
            ]);
           
            if ($details_solde->successful()){
                $details_solde2 = $details_solde->json();
            }else{
                return redirect()->back()->with('message', __('favoris.erreur'))->withInput();
            }
            //dd($details_solde2);
            return view('solde_user',[
                'details_soldes' => $details_solde2
              ]);
          }


          public function mes_commandes_api(Request $request)
          {
            if (Session::get('user')){
                $user=Session::get('user');
                $id=$user['IDUtilisateurs'];
                if($user['Type']=='A')
                {
                    return 'erreur';
                }
            } else{
                return 'erreur';
            }



            $etat=$request->input('etat');
            $start_date=$request->input('start_date');
            $end_date=$request->input('end_date');
           
              //dd($taille_filtre);
    
           
            //dd($request->all());
            if ($etat==null)
            {
                $etat ='';
            }
            if ($start_date==null)
            {
                $start_date ='';
            }
            if ($end_date==null)
            {
                $end_date ='';
            }




    
            $response = Http::post('http://51.68.36.192/REST_BeldiLook/Produit_Acheter_vendeur_web', [
                'sIDUtilisateur' => $id,
                'date_debut' => $start_date,
                'date_fin' => $end_date,
                'statut' => $etat
            ]);
             if($response->successful()) {
                $reponse2 = $response->json();
                //dd($reponse2);
             }else{
                return redirect(url()->previous())->with('message', __('favoris.erreur'));
             }
    
    
             
            return view('mes_commande_api',[
                'commandes' => $reponse2
            ]);
          }


          public function welcome()
          {
            $this->actualiser_user();
          
            $response = Http::get('http://51.68.36.192/REST_BeldiLook/boutique_a_la_une_web');
             if($response->successful()) {
                $reponse2 = $response->json();
                //dd($reponse2);
                

                $tpye_tags = Http::get('http://51.68.36.192/REST_BeldiLook/recuperer_tag_type_tag_web');
                if($tpye_tags->successful()) {
                   $tpye_tags2 = $tpye_tags->json();
                   //dd($reponse2);
                   
   
                }else{
                    return redirect(url()->previous())->with('message', __('favoris.erreur'));
                 }
   
                    return view('welcome',[
                        'boutiques' => $reponse2,
                        'type_tags' => $tpye_tags2
                    ]);
               
    
             }else{
                return redirect(url()->previous())->with('message', __('favoris.erreur'));
             }
          }

          public function contacter_nous()
          {
            $this->actualiser_user();

            return view('contacter_nous');
          }

          public function contacter_nous_post(Request $request)
          {
            $validated = $request->validate([
                'nom_prenom' => 'required',
                'email' => 'required|email',
              'message' => 'required'
            ]);


            $nom_prenom=$request->input('nom_prenom');
            $email=$request->input('email');
            $message=$request->input('message');

            $response = Http::post('http://51.68.36.192/REST_BeldiLook/contacter_nous_web', [
                'nom_prenom' => $nom_prenom,
                'email' => $email,
                'message' => $message
            ]);
             if($response->successful()) {
                $reponse2 = $response->json();
                //dd($reponse2);
                if($reponse2['message']=='erreur')
                {
                    return redirect(url()->previous())->with('message', __('favoris.erreur'))->withInput();
                }
                if($reponse2['message']=='ok')
                {
                    return redirect(url()->previous())->with('success', __('contacter_nous.success'));
                }
             }else{
                return redirect(url()->previous())->with('message', __('favoris.erreur'))->withInput();
             }

            
          }


}
