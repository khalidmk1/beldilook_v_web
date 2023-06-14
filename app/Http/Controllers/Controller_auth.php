<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;
use App;

class Controller_auth extends Controller
{
    public function change_l(){
        $language = Session::get('lang');
        if ($language){
           App::setlocale($language);
        }
    }
    public function get_login(){
      //  $this->change_l();
        return view('authentification/se_connecter');
    }

    public function login(Request $request){
       // $this->change_l();
       if (Session::get('user')){
        return redirect(Route('home'));
       } 
        $validated = $request->validate([
            'email' => 'required',
            'pswd' => 'required',
        ]);

        $email = $request->input('email');
        $password = $request->input('pswd');
        
        $response = Http::post('http://51.68.36.192/REST_BeldiLook/login_web', [
            'sEmail' => $email,
            'sMot_de_passe' => $password,
        ]);
if($response->successful()) {
$reponse = $response->json();
//dd($reponse);
if ($reponse['message']!='Erreur' && $reponse['id']!=0){
    $response = Http::post('http://51.68.36.192/REST_BeldiLook/Rechercher_utilisateur', [
        'sPar_type' => 'IDUtilisateurs',
        'sValeur' => $reponse['id'],
    ]);
    if ($response->successful()){
        $reponse2 = $response->json();
       

     
        if($reponse2['black_liste']=='oui')
        {
            return redirect()->back()->with('message', __('login.block'));
        }
        Session::put('user',$reponse2);
        return redirect(route('home'));
    }
    
}else {
    if ($reponse['message']=='Erreur')
    {
        return redirect()->back()->with('message', __('favoris.erreur'))->withInput();
    }
    if( $reponse['id']==0)
    {
        return redirect()->back()->with('message', __('login.autherr'))->withInput();
    }
   
}
       
    }else{
        return redirect()->back()->with('message', __('favoris.erreur'))->withInput();
    }
}

public function logout(){
   // $this->change_l();
    Session::put('user',null);
    Session::put('notification',null);
    return redirect(Route('home'));
}

public function get_register()
{
   // $this->change_l();
   if (Session::get('user')){
 return redirect(Route('home'));
} 
    return view('authentification/register');
}
public function register(Request $request)
{
  //  $this->change_l();
  if (Session::get('user')){
    return redirect(Route('home'));
   } 
    $validated = $request->validate([
        'email' => 'required|email',
        'pswd' => 'required|min:8',
        'nom' => 'required',
        'prenom' => 'required'
    ]);





    $email=$request->input('email');
    $password=$request->input('pswd');
    $nom=$request->input('nom');
    $prenom=$request->input('prenom');

    $response5 = Http::post('http://51.68.36.192/REST_BeldiLook/verification_email_web', [
        'email' => $email,
    ]);
    if ($response5->successful()){
        $reponse6 = $response5->json();
        //dd($reponse6);
        if($reponse6==1)
        {
            return redirect()->back()->with('message', __('register.email_existe'))->withInput();
        }
    }else{
     
    
        return redirect()->back()->with('message', __('favoris.erreur'))->withInput();
    }


    $code=rand(1111,9999);

  $response = Http::post('http://51.68.36.192/REST_BeldiLook/envoi_email_verification', [
        'code' => $code,
        'email' => $email,
    ]);
    if ($response->successful()){
        $reponse2 = $response->json();
        //dd($reponse2);
        if($reponse2['message']=="erreur")
        {
return redirect()->back()->with('message', __('favoris.erreur'))->withInput();
        }
        else{
            $array=[
                'password' => $password,
                'email' => $email,
                'nom' => $nom,
                'prenom' => $prenom
            ];
            Session::put('register',$array);
            Session::put('code',$code);
            Session::put('tentative',3);
            return redirect('code');
        }
    }else{
        return redirect()->back()->with('message', __('favoris.erreur'))->withInput();
    }


    return view('authentification/register');
}
public function code(){
   // $this->change_l();
   
    if (Session::get('code')==null)
    {
        return redirect('home');
    }
    
    
    $array=Session::get('register');
    return view('authentification/code_verification',[
        'email' => $array['email']
    ]);
}
    public function code_verification(Request $request){
      // $this->change_l();
        $validated = $request->validate([
        'code' => 'required',
        ]);

        $code=$request->input('code');
        $code2=Session::get('code');

        if ($code==$code2){
          $array =  Session::get('register');
         
          // traitement 
          $response = Http::post('http://51.68.36.192/REST_BeldiLook/Inscription', [
            'sMot_de_passe' => $array['password'],
            'sEmail' => $array['email'],
            'prenom' => $array['prenom'],
            'nom' => $array['nom']
        ]);
        if ($response->successful()){
            $reponse2 = $response->json();
            if($reponse2=="Erreur")
            {
                return redirect()->back()->with('message', __('favoris.erreur'))->withInput();
            }else{
            $id=$reponse2;
            $response5 = Http::post('http://51.68.36.192/REST_BeldiLook/Rechercher_utilisateur', [
                'sPar_type' => 'IDUtilisateurs',
                'sValeur' => $id,
            ]);
            if ($response5->successful()){
                $reponse4 = $response5->json();
                Session::put('user',$reponse4);
                return redirect('home');
            }else{
                return redirect()->back()->with('message', __('favoris.erreur'))->withInput();
            }
            }
        }else{
                return redirect()->back()->with('message', __('favoris.erreur'))->withInput();
        }
         }else{
         $tentative = Session::get('tentative');
         $tentative=$tentative-1;
         Session::put('tentative',$tentative);
         if($tentative==0)
         {
           Session::put('code',null);
           return redirect('register')->with('message',__('register.fin_tentative'));
         }
   
           return redirect()->back()->with('message', __('register.code_incorrect'))->withInput();
 }
}
      // change password code
       public function change_password(){
       
        if (Session::get('user')){
            $user=Session::get('user');
            $id=$user['IDUtilisateurs'];
        } else{
          return redirect('login')->with('message', __('favoris.message_connection'));
        }
        if($user['id_facebook']!=0)
        {
            return redirect('home');
        }
        if($user['id_google']!=0)
        {
            return redirect('home');
        }
        $code=rand(1111,9999);

        $response = Http::post('http://51.68.36.192/REST_BeldiLook/envoi_email_verification', [
              'code' => $code,
              'email' => $user['Email'],
              'type' => 'init'
          ]);
          if ($response->successful()){
              $reponse2 = $response->json();
              //dd($reponse2);
              if($reponse2['message']=="erreur")
              {
      return redirect()->back()->with('message', __('favoris.erreur'))->withInput();
              }
              else{
               
                  
                  Session::put('code_change_password',$code);
                  Session::put('tentative_change_password',3);
                  return redirect('code_change_password');
              }
          }else{
              return redirect()->back()->with('message', __('favoris.erreur'))->withInput();
          }

       }
       public function code_change_password()
       {
        if (Session::get('user')){
            $user=Session::get('user');
            $id=$user['IDUtilisateurs'];
        } else{
          return redirect('login')->with('message', __('favoris.message_connection'));
        }
        
        if (Session::get('code_change_password')==null)
        {
            return redirect('home');
        }
        
        
        $array=Session::get('register');
        return view('authentification/code_verification_change_password',[
            'email' => $user['Email']
        ]);
        

       }
       public function code_change_password_post(Request $request)
       {
        if (Session::get('user')){
            $user=Session::get('user');
            $id=$user['IDUtilisateurs'];
        } else{
          return redirect('login')->with('message', __('favoris.message_connection'));
        }
        $validated = $request->validate([
            'code' => 'required',
            ]);
    
            $code=$request->input('code');
            $code2=Session::get('code_change_password');
    
            if ($code==$code2){
                Session::put('bool_change_password',true);
                return redirect(route('changer_mot_de_passe_get'));
             }else{
             $tentative = Session::get('tentative_change_password');
             $tentative=$tentative-1;
             Session::put('tentative_change_password',$tentative);
             if($tentative==0)
             {
               Session::put('code_change_password',null);
               return redirect('register')->with('message',__('register.fin_tentative'));
             }
       
               return redirect()->back()->with('message', __('register.code_incorrect'))->withInput();
     }
       }
       public function changer_mot_de_passe_get()
       {
        
        if (Session::get('user')){
            $user=Session::get('user');
            $id=$user['IDUtilisateurs'];
        } else{
          return redirect('login')->with('message', __('favoris.message_connection'));
        }
        $bool_change=Session::get('bool_change_password');
        //dd($bool_change);
        if($bool_change!=true)
        {
            return redirect('change_password');
        }
        return view('authentification/changer_mot_de_passe');
       }

       public function changer_mot_de_passe(Request $request){
        if (Session::get('user')){
            $user=Session::get('user');
            $id=$user['IDUtilisateurs'];
        } else{
          return redirect('login')->with('message', __('favoris.message_connection'));
        }
        $bool_change=Session::get('bool_change_password');
        if($bool_change!=true)
        {
            return redirect('change_password');
        }

        $validated = $request->validate([
            'new_password' => 'required',
            'new_password_confirme' => 'required'
            ]);

            $new_password=$request->input('new_password');
            $new_password_confirme=$request->input('new_password_confirme');

            if($new_password!=$new_password_confirme)
            {
                return redirect()->back()->with('message', __('change_password.deux_password'))->withInput();
            }

            $response = Http::post('http://51.68.36.192/REST_BeldiLook/updatePassword', [
                'password' => $new_password,
                'email' => $user['Email'],
            ]);
            if ($response->successful()){
                $reponse2 = $response->json();
                if($reponse2['message']=='ok'){
                    return redirect('home')->with('success',__('change_password.changer_success'));
                }else{
                    return redirect()->back()->with('message', __('favoris.erreur'))->withInput();
                }
            }else{
                return redirect()->back()->with('message', __('favoris.erreur'))->withInput();
            }

       }

       public function mot_de_passe_oublie_get()
       {
        if (Session::get('user')){
           return redirect(Route('home'));
        }
        return view('mot_de_passe_oublie');
       }
       public function mot_de_passe_oublie_post(Request $request)
       {

        if (Session::get('user')){
            return redirect(Route('home'));
         }

        $validated = $request->validate([
            'email' => 'required|email'
            ],[
                'email.required' => __('login.email_required'),
                'email.email' => __('login.email_email')
            ]);

                $email=$request->input('email');

            $code=rand(1111,9999);

            $response = Http::post('http://51.68.36.192/REST_BeldiLook/mot_de_passe_oublie_web', [
                  'code' => $code,
                  'email' => $email,
                  'type' => 'init'
              ]);
              if ($response->successful()){
                  $reponse2 = $response->json();


                 // dd($reponse2);

                  if($reponse2['message']=="email introuvable")
                  {
          return redirect()->back()->with('message', __('login.email_introuvable'))->withInput();
                  }



                  if($reponse2['message']=="erreur")
                  {
          return redirect()->back()->with('message', __('favoris.erreur'))->withInput();
                  }
                  else{
                    
                      Session::put('init_email',$email);
                      Session::put('code_init',$code);
                      Session::put('tentative_init',3);
                      return redirect(route('code_init'));
                  }
              }else{
                  return redirect()->back()->with('message', __('favoris.erreur'))->withInput();
              }





       }
       public function code_init()
       {
        if (Session::get('user')){
            return redirect(Route('home'));
         }
         if (Session::get('init_email')){
            $email=Session::get('init_email');
         }else{
            return redirect(Route('home'));
         }

         return view('authentification/code_verification_init',[
            'email' => $email
        ]);

       }
       public function code_change_password_post_init(Request $request)
       {
        if (Session::get('user')){
            return redirect(Route('home'));
         }

         if (Session::get('init_email')){
            $email=Session::get('init_email');
         }else{
            return redirect(Route('home'));
         }
        $validated = $request->validate([
            'code' => 'required',
            ]);
    
            $code=$request->input('code');
            $code2=Session::get('code_init');
    
            if ($code==$code2){
                Session::put('bool_change_password_init',true);
                return redirect(route('changer_mot_de_passe_get_init'));
             }else{
             $tentative = Session::get('tentative_init');
             $tentative=$tentative-1;
             Session::put('tentative_init',$tentative);
             if($tentative==0)
             {
               Session::put('code_init',null);
               return redirect('register')->with('message',__('register.fin_tentative'));
             }
       
               return redirect()->back()->with('message', __('register.code_incorrect'))->withInput();
     }
       }

       public function changer_mot_de_passe_get_init()
       {
        if (Session::get('user')){
            return redirect(Route('home'));
         }
         if (Session::get('init_email')){
            $email=Session::get('init_email');
         }else{
            return redirect(Route('home'));
         }
        $bool_change=Session::get('bool_change_password_init');
        //dd($bool_change);
        if($bool_change!=true)
        {
            return route('changer_mot_de_passe_get_init');
        }
        return view('authentification/changer_mot_de_passe_init');
       }


       public function changer_mot_de_passe_init(Request $request){
        if (Session::get('user')){
            return redirect(Route('home'));
         }
         if (Session::get('init_email')){
            $email=Session::get('init_email');
         }else{
            return redirect(Route('home'));
         }
        $bool_change=Session::get('bool_change_password_init');
        if($bool_change!=true)
        {
            return redirect('change_password');
        }

        $validated = $request->validate([
            'new_password' => 'required',
            'new_password_confirme' => 'required'
            ]);

            $new_password=$request->input('new_password');
            $new_password_confirme=$request->input('new_password_confirme');

            if($new_password!=$new_password_confirme)
            {
                return redirect()->back()->with('message', __('change_password.deux_password'))->withInput();
            }

            $response = Http::post('http://51.68.36.192/REST_BeldiLook/updatePassword', [
                'password' => $new_password,
                'email' => $email,
            ]);
            if ($response->successful()){
                $reponse2 = $response->json();
                if($reponse2['message']=='ok'){
                    return redirect(route('login'))->with('success',__('change_password.changer_success'));
                }else{
                    return redirect()->back()->with('message', __('favoris.erreur'))->withInput();
                }
            }else{
                return redirect()->back()->with('message', __('favoris.erreur'))->withInput();
            }

       }

}
