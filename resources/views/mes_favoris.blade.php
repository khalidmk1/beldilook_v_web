@extends('navbar')
@section('content')
<link rel="stylesheet" type="text/css" href="{{ url('/css/style.css') }}" />
<style>
    body {font-family: Arial;}
    
    /* Style the tab */
    .tab {
      overflow: hidden;
      text-align: center;
    }
    
    /* Style the buttons inside the tab */
    .tab button {
      background-color: inherit;
    border-radius: 50px;
    width: 153px;
    border: none;
    outline: none;
    cursor: pointer;
    text-align: center;
    padding: 8px 16px;
    transition: 0.3s;
    font-size: 17px;
    }
    
    /* Change background color of buttons on hover */
    .tab button:hover {
      background-color: #ddd;
    }
    
    /* Create an active/current tablink class */
    .tab button.active {
      background-color: #ccc;
    }
    
    /* Style the tab content */
    .tabcontent {
      display: none;
      padding: 6px 12px;
      border-top: none;
      margin-bottom:30px;
    }


    </style>



<!-- Modal articles -->
<div class="modal fade" id="Modal_article" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{__('adresses_livraison.suppression_adresse')}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {{__('favoris.suppression_article')}}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('adresses_livraison.annuler')}}</button>
        <form action={{route('delete_favoris_article')}} method="POST">
          @csrf
          <input id="id_delete_article" type="hidden" name="idarticle" value="">
          <button type="submit" class="btn btn-danger">{{__('adresses_livraison.supprimer')}}</button>
        </form>
       
      </div>
    </div>
  </div>
</div>





<!-- Modal boutique -->
<div class="modal fade" id="Modal_boutique" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{__('adresses_livraison.suppression_adresse')}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {{__('favoris.suppression_boutique')}}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('adresses_livraison.annuler')}}</button>
        <form action={{route('delete_favoris_boutique')}} method="POST">
          @csrf
          <input id="id_delete_boutique" type="hidden" name="idboutique" value="">
          <button type="submit" class="btn btn-danger">{{__('adresses_livraison.supprimer')}}</button>
        </form>
       
      </div>
    </div>
  </div>
</div>











<div class="container mt-3">

  <h2 style="padding: 20px;@if(App::getlocale()=="ar") text-align:end; @endif">{{__('nav.myfavoris')}} </h2>

</div>

<div class="tab mb-4" >
    <button class="tablinks" onclick="openCity(event, 'Articles')">{{__('nav.articles')}}</button>
    <button class="tablinks " onclick="openCity(event, 'Boutiques')">{{__('nav.boutiques')}}</button>
    
  </div>
  
  <div id="Articles" class="tabcontent" >
    <div class="container items">
        <div class="row">
            @forelse ($articles as $article)


            <div class="col  width_card col-lg-3 col-md-4 col-sm-6 col-6 p-1 d-flex justify-content-center">
                
                   
                
              <div class="card card_content border-0">

              
                
                <a href="{{route('details_produit',$article['idarticles'])}}">
                      <img  src={{ $article['image1']}} class="card-img-top img_product img-fluid"  alt="product_card" >
                  
                </a>

                

               
                 <img id="art{{$article['idarticles']}}" onclick="delete_article({{$article['idarticles']}})"  class="topright pointer" height="30" width="30" src={{ asset('storage/supp2_new.png') }}  alt="">
                 
                 

                    


                  
                

                <div class="card-body p-2 ">
                 
                  <h5 class="card-title mb-1 " >{{$article['libellé']}}</h5>
                 
                  <p style="font-size: 14px" class="card-text mb-1">{{$article['prix']." DH"}}</p>
                </div>
              </div>
            </div>



     {{--    <div class="col-lg-3 col-md-4 col-sm-6 col-6" style="padding-bottom: 20px;display:flex;justify-content:center;align-items:center;padding-top:5px">
        
            <div class="card card2" >
                <div class="imgprod">
                <img class="card-img-top" src={{ $article['image1']}} alt="Card image cap" height="200" width="200" style="border-radius: 8px;object-fit: contain;">
                <img id="delete_article" onclick="delete_article({{$article['idarticles']}})" class="topright pointer" height="30" width="30" src={{ asset('storage/supprimer.png') }} alt="">

               
              
            </div>
                <div class="card-body">
                  <p style="font-size: 17px" class="card-title text" data-toggle="{{$article['libellé']}}">{{$article['libellé']}} </p>
                  <p style="font-size: 14px" class="card-text">{{$article['prix']." DH"}}</p>
                </div>
              </div>
        
        </div> --}} 
           @empty
    <p class="col-12" style="text-align: center;padding-top: 80px;">{{__('home.aucun_produit')}}</p>
           @endforelse

        </div>
    </div>
  </div>
  
  <div id="Boutiques" class="tabcontent">
    <div class="container items">
        <div class="row" >
            @forelse ($boutiques as $boutique)


            <div class="col  width_card col-lg-3 col-md-4 col-sm-6 col-6 p-1 d-flex justify-content-center">
                
                   
                
              <div class="card card_content border-0">

              
                
                <a href="{{route('boutiqua',$boutique['id_utilisateur'])}}">
                      <img src={{ $boutique['photologo']}}  class="card-img-top img_product img-fluid"  alt="product_card" >
                  
                </a>

                

               
                      <img id="delete_article" onclick="delete_boutique({{$boutique['id_utilisateur']}})"  class="topright pointer" height="30" width="30" src={{ asset('storage/supp2_new.png') }} alt="">
                 
                 

                    


                  
                

                <div class="card-body p-2 ">
                 
                  <h5 class="card-title mb-1 " >{{$boutique['nomb'].' '.$boutique['prenomb']}} </h5>
                 
                </div>
              </div>
            </div>





      {{--   <div class="col-lg-3 col-md-4 col-sm-6 col-6" style="padding-bottom: 20px;display:flex;justify-content:center;align-items:center;padding-top:5px">
        
            <div class="card card2" >
                <div class="imgprod">
                <img class="card-img-top" src={{ $boutique['photologo']}} alt="Card image cap" height="200" width="200" style="border-radius: 8px;object-fit: contain;">
                <img id="delete_article" onclick="delete_boutique({{$boutique['id_utilisateur']}})"  class="topright pointer" height="30" width="30" src={{ asset('storage/supprimer.png') }} alt="">
            </div>
                <div class="card-body">
                  <p class="card-title text" data-toggle="{{$boutique['nomb']}}">{{$boutique['nomb'].' '.$boutique['prenomb']}} </p>
                </div>
              </div>
        
        </div>  --}}



           @empty
    <p class="col-12" style="text-align: center;padding-top: 80px;">{{__('home.aucun_boutique')}}</p>
           @endforelse
        </div>
        
    </div>
    
  </div>
  
  
  @if(Session::has('success'))
  @if (Session::get('success')==__('favoris.message_success_boutique') )
  @php
$d=1;
@endphp
  @else
  @php
  $d=0;
  @endphp
  @endif
  @else
  @php
  $d=0;
  @endphp
  @endif
  
  <script>
    
    $(document).ready(function() { 
        var tabcontent2 = document.getElementsByClassName("tabcontent");
        var tablinks = document.getElementsByClassName("tablinks");
      
        tabcontent2[{{$d}}].style.display = "block";
        tablinks[{{$d}}].className += " active";
console.log({{$d}});
 

     });


     function delete_article(id){
  $('#id_delete_article').val(id);
         $('#Modal_article').modal('show');
}

function delete_boutique(id){
  $('#id_delete_boutique').val(id);
         $('#Modal_boutique').modal('show');
}
   
  function openCity(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget
    .className += " active";
  }
  </script>

@endsection