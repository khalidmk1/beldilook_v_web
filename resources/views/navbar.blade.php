<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/footer.css')}}">
    <link rel="stylesheet" type="text/css"
		href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js" integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous"></script> 


    <title>Beldilook</title>
   <style>
    .nav_top{
      display: flex;
	background-image: url('{{asset("storage/Untitled-1.png")}}');
	background-color: #cccccc;
	height: 100px;
	background-position: center;
	background-repeat: no-repeat;
	background-size: cover;
	position: relative;
  
}

.dropdown-toggle::after{
  color: white;

}

@media screen and (max-width: 960px) {
  .responsive {
    flex-direction: column;
    gap: 11px;
  }
  .nav_top {
    height: 339px;
}
}
   </style>
{{ csrf_field() }}


<div id="modal_newsletter" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">{{__('nav.titre_success_newsletter')}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>{{__('nav.success_newsletter')}}</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary"  data-dismiss="modal">{{__('nav.ok')}}</button>
      </div>
    </div>
  </div>
</div>


   <nav class="nav_top " > 
      
       <div class="container ">
        <div class="row mr-0 responsive  align-items-center @if (App::getlocale()=="ar") flex-row-reverse @endif">
          <div class="col col-lg-2 col-xl-2 col-md-12 col-sm-12 text-center" >
            <a href="{{route('welcome')}}">
              <img src="{{asset('storage/logo-beldiloock.png')}}" alt="" class="img_logo_top image_obligatoire">
            </a>
          </div>

  
          <div class="col col-lg-3 col-xl-3 ml-sm-5" style="text-align: center;">
            <div class="search d-flex justify-content-center">
            <form action="{{Route('home')}}"  method="GET">
              <input name="search" type="text" class="form-control m-0" placeholder="{{__('nav.recherche')}}">
              <button style="background-color: transparent; border: none; position: absolute;
              top: 0; margin-left: 111px;" type="submit"> 
                <i class="fa fa-search"></i></button>
            </form>

             
            </div>
          </div>
  
          <div class="col col-xl-2 col-lg-2 col-md-12 col-sm-12 " style="text-align: center;">
           
              <button class="btn_sell shadow "  style="font-size: 10px;">
               <a href="{{route('ajout_produit')}}" class="text-light link_product"> <span class="btn_plus">+</span> {{__('nav.vente_avec_beldi')}}</a>
              </button>
            
          </div>

          <div class="col-lg-3 col-xl-3 col-md-12 col-sm-12 ">

            <ul class="navbar-nav ml-auto d-flex flex-row justify-content-around align-items-center">
              @if (Session::get('user'))
              <?php
      $user=Session::get('user');
      
              ?>
      
      
                  <div class="nav-item dropdown"  >
                    <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      @if($user['Photo_Logo']!='') 
                   
                      <img src={{$user['Photo_Logo']}} alt="avatar" class="img_avatar image_obligatoire">
                    
                      @else
                      <img src={{ asset('storage/user.png') }} alt="avatar_default" class="img_avatar image_obligatoire">
                      @endif
                      <span class="text-light">
                        {{$user['Nom']." ".$user['Prenom']}}
                      </span>
                      
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown" @if(App::getlocale()=="ar") style="text-align: end" @endif>
                      @php
                          $solde=number_format($user['solde'], 2, ',', ' ')
                      @endphp
                      @if(App::getlocale()=="ar")
                      <a class="dropdown-item" @if($user['solde']!=0) href="{{route('solde_user')}}" @endif style="cursor: pointer;">  {{$solde}} DH : {{__('nav.mon_solde')}}</a>
                      @else
                      <a class="dropdown-item" @if($user['solde']!=0) href="{{route('solde_user')}}" @endif style="cursor: pointer;">   {{__('nav.mon_solde')}} : {{$solde}} DH</a>
                      @endif
                      <a class="dropdown-item" href={{ route('myaccount') }}>{{__('nav.myaccount')}}</a>
                     
                      @if($user['pack_user']=='GOLD' || $user['pack_user']=='SILVER' || $user['pack_user']=='BRONZE')
                      <a class="dropdown-item" href={{ route('gerer_ma_boutique') }}>{{__('nav.gerer_ma_boutique')}}</a>
                      @endif
                      @if($user['Type']=='B')
                      @if($user['pack_user']=='aucun')
                      <a class="dropdown-item" href={{ route('decouvrez_formulaire') }}>{{__('nav.decouvrez_formulaire')}}</a>
                      @endif
                      @endif
                      @if($user['Type']=='V')
                      <a class="dropdown-item" href="#">{{__('nav.vendeur_confirme')}}</a>
                      @endif
                      @if($user['Type']=='A')
                      @if($user['demande']=='E')
                      @if ($user['demande']=='E'&& $user['type_pour_demande']=='V' && $user['paye']=='faux')
                      <a class="dropdown-item" href={{ route('page_paiement_demande') }}>{{__('nav.paye')}}</a>
                      @else
                      <a class="dropdown-item" href="#">{{__('nav.en_cours')}}</a>
                      @endif
                      @else
                      <a class="dropdown-item" href={{ route('devenir_vendeur') }}>{{__('nav.devenir_vendeur')}}</a>
                      @endif
                      @endif
                      <a class="dropdown-item" href={{ route('achats') }}>{{__('nav.mes_achats')}}</a>
                      @if($user['Type']!='A')
                      <a class="dropdown-item" href={{ route('commandes') }}>{{__('nav.mes_commandes')}}</a>
                      <a class="dropdown-item" href={{ route('mes_offres_ventes') }}>{{__('offre_vente.titre')}}</a>
                      @endif
                      <a class="dropdown-item" href={{ route('get_notifications') }}>{{__('notification.mes_notifications')}}</a>
                      <a class="dropdown-item" href={{ route('get_adresses') }}>{{__('adresses_livraison.titre')}}</a>
                      <a class="dropdown-item" href={{ route('get_favoris') }}>{{__('nav.myfavoris')}}</a>
                      <a class="dropdown-item" href={{ route('chat_support') }}>{{__('chat_support.chat_support')}}</a>
                      @if($user['id_facebook']==0 && $user['id_google']==0 )
                      <a class="dropdown-item" href={{ route('change_password') }}>{{__('nav.changer_mot_de_passe')}}</a>
                      @endif
                      <a class="dropdown-item" href={{ route('logout') }}>{{__('nav.deconnecter')}}</a>
                    </div>
                  </div>

                  <div class="col col-1 col-lg-1 col-xl-1 col-md-12 col-sm-12" style="text-align: center;">
                    <div >
                      <a href="{{ route('get_notifications') }}">
                        <img src="{{asset('storage/568182.png')}}" class="bell_not bell image_obligatoire"  alt="bell">
                      </a>
                    
                    </div>
                  </div>
      
                 
      
              @else
              <li class="nav-item bg-light p-1 border_log ">
                  <a class="nav-link p-0 text-dark" href={{route('login')}}>{{__('nav.connect')}}</a>
              </li>
              <li class="nav-item bg-light p-1 border_log">
                  <a class="nav-link p-0 text-dark" href={{route('register')}}>{{__('nav.register')}}</a>
                </li>
              @endif

          </div>
        
         
          
          <div class="col-lg-1 col-xl-1 col-md-12 col-sm-12 ">
            <div class="nav-item dropdown  text-light">
              <a class="nav-link dropdown-toggle text-dark text-center  text-light" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img src="{{asset('storage/download-removebg-preview.png')}}" class="image_obligatoire" alt="language" 
                style="height: 27px;">
             
   
              </a>
              <div class="dropdown-menu dropdown-menu-right text-light " aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href={{ route('langue', ['lang'=>'en']) }}>{{__('nav.Anglais')}}</a>
                <a class="dropdown-item" href={{ route('langue', ['lang'=>'fr']) }}>{{__('nav.francais')}}</a>
                <a class="dropdown-item" href={{ route('langue', ['lang'=>'ar']) }}>{{__('nav.arabe')}}</a>
              </div>
            </div>
          </div>
          
          
        </div>
     
        </div>
    
       </div>
          
   </nav>

 
<div class="container ">
  <div class="row p-2 mr-0 contain_link mt-3 @if (App::getlocale() == "ar") flex-row-reverse @endif">
   
    <div class="col"><a class="nav-link @if(URL()->full() == URL(route('home'))) {{'link_slected'}}  @endif" href={{route('home')}}>{{__('home.home')}}<span class="sr-only">(current)</span></a></div>
    <div class="col"><a class="nav-link @if(URL()->full() == URL(route('boutique'))) {{'link_slected'}}  @endif" href={{route('boutique')}}>{{__('nav.boutique')}}</a></div>
    <div class="col"> <a class="nav-link @if(URL()->full() == URL(route('news'))) {{'link_slected'}}  @endif" href={{route('news')}}>{{__('nav.nouveaute')}}</a></div>
    <div class="col"> <a class="nav-link @if(URL()->full() == URL(route('boutique_une'))) {{'link_slected'}}  @endif" href={{route('boutique_une')}}>{{__('boutique_une.titre')}}</a></div>
    
    @if (Session::get('user'))
    <?php
    $user=Session::get('user');
    
              ?>
    @if($user['Type']!='A')
    <div class="col">
      <a class="nav-link @if(URL()->full() == URL(route('ajout_produit'))) {{'link_slected'}}  @endif" href={{route('ajout_produit')}}>{{__('ajout_produit.ajouter_produit')}}</a>
  </div>
    @endif
    @endif
    <div class="col">
      <a class="nav-link @if(URL()->full() == URL(route('explorer'))) {{'link_slected'}}  @endif" href={{route('explorer')}}>{{__('nav.explorer')}}</a>
    </div>
   
      <div class="col"> <a class="nav-link @if(URL()->full() == URL(route('contacter_nous'))) {{'link_slected'}}  @endif" href={{route('contacter_nous')}}>{{__('contacter_nous.titre')}}</a></div>
   
  </div>
</div>

     {{--  <nav class="navbar navbar-expand-lg navbar-light bg-light " style="z-index:100;width:100%">
        <a class="navbar-brand" href={{route('home')}}><img src={{ asset('storage/BELDI_LOOK_1024-removebg-preview.png') }} alt="" height="40" width="40"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
          <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item">
              <a class="nav-link" href={{route('home')}}>{{__('home.home')}}<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href={{route('boutique')}}>{{__('nav.boutique')}}</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href={{route('news')}}>{{__('nav.nouveaute')}}</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href={{route('boutique_une')}}>{{__('boutique_une.titre')}}</a>
            </li>

            @if (Session::get('user'))
            <?php
            $user=Session::get('user');
            
                      ?>
            @if($user['Type']!='A')
            <li class="nav-item">
              <a class="nav-link" href={{route('ajout_produit')}}>{{__('ajout_produit.ajouter_produit')}}</a>
            </li>
            @endif
            @endif
            <li class="nav-item">
              <a class="nav-link" href={{route('explorer')}}>{{__('nav.explorer')}}</a>
            </li>
          </ul>
          <ul class="navbar-nav ml-auto">
          @if (Session::get('user'))
          <?php
$user=Session::get('user');

          ?>




              <div class="nav-item dropdown" >
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  @if($user['Photo_Logo']!='') 
                  <img style="border-radius: 50%" src={{$user['Photo_Logo']}} alt="" height="30" width="30">
                  @else
                  <img style="border-radius: 50%" src={{ asset('storage/user.png') }} alt="" height="30" width="30">
                  @endif
                  {{$user['Nom']." ".$user['Prenom']}}
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                  @php
                      $solde=number_format($user['solde'], 2, ',', ' ')
                  @endphp
                  <a class="dropdown-item" @if($user['solde']!=0) href="{{route('solde_user')}}" @endif style="cursor: pointer;">{{__('nav.mon_solde')}} : {{$solde.' DH'}}</a>
                  <a class="dropdown-item" href={{ route('myaccount') }}>{{__('nav.myaccount')}}</a>
                 
                  @if($user['pack_user']=='GOLD' || $user['pack_user']=='SILVER' || $user['pack_user']=='BRONZE')
                  <a class="dropdown-item" href={{ route('gerer_ma_boutique') }}>{{__('nav.gerer_ma_boutique')}}</a>
                  @endif
                  @if($user['Type']=='B')
                  @if($user['pack_user']=='aucun')
                  <a class="dropdown-item" href={{ route('decouvrez_formulaire') }}>{{__('nav.decouvrez_formulaire')}}</a>
                  @endif
                  @endif
                  @if($user['Type']=='V')
                  <a class="dropdown-item" href="#">{{__('nav.vendeur_confirme')}}</a>
                  @endif
                  @if($user['Type']=='A')
                  @if($user['demande']=='E')
                  <a class="dropdown-item" href="#">{{__('nav.en_cours')}}</a>
                  @else
                  <a class="dropdown-item" href={{ route('devenir_vendeur') }}>{{__('nav.devenir_vendeur')}}</a>
                  @endif
                  @endif
                  <a class="dropdown-item" href={{ route('achats') }}>{{__('nav.mes_achats')}}</a>
                  @if($user['Type']!='A')
                  <a class="dropdown-item" href={{ route('commandes') }}>{{__('nav.mes_commandes')}}</a>
                  <a class="dropdown-item" href={{ route('mes_offres_ventes') }}>{{__('offre_vente.titre')}}</a>
                  @endif
                  <a class="dropdown-item" href={{ route('get_notifications') }}>{{__('notification.mes_notifications')}}</a>
                  <a class="dropdown-item" href={{ route('get_adresses') }}>{{__('adresses_livraison.titre')}}</a>
                  <a class="dropdown-item" href={{ route('get_favoris') }}>{{__('nav.myfavoris')}}</a>
                  <a class="dropdown-item" href={{ route('chat_support') }}>{{__('chat_support.chat_support')}}</a>
                  @if($user['id_facebook']==0 && $user['id_google']==0 )
                  <a class="dropdown-item" href={{ route('change_password') }}>{{__('nav.changer_mot_de_passe')}}</a>
                  @endif
                  <a class="dropdown-item" href={{ route('logout') }}>{{__('nav.deconnecter')}}</a>
                </div>
              </div>

             

          @else
          <li class="nav-item ">
              <a class="nav-link" href={{route('login')}}>{{__('nav.connect')}}</a>
          </li>
          <li class="nav-item ">
              <a class="nav-link" href={{route('register')}}>{{__('nav.register')}}</a>
            </li>
          @endif

        


          <div class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              {{__('nav.drop_langue')}}
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href={{ route('langue', ['lang'=>'en']) }}>{{__('nav.Anglais')}}</a>
              <a class="dropdown-item" href={{ route('langue', ['lang'=>'fr']) }}>{{__('nav.francais')}}</a>
              <a class="dropdown-item" href={{ route('langue', ['lang'=>'ar']) }}>{{__('nav.arabe')}}</a>
            </div>
          </div>
        </div>
      </nav> --}}

    
      
    
</head>
<body>
  <div style="padding-top: 15px">

    @if(Session::has('message'))
    @if(App::getlocale()=="ar")
    <div class="alert alert-danger alert-dismissible fade show" role="alert" style="text-align: end">
      {{ Session::get('message') }}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
   
    @else
    <div class="alert alert-danger alert-dismissible fade show" role="alert" >
      {{ Session::get('message') }}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    @endif
    @endif

    @if(Session::has('success'))
    @if(App::getlocale()=="ar")
    <div class="alert alert-success alert-dismissible fade show" role="alert" style="text-align: end">
      {{ Session::get('success') }}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    
    @else
    <div class="alert alert-success alert-dismissible fade show" role="alert" >
      {{ Session::get('success') }}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    @endif
    @endif
    @yield('content')
  </div>

  @if(URL()->full() != route('chat_support') )
  <footer class="mt-3">
		<div class=" container-fluid footer ">
			<div class="row justify-content-center mr-0 @if(App::getlocale() == "ar") flex-row-reverse @endif">
				<div class="footer-col  col-xl-3 col-lg-4 col-md-6 col-12 ">
					<div>
            <img src="{{asset('storage/Web_Site_Beldilook_Home_02062023-removebg-preview.png')}}" class="image_obligatoire" style="height: 144px;"
							alt="">
            </div>
					<div class="social-links d-flex">
						<a href="#" >
							<h4>Fb.</h4>
						</a>
						<div class="seprator"></div>
						<a href="#" >
							<h4>lg.</h4>
						</a>
						<div class="seprator"></div>
						<a href="#" >
							<h4>Tw.</h4>
						</a>
						<div class="seprator"></div>
						<a href="#" class="d-flex">
							<h4>Be.</h4>
						</a>

					</div>
				</div>
				<div class="footer-col col-xl-3 col-lg-4 col-md-6 col-12 ">
					
					<ul>
						<li><p class="size">Casablanca</p></li>
						<li>
							<p class="d-flex flex-column" style="max-width: 166px;">
                <span style="font-weight: 500 ;
                font-size: 14px;">Beldi Look.</span>
								3 rue Ibn Jahir -ex Taravo Quartier bourgogne Casablanca - Maroc</p>
						</li>
					</ul>
				</div>
				<div class="footer-col  col-xl-3 col-lg-4 col-md-6 col-12 ">

					<ul>
						<li>
							<p class="size">Demandes de travail</p>
						</li>
						<li>
							<p> Intéressé de travailler avec nous?</p>
						</li>
						<li><a href="#">contact@beldilook.ma</a></li>
						<li >
							<p class="mt-5 mb-0 size">Carrière</p>
						</li>
						
						<li style="max-width: 192px;">
							<p> Vous cherchez une opportunité d’emploi?</p>
						</li>
						<li><a href="#">Voir les postes ouverts</a></li>
					</ul>
				</div>
				<div class="footer-col  col-xl-3 col-lg-4 col-md-6 col-12 mb-50">

					<ul class="d-flex flex-column-reverse ">
						<span id="span_email" style="color: rgb(218, 16, 16);margin-left:15px"></span>
						<li class="input_check gap-1">
						
							<div class="mb-3">
								<input id="sub-check" type="checkbox" style="opacity: .5" aria-label="Checkbox for following text input">
							  </div>
							<p>
								Je suis d’accord pour recevoir des e-mails et
								faire suivre cette activité pour améliorer mon
								expérience.
							</p>
						</li>
						<li class="mb-3 d-flex justify-content-lg-start ml-3 ">
							<input name="email" id="email_inp" type="email" class=" input_email pl-2" placeholder="email" id="exampleInputEmail1" aria-describedby="emailHelp">
              
							<button class="form-btn" onclick="enr_news()" style="z-index: 100">S'inscrire</button>
						</li>
						<li><p class="ml-3 pb-3 size">Recevoir notre Newsletter</p></li>
            
					</ul>
				</div>
			</div>

			<div class="row justify-content-center mr-0">
        <div class="alert cockies alert-dismissible alert_cokies fade show text-light" role="alert">
          Ce site internet utilise des cookies pour une meilleure expérience utilisateur
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span class="btn_cokies" aria-hidden="true">&times;</span>
          </button>
        </div>
      </div>


		</div>
		<div class="row container-fluid justify-content-center mt-5 mb-4 m-0 ">
			<div class="col text-center "><a href="https://www.beldilook.ma/beldilook/politique_beldi_look.html" style="text-decoration:none ; color: black"><h5 style="font-size: 18px;">2023 Beldilook. All rights reserved</h5></a></div>
			<div class="col  p-0  "><a href="https://www.beldilook.ma/beldilook/politique_beldi_look.html" class="d-flex" style="text-decoration:none ; color: black"><h6>Sécurité</h6> <p class="ml-2 mr-2"><h6>|</h6></p> <h6>Politique de confidentialité et de cookies </h6><p class="ml-2 mr-2">|</p><h6> Conditions d’utilisation</h6></a></div>
		</div>
	</footer>
@endif
    
</body>


<script>
function enr_news()
{
  var email_inp=$("#email_inp").val();
  if(email_inp.replace( / +/g, '')=="")
  {
  
    $('#span_email').html("{{__('nav.email_obligatoire')}}");
   return ;
  }

  
  function validateEmail(email) {
  var re = /\S+@\S+\.\S+/;
  return re.test(email);
}


if(validateEmail(email_inp)==false){
  $('#span_email').html("{{__('nav.email_invalide')}}");
  return;
}

  if ($("#sub-check").prop('checked')== false){
    $('#span_email').html("{{__('nav.accept_recev')}}");
      return ;
     } 

     var _token=$('input[name="_token"]').val();
  $.ajax({

      url:("{{route('register_newsletter')}}"),
      method:"POST",
     data:{
      email: $("#email_inp").val(),
      _token:_token
     },

      success: function (data){
        console.log(data);
        
       
        
        if(data == 'Erreur' ){
          alert("{{__('favoris.erreur')}}");
        }else{
          $('#modal_newsletter').modal('show');
          $("#email_inp").val('');
          $('#sub-check').prop('checked', false);
        }
       
      },

      error: function (request, status, error) {
        alert("{{__('favoris.erreur')}}");
  }

  });
}
</script>
</html>