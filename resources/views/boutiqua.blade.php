@extends('navbar')
@section('content')
<link rel="stylesheet" type="text/css" href="{{ url('/css/details_produit.css') }}" />
<link href="https://fonts.googleapis.com/css?family=Bentham|Playfair+Display|Raleway:400,500|Suranna|Trocchi" rel="stylesheet">
<link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{ url('/css/style.css') }}" />


<link rel="stylesheet" type="text/css" href="{{ url('/css/filter.css') }}" />
{{-- @php
  dd($boutique);
@endphp --}}


<style>
    .a_yellow{
        color:goldenrod;
    }
    .a_blue:hover{
color: blue;
    }
    .a_yellow:hover{
color: rgba(117, 119, 5, 0.562);
    }
    @media only screen and (max-width: 600px) {
      .photo_local2{
height: 300px;
width: 300px;
}
}

.img-2{
  height: 110px;
  width: 110px;
    bottom: 24px;
    position: relative;
}

.loader {
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid #B09636;
  width: 120px;
  height: 120px;
  -webkit-animation: spin 2s linear infinite; /* Safari */
  animation: spin 2s linear infinite;
  position: relative;
  left: 35%;
}

/* Safari */
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}


</style>




<!-- Modal locals -->
<div class="modal fade" id="Modal_locals" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
    <div class="modal-dialog" role="document" >
      <div class="modal-content" >
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" style="text-align: center">
            @if($boutique_info['Photo_local1']=='' && $boutique_info['Photo_local2']=='' && $boutique_info['Photo_local3']=='')
            <p style="text-align: center">{{__('boutiqua.auncune_photo')}}</p>
            @endif
            @if($boutique_info['Photo_local1']!='')
          <img class="photo_local2" id="image_popup" src="{{$boutique_info['Photo_local1']}}" height="470" width="466" style="object-fit: contain">
          @endif
          @if($boutique_info['Photo_local2']!='')
          <img class="photo_local2" id="image_popup" src="{{$boutique_info['Photo_local2']}}" height="470" width="466" style="object-fit: contain">
          @endif
          @if($boutique_info['Photo_local3']!='')
          <img class="photo_local2" id="image_popup" src="{{$boutique_info['Photo_local3']}}" height="470" width="466" style="object-fit: contain">
          @endif
        </div>
        <div class="modal-footer">
         
         
        </div>
      </div>
    </div>
  </div>

  <div class="modal" id="modal_loading" tabindex="-1" role="dialog" data-backdrop="static" >
    <div class="modal-dialog modal-dialog-centered" role="document" >
      <div class="modal-content" style="background-color: transparent;border:transparent">
      
        <div class="modal-body">
          <div style="align-items: center;position:relative">
  
            <div class="loader"></div>
          </div>
          
        </div>
       
      </div>
    </div>
  </div>
<div class="container">
  <div class="row flex-column">
    <div class="col" id="snackbar">Some text some message..</div>
  <div style="text-align: center">
      @if($vendeur['photo']!='no' && $vendeur['photo']!='')
      <img id="image_p" style="border-radius: 50%" src="{{ $vendeur['photo'] }}" alt="" height="150px" width="150px">
      @else
      <img id="image_p" style="border-radius: 50%" src="{{ asset('storage/user.png') }}" alt="" height="150px" width="150px">
      @endif
  </div>
  
  <div class="col text-center">
   <div class="row p-2">
    <div class="col-7 align-self-center d-flex justify-content-end pr-5 ">
      <a href="@if($rate_user['nb_avis']!=0) {{route('commentaires',$id_boutique)}} @else # @endif" style="text-decoration: none;color: black" class="a_blue" >
  
        <div class="stars" style="padding-top: 10px ; ">
    
            <div>
                <span class="star1" style="font-size: 17px ;display:inline"> {{$rate_user['nb_avis']." ".__('page_details_produit.avis')}}</span>
    
              @php
              $etoile=$rate_user['moyenne_etoile'];
              $etoile=intval($etoile);
              @endphp
               @if($etoile==0)
               <i class="star stargrey fas fa-star" data-index="0"></i>
               <i class="star stargrey fas fa-star" data-index="1"></i>
               <i class="star stargrey fas fa-star" data-index="2"></i>
               <i class="star stargrey fas fa-star" data-index="3"></i>
               <i class="star stargrey fas fa-star" data-index="4"></i>
               @endif
              @if($etoile==1)
              <i class="star yellow fas fa-star" data-index="0"></i>
              <i class="star stargrey fas fa-star" data-index="1"></i>
              <i class="star stargrey fas fa-star" data-index="2"></i>
              <i class="star stargrey fas fa-star" data-index="3"></i>
              <i class="star stargrey fas fa-star" data-index="4"></i>
              @endif
              @if($etoile==2)
              <i class="star yellow fas fa-star" data-index="0"></i>
              <i class="star yellow fas fa-star" data-index="1"></i>
              <i class="star stargrey fas fa-star" data-index="2"></i>
              <i class="star stargrey fas fa-star" data-index="3"></i>
              <i class="star stargrey fas fa-star" data-index="4"></i>
              @endif
              @if($etoile==3)
              <i class="star yellow fas fa-star" data-index="0"></i>
              <i class="star yellow fas fa-star" data-index="1"></i>
              <i class="star yellow fas fa-star" data-index="2"></i>
              <i class="star stargrey fas fa-star" data-index="3"></i>
              <i class="star stargrey fas fa-star" data-index="4"></i>
              @endif
              @if($etoile==4)
              <i class="star yellow fas fa-star" data-index="0"></i>
              <i class="star yellow fas fa-star" data-index="1"></i>
              <i class="star yellow fas fa-star" data-index="2"></i>
              <i class="star yellow fas fa-star" data-index="3"></i>
              <i class="star stargrey fas fa-star" data-index="4"></i>
              @endif
              @if($etoile==5)
              <i class="star yellow fas fa-star" data-index="0"></i>
              <i class="star yellow fas fa-star" data-index="1"></i>
              <i class="star yellow fas fa-star" data-index="2"></i>
              <i class="star yellow fas fa-star" data-index="3"></i>
              <i class="star yellow fas fa-star" data-index="4"></i>
              @endif
             
            </div>
    
    
          
              
           
          </div>
    
        </a>
    </div>
    <div class="col d-flex align-self-center justify-content-start" style="padding-top: 10px"><a href="#resau_social" style="color: #B09636">Contactez Nous</a></div>
   </div>
  </div>
  
  <div class="col" style="text-align: center">
      <div class="row">
        <div class="col-7 align-self-center d-flex justify-content-end"><h3>{{$vendeur['nom']}}</h3></div>
        <div class="col d-flex align-self-center justify-content-start">
            <img src="{{ asset('storage/verifier bl.png') }}" alt="" style="height: 29px; width: 30px;">
        </div>
      </div>
  </div>
  
  </div>
</div>
<hr>

<div class="container" >

  <div class="row p-2 " style="row-gap: 27px;">
    <div class="col  col-xl-3 col-lg-3 col-md-12 col-sm-12 d-flex flex-column justify-content-around">

      <div class="slidecontainer row m-0 p-0 ">
        <div class="col d-flex flex-column justify-content-center p-0">
          <p  style="font-weight: 500;"> Min
            <span style="font-size:15px" id="pix_minimum"> </span> 
          </p>
      
          <input class="progress_input slider slider_min  p-0 " id="myRange_minimum" type="range" value="0" min="0" max="30000" />
        </div>
       

        <div class="col  p-0 d-flex justify-content-center  flex-column">
          <p class=" RadialProgress radian  "> 
         
            <span style="font-size:15px" id="demo"></span> 
          <span style="font-size: 15px ; margin-left: 2px"> Max</span>
          </p>
          <input type="range" min="0" max="30000" value="0" class="slider  slider_max p-0 " id="myRange"> 
        </div>
       
      </div>
     
    
    <div>
      

     
    
    </div>

                        

    </div>
    <div class="col  col-xl-5 col-lg-5 col-md-12 col-sm-12  ">


      <div class="scrollable-tabs-container-tailles container" id="scrollable-tabs-container-tailles" style="height: 42px;">
                     
        <ul class="tailles_responsive" >

            <li  >
              <a  class="class_tailles" style="padding-left: 16px;
                  padding-top: 13px;cursor: pointer;" donn="XS" >XS</a>
            </li>
    
            <li>
              <a  class="class_tailles" style="padding-top: 13px;
              padding-left: 21px;cursor: pointer;" donn="S" >S</a>
            </li>
    
            <li>
              <a  class=" class_tailles" style="padding-top: 13px;
              padding-left: 18px;cursor: pointer;" donn="M" >M</a>
            </li>
    
            <li>
              <a  class="class_tailles" style="    padding-top: 13px;
              padding-left: 20px;cursor: pointer;" donn="L" >L</a>
            </li>
    
            <li>
              <a  class="class_tailles" style="padding-top: 13px;
              padding-left: 17px;cursor: pointer;" donn="XL" >XL</a>
            </li>
    
            <li>
              <a  class="class_tailles" style="padding-top: 13px;
              padding-left: 12px;cursor: pointer;" donn="XXL" >XXL</a>
            </li>
    
            <li>
              <a  class=" class_tailles" style="padding-top: 15px;
              padding-left: 13px;cursor: pointer;" donn="3XL" >3XL</a>
            </li>
  
          </ul>

       
    </div>


    </div>
    <div class="col  col-xl-4 col-lg-4 col-md-12 col-sm-12   ">

      <div class="scrollable-tabs-container container">
        <div class="left-arrow ">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M15.75 19.5L8.25 12l7.5-7.5" />
            </svg>
        </div>

        <ul class="mt-1" style="height: 73px;">
@foreach ($colors as $color)
<li donn="{{$color}}" class="class_colors">
<a  style="background-color: {{$color}};cursor: pointer;" class="shadow-sm p-3 mb-5" donn="{{$color}}" ></a>
</li>
@endforeach
          
    
            
    
          
  
          </ul>

        <div class="right-arrow active">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M8.25 4.5l7.5 7.5-7.5 7.5" />
            </svg>
        </div>
    </div>

    </div>
  </div>
</div>



    <div  class="container items" >



      <div class="row">
        <div class="col-md-3  " >
        <div class="row "   >


          <div class="col p-3 "> 
            <button type="button" class="btn  text-black bg-light  " onclick="effacer_filtre()">{{__('filtre.effacer')}}</button>
          </div>
          <div class="col d-flex align-items-center justify-content-center  col-sm-6  ">
            <button type="button" onclick="valider_filtre('filtre')"  class="btn btn-submit">{{__('filtre.appliquer')}}</button>
          </div>

          <div class="col-12 p-2 ">
            <label for="" style="color:#00000070" class="text-left">{{__('filtre.genre')}}</label>
            <select id="combo_genre" class="border-right-0 border-top-0 border-left-0 p-2 w-100" name="">
              <option value="">{{__('filtre.tout')}}</option>
              <option value="Homme">{{__('filtre.homme')}}</option>
              <option value="Femme">{{__('filtre.femme')}}</option>
              <option value="Garçon">{{__('filtre.garcon')}}</option>
              <option value="Fille">{{__('filtre.fille')}}</option>
          
            </select>
          </div>
         
          <div class="col-12 p-2">
            <label for=""  style="color:#00000070" class="text-left">{{__('filtre.type_tissue')}}</label>
            <select class="border-right-0 border-top-0 border-left-0 p-2 w-100" name="" id="type_tissus">
              <option value="" selected>{{__('filtre.tout')}}</option>
              @foreach ($tissus as $tissu)
              <option value="{{$tissu['idtissus']}}">{{$tissu['Libelle']}}</option>
              @endforeach
              
           
            </select>
          </div>


          <div class="col col-xl-6 col-lg-6 col-md-6 col-sm-6 font_side_filtter p-3"  style="font-size: 14px; color:#00000070">
            {{__('filtre.categories')}}   
          </div>
          <div class="col col-xl-6 col-lg-6 col-md-6 col-sm-6 p-3">
            <div class="font_side_filtter " style="color:#00000070 ;cursor: pointer; " onclick="tout_selectionner_categories(this)" id="select_all">{{__('filtre.tout_selectionner')}}</div>
          </div>
          <div class="col">

            <div id="container-categorie" class="container-categorie h-100">
              <ul class=" p-0 mt-1 " id="Categories">
@foreach ($categories as $categorie)
<li class="col-12  li_align " >

  <a class="link_a font_side_filtter" style="cursor: pointer;" donn="{{$categorie['idcategorie']}}">{{$categorie['Libelle']}}</a>
 

</li>
<hr class="m-0">
@endforeach
                
               
       
              </ul>
            </div>

          

          </div>

          <div class="col col-xl-6 col-lg-6 col-md-6 col-sm-6 font_side_filtter  p-3" style="color:#00000070">{{__('filtre.etat_tenue')}}</div>
          <div class="col col-xl-6 col-lg-6 col-md-6 col-sm-6 cursor_link font_side_filtter  p-3" style="color:#00000070" id="select_all" onclick="tout_selectionner_etat(this)" >{{__('filtre.tout_selectionner')}}</div>
        
          <div class="col">

            <div id="container-categorie" class="container-categorie h-100">
              <ul class=" p-0 " id="etat">
                  @foreach ($etats_tenues as $etats_tenue)
                <li class="col-12  li_align " >
                  <a class="link_a font_side_filtter" style="cursor: pointer;" donn="{{$etats_tenue['id']}}">{{$etats_tenue['Libelle']}}</a>
                 
                </li>
  
                <hr class="m-0">
                @endforeach
  
               
                  
       
              </ul>
            </div>

          </div>


        
         
         
          
         


          



        </div>
        </div>


        <div class="col-md-9">

          @if(count($articles)!=0)
          @if($articles[0]['nbr_articles']==1)
          <div id="div_nb_article" style="padding-left: 15px;margin-bottom:10px;">{{$articles[0]['nbr_articles'].' '.__('produit_collection.article')}}</div>
          @else
          <div id="div_nb_article" style="padding-left: 15px;margin-bottom:10px;">{{$articles[0]['nbr_articles'].' '.__('produit_collection.articles')}}</div>
          @endif
         @endif
         
<div class="row" id="div_articles">



 



          
  @forelse ($articles as $article)

<div class="col-lg-4 col-md-4 col-sm-6 col-xl-4  d-flex  flex-column align-items-center ">
  
     
  
  <div class="card card_content border-0">

  
    
      <a href="{{route('details_produit',$article['idarticles'])}}">
          <img src="{{ $article['photo1']}}" class="card-img-top img_product img-fluid"  alt="product_card" >
      </a>

      @if ($article['favoris5']==1)
     <img id="art{{$article['idarticles']}}" onclick="favoris({{$article['idarticles']}},this.id)" class="topright pointer" height="30" width="30" src={{ asset('storage/likeplein.png') }}  alt="">
      @else
     <img id="art{{$article['idarticles']}}"  onclick="favoris({{$article['idarticles']}},this.id)" class="topright pointer" height="30" width="30" src={{ asset('storage/likevide_1.png') }} alt="">
      @endif
     

          @if ($article['nouveau']==1)
          <span class="badge  bottomleft" >{{__('home.nouveau')}}</span>
          @endif

          @if ($article['rupture_stock']!='no')
          <span class="badge bg-danger bottomright" >{{__('home.rupture_stock')}}</span>

          @endif

      
    

    <div class="card-body p-2 ">
      <h5 class="card-title mb-1 " >{{$article['libellé']}}</h5>
      <p style="font-size: 14px" class="card-text mb-1"> {{__('boutique_une.etat')}} : {{$article['etat_tenu']}} </p>
      <p style="font-size: 14px" class="card-text mb-1">{{$article['prix']." DH"}}</p>
    </div>
  </div>
</div>





@empty
<p class="col-12" style="text-align: center;padding-top: 80px;">{{__('home.aucun_produit')}}</p>
@endforelse





</div>

<div class="mt-5" style="text-align: center;padding-bottom:50px">


  <a onclick="afficher_plus('-')"  class="paginationa" style="cursor: pointer">❮</a>


  <a onclick="afficher_plus('+')"  class="paginationa" style="cursor: pointer">❯</a>


</div>


        </div>
      
      </div>


      <button
      type="button"
      class="btn position-fixed btn-lg  m-2 " style="border-radius:50px ; bottom: 0 ; right: 0; background-color: #B09636"
      id="btn-back-to-top"
      >
      <i class="fas fa-arrow-up"></i>
      </button>
  </div>


{{--   <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="row">
          <div class="col-12">
            <h5  style="color:#263066;" class="@if (App::getlocale() == 'ar') text-right @endif" >{{__('boutiqua.reseau_sociaux')}}</h5>
          </div>
          <div class="col text-center p-2">
            @if($boutique_info['lien_facebook']!='')
            <a style="display: inline;text-decoration:none ; color: black" class="a_blue" href="{{$boutique_info['lien_facebook']}}" target="_blank">    
              <div style="">Facebook 
                <img src="{{ asset('storage/facebbok.png') }}" alt="" height="30px" width="30px"></div>
            </a>
            @endif
          </div>
          <div class="col  text-center  p-2">
            @if($boutique_info['lien_tiktok']!='')
            <a style="display: inline;text-decoration:none ; color: black" class="a_blue"  href="{{$boutique_info['lien_tiktok']}}" target="_blank">    
              <div style="margin-left: 21px;">Tiktok 
                <img src="{{ asset('storage/tiktok.png') }}" alt="" height="30px" width="30px">
              </div>
            </a>
            @endif

          </div>
          <div class="w-100"></div>
          <div class="col  text-center   p-2"> 
            @if($boutique_info['lien_snapshat']!='')
            <a style="display: inline;text-decoration:none ; color: black"  href="{{$boutique_info['lien_snapshat']}}" target="_blank">    
              <div style="">Snapshat 
                <img src="{{ asset('storage/snapcaht.png') }}" alt="" height="30px" width="30px">
              </div>
            </a>
            @endif</div>
          <div class="col  text-center   p-2"> 
            @if($boutique_info['lien_youtube']!='')
            <a style="display: inline;text-decoration:none ; color: black" class="a_blue"  href="{{$boutique_info['lien_youtube']}}" target="_blank">    
              <div style="">Youtube 
                <img src="{{ asset('storage/youtube.png') }}" alt="" height="30px" width="30px">
              </div>
            </a>
            @endif
          </div>

          <div class="w-100"></div>
          <div class="col  text-center p-2" >
            @if($boutique_info['lien_linkdin']!='')
            <a style="display: inline;text-decoration:none ; color: black" class="a_blue"  href="{{$boutique_info['lien_linkdin']}}" target="_blank">   
               <div style="margin-left: 10px;">Linkdin 
                <img src="{{ asset('storage/Linkdin.png') }}" alt="" height="30px" width="30px">
              </div>
            </a>
            @endif
          </div>
          <div class="col  text-center   p-2">
            @if($boutique_info['lien_instagram']!='')
            <a style="display: inline;text-decoration:none ; color: black" class="a_blue"  href="{{$boutique_info['lien_instagram']}}" target="_blank">   
               <div style="margin-right: 16px;">
                Instagram 
                <img src="{{ asset('storage/insta.png') }}" alt="" height="30px" width="30px">
              </div>
            </a>
            @endif
          </div>
          <div class="w-100"></div>
          <div class="col p-2 text-center">
            <a   href="{{route('actualites',$id_boutique)}}" class="a_yellow" >    
              <div style="">{{__('boutiqua.news')}} </div>
            </a>
          </div>
          
          <div class="col p-2 text-center">
            <a onclick="show_locals()" style="color:black" class="a_blue"  href="#" >   
               <div >{{__('boutiqua.notre_local')}} </div>
            </a>
          </div>
        </div>
        <div class="w-100"></div>
      
      </div>
    </div>
  </div> --}}



  <div class="container p-3" id="resau_social" >
    <div class="col-12 p-2">
      <h5  style="color:#263066;" class="@if (App::getlocale() == 'ar') text-right @endif" >{{__('boutiqua.reseau_sociaux')}}</h5>
    </div>
    <div class="row p-3 " style="border: 1px solid;
    border-radius: 20px;
    max-width: 697px;
    margin: auto;">
     
      <div class="col-sm text-center p-2 ">
        @if($boutique_info['lien_facebook']!='')
        <a style="display: inline;text-decoration:none ; color: black" class="a_blue" href="{{$boutique_info['lien_facebook']}}" target="_blank">    
          <div class="row" >
            <div class="col  d-flex justify-content-end">
              Facebook
            </div> 
            <div class="col d-flex justify-content-start p-0">
              <img src="{{ asset('storage/facebbok.png') }}" alt="" height="30px" width="30px"></div>
            </div>
        </a>
        @endif
      </div>
      <div class="col-sm  text-center p-2  ">
        @if($boutique_info['lien_tiktok']!='')
        <a style="display: inline;text-decoration:none ; color: black" class="a_blue"  href="{{$boutique_info['lien_tiktok']}}" target="_blank">    
          <div class="row" >
            <div class="col  d-flex justify-content-end">
              Tiktok
            </div> 
           <div class="col d-flex justify-content-start p-0">
            <img src="{{ asset('storage/tiktok.png') }}" alt="" height="30px" width="30px">
           </div>
          </div>
        </a>
        @endif

      </div>
    
      <div class="col-sm  text-center p-2 "> 
        @if($boutique_info['lien_snapshat']!='')
        <a style="display: inline;text-decoration:none ; color: black"  href="{{$boutique_info['lien_snapshat']}}" target="_blank">    
          <div class="row" >
            <div class="col d-flex justify-content-end">
              Snapshat
            </div> 
            <div class="col  d-flex justify-content-start p-0">
              <img src="{{ asset('storage/snapcaht.png') }}" alt="" height="30px" width="30px">
            </div>
          </div>
        </a>
        @endif</div>
        <div class="w-100"></div>


      <div class="col-sm  text-center p-2 "> 
        @if($boutique_info['lien_youtube']!='')
        <a style="display: inline;text-decoration:none ; color: black" class="a_blue"  href="{{$boutique_info['lien_youtube']}}" target="_blank">    
          <div class="row">
            <div class="col d-flex justify-content-end">
              Youtube 
            </div>
            <div class="col  d-flex justify-content-start p-0">
              <img src="{{ asset('storage/youtube.png') }}" alt="" height="30px" width="30px">
            </div>        
          </div>
        </a>
        @endif
      </div>

   
      <div class="col-sm  text-center p-2 " >
        @if($boutique_info['lien_linkdin']!='')
        <a style="display: inline;text-decoration:none ; color: black" class="a_blue"  href="{{$boutique_info['lien_linkdin']}}" target="_blank">   
           <div class="row" >
            <div class="col  d-flex justify-content-end">
              Linkdin 
            </div>
            <div class="col d-flex justify-content-start p-0">
              <img src="{{ asset('storage/Linkdin.png') }}" alt="" height="30px" width="30px">
            </div>
          </div>
        </a>
        @endif
      </div>
      <div class="col-sm  text-center p-2 ">
        @if($boutique_info['lien_instagram']!='')
        <a style="display: inline;text-decoration:none ; color: black" class="a_blue"  href="{{$boutique_info['lien_instagram']}}" target="_blank">   
           <div class="row">
            <div class="col  d-flex justify-content-end ">
              Instagram
            </div>
            <div class="col d-flex justify-content-start p-0">
              <img src="{{ asset('storage/insta.png') }}" alt="" height="30px" width="30px">
              </div> 
          </div>
        </a>
        @endif
      </div>
      <div class="w-100"></div>
      <div class="col-sm text-center p-3">
        <a   href="{{route('actualites',$id_boutique)}}" class="a_yellow" >    
          <div style="">{{__('boutiqua.news')}} </div>
        </a>
      </div>
      
      <div class="col-sm text-center p-3">
        <a onclick="show_locals()" style="color:black" class="a_blue"  href="#" >   
           <div >{{__('boutiqua.notre_local')}} </div>
        </a>
      </div>
  
    </d>
  </div>





{{--   <div class="container">
    <div class="row @if (App::getlocale() == 'ar') flex-row-reverse @endif">
      <div class="col-sm-5">
        <div class="row ">
          <div class="col-12 text-center position-relative">
            <div class="card border-0">
              <a style="position: relative ; z-index: 100;">
                <img src="{{$boutique['photo']}}" alt="boutique" style="height: 100px;
                padding: 2px;border: 4px solid white;
                width: 100px;" class="rounded-circle img-1">
              </a>
              <div class="card-img-overlay">
                <img src="{{$boutique['photo']}}" alt="boutique"
                 class="rounded-circle img-2">
                </p>
              </div>
            </div>

           
       
          
          </div>
          <div class="col-12">
            <div class="row text-center justify-content-center">
              <div class="col-8" style="margin: 15px 0px 8px 0px;">
                <h1  style="color:#263066;font-size: 16px; ">{{$boutique['nom']}}</h1>
              </div>
              <div class="col-4" style="position: absolute;
              text-align: start;
              right: 7%;
              top: 9px;
              margin-right: -44px;">
                <img src="{{ asset('storage/verifier bl.png') }}" alt="" style="height: 29px;
                width: 30px;">
              </div>
            </div>
           
          </div>
          <div class="col-12">
            <div class="row">
              <div class="col-12">
                <h5  style="color:#263066;" class="@if (App::getlocale() == 'ar') text-right @endif" >{{__('boutiqua.reseau_sociaux')}}</h5>
              </div>
              <div class="col text-center p-2">
                @if($boutique_info['lien_facebook']!='')
                <a style="display: inline;text-decoration:none ; color: black" class="a_blue" href="{{$boutique_info['lien_facebook']}}" target="_blank">    
                  <div style="">Facebook 
                    <img src="{{ asset('storage/facebbok.png') }}" alt="" height="30px" width="30px"></div>
                </a>
                @endif
              </div>
              <div class="col  text-center  p-2">
                @if($boutique_info['lien_tiktok']!='')
                <a style="display: inline;text-decoration:none ; color: black" class="a_blue"  href="{{$boutique_info['lien_tiktok']}}" target="_blank">    
                  <div style="margin-left: 21px;">Tiktok 
                    <img src="{{ asset('storage/tiktok.png') }}" alt="" height="30px" width="30px">
                  </div>
                </a>
                @endif

              </div>
              <div class="w-100"></div>
              <div class="col  text-center   p-2"> 
                @if($boutique_info['lien_snapshat']!='')
                <a style="display: inline;text-decoration:none ; color: black"  href="{{$boutique_info['lien_snapshat']}}" target="_blank">    
                  <div style="">Snapshat 
                    <img src="{{ asset('storage/snapcaht.png') }}" alt="" height="30px" width="30px">
                  </div>
                </a>
                @endif</div>
              <div class="col  text-center   p-2"> 
                @if($boutique_info['lien_youtube']!='')
                <a style="display: inline;text-decoration:none ; color: black" class="a_blue"  href="{{$boutique_info['lien_youtube']}}" target="_blank">    
                  <div style="">Youtube 
                    <img src="{{ asset('storage/youtube.png') }}" alt="" height="30px" width="30px">
                  </div>
                </a>
                @endif
              </div>

              <div class="w-100"></div>
              <div class="col  text-center p-2" >
                @if($boutique_info['lien_linkdin']!='')
                <a style="display: inline;text-decoration:none ; color: black" class="a_blue"  href="{{$boutique_info['lien_linkdin']}}" target="_blank">   
                   <div style="margin-left: 10px;">Linkdin 
                    <img src="{{ asset('storage/Linkdin.png') }}" alt="" height="30px" width="30px">
                  </div>
                </a>
                @endif
              </div>
              <div class="col  text-center   p-2">
                @if($boutique_info['lien_instagram']!='')
                <a style="display: inline;text-decoration:none ; color: black" class="a_blue"  href="{{$boutique_info['lien_instagram']}}" target="_blank">   
                   <div style="margin-right: 16px;">
                    Instagram 
                    <img src="{{ asset('storage/insta.png') }}" alt="" height="30px" width="30px">
                  </div>
                </a>
                @endif
              </div>
              <div class="w-100"></div>
              <div class="col p-2 text-center">
                <a   href="{{route('actualites',$id_boutique)}}" class="a_yellow" >    
                  <div style="">{{__('boutiqua.news')}} </div>
                </a>
              </div>
              
              <div class="col p-2 text-center">
                <a onclick="show_locals()" style="color:black" class="a_blue"  href="#" >   
                   <div >{{__('boutiqua.notre_local')}} </div>
                </a>
              </div>
            </div>
            <div class="w-100"></div>
          
          </div>
        </div>
      </div>
      <div class="col-sm-7">
        <div class="row">
          <div class="col-12 text-center">
            <a href="@if($rate_user['nb_avis']!=0) {{route('commentaires',$id_boutique)}} @else # @endif" style="text-decoration: none;color: black" class="a_blue" >

              <div class="stars" style="padding-top: 10px">
          
                  <div>
                      <span class="star1" style="font-size: 17px ;display:inline"> {{$rate_user['nb_avis']." ".__('page_details_produit.avis')}}</span>
          
                    @php
                    $etoile=$rate_user['moyenne_etoile'];
                    $etoile=intval($etoile);
                    @endphp
                     @if($etoile==0)
                     <i class="star stargrey fas fa-star" data-index="0"></i>
                     <i class="star stargrey fas fa-star" data-index="1"></i>
                     <i class="star stargrey fas fa-star" data-index="2"></i>
                     <i class="star stargrey fas fa-star" data-index="3"></i>
                     <i class="star stargrey fas fa-star" data-index="4"></i>
                     @endif
                    @if($etoile==1)
                    <i class="star yellow fas fa-star" data-index="0"></i>
                    <i class="star stargrey fas fa-star" data-index="1"></i>
                    <i class="star stargrey fas fa-star" data-index="2"></i>
                    <i class="star stargrey fas fa-star" data-index="3"></i>
                    <i class="star stargrey fas fa-star" data-index="4"></i>
                    @endif
                    @if($etoile==2)
                    <i class="star yellow fas fa-star" data-index="0"></i>
                    <i class="star yellow fas fa-star" data-index="1"></i>
                    <i class="star stargrey fas fa-star" data-index="2"></i>
                    <i class="star stargrey fas fa-star" data-index="3"></i>
                    <i class="star stargrey fas fa-star" data-index="4"></i>
                    @endif
                    @if($etoile==3)
                    <i class="star yellow fas fa-star" data-index="0"></i>
                    <i class="star yellow fas fa-star" data-index="1"></i>
                    <i class="star yellow fas fa-star" data-index="2"></i>
                    <i class="star stargrey fas fa-star" data-index="3"></i>
                    <i class="star stargrey fas fa-star" data-index="4"></i>
                    @endif
                    @if($etoile==4)
                    <i class="star yellow fas fa-star" data-index="0"></i>
                    <i class="star yellow fas fa-star" data-index="1"></i>
                    <i class="star yellow fas fa-star" data-index="2"></i>
                    <i class="star yellow fas fa-star" data-index="3"></i>
                    <i class="star stargrey fas fa-star" data-index="4"></i>
                    @endif
                    @if($etoile==5)
                    <i class="star yellow fas fa-star" data-index="0"></i>
                    <i class="star yellow fas fa-star" data-index="1"></i>
                    <i class="star yellow fas fa-star" data-index="2"></i>
                    <i class="star yellow fas fa-star" data-index="3"></i>
                    <i class="star yellow fas fa-star" data-index="4"></i>
                    @endif
                   
                  </div>
          
          
                
                    
                 
                </div>
          
              </a>
          </div>
        
          
        </div>
      </div>
    </div>
  </div>
 --}}





{{-- 
<img src="{{ asset('storage/cover_boutique.jpg') }} " height="300px" width="100%" alt=""> --}}

{{-- @if(App::getlocale()=="ar")
<h1  style="margin: 40px 0px 20px 20px;color:#263066;text-align:end;display:inline;position: relative;top:10px">{{$boutique['nom']}}</h1>
@else
<h3  style="margin: 40px 0px 20px 20px;color:#263066;text-align:start;display:inline;position: relative;top:10px">{{$boutique['nom']}}</h1>
@endif
<img src="{{ asset('storage/verifier bl.png') }}" alt="" height="50" width="50">
<div style="padding-top: 20px;text-align:center">
    @foreach ($produits as $produit)
    <div style="display: inline">
        <a href="{{route('details_produit',$produit['idarticles'])}}">        
          <img style="border-radius: 50%;margin-right:15px"  src="{{ $produit['photo1'] }}" alt="" height="150" width="150">
        </a>
    </div>
    @endforeach
    @if(count($produits)!=0)
    <a href="{{route('page_vendeur',$id_boutique)}}">{{__('boutiqua.voir_plus')}}</a>
    @else
    <p class="col-12" style="text-align: center;padding-top: 80px;">{{__('home.aucun_produit')}}</p>
    @endif
</div>


<div class="container">
    @if(App::getlocale()=="ar")
<div class="row flex-row-reverse">
    @else
    <div class="row">
    @endif
@if(App::getlocale()=="ar")

<div class="col-6 " style="text-align: end"><h5  style="margin: 40px 0px 0px 0px;color:#263066;text-align:end;display:inline;position: relative;top:10px">{{__('boutiqua.reseau_sociaux')}}</h5>
</div>
@else
<div class="col-6 "><h5  style="margin: 40px 0px 0px 0px;color:#263066;text-align:start;display:inline;position: relative;top:10px">{{__('boutiqua.reseau_sociaux')}}</h5>
</div>
@endif
@if(App::getlocale()=="ar")
<div class="col-6">
<a href="@if($rate_user['nb_avis']!=0) {{route('commentaires',$id_boutique)}} @else # @endif" style="text-decoration: none;color: black" class="a_blue" >
    <div class="stars" style="padding-top: 10px">

        <div>
            <span class="star1" style="font-size: 17px ;display:inline"> {{$rate_user['nb_avis']." ".__('page_details_produit.avis')}}</span>

          @php
          $etoile=$rate_user['moyenne_etoile'];
          $etoile=intval($etoile);
          @endphp
           @if($etoile==0)
           <i class="star stargrey fas fa-star" data-index="0"></i>
           <i class="star stargrey fas fa-star" data-index="1"></i>
           <i class="star stargrey fas fa-star" data-index="2"></i>
           <i class="star stargrey fas fa-star" data-index="3"></i>
           <i class="star stargrey fas fa-star" data-index="4"></i>
           @endif
          @if($etoile==1)
          <i class="star yellow fas fa-star" data-index="0"></i>
          <i class="star stargrey fas fa-star" data-index="1"></i>
          <i class="star stargrey fas fa-star" data-index="2"></i>
          <i class="star stargrey fas fa-star" data-index="3"></i>
          <i class="star stargrey fas fa-star" data-index="4"></i>
          @endif
          @if($etoile==2)
          <i class="star yellow fas fa-star" data-index="0"></i>
          <i class="star yellow fas fa-star" data-index="1"></i>
          <i class="star stargrey fas fa-star" data-index="2"></i>
          <i class="star stargrey fas fa-star" data-index="3"></i>
          <i class="star stargrey fas fa-star" data-index="4"></i>
          @endif
          @if($etoile==3)
          <i class="star yellow fas fa-star" data-index="0"></i>
          <i class="star yellow fas fa-star" data-index="1"></i>
          <i class="star yellow fas fa-star" data-index="2"></i>
          <i class="star stargrey fas fa-star" data-index="3"></i>
          <i class="star stargrey fas fa-star" data-index="4"></i>
          @endif
          @if($etoile==4)
          <i class="star yellow fas fa-star" data-index="0"></i>
          <i class="star yellow fas fa-star" data-index="1"></i>
          <i class="star yellow fas fa-star" data-index="2"></i>
          <i class="star yellow fas fa-star" data-index="3"></i>
          <i class="star stargrey fas fa-star" data-index="4"></i>
          @endif
          @if($etoile==5)
          <i class="star yellow fas fa-star" data-index="0"></i>
          <i class="star yellow fas fa-star" data-index="1"></i>
          <i class="star yellow fas fa-star" data-index="2"></i>
          <i class="star yellow fas fa-star" data-index="3"></i>
          <i class="star yellow fas fa-star" data-index="4"></i>
          @endif
         
        </div> --}}


        {{--   <span class="star1"><img src="images/stars.png" class="img_stars"   alt=""></span>
          <span class="star1"><img src="images/stars.png" class="img_stars"   alt=""></span>
          <span class="star1"><img src="images/stars.png" class="img_stars"   alt=""></span>
          <span class="star1"><img src="images/stars.png" class="img_stars"   alt=""></span>
          <span class="star1"><img src="images/stars.png" class="img_stars"   alt=""></span> --}}
          
   {{--     
      </div>
    </a>
</div>
@else

<div class="col-6" style="text-align: end">
    
    <a href="@if($rate_user['nb_avis']!=0) {{route('commentaires',$id_boutique)}} @else # @endif" style="text-decoration: none;color: black" class="a_blue" >

    <div class="stars" style="padding-top: 10px">

        <div>
            <span class="star1" style="font-size: 17px ;display:inline"> {{$rate_user['nb_avis']." ".__('page_details_produit.avis')}}</span>

          @php
          $etoile=$rate_user['moyenne_etoile'];
          $etoile=intval($etoile);
          @endphp
           @if($etoile==0)
           <i class="star stargrey fas fa-star" data-index="0"></i>
           <i class="star stargrey fas fa-star" data-index="1"></i>
           <i class="star stargrey fas fa-star" data-index="2"></i>
           <i class="star stargrey fas fa-star" data-index="3"></i>
           <i class="star stargrey fas fa-star" data-index="4"></i>
           @endif
          @if($etoile==1)
          <i class="star yellow fas fa-star" data-index="0"></i>
          <i class="star stargrey fas fa-star" data-index="1"></i>
          <i class="star stargrey fas fa-star" data-index="2"></i>
          <i class="star stargrey fas fa-star" data-index="3"></i>
          <i class="star stargrey fas fa-star" data-index="4"></i>
          @endif
          @if($etoile==2)
          <i class="star yellow fas fa-star" data-index="0"></i>
          <i class="star yellow fas fa-star" data-index="1"></i>
          <i class="star stargrey fas fa-star" data-index="2"></i>
          <i class="star stargrey fas fa-star" data-index="3"></i>
          <i class="star stargrey fas fa-star" data-index="4"></i>
          @endif
          @if($etoile==3)
          <i class="star yellow fas fa-star" data-index="0"></i>
          <i class="star yellow fas fa-star" data-index="1"></i>
          <i class="star yellow fas fa-star" data-index="2"></i>
          <i class="star stargrey fas fa-star" data-index="3"></i>
          <i class="star stargrey fas fa-star" data-index="4"></i>
          @endif
          @if($etoile==4)
          <i class="star yellow fas fa-star" data-index="0"></i>
          <i class="star yellow fas fa-star" data-index="1"></i>
          <i class="star yellow fas fa-star" data-index="2"></i>
          <i class="star yellow fas fa-star" data-index="3"></i>
          <i class="star stargrey fas fa-star" data-index="4"></i>
          @endif
          @if($etoile==5)
          <i class="star yellow fas fa-star" data-index="0"></i>
          <i class="star yellow fas fa-star" data-index="1"></i>
          <i class="star yellow fas fa-star" data-index="2"></i>
          <i class="star yellow fas fa-star" data-index="3"></i>
          <i class="star yellow fas fa-star" data-index="4"></i>
          @endif
         
        </div>


      
          
       
      </div>

    </a>
</div>
@endif
</div>
</div>
</div>
<br>
<br>
<div class="container">
    <div style="text-align: center">
    @if($boutique_info['lien_facebook']!='')
    <a style="display: inline;text-decoration:none" class="a_blue" href="{{$boutique_info['lien_facebook']}}" target="_blank">    <div style="padding-left: 20px;display:inline-block;padding-bottom:10px">Facebook <img src="{{ asset('storage/facebbok.png') }}" alt="" height="30px" width="30px"></div>
    </a>
    @endif



    @if($boutique_info['lien_tiktok']!='')
    <a style="display: inline;text-decoration:none" class="a_blue"  href="{{$boutique_info['lien_tiktok']}}" target="_blank">    <div style="padding-left: 20px;display:inline-block;padding-bottom:10px">Tiktok <img src="{{ asset('storage/tiktok.png') }}" alt="" height="30px" width="30px"></div>
    </a>
    @endif

    @if($boutique_info['lien_snapshat']!='')
    <a style="display: inline;text-decoration:none"  href="{{$boutique_info['lien_snapshat']}}" target="_blank">    <div style="padding-left: 20px;display:inline-block;padding-bottom:10px">Snapshat <img src="{{ asset('storage/snapcaht.png') }}" alt="" height="30px" width="30px"></div>
    </a>
    @endif


    @if($boutique_info['lien_youtube']!='')
    <a style="display: inline;text-decoration:none" class="a_blue"  href="{{$boutique_info['lien_youtube']}}" target="_blank">    <div style="padding-left: 20px;display:inline-block;padding-bottom:10px">Youtube <img src="{{ asset('storage/youtube.png') }}" alt="" height="30px" width="30px"></div>
    </a>
    @endif


    @if($boutique_info['lien_linkdin']!='')
    <a style="display: inline;text-decoration:none" class="a_blue"  href="{{$boutique_info['lien_linkdin']}}" target="_blank">    <div style="padding-left: 20px;display:inline-block;padding-bottom:10px">Linkdin <img src="{{ asset('storage/Linkdin.png') }}" alt="" height="30px" width="30px"></div>
    </a>
    @endif


    @if($boutique_info['lien_instagram']!='')
    <a style="display: inline;text-decoration:none" class="a_blue"  href="{{$boutique_info['lien_instagram']}}" target="_blank">    <div style="padding-left: 20px;display:inline-block;padding-bottom:10px">Instagram <img src="{{ asset('storage/insta.png') }}" alt="" height="30px" width="30px"></div>
    </a>
    @endif

    @if($boutique_info['lien_visite_3d']!='')
    <a style="display: inline;text-decoration:none" class="a_blue"  href="{{$boutique_info['lien_visite_3d']}}" target="_blank">    <div style="padding-left: 20px;display:inline-block;padding-bottom:10px">{{__('boutiqua.visite_virtuelle')}} </div>
    </a>
    @endif --}}


  {{--   <a style="display: inline;text-decoration:none"  href="{{route('actualites',$id_boutique)}}" class="a_yellow" >    <div style="padding-left: 20px;display:inline-block;padding-bottom:10px;">{{__('boutiqua.news')}} </div>
    </a>
    <a onclick="show_locals()" style="display: inline;text-decoration:none" class="a_blue"  href="#" >    <div style="padding-left: 20px;display:inline-block;padding-bottom:10px">{{__('boutiqua.notre_local')}} </div>
        
    </a>
  
</div>
</div> --}}


<script>

  
  
        //Get the button
        let mybutton = document.getElementById("btn-back-to-top");
  
  // When the user scrolls down 20px from the top of the document, show the button
  window.onscroll = function () {
  scrollFunction();
  };
  
  function scrollFunction() {
  if (
  document.body.scrollTop > 20 ||
  document.documentElement.scrollTop > 20
  ) {
  mybutton.style.display = "block";
  } else {
  mybutton.style.display = "none";
  }
  }
  // When the user clicks on the button, scroll to the top of the document
  mybutton.addEventListener("click", backToTop);
  
  function backToTop() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
  }
  
  
  
     
   var id_vendeur="{{$id_vendeur}}";
        var sort_selectionner="";
        var sort_selectionner_valider="";
        var id_sort_image_selectionner_valider="";
        var id_sort_image_selectionner="";
          var pagination=1;
          var min_valider=0;
          var max_valider=0;
          var min=0;
          var max=0;
          var tailles="";
      var tab_tailles = [];
      var colores="";
      var tab_colores = [];
      var categories="";
      var tab_categories = [];
      var etats="";
      var tab_etats = [];
      var search="";
      var genre="";
      var type_tissus="";
          var myTimeout;
          function favoris(id,art)
          {
              var snack = document.getElementById("snackbar");
              snack.className = snack.className.replace("show", "");
             var _token=$('input[name="_token"]').val();
             $.ajax({
         url:("{{route('change_favoris')}}"),
         method:"POST",
         data:{idarticle:id,
         _token:_token
         
         },
         success:function(data)
         {
         
         
             var x = document.getElementById("snackbar");
         
         // Add the "show" class to DIV
         x.className = "show col";
         
         // After 3 seconds, remove the show class from DIV
         console.log(art);
         $("#snackbar").html(data);
         if(data=="{{__('favoris.like')}}"){
          $("#"+art).attr("src","{{ asset('storage/likeplein.png') }}");
         }else{
          $("#"+art).attr("src","{{ asset('storage/likevide_1.png') }}");
         }
         clearTimeout(myTimeout);
          myTimeout=setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
         }
         ,error:function(error)
  {
  // error alert message
  console.log(error);
  }
         });
          }
         
  
  
  
  
  // filter
  
  
  
  /* seconde slide progress */
  
  var slider = document.getElementById("myRange");
  var output = document.getElementById("demo");
  output.innerHTML = slider.value + " " +'DH'; // Display the default slider value
  
  // Update the current slider value (each time you drag the slider handle)
  slider.oninput = function () {
    const value = `${this.value} DH`
    output.innerHTML = value;
    max=this.value;
  }
  
  
  /* first slide progress */
  
  var input_minimum = document.getElementById("myRange_minimum");
  var pix_minimum = document.getElementById("pix_minimum");
  
  pix_minimum.innerHTML = input_minimum.value + " " + "DH"
  
  input_minimum.oninput = function () {
  
    const value = `${this.value} DH`
    pix_minimum.innerHTML = value;
    min=this.value;
  }
  
  
  
  
  const tabs = document.querySelectorAll(".scrollable-tabs-container li");
  
  const rightArrow = document.querySelector(
    ".scrollable-tabs-container .right-arrow svg"
  );
  const leftArrow = document.querySelector(
    ".scrollable-tabs-container .left-arrow svg"
  );
  const tabsList = document.querySelector(".scrollable-tabs-container ul");
  
  const leftArrowContainer = document.querySelector(
    ".scrollable-tabs-container .left-arrow"
  );
  const rightArrowContainer = document.querySelector(
    ".scrollable-tabs-container .right-arrow"
  );
  
  /* const removeAllActiveClasses = () => {
    tabs.forEach((tab) => {
      tab.classList.remove("active");
    });
  }; */
  
  tabs.forEach((tab) => {
    tab.addEventListener("click", () => {
      if (tab.querySelector('img')) {
        tab.removeChild(tab.querySelector('img'));
      } else {
        var img = document.createElement('img');
        img.src = '{{asset('storage/Rectangle_4-removebg-preview.png')}}';
        img.setAttribute("donn", tab.getAttribute("donn"));
        img.className = 'img_link_color col';
        tab.appendChild(img);
      }
    });
  });
  
  
  
  const manageIcons = () => {
    if (tabsList.scrollLeft >= 20) {
      leftArrowContainer.classList.add("active");
    } else {
      leftArrowContainer.classList.remove("active");
    }
  
    let maxScrollValue = tabsList.scrollWidth - tabsList.clientWidth - 20;
    console.log("scroll width: ", tabsList.scrollWidth);
    console.log("client width: ", tabsList.clientWidth);
  
    if (tabsList.scrollLeft >= maxScrollValue) {
      rightArrowContainer.classList.remove("active");
    } else {
      rightArrowContainer.classList.add("active");
    }
  };
  
  rightArrow.addEventListener("click", () => {
    tabsList.scrollLeft += 200;
    manageIcons();
  });
  
  leftArrow.addEventListener("click", () => {
    tabsList.scrollLeft -= 200;
    manageIcons();
  });
  
  tabsList.addEventListener("scroll", manageIcons);
  
  let dragging = false;
  
  const drag = (e) => {
    if (!dragging) return;
    tabsList.classList.add("dragging");
    tabsList.scrollLeft -= e.movementX;
  };
  
  tabsList.addEventListener("mousedown", () => {
    dragging = true;
  });
  
  tabsList.addEventListener("mousemove", drag);
  
  document.addEventListener("mouseup", () => {
    dragging = false;
    tabsList.classList.remove("dragging");
  });
  
  
  
  
  
  
  /* categorie */
  
  
  var listItems = document.querySelectorAll('#Categories li');
  var listItems_link = document.querySelectorAll('#Categories li a');
  
  var listItems_link_etat = document.querySelectorAll('#etat li a');
  var listItems_etat = document.querySelectorAll('#etat li');
  
  var listItems_taille = document.querySelectorAll('#scrollable-tabs-container-tailles  a');
  /* var all = document.getElementById('select_all'); */
  
  
  listItems.forEach(function (item) {
    item.addEventListener('click', function () {
      if (this.querySelector('img')) {
        this.removeChild(this.querySelector('img'));
      } else {
        var img = document.createElement('img');
        img.src = '{{asset('storage/Rectangle_4-removebg-preview.png')}}';
        img.className = 'img_link col'
        this.appendChild(img);
      }
    });
  });
  
  
  listItems_etat.forEach(function (item) {
    item.addEventListener('click', function () {
      if (this.querySelector('img')) {
        this.removeChild(this.querySelector('img'));
      } else {
        var img = document.createElement('img');
        img.src = '{{asset('storage/Rectangle_4-removebg-preview.png')}}';
        img.className = 'img_link col'
        this.appendChild(img);
      }
    });
  });
  
  listItems_link.forEach(function (item) {
    item.addEventListener('click', function () {
      this.classList.toggle('change');
    });
  })
  listItems_link_etat.forEach(function (item) {
    item.addEventListener('click', function () {
      this.classList.toggle('change_etat');
    });
  })
  
  /* taille */
  
  listItems_taille.forEach(function (item) {
    item.addEventListener('click', function () {
      this.classList.toggle('tailles');
    });
  })
  
  
  
  
  
  
  
  
  function open_filter()
  {
      
      $('#filter_modal').modal('show');
  }
  
  
  function valider_filtre(type_modal)
  {
      pagination=1;
      console.log(min);
      console.log(max);
   tailles="";
  
      tab_tailles = document.getElementsByClassName("tailles");
      for (i = 0; i < tab_tailles.length; i++) {
           if(i!=tab_tailles.length-1)
           {
              tailles+=tab_tailles[i].getAttribute("donn")+';';
           }else {
              tailles+=tab_tailles[i].getAttribute("donn");
           }
      }
      
      console.log(tailles);
  
        colores="";
  
  tab_colores = document.getElementsByClassName("img_link_color");
  for (i = 0; i < tab_colores.length; i++) {
       if(i!=tab_colores.length-1)
       {
          colores+=tab_colores[i].getAttribute("donn")+';';
       }else {
          colores+=tab_colores[i].getAttribute("donn");
       }
  }
  
  console.log(colores); 
  
  
   categories="";
  
  tab_categories = document.getElementsByClassName("change");
  for (i = 0; i < tab_categories.length; i++) {
       if(i!=tab_categories.length-1)
       {
          categories+=tab_categories[i].getAttribute("donn")+';';
       }else {
          categories+=tab_categories[i].getAttribute("donn");
       }
  }
  
  console.log(categories); 
  
  
   etats="";
  
  tab_etats = document.getElementsByClassName("change_etat");
  for (i = 0; i < tab_etats.length; i++) {
       if(i!=tab_etats.length-1)
       {
          etats+=tab_etats[i].getAttribute("donn")+';';
       }else {
          etats+=tab_etats[i].getAttribute("donn");
       }
  }
   genre=$('#combo_genre').val();
   type_tissus=$('#type_tissus').val();
  console.log(etats); 
  
  min_valider=min;
  max_valider=max;
  id_sort_image_selectionner_valider=id_sort_image_selectionner;
  sort_selectionner_valider=sort_selectionner;
  search=$('#search').val();
  if(type_modal=='filtre')
  {
    $('#filter_modal').modal('hide');
  }
  if(type_modal=='sort')
  {
    $('#modal_sort').modal('hide');
  }
  
  $('#modal_loading').modal('show');
  var _token=$('input[name="_token"]').val();
             $.ajax({
         url:("{{route('filtre_page_vendeur')}}"),
         method:"POST",
         data:{page:pagination,
         _token:_token,
         taille:tailles,
         categorie:categories,
         color:colores,
         etat:etats,
         prix_min:min,
         prix_max:max,
         search:search,
         sort:sort_selectionner_valider,
         genre:genre,
         type_tissue:type_tissus,
         id_vendeur:id_vendeur,
         pagination:9
         },
         success:function(data)
         {
         if(data!='erreur')
         {
          $( "#afficher_plus" ).remove();
          $('#div_articles').html(data);
          $('#div_nb_article').html($('#input_nbr_article').val());
         }
         $('#modal_loading').modal('hide');
       
         }
         ,error:function(error)
  {
  // error alert message
  
  $('#modal_loading').modal('hide');
  if(type_modal=='filtre')
  {
    $('#filter_modal').modal('show');
  }
  if(type_modal=='sort')
  {
    $('#modal_sort').modal('show');
  }
  
  console.log(error);
  }
         });
  
  
  
  }
  
  
  
  
  
  
  
  function afficher_plus(sign)
  {

    
if(sign=='+')
{
  pagination=pagination+1;
}
if(sign=='-')
{
  if(pagination==1)
{
  return
}
  pagination=pagination-1;
}
if(pagination==0)
{
  pagination=1;
}
$('#modal_loading').modal('show');
      var _token=$('input[name="_token"]').val();
             $.ajax({
         url:("{{route('filtre_page_vendeur')}}"),
         method:"POST",
         data:{page:pagination,
         _token:_token,
         taille:tailles,
         categorie:categories,
         color:colores,
         etat:etats,
         prix_min:min,
         prix_max:max,
         search:search,
         sort:sort_selectionner_valider,
         genre:genre,
         type_tissue:type_tissus,
         id_vendeur:id_vendeur,
         pagination:9
         },
         success:function(data)
         {
         if(data!='erreur')
         {
          $( "#afficher_plus" ).remove();
        /*   var content_d =$('#div_articles').html();
          content_d+=data; */
          
          $('#div_articles').html(data);
          document.getElementById('image_p').scrollIntoView();
          $('#div_nb_article').html($('#input_nbr_article').val());
          
         }
         $('#modal_loading').modal('hide');
         }
         ,error:function(error)
  {
  // error alert message
  console.log(error);
  $('#modal_loading').modal('hide');
  }
         });
  
  }
  
  
  function close_filter()
  {
    $('#myRange_minimum').val(min_valider);
    $('#pix_minimum').html(min_valider+' DH');
  
    $('#myRange').val(max_valider);
    $('#demo').html(max_valider+' DH');
  
    // tailles close
    tab_tailles_close = document.getElementsByClassName("class_tailles");
    var myArray = tailles.split(";");
    for (i = 0; i < tab_tailles_close.length; i++) {
      tab_tailles_close[i].classList.remove('tailles');
      if(myArray.includes(tab_tailles_close[i].getAttribute("donn")))
      {
        tab_tailles_close[i].classList.add('tailles');
      } 
  }
  
     
     // colors close
    tab_colors_close = document.getElementsByClassName("class_colors");
     myArray = colores.split(";");
    for (i = 0; i < tab_colors_close.length; i++) {
  
  
      if (tab_colors_close[i].querySelector('img')) {
      tab_colors_close[i].removeChild(tab_colors_close[i].querySelector('img'));
      }
      if(myArray.includes(tab_colors_close[i].getAttribute("donn")))
      {
        var img = document.createElement('img');
        img.src = '{{asset('storage/Rectangle_4-removebg-preview.png')}}';
        img.setAttribute("donn", tab_colors_close[i].getAttribute("donn"));
        img.className = 'img_link_color col';
        tab_colors_close[i].appendChild(img);
      } 
  }
  
  // close categories
  
  var listItems2_close = document.querySelectorAll('#Categories li');
  var listItems_link2_close = document.querySelectorAll('#Categories li a');
  
  
  myArray = categories.split(";");
  
  
  for (i = 0; i < listItems2_close.length; i++) {
    if (listItems2_close[i].querySelector('img')) {
      listItems2_close[i].removeChild(listItems2_close[i].querySelector('img'));
      listItems_link2_close[i].classList.remove('change');
  } 
  
  if(myArray.includes(listItems_link2_close[i].getAttribute("donn")))
      {
        var img = document.createElement('img');
        img.src = '{{asset('storage/Rectangle_4-removebg-preview.png')}}';
        img.className = 'img_link col'
        listItems2_close[i].appendChild(img);
        listItems_link2_close[i].classList.add('change');
      }
  }
  
  
  // close etat
  
  var listItems_etat2_close = document.querySelectorAll('#etat li');
  var listItems_link_etat2_close = document.querySelectorAll('#etat li a');
  
  myArray = etats.split(";");
  
  for (i = 0; i < listItems_etat2_close.length; i++) {
    if (listItems_etat2_close[i].querySelector('img')) {
      listItems_etat2_close[i].removeChild(listItems_etat2_close[i].querySelector('img'));
      listItems_link_etat2_close[i].classList.remove('change_etat');
  } 
  
  if(myArray.includes(listItems_link_etat2_close[i].getAttribute("donn")))
      {
        var img = document.createElement('img');
        img.src = '{{asset('storage/Rectangle_4-removebg-preview.png')}}';
        img.className = 'img_link col'
        listItems_etat2_close[i].appendChild(img);
        listItems_link_etat2_close[i].classList.add('change_etat');
      }
  }
  
  
    $('#filter_modal').modal('hide');
  }
  
  
  
  function tout_selectionner_categories(select)
  {
      var listItems2 = document.querySelectorAll('#Categories li');
  var listItems_link2 = document.querySelectorAll('#Categories li a');
  
  
  if(select.innerHTML=="{{__('filtre.tout_selectionner')}}")
  {
  
  
  listItems2.forEach(function (item) {
  
      if (item.querySelector('img')) {
         
      } else {
        var img = document.createElement('img');
        img.src = '{{asset('storage/Rectangle_4-removebg-preview.png')}}';
        img.className = 'img_link col'
        item.appendChild(img);
      }
   
  });
  
  listItems_link2.forEach(function (item) {
   
      item.classList.add('change');
   
  })
  
  select.innerHTML="{{__('filtre.tout_deselectionner')}}";
  
  }else{
   
  
      listItems2.forEach(function (item) {
  
  if (item.querySelector('img')) {
      item.removeChild(item.querySelector('img'));
  } 
  
  });
  
  listItems_link2.forEach(function (item) {
  
  item.classList.remove('change');
  
  })
  select.innerHTML="{{__('filtre.tout_selectionner')}}";
  }
  }
  
  function tout_selectionner_etat(select)
  {
    
  
      var listItems_etat2 = document.querySelectorAll('#etat li');
  var listItems_link_etat2 = document.querySelectorAll('#etat li a');
  
  
  if(select.innerHTML=="{{__('filtre.tout_selectionner')}}")
  {
  
  
      listItems_etat2.forEach(function (item) {
  
      if (item.querySelector('img')) {
         
      } else {
        var img = document.createElement('img');
        img.src = '{{asset('storage/Rectangle_4-removebg-preview.png')}}';
        img.className = 'img_link col'
        item.appendChild(img);
      }
   
  });
  
  listItems_link_etat2.forEach(function (item) {
   
      item.classList.add('change_etat');
   
  })
  
  select.innerHTML="{{__('filtre.tout_deselectionner')}}";
  
  }else{
   
  
      listItems_etat2.forEach(function (item) {
  
  if (item.querySelector('img')) {
      item.removeChild(item.querySelector('img'));
  } 
  
  });
  
  listItems_link_etat2.forEach(function (item) {
  
  item.classList.remove('change_etat');
  
  })
  select.innerHTML="{{__('filtre.tout_selectionner')}}";
  }
  
  
  
  
  }
  
  function effacer_filtre()
  {
    $('#myRange_minimum').val(0);
    $('#pix_minimum').html(0+' DH');
  
    $('#myRange').val(0);
    $('#demo').html(0+' DH');
  
    // tailles close
    tab_tailles_close = document.getElementsByClassName("class_tailles");
    var myArray = tailles.split(";");
    for (i = 0; i < tab_tailles_close.length; i++) {
      tab_tailles_close[i].classList.remove('tailles');
   
  }
  
     
     // colors close
    tab_colors_close = document.getElementsByClassName("class_colors");
     myArray = colores.split(";");
    for (i = 0; i < tab_colors_close.length; i++) {
  
  
      if (tab_colors_close[i].querySelector('img')) {
      tab_colors_close[i].removeChild(tab_colors_close[i].querySelector('img'));
      }
  
  }
  
  // close categories
  
  var listItems2_close = document.querySelectorAll('#Categories li');
  var listItems_link2_close = document.querySelectorAll('#Categories li a');
  
  
  myArray = categories.split(";");
  
  
  for (i = 0; i < listItems2_close.length; i++) {
    if (listItems2_close[i].querySelector('img')) {
      listItems2_close[i].removeChild(listItems2_close[i].querySelector('img'));
      listItems_link2_close[i].classList.remove('change');
  } 
  
  
  }
  
  
  // close etat
  
  var listItems_etat2_close = document.querySelectorAll('#etat li');
  var listItems_link_etat2_close = document.querySelectorAll('#etat li a');
  
  myArray = etats.split(";");
  
  for (i = 0; i < listItems_etat2_close.length; i++) {
    if (listItems_etat2_close[i].querySelector('img')) {
      listItems_etat2_close[i].removeChild(listItems_etat2_close[i].querySelector('img'));
      listItems_link_etat2_close[i].classList.remove('change_etat');
  } 
  
  
  }
  }
  function open_sort()
  {
    $('#modal_sort').modal('show');
  }
  function select_sort(image_sort,sort)
  {
    $('#image_sort_1').css('visibility', 'hidden');
    $('#image_sort_2').css('visibility', 'hidden');
    $('#image_sort_3').css('visibility', 'hidden');
    $('#image_sort_4').css('visibility', 'hidden');
  
    sort_selectionner=sort;
    id_sort_image_selectionner=image_sort;
  
  $('#'+image_sort).css('visibility', 'visible');
  }
  
  function close_sort()
  {
    if(id_sort_image_selectionner_valider!="")
    {
      $('#image_sort_1').css('visibility', 'hidden');
    $('#image_sort_2').css('visibility', 'hidden');
    $('#image_sort_3').css('visibility', 'hidden');
    $('#image_sort_4').css('visibility', 'hidden');
  
    sort_selectionner=sort_selectionner_valider;
  
  $('#'+id_sort_image_selectionner_valider).css('visibility', 'visible');
    }else{
      $('#image_sort_1').css('visibility', 'hidden');
    $('#image_sort_2').css('visibility', 'hidden');
    $('#image_sort_3').css('visibility', 'hidden');
    $('#image_sort_4').css('visibility', 'hidden');
    }
    $('#modal_sort').modal('hide');
  }
  
  function effacer_sort()
  {
    $('#image_sort_1').css('visibility', 'hidden');
    $('#image_sort_2').css('visibility', 'hidden');
    $('#image_sort_3').css('visibility', 'hidden');
    $('#image_sort_4').css('visibility', 'hidden');
    sort_selectionner="";
  
  }
  
  
  
  let slideIndex = 1;
  showSlides(slideIndex);
  
  function plusSlides(n) {
    showSlides(slideIndex += n);
  }
  
  function currentSlide(n) {
    showSlides(slideIndex = n);
  }
  
  function showSlides(n) {
    let i;
    let slides = document.getElementsByClassName("mySlides");
    let dots = document.getElementsByClassName("dot");
    if (n > slides.length) {slideIndex = 1}    
    if (n < 1) {slideIndex = slides.length}
    for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";  
    }
    for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex-1].style.display = "block";  
    dots[slideIndex-1].className += " active";
  }




    function show_locals(){
         $('#Modal_locals').modal('show');
}



</script>

@endsection