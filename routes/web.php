<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




  /*   Route::get('/', function () {
        return view('welcome');
    }); */
    Route::get('/felicitation','Controller_google@felicitation_google')->name('felicitation_google');
Route::group(['prefix'=> LaravelLocalization::setLocale(),
'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
],function(){

    Route::get('/', 'Controller@welcome')->name('welcome');
     Route::get('/home', 'Controller@get_home')->name('home');
    //Route::get('/home/{page?}', 'Controller@get_home_search')->name('home_sreach');
    Route::get('/myaccount', 'Controller@get_myaccount')->name('myaccount');
    Route::post('/myaccount', 'Controller@modifier_compte')->name('modifier_compte');
    Route::post('/changeaccount', 'Controller@changeaccount')->name('changeaccount');
    Route::get('/boutique/{page?}', 'Controller@get_boutique')->name('boutique');
    Route::get('/login', 'Controller_auth@get_login')->name('login');
    Route::post('/login', 'Controller_auth@login')->name('seconnecter');
    Route::get('/change_langue/{lang}', 'Controller_auth@change_langue')->name('langue');
    Route::get('/logout', 'Controller_auth@logout')->name('logout');
    Route::post('/favoris', 'Controller@change_favoris')->name('change_favoris');
    Route::post('/favoris_boutique', 'Controller@change_favoris_boutique')->name('change_favoris_boutique');

    
    Route::get('/register','Controller_auth@get_register')->name('register');
    Route::post('/register','Controller_auth@register')->name('post_register');
    Route::get('/code','Controller_auth@code')->name('code');
    Route::post('/code','Controller_auth@code_verification')->name('code_verification');

    Route::get('/adresse_livraison','Controller_adresse_livraison@get_adresses')->name('get_adresses');
    Route::get('/adresse_livraison/add','Controller_adresse_livraison@get_add_adresse')->name('get_add_adresses');
    Route::post('/adresse_livraison/add','Controller_adresse_livraison@add_adresse')->name('add_adresses');

    Route::get('/adresse_livraison/update/{idadresse}','Controller_adresse_livraison@get_update_adresse')->name('get_update_adresse');
    Route::post('/adresse_livraison/update/{idadresse}','Controller_adresse_livraison@update_adresse')->name('update_adresse');
    Route::post('/adresse_livraison/delete','Controller_adresse_livraison@delete_adresse')->name('delete_adresse');


    Route::get('/mes_favoris','Controller_favoris@get_favoris')->name('get_favoris');

    Route::post('/delete_favoris_article','Controller_favoris@delete_favoris_article')->name('delete_favoris_article');
    Route::post('/delete_favoris_boutique','Controller_favoris@delete_favoris_boutique')->name('delete_favoris_boutique');

    Route::get('/notifications','Controller_notification@get_notifications')->name('get_notifications');
   
    Route::get('/produit/{id}','Controller@details_produit')->name('details_produit');

    Route::post('/couleur','Controller@recuperer_couleur')->name('recuperer_couleur'); 

    Route::get('/google/auth','Controller_google@login')->name('google_auth');
    Route::get('/google/callback','Controller_google@callback')->name('google_callback');

    Route::get('/facebook/auth','Controller_facebook@login')->name('facebook_auth');
    Route::get('/facebook/callback','Controller_facebook@callback')->name('facebook_callback');

    

     Route::get('/nouveaute/{page?}','Controller@news')->name('news');
    Route::get('/achats','Controller@achats')->name('achats');
    Route::get('/commandes','Controller@commandes')->name('commandes');
    Route::post('/annuler_commande','Controller@annuler_commande')->name('annuler_commande');

    Route::post('/ajouter_reclamation','Controller@ajouter_reclamation')->name('ajouter_reclamation');

    Route::get('/suivi_achat/{id_commande}','Controller@suivi_achat')->name('suivi_achat');

    Route::post('ajouter_avis','Controller@ajouter_avis')->name('ajouter_avis');

    Route::get('vendeur/{id_vendeur}','Controller@page_vendeur')->name('page_vendeur');
    
    Route::get('change_password','Controller_auth@change_password')->name('change_password');
    Route::get('code_change_password','Controller_auth@code_change_password')->name('code_change_password');

    Route::post('/code_change_password','Controller_auth@code_change_password_post')->name('code_change_password_post');

    Route::get('/changer_mot_de_passe','Controller_auth@changer_mot_de_passe_get')->name('changer_mot_de_passe_get');
    Route::post('/changer_mot_de_passe','Controller_auth@changer_mot_de_passe')->name('changer_mot_de_passe');

    Route::get('suivi_commande/{id_commande}','Controller@suivi_commande')->name('suivi_commande');
    Route::get('chat_support','Controller@chat_support')->name('chat_support');

    Route::post('chat_support_api','Controller@chat_support_api')->name('chat_support_api');
    Route::post('send_message','Controller@send_message')->name('send_message');
    Route::post('send_message_image','Controller@send_message_image')->name('send_message_image');

    Route::get('mes_offres_ventes','Controller@mes_offres_ventes')->name('mes_offres_ventes');
    Route::post('delete_article','Controller@delete_article')->name('delete_article');

    Route::get('boutique_une','Controller@boutique_une')->name('boutique_une');
    Route::post('produit_story','Controller@produit_story')->name('produit_story');

    Route::post('get_produit_story','Controller@get_produit_story')->name('get_produit_story');
    Route::get('boutiqua/{id_boutique}','Controller@boutiqua')->name('boutiqua');

    Route::get('commentaires/{id_boutique}','Controller@commentaires')->name('commentaires');

    Route::get('actualites/{id_boutique}','Controller@actualites')->name('actualites');

    Route::get('ajout_produit/','Controller@ajout_produit')->name('ajout_produit'); 

    Route::post('ajouter_produit_api','Controller@ajouter_produit_api')->name('ajouter_produit_api');

    Route::post('api_accepte_terme','Controller@api_accepte_terme')->name('api_accepte_terme');

    Route::get('gerer_ma_boutique','Controller@gerer_ma_boutique')->name('gerer_ma_boutique');

    Route::post('modifier_ma_boutique','Controller@modifier_ma_boutique')->name('modifier_ma_boutique');

    Route::get('gestion_actualites','Controller@gestion_actualites')->name('gestion_actualites');

    Route::post('add_blog','Controller@add_blog')->name('add_blog');

    Route::get('gestion_actualites_api','Controller@gestion_actualites_api')->name('gestion_actualites_api');

    

    Route::post('edit_blog','Controller@edit_blog')->name('edit_blog');
    Route::post('delete_blog','Controller@delete_blog')->name('delete_blog');

    Route::get('modifier_produit/{id_produit}','Controller@get_modifier_produit')->name('get_modifier_produit');

    Route::post('modifier_produit_api','Controller@modifier_produit_api')->name('modifier_produit_api');

    Route::get('explorer','Controller@explorer')->name('explorer');

    Route::get('decouvrez_formulaire','Controller@decouvrez_formulaire')->name('decouvrez_formulaire');

    Route::get('devenir_vendeur','Controller@devenir_vendeur')->name('devenir_vendeur');

    Route::post('filtre_home','Controller@filtre_home')->name('filtre_home');



    Route::get('mot_de_passe_oublie','Controller_auth@mot_de_passe_oublie_get')->name('mot_de_passe_oublie_get');

    Route::post('mot_de_passe_oublie','Controller_auth@mot_de_passe_oublie_post')->name('mot_de_passe_oublie_post');

    Route::post('code_change_password_post_init','Controller_auth@code_change_password_post_init')->name('code_change_password_post_init');

    Route::get('changer_mot_de_passe_get_init','Controller_auth@changer_mot_de_passe_get_init')->name('changer_mot_de_passe_get_init');

    Route::post('changer_mot_de_passe_init','Controller_auth@changer_mot_de_passe_init')->name('changer_mot_de_passe_init');

    Route::get('code_init','Controller_auth@code_init')->name('code_init');

    Route::post('select_ville','Controller_adresse_livraison@select_ville')->name('select_ville');

    Route::get('completer_profile_demande','Controller@completer_profile_demande')->name('completer_profile_demande');

    Route::post('demande_vendeur','Controller@demande_vendeur')->name('demande_vendeur');

    Route::get('completer_profile_boutique','Controller@completer_profile_boutique')->name('completer_profile_boutique');

    Route::post('demande_boutique','Controller@demande_boutique')->name('demande_boutique');

    Route::get('produit_collection/{id}','Controller@produit_collection')->name('produit_collection');

    Route::post('produit_collection_apî','Controller@produit_collection_apî')->name('produit_collection_apî');

    Route::get('solde_user','Controller@solde_user')->name('solde_user');

    Route::post('mes_commandes_api','Controller@mes_commandes_api')->name('mes_commandes_api');

    Route::get('contacter_nous','Controller@contacter_nous')->name('contacter_nous');

    Route::post('contacter_nous','Controller@contacter_nous_post')->name('contacter_nous_post');

    Route::get('produit_sous_categorie/{id_type}/{id_tag}/{page?}','Controller@produit_sous_categorie')->name('produit_sous_categorie');

});
   // Route::get('/test', 'Controller@test')->name('test');
    


