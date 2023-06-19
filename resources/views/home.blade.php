@extends('navbar')
@section('content')
<link rel="stylesheet" type="text/css" href="{{ url('/css/style.css') }}" />

<link rel="stylesheet" type="text/css" href="{{ url('/css/filter.css') }}" />

<style>


/* #boxThis {
        padding: 5px;
        background-color: #ffffff;
        
      }
      #boxThis.box {
      
        position: fixed;
        top: 0;
        z-index: 9999;
      } */



    .btn_ajouter{
        background-color: #212951;
        border: #212951;
        width: 80px;
        font-size: 17px;
        width: 100px;
        color: white;
        height: 40px;
        border-radius: 30px;
    }
    .btn_sort:hover{
        background-color: #b1a8a8;
        border: 1px solid #000000;
    }
    .btn_sort{
        background-color: #ffffff;
        border: 1px solid #000000;
        width: 80px;
        font-size: 17px;
        width: 100px;
        color: #000000;
        height: 40px;
        border-radius: 30px;
    }
    .btn_sort_2:hover{
        background-color: #83cad3;
        border: 1px solid #2d1194;
    }
    .btn_sort_2{
        background-color: #ffffff;
        border: 1px solid #2d1194;
        font-size: 17px;
        width: 150px;
        color: #2d1194;
        height: 40px;
        border-radius: 30px;
    }
    .btn_ajouter:hover{
        background-color: #283991;
        border: #283991;
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








.mySlides {display: none}


/* Slideshow container */
.slideshow-container {
  max-width: 1000px;
  position: relative;
  margin: auto;
}

/* Next & previous buttons */
.prev, .next {
  cursor: pointer;
  position: absolute;
  top: 50%;
  width: auto;
  padding: 16px;
  margin-top: -22px;
  color: rgb(0, 0, 0);
  font-weight: bold;
  font-size: 18px;
  transition: 0.6s ease;
  border-radius: 0 3px 3px 0;
  user-select: none;
}

/* Position the "next button" to the right */
.next {
  right: 0;
  border-radius: 3px 0 0 3px;
}

/* On hover, add a black background color with a little bit see-through */
.prev:hover, .next:hover {
  background-color: rgba(0,0,0,0.8);
  text-decoration: none;
}

/* Caption text */
.text5 {
  color: #212951;
  font-size: 15px;
  padding: 8px 12px;
 
  width: 100%;
  text-align: center;
  font-size: 30px;
}
.text2 {
  color: #5F6368;
  font-size: 15px;
  padding: 8px 12px;
 
  width: 100%;
  text-align: center;
}

/* Number text (1/3 etc) */
.numbertext {
  color: #000000;
  font-size: 12px;
  padding: 8px 12px;
  position: absolute;
  top: 0;
}

/* The dots/bullets/indicators */
.dot {
  cursor: pointer;
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbb;
  border-radius: 50%;
  display: inline-block;
  transition: background-color 0.6s ease;
}

.active, .dot:hover {
  background-color: #717171;
}

/* Fading animation */
.fade2 {
  animation-name: fade;
  animation-duration: 1.5s;
}
.image_slider {height: 300px;width: 300px;}
@keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}

/* On smaller screens, decrease text size */
@media only screen and (max-width: 300px) {
  .prev, .next,.text {font-size: 11px}
  
}

@media only screen and (max-width: 600px) {
  .image_slider {height: 200px;width: 200px;}

}


.font_side_filtter{
  font-size: 14px;
}



</style>


{{ csrf_field() }}

<div id="modal_popup" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
      {{--   <h5 class="modal-title">Modal title</h5> --}}
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="slideshow-container">
@foreach ($popups as $key=>$popup)
<div class="mySlides fade2">
  <div class="numbertext">{{$key+1}} / {{count($popups)}}</div>
  <div style="text-align: center">
    <img class="image_slider" src="{{$popup['image']}}" >
  </div>
  
  <div class="text5">{{$popup['titre']}}</div>
  
  <div class="text2">{{$popup['description']}}</div>
  <div style="text-align: center">
    <br>
    <button onclick="window.location='{{route('boutiqua',$popup['titre_button'])}}'" class="btn_ajouter" style="width: 250px;text-align:center">{{__('nav.acheter_maintenant')}} <img src="{{asset('storage/next.png')}}" height="20px" width="20px" alt=""></button>
  </div>
  
</div>
@endforeach
        
          
        
          
          <a class="prev" onclick="plusSlides(-1)">❮</a>
          <a class="next" onclick="plusSlides(1)">❯</a>
          
          </div>
          <br>
          
          <div style="text-align:center">
            @foreach ($popups as $key=>$popup)
            <span class="dot" onclick="currentSlide({{$key+1}})"></span> 
            @endforeach
           
          </div>
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

<div class="modal" id="modal_sort" tabindex="-1" role="dialog" data-backdrop="static">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
       
        <button onclick="close_sort()" type="button" class="close" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div style="align-items: center;position:relative">

          <div class="row" style="margin-bottom: 20px;cursor: pointer;" onclick="select_sort('image_sort_1','NG')">
            <img class="col-2" src="{{asset('storage/list.png')}}" height="50px" width="50px" alt="" style="margin-left:15px">  <div class="col" style="text-align: center;margin: auto;">{{__('filtre.nom_ascendent')}}</div> <img style="object-fit: contain;margin:auto;visibility:hidden" height="25px" width="25px" class="col-2" id="image_sort_1" src="{{asset('storage/Rectangle_4-removebg-preview.png')}}" alt="">
          </div>
          <div class="row" style="margin-bottom: 20px;cursor: pointer;" onclick="select_sort('image_sort_2','ND')">
            <img class="col-2" src="{{asset('storage/list2.png')}}" height="50px" width="50px" alt="" style="margin-left:15px">  <div class="col" style="text-align: center;margin: auto;">{{__('filtre.nom_descendant')}}</div> <img style="object-fit: contain;margin:auto;visibility:hidden" height="25px" width="25px" class="col-2" id="image_sort_2" src="{{asset('storage/Rectangle_4-removebg-preview.png')}}" alt="">
          </div>
          <div class="row" style="margin-bottom: 20px;cursor: pointer;" onclick="select_sort('image_sort_3','PG')">
            <img class="col-2" src="{{asset('storage/list3.png')}}" height="50px" width="50px" alt="" style="margin-left:15px">  <div class="col" style="text-align: center;margin: auto;">{{__('filtre.prix_ascendent')}}</div> <img style="object-fit: contain;margin:auto;visibility:hidden" height="25px" width="25px" class="col-2" id="image_sort_3" src="{{asset('storage/Rectangle_4-removebg-preview.png')}}" alt="">
          </div>
          <div class="row" style="margin-bottom: 20px;cursor: pointer;" onclick="select_sort('image_sort_4','PD')">
            <img class="col-2" src="{{asset('storage/list4.png')}}" height="50px" width="50px" alt="" style="margin-left:15px">  <div class="col" style="text-align: center;margin: auto;">{{__('filtre.prix_descendant')}}</div> <img style="object-fit: contain;margin:auto;visibility:hidden" height="25px" width="25px" class="col-2" id="image_sort_4" src="{{asset('storage/Rectangle_4-removebg-preview.png')}}" alt="">
          </div>
        </div>
        
      </div>
      <div class="modal-footer justify-content-center">
        <button type="button" class="btn btn-clear text-black bg-light  " onclick="effacer_sort()">{{__('filtre.effacer')}}</button>
        <button type="button" onclick="valider_filtre('sort')"  class="btn btn-submit">{{__('filtre.appliquer')}}</button>
    </div>
     
    </div>
  </div>
</div>




  <!-- Modal filtre -->
 {{--  <div class="modal" id="filter_modal" data-backdrop="static"  data-bs-keyboard="false" tabindex="-1"
  aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h1 class="modal-title fs-5" id="staticBackdropLabel">Filtres</h1>
              <button onclick="close_filter()" type="button" class="close" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">

              <div class="row">
                  <div class="title col-12">Prix minimum</div>
                  <input class="progress_input slider  p-0 " id="myRange_minimum" type="range" value="0" min="0" max="30000" />
                  <p class="col-12 RadialProgress radian p-0"  style="position: relative; top: 11px;"> <span id="pix_minimum"></span> </p>

              </div>
              <div class="row">
                  <div class="title col-12">Prix maximum</div>
                  <div class="slidecontainer p-0">
                    <input type="range" min="0" max="30000" value="0" class="slider col-12 p-0 " id="myRange"> 
                    <p class="col-12 RadialProgress radian m-0 " style=" position: relative;
                    top: 11px;
                    right: -3px;"> <span id="demo"></span> </p>
                  </div>
                 
              </div>




              
              <div class="container containe mt-5">

                  <div class="title">Taille</div>

                  <div class="scrollable-tabs-container-tailles container" id="scrollable-tabs-container-tailles" style="height: 42px;">
                     
                      <ul class="tailles_responsive" >

                          <li  >
                            <a  class="shadow-sm class_tailles" style="padding-left: 16px;
                            padding-top: 15px;cursor: pointer;" donn="XS" >XS</a>
                          </li>
                  
                          <li>
                            <a  class="shadow-sm class_tailles" style="padding-top: 13px;
                            padding-left: 21px;cursor: pointer;" donn="S" >S</a>
                          </li>
                  
                          <li>
                            <a  class="shadow-sm class_tailles" style="padding-top: 13px;
                            padding-left: 18px;cursor: pointer;" donn="M" >M</a>
                          </li>
                  
                          <li>
                            <a  class="shadow-sm class_tailles" style="    padding-top: 13px;
                            padding-left: 20px;cursor: pointer;" donn="L" >L</a>
                          </li>
                  
                          <li>
                            <a  class="shadow-sm class_tailles" style="padding-top: 13px;
                            padding-left: 17px;cursor: pointer;" donn="XL" >XL</a>
                          </li>
                  
                          <li>
                            <a  class="shadow-sm class_tailles" style="padding-top: 13px;
                            padding-left: 12px;cursor: pointer;" donn="XXL" >XXL</a>
                          </li>
                  
                          <li>
                            <a  class="shadow-sm class_tailles" style="padding-top: 15px;
                            padding-left: 13px;cursor: pointer;" donn="3XL" >3XL</a>
                          </li>
                
                        </ul>

                     
                  </div>

              </div>







              <div class="container containe mt-5">

                  <div class="title">Couleurs</div>

                  <div class="scrollable-tabs-container container">
                      <div class="left-arrow d-none">
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

                      <div class="right-arrow active d-none">
                          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                              stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                              <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                          </svg>
                      </div>
                  </div>

              </div>


              <div class="row">
                  <div class="col text-start" style="font-weight: 500;
                  font-size: max(23px, 0.4rem);">Categories</div>
                  <div onclick="tout_selectionner_categories(this)" class="col cursor_link" style="text-align: end;" id="select_all">Tout sélectionner</div>
              </div>


              <div id="container-categorie" class="container-categorie h-50">
                <ul class=" p-0 mt-1 " id="Categories">
@foreach ($categories as $categorie)
<li class="col-12  li_align " >
    <a class="link_a" style="cursor: pointer;" donn="{{$categorie['idcategorie']}}">{{$categorie['Libelle']}}</a>
  </li>
  <hr class="m-0">
@endforeach
                  
                 
         
                </ul>
              </div>

             <!--  etat tenue -->

              <div class="row mt-5">
                  <div class="col text-start" style="font-weight: 500;
                  font-size: max(23px, 0.4rem);">Etat tenue</div>
                  <div onclick="tout_selectionner_etat(this)" class="col cursor_link"  style="text-align: end;" id="select_all">Tout sélectionner</div>
              </div>


              <div id="container-categorie" class="container-categorie h-50">
                <ul class=" p-0 " id="etat">
                    @foreach ($etats_tenues as $etats_tenue)
                  <li class="col-12  li_align " >
                    <a class="link_a" style="cursor: pointer;" donn="{{$etats_tenue['id']}}">{{$etats_tenue['Libelle']}}</a>
                   
                  </li>

                  <hr class="m-0">
                  @endforeach

                 
                    
         
                </ul>
              </div>


          </div>
          <div class="modal-footer justify-content-center">
              <button type="button" class="btn btn-clear text-black bg-light  " onclick="effacer_filtre()">Effacer</button>
              <button type="button" onclick="valider_filtre('filtre')"  class="btn btn-submit">Appliquer</button>
          </div>
      </div>
  </div>
</div> --}}







<div class="col"  id="snackbar">Some text some message..</div>
 <div class="container">
    <div class="row justify-content-center" style="align-items: center">

      <div class="col-6">
        <input {{-- style="display: inline;width:50%;margin-left:20px;margin-right:20px" --}} id="search" name="search" class="form-control input-sm" id="inputsm" type="text" value="{{$search}}">
      </div>

 <div class="col position-absolute" style="right: 0"> 
  <img onclick="valider_filtre('search')" src="{{asset('storage/searchbl_1.png')}}" style="cursor: pointer;
  position: absolute;
  right: 32%;
  bottom: -15px;
  background: white;
  padding: 3px;" alt="" height="30px" width="30px">
 </div>
        
        
       {{--  <label for="inputsm" style="display: inline;">Search :</label> --}}
    
   
        

    </div>
</div> 




<div style="text-align: center;margin-top:20px;margin-bottom:20px">
  <button style="margin-right: 10px" id="btn_sort_id" class="btn_sort" onclick="open_sort()"> {{__('home.sort')}} </button>
  {{-- <button class="btn_ajouter" onclick="open_filter()"> {{__('home.filtre')}} </button> --}}
</div>


<div class="container" >

  <div class="row p-2 " style="row-gap: 27px;">
    <div class="col  col-xl-3 col-lg-3 col-md-12 col-sm-12 d-flex flex-column justify-content-around">

      <div class="slidecontainer row m-0 p-0 ">
        <div class="col d-flex flex-column justify-content-center p-0">
          <p style="font-weight: 500;" > Min
            <span style="font-size:15px" id="pix_minimum"> </span> </p>
      
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

        <div class="right-arrow active ">
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

          <div class="col-12 p-2   @if(App::getlocale() == "ar") text-right @endif">
            <label for="" style="color:#00000070" class="text-left">{{__('filtre.genre')}}</label>
            <select id="combo_genre" class="border-right-0 border-top-0 border-left-0 p-2 w-100" name="">
              <option value="">{{__('filtre.tout')}}</option>
              <option value="Homme">{{__('filtre.homme')}}</option>
              <option value="Femme">{{__('filtre.femme')}}</option>
              <option value="Garçon">{{__('filtre.garcon')}}</option>
              <option value="Fille">{{__('filtre.fille')}}</option>
          
            </select>
          </div>
         
          <div class="col-12 p-2   @if(App::getlocale() == "ar") text-right @endif">
            <label for=""  style="color:#00000070" class="text-left @if(App::getlocale() == "ar") text-right @endif">{{__('filtre.type_tissue')}}</label>
            <select class="border-right-0 border-top-0 border-left-0 p-2 w-100 " name="" id="type_tissus">
              <option value="" selected>{{__('filtre.tout')}}</option>
              @foreach ($tissus as $tissu)
              <option value="{{$tissu['idtissus']}}">{{$tissu['Libelle']}}</option>
              @endforeach
              
           
            </select>
          </div>


          <div class="row w-100 @if(App::getlocale() == "ar") flex-row-reverse text-right @endif">
            <div class="col col-xl-6 col-lg-6 col-md-6 col-sm-6 font_side_filtter p-3 "  style="font-size: 14px; color:#00000070">
              {{__('filtre.categories')}}  
            </div>
            <div class="col col-xl-6 col-lg-6 col-md-6 col-sm-6 p-3 ">
              <div class="font_side_filtter @if(App::getlocale() == "ar") text-left @endif " style="color:#00000070 ;cursor: pointer; " onclick="tout_selectionner_categories(this)" id="select_all">{{__('filtre.tout_selectionner')}}</div>
            </div>
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

          <div class="row w-100 @if(App::getlocale() == "ar") flex-row-reverse text-right @endif">

          <div class="col col-xl-6 col-lg-6 col-md-6 col-sm-6 font_side_filtter  p-3" style="color:#00000070">{{__('filtre.etat_tenue')}}</div>
          <div class="col col-xl-6 col-lg-6 col-md-6 col-sm-6 cursor_link font_side_filtter  p-3  @if(App::getlocale() == "ar") text-left @endif " style="color:#00000070" id="select_all" onclick="tout_selectionner_etat(this)" >{{__('filtre.tout_selectionner')}}</div>
          </div>
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


         
<div class="row" id="div_articles">



 



          
  @forelse ($articles as $article)

<div class="col-6 col-xl-4 col-lg-4 col-md-4 col-sm-6 d-flex  flex-column  ">
  
     
  
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
      <p class="mb-1"> <a href="{{route('boutiqua',$article['idutilisateurs'])}}">{{$article['nom_vendeur']}}</a></p>
      <h5 class="card-title mb-1 " >{{$article['libellé']}}</h5>
      <p style="font-size: 14px" class="card-text mb-1"> {{__('boutique_une.etat')}} : {{$article['etat_tenu']}} </p>
      <p style="font-size: 14px" class="card-text mb-1">{{$article['prix']." DH"}}</p>
    </div>
  </div>
</div>





@empty
<p class="col-12" style="text-align: center;padding-top: 80px;">{{__('home.aucun_produit')}}</p>
@endforelse

{{-- <div onclick="afficher_plus()" class="col-12" style="text-align: center" id="afficher_plus"><button class="btn_sort_2">{{__('home.afficher_plus')}}</button></div>
 --}}


</div>


<div class="mt-5" style="text-align: center;padding-bottom:50px">


  <a onclick="afficher_plus('-')"  class="paginationa" style="cursor: pointer">❮</a>


  <a onclick="afficher_plus('+')"  class="paginationa" style="cursor: pointer">❯</a>


</div>


        </div>
      
      </div>






{{-- 
      <div class="row"  >
        <div class="col  width_card col-lg-5 col-md-4 col-sm-6 col-6 p-1 d-flex h-100 justify-content-center" style="position: sticky ;top: 115px; position: -webkit-sticky; z-index: 100; background-color: #ffffff ;" >
          <div class="col text-start" style="font-weight: 500;
          font-size: max(23px, 0.4rem);">Categories</div>
          <div onclick="tout_selectionner_categories(this)" class="col cursor_link" style="text-align: end;" id="select_all">Tout sélectionner</div>

          
          
          <div class="col  width_card col-lg-5 col-md-4 col-sm-6 col-6 p-1 d-flex h-100 justify-content-center" style="position: sticky ;top: 115px; position: -webkit-sticky; z-index: 100; background-color: #ffffff ;">

            <div id="container-categorie" class="container-categorie h-50">
              <ul class=" p-0 " id="etat">
                  @foreach ($etats_tenues as $etats_tenue)
                <li class="col-12  li_align " >
                  <a class="link_a" style="cursor: pointer;" donn="{{$etats_tenue['id']}}">{{$etats_tenue['Libelle']}}</a>
                 
                </li>

                <hr class="m-0">
                @endforeach

               
                  
       
              </ul>
            </div>

          </div>
      </div>
      
     



      <div class="col">


      <div class="row " style="padding-top:30px">
       

        



        {{ csrf_field() }}



          
                @forelse ($articles as $article)
              <div class="col  width_card col-lg-6 col-md-4 col-sm-6 col-6 p-1 d-flex justify-content-center">
                
                   
                
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
                    <p class="mb-1"> <a href="{{route('boutiqua',$article['idutilisateurs'])}}">{{$article['nom_vendeur']}}</a></p>
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
  </div>
  </div> --}}



{{-- 
        <div id="div_articles" class="row">
            {{ csrf_field() }}
            @forelse ($articles as $article)
        <div class="col-lg-3 col-md-4 col-sm-6 col-6" style="padding-bottom: 20px;display:flex;justify-content:center;align-items:center">
        
            <div class="card card2" >
                <div class="imgprod">
                    <a href="{{route('details_produit',$article['idarticles'])}}">
                        <img class="card-img-top" src={{ $article['photo1']}} alt="Card image cap" height="200" width="200" style="border-radius: 8px;object-fit: contain;">
                    </a>
                @if ($article['rupture_stock']!='no')
                <span class="badge bg-danger bottomright">{{__('home.rupture_stock')}}</span>
                @endif
                @if ($article['nouveau']==1)
                <span class="badge bg-warning bottomleft" >{{__('home.nouveau')}}</span>
                @endif
                @if ($article['favoris5']==1)
                <img id="art{{$article['idarticles']}}" onclick="favoris({{$article['idarticles']}},this.id)" class="topright pointer" height="30" width="30" src={{ asset('storage/likeplein.png') }} alt="">
                @else
                <img id="art{{$article['idarticles']}}"  onclick="favoris({{$article['idarticles']}},this.id)" class="topright pointer" height="30" width="30" src={{ asset('storage/likevide_1.png') }} alt="">
                @endif
            </div>
                <div class="card-body">
                  <p style="font-size: 17px" class="card-title text" data-toggle="{{$article['libellé']}}">{{$article['libellé']}} </p>
                  <p style="font-size: 14px" class="card-text"> {{__('boutique_une.etat')}} : {{$article['etat_tenu']}} </p>
                  <p style="font-size: 14px" class="card-text">{{$article['prix']." DH"}}</p>
                  
                    <a href="{{route('boutiqua',$article['idutilisateurs'])}}">{{'@'.$article['nom_vendeur']}}</a>
                </div>
              </div>
        
        </div> 
           @empty
    <p class="col-12" style="text-align: center;padding-top: 80px;">{{__('home.aucun_produit')}}</p>
           @endforelse

        </div> --}}

        <button
        type="button"
        class="btn position-fixed btn-lg  m-2 " style="border-radius:50px ; z-index: 200 ;  bottom: 0 ; right: 24px; background-color: #B09636"
        id="btn-back-to-top"
        >
        <i class="fas fa-arrow-up"></i>
        </button>
    </div>

    

   
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



    var show_popup='{{count($popups)}}';
    if(show_popup!='0')
    {
      // show modal popups
      $('#modal_popup').modal('show');
    }
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
       url:("{{route('filtre_home')}}"),
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
       type_tissue:type_tissus
       },
       success:function(data)
       {
       if(data!='erreur')
       {
        $( "#afficher_plus" ).remove();
        $('#div_articles').html(data);
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
$('#modal_loading').modal('show');
  
    var _token=$('input[name="_token"]').val();
           $.ajax({
       url:("{{route('filtre_home')}}"),
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
       type_tissue:type_tissus
       },
       success:function(data)
       {
       if(data!='erreur')
       {
        $( "#afficher_plus" ).remove();
     /*    var content_d =$('#div_articles').html();
        content_d+=data; */
        
        $('#div_articles').html(data);
        document.getElementById('btn_sort_id').scrollIntoView();
        $('#modal_loading').modal('hide');
       }
       
       }
       ,error:function(error)
{
// error alert message
$('#modal_loading').modal('hide');
console.log(error);
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
       </script>
@endsection


