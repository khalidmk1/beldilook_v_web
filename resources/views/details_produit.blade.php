@extends('navbar')
@section('content')
<link href="https://fonts.googleapis.com/css?family=Bentham|Playfair+Display|Raleway:400,500|Suranna|Trocchi" rel="stylesheet">
<link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{ url('/css/details_produit.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ url('/css/style.css') }}" />
<style>
  .w3-light-grey,.w3-hover-light-grey:hover,.w3-light-gray,.w3-hover-light-gray:hover{color:#000!important;background-color:#f1f1f1!important}
  .w3-black,.w3-hover-black:hover{color:#fff!important;background-color:#000!important}
  .selected{
    border: #EFEFEF 1px solid;
    background-color: #EFEFEF;
    color: #212529;
    padding: 10px;
    border-radius: 10px;
  
    
  }
  .tags{
    display: inline-block;
    margin-right: 12px;
    letter-spacing: 1px;
    margin-top: 10px;
    cursor: pointer;
    min-width: 50px;
    padding: 10px 27px;
  }

  @media screen and (max-width:768px) {
    .image_principal{
      margin-top: 13px;
    }
  .img_chontio {
    margin: 1rem 0 1rem 0 ;
    padding: 0 0 0 0 !important;
  }
}
</style>

<div class="col"  id="snackbar">Some text some message..</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-12 text-center p-2">{{__('nav.text_download')}}</div>
         <div class="col-12  text-center"> <a target="_blank" href="https://play.google.com/store/apps/details?id=com.isi.beldi_look"><img src="{{asset('storage/093c-DX36-y.png')}}" alt="" style="height: 63px;"></a>
         </div>
        </div>

        <div class="row">
         <div class="col-12  text-center"> <img src="{{asset('storage/telecharger-apple-app-store_francais.png')}}" alt="" style="height: 105px;">
         </div>
        </div>



      </div>
      
    </div>
  </div>
</div>

<div class="container">
  {{ csrf_field() }}
<input name="article_id" type="hidden"  value="{{$idarticle}}">
@if ($article['smessage']=='non trouvé')
 <div style="text-align: center;padding-top: 15%">{{__('nav.article_non_trouve')}}</div> 
@else

    <div class="row justify-content-center">
    <div class="col-sm col-lg-3">
     <div class="row justify-content-center ">
      <div class="col-12 text-center">
        <h1 class="p-2" style="font-size: 30px;">{{$article['sNom_produit']}}</h1>
      </div>
      <div class="col-12  text-center">
  @php
        $etoile=$rate['moyenne_etoile'];
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
        <span class="star1" style="font-size: 12px ;display:inline"> {{$rate['nb_avis']." ".__('page_details_produit.avis')}}</span>
       
      </div>

      <div class="col-12  ">
       <div class="row justify-content-center align-items-center">
       @if ($article['tag1'] != "")
       <div class=" tags selected "> {{$article['tag1']}}</div>
       @endif
     @if ($article['tag2'] != "")
     <div class=" tags selected">{{$article['tag2']}}</div>
     @endif
     @if ($article['tag3'] != "")
     <div class=" tags selected  ">{{$article['tag3']}}</div>
     @endif
     @if ($article['tag4'] != "")
     <div class=" tags selected  ">{{$article['tag4']}}</div>
     @endif
    
       </div>
      
    
      </div>
     </div>
    </div>
    <div class="col-sm col-lg-4 p-0">
      @if($article['sPhoto1']!="")
    
      <img id="image_principal"  class = "img-responsive image_principal w-100"  src="{{$article['sPhoto1']}}">

    @endif
    </div>
    <div class="col col-lg-1 pl-lg-1 pl-xl-1 pl-md-1 pl-sm  ">
      <div class="row flex-xl-column flex-lg-column flex-md-row   flex-sm-row">
        <div class="col">
          @if($article['sPhoto1']!="")
          <img  onclick="change_image(this.src)" class="img_chontio" src="{{$article['sPhoto1']}}">
        @endif
        </div>
        <div class="col">
          @if($article['sPhoto2']!="")
        
          <img  onclick="change_image(this.src)" class="img_chontio" src="{{$article['sPhoto2']}}">
       
        @endif
        </div>
        <div class="col">
          @if($article['sPhoto3']!="")
           
          <img onclick="change_image(this.src)" class="img_chontio" src="{{$article['sPhoto3']}}">
      
        @endif
        </div>
        <div class="col">
          @if($article['sPhoto4']!="")
         
          <img onclick="change_image(this.src)" class="img_chontio" src="{{$article['sPhoto4']}}">
       
        @endif
        </div>
        <div class="col">
          @if($article['sPhoto5']!="")
          
          <img  onclick="change_image(this.src)" class="img_chontio" src="{{$article['sPhoto5']}}">
        
        @endif
        </div>
      </div>
    </div>
    <div class="col-sm col-lg-4 d-flex align-items-center ">
     <div class="row align-items-center">
      <div class="col-12">
        <p>
          {{$article['sDescription']}}
        </p>
      </div>
      <div class="col-12 price">
        <span  id="prix"></span>
      </div>
      @php
        $tailles=$article['tabTaille_produit'];
        $couleurs=$tailles[0];
        @endphp
      <div class="col-12 taille">
        @foreach($tailles as $taille)
        <span classe="black" onclick="get_color('{{$taille['sLib_taille']}}')">{{$taille["sLib_taille"]}}</span>
        @endforeach
      </div>
      <div class="col-12 colors" id="couleur_produit">
        @foreach($couleurs['tabCouleur'] as $couleur)
        <span class="black" onclick="get_prix('{{$couleur['rPrix']}}')" style="background-color: {{$couleur['sHtml_couleur']}};cursor:pointer"></span>
        @endforeach
      </div>
      <div class="col-12">
        <button class="btn btn_add_cart mt-2 " data-toggle="modal" data-target="#exampleModal" type="submit">
          <i class="fas fa-shopping-cart" ></i> {{__('nav.add_to_cart')}}
      </button>
      </div>
     </div>
    </div>
  </div>
</div>
{{-- @endif --}}




{{-- <div class="containe" style="display: flex;justify-content: center; margin-top:20px">

            
{{ csrf_field() }}
<input name="article_id" type="hidden"  value="{{$idarticle}}">



@if($article['smessage']=='non trouvé')
      <div style="text-align: center;padding-top: 15%">{{__('nav.article_non_trouve')}}</div> 
      @else 
<div class="container">

  <div class="row align-items-center" style="gap: 9px;">
    <h1 class="p-2" style="font-size: 30px;">{{$article['sNom_produit']}}</h1>
    <div class="stars">

      <div>
        @php
        $etoile=$rate['moyenne_etoile'];
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
        <span class="star1" style="font-size: 12px ;display:inline"> {{$rate['nb_avis']." ".__('page_details_produit.avis')}}</span>
       
      </div>
     
    </div>
  </div>


<div class="row ">

 
    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 ">
     
      @if($article['sPhoto1']!="")
    
        <img id="image_principal"  class = "img-responsive image_principal"  src="{{$article['sPhoto1']}}">
  
      @endif

      
    </div>
    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 ">

      <div class="row ">
        <div class="col   p-2 pb-2 pl-2 p-sm-2 pr-2 pt-0  text-center">
          @if($article['sPhoto1']!="")
                <img  onclick="change_image(this.src)" class="img_chontio" src="{{$article['sPhoto1']}}">
              @endif
        </div>
        <div class="col p-2 pb-2 pl-2 p-sm-2 pr-2 pt-0 text-center">
          @if($article['sPhoto2']!="")
        
            <img  onclick="change_image(this.src)" class="img_chontio" src="{{$article['sPhoto2']}}">
         
          @endif
        </div>
        <div class="col p-2 pb-2 pl-2 p-sm-2 pr-2 pt-0 text-center">
          @if($article['sPhoto3']!="")
           
                <img onclick="change_image(this.src)" class="img_chontio" src="{{$article['sPhoto3']}}">
            
              @endif
        </div>
        <div class="col p-2 pb-2 pl-2 p-sm-2 pr-2 pt-0 text-center">
          @if($article['sPhoto4']!="")
         
            <img onclick="change_image(this.src)" class="img_chontio" src="{{$article['sPhoto4']}}">
         
          @endif
        </div>
        <div class="col p-2 pb-2 pl-2 p-sm-2 pr-2 pt-0 text-center">
          @if($article['sPhoto5']!="")
          
            <img  onclick="change_image(this.src)" class="img_chontio" src="{{$article['sPhoto5']}}">
          
          @endif
        </div>
      </div>

        <div class="price" id="prix"></div>
        <div class="description p-2">
            <p>
              {{$article['sDescription']}}
            </p>
        </div>

        @php
        $tailles=$article['tabTaille_produit'];
        $couleurs=$tailles[0];
        @endphp

<div class="taille">
@foreach($tailles as $taille)
<span classe="black" onclick="get_color('{{$taille['sLib_taille']}}')">{{$taille["sLib_taille"]}}</span>
@endforeach
</div>
        <div class="colors" id="couleur_produit">
          @foreach($couleurs['tabCouleur'] as $couleur)
          <span class="black" onclick="get_prix('{{$couleur['rPrix']}}')" style="background-color: {{$couleur['sHtml_couleur']}};cursor:pointer"></span>
          @endforeach



       
        </div>
        <button class="btn btn_add_cart mt-2 " data-toggle="modal" data-target="#exampleModal" type="submit">
            <i class="fas fa-shopping-cart" ></i> {{__('nav.add_to_cart')}}
        </button>
    </div>
</div>
</div>
</div> --}}













<br>
<h5 style="padding-left:122px;padding-bottom:10px">{{__('nav.produit_suggerer')}}</h5>
<div class="container">
<div class="row" >
@foreach ($articles2 as $article2)
    


<div style="justify-content: center" class=" col-xl-3 col-lg-3 col-md-4 col-sm-2  d-flex ">
  
     
  
  <div class="card card_content border-0">

  
    
      <a href="{{route('details_produit',$article2['idarticles'])}}">
          <img src="{{ $article2['photo1']}}" class="card-img-top img_product img-fluid"  alt="product_card" >
      </a>

      @if ($article2['favoris5']==1)
     <img id="art{{$article2['idarticles']}}" onclick="favoris({{$article2['idarticles']}},this.id)" class="topright pointer" height="30" width="30" src={{ asset('storage/likeplein.png') }}  alt="">
      @else
     <img id="art{{$article2['idarticles']}}"  onclick="favoris({{$article2['idarticles']}},this.id)" class="topright pointer" height="30" width="30" src={{ asset('storage/likevide_1.png') }} alt="">
      @endif
     

          @if ($article2['nouveau']==1)
          <span class="badge  bottomleft" >{{__('home.nouveau')}}</span>
          @endif

          @if ($article2['rupture_stock']!='no')
          <span class="badge bg-danger bottomright" >{{__('home.rupture_stock')}}</span>

          @endif

      
    

    <div class="card-body p-2 ">
      <p class="mb-1"> <a href="{{route('boutiqua',$article2['idutilisateurs'])}}">{{$article2['nom_vendeur']}}</a></p>
      <h5 class="card-title mb-1 " >{{$article2['libellé']}}</h5>
      <p style="font-size: 14px" class="card-text mb-1"> {{__('boutique_une.etat')}} : {{$article2['etat_tenu']}} </p>
      <p style="font-size: 14px" class="card-text mb-1">{{$article2['prix']." DH"}}</p>
    </div>
  </div>
</div>








@endforeach

</div>



</div>










@if(count($commentaires)!=0)
<div class="container">
  
<p style="text-align: start;padding-top:50px"> Avis général :</p>
</div>
@else
<br>
@endif

@php
if($rate['nb_avis']!=0){
$poucentage5=($rate['nb_5t']/$rate['nb_avis'])*100;
$poucentage4=($rate['nb_4t']/$rate['nb_avis'])*100;
$poucentage3=($rate['nb_3t']/$rate['nb_avis'])*100;
$poucentage2=($rate['nb_2t']/$rate['nb_avis'])*100;
$poucentage1=($rate['nb_1t']/$rate['nb_avis'])*100;
}else{
  $poucentage5=0;
$poucentage4=0;
$poucentage3=0;
$poucentage2=0;
$poucentage1=0;
}
$nombre_format_francais = number_format($rate['moyenne_etoile'], 1, ',', ' ');
//dd($poucentage5);
@endphp
{{-- <div style="width: 70%;  margin: auto;">
  <div >
    <div class="row" style="align-items: center;padding-bottom:20px">
<div class="col-1" style="font-size: 40px">{{$nombre_format_francais}}</div><br>
<div class="col-8"></div>
<div class="col-3">basé sur {{$rate['nb_avis']." ".__('page_details_produit.avis')}}</div>
    </div>
  <div class="row align-items-center" style="flex-wrap: inherit;">
     <span>5</span> 
    <div class="col-1">
    <i  class="star yellow fas fa-star" data-index="3"></i>
  </div>
  <div class="col-10">
<div class="w3-light-grey">
  <div class="w3-black" style="height:15px;width:{{$poucentage5}}%"></div>
</div>
</div>
  {{$rate['nb_5t']}}
</div><br>

 <div class="row align-items-center" style="flex-wrap: inherit;">
      4
    <div class="col-1">
    <i  class="star yellow fas fa-star" data-index="3"></i>
  </div>
  <div class="col-10">
<div class="w3-light-grey">
  <div class="w3-black" style="height:15px;width:{{$poucentage4}}%"></div>
</div>
</div>
  {{$rate['nb_4t']}}
</div>

<br>

<div class="row align-items-center" style="flex-wrap: inherit;">
  3
<div class="col-1">
<i  class="star yellow fas fa-star" data-index="3"></i>
</div>
<div class="col-10">
<div class="w3-light-grey">
<div class="w3-black" style="height:15px;width:{{$poucentage3}}%"></div>
</div>
</div>
{{$rate['nb_3t']}}
</div><br>



<div class="row align-items-center" style="flex-wrap: inherit;">
  2
<div class="col-1">
<i  class="star yellow fas fa-star" data-index="3"></i>
</div>
<div class="col-10">
<div class="w3-light-grey">
<div class="w3-black" style="height:15px;width:{{$poucentage2}}%"></div>
</div>
</div>
<div>{{$rate['nb_2t']}}</div>
</div><br>



<div class="row align-items-center" style="flex-wrap: inherit;" >
  1
<div class="col-1">
<i  class="star yellow fas fa-star" data-index="3"></i>
</div>
<div class="col-10">
<div class="w3-light-grey">
<div class="w3-black" style="height:15px;width:{{$poucentage1}}%"></div>
</div>
</div>
{{$rate['nb_1t']}}
</div><br>--}}
@php
//dd($commentaires);
@endphp
@foreach($commentaires as $commentaire)
<div >
<div style="display: inline-block;"><img height="30" width="30" style="border-radius: 100%" src="{{$commentaire['photo_profile']}}" alt=""><p style="padding-left: 10px;display: inline-block;">{{$commentaire['nom']." ".$commentaire['prenom']." : "}}</p>

  @if($commentaire['nb_etoile']==1)
  <i class="star yellow fas fa-star" data-index="0"></i>
  <i class="star stargrey fas fa-star" data-index="1"></i>
  <i class="star stargrey fas fa-star" data-index="2"></i>
  <i class="star stargrey fas fa-star" data-index="3"></i>
  <i class="star stargrey fas fa-star" data-index="4"></i>
  @endif
  @if($commentaire['nb_etoile']==2)
  <i class="star yellow fas fa-star" data-index="0"></i>
  <i class="star yellow fas fa-star" data-index="1"></i>
  <i class="star stargrey fas fa-star" data-index="2"></i>
  <i class="star stargrey fas fa-star" data-index="3"></i>
  <i class="star stargrey fas fa-star" data-index="4"></i>
  @endif
  @if($commentaire['nb_etoile']==3)
  <i class="star yellow fas fa-star" data-index="0"></i>
  <i class="star yellow fas fa-star" data-index="1"></i>
  <i class="star yellow fas fa-star" data-index="2"></i>
  <i class="star stargrey fas fa-star" data-index="3"></i>
  <i class="star stargrey fas fa-star" data-index="4"></i>
  @endif
  @if($commentaire['nb_etoile']==4)
  <i class="star yellow fas fa-star" data-index="0"></i>
  <i class="star yellow fas fa-star" data-index="1"></i>
  <i class="star yellow fas fa-star" data-index="2"></i>
  <i class="star yellow fas fa-star" data-index="3"></i>
  <i class="star stargrey fas fa-star" data-index="4"></i>
  @endif
  @if($commentaire['nb_etoile']==5)
  <i class="star yellow fas fa-star" data-index="0"></i>
  <i class="star yellow fas fa-star" data-index="1"></i>
  <i class="star yellow fas fa-star" data-index="2"></i>
  <i class="star yellow fas fa-star" data-index="3"></i>
  <i class="star yellow fas fa-star" data-index="4"></i>
  @endif
<br>
</div>
@if($commentaire['commentaire1']!="")
<div>{{$commentaire['commentaire1']}}</div>
@endif
</div>
@endforeach
</div>
</div> 
@endif



<script>
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
 
 </script>

<script>
  function get_prix(pr)
  {
     $("#prix").html(pr+" DH");
  }
  function get_color(taille)
  {
   
     var _token=$('input[name="_token"]').val();
     var article_id=$('input[name="article_id"]').val();
     $.ajax({
 url:("{{route('recuperer_couleur')}}"),
 method:"POST",
 data:{id_article:article_id,
 _token:_token,
 taille:taille
 },
 success:function(data)
 {


    
  console.log(data);
  var sum="";
  data.forEach(myFunction);

function myFunction(item) {
  var su="'"+item['rPrix']+"'";
  var d='<span class="black" onclick="get_prix('+su+')" style="background-color: '+item['sHtml_couleur']+';cursor:pointer"></span>'
  sum += d;
}
console.log(sum);
$('#couleur_produit').html(sum);
 }
 ,error:function(error)
{
// error alert message
console.log(error);
}
 });
  }
 function change_image(im){
  $("#image_principal").attr("src",im);
 }
 </script>


@endsection