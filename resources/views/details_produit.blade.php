@extends('navbar')
@section('content')
<link href="https://fonts.googleapis.com/css?family=Bentham|Playfair+Display|Raleway:400,500|Suranna|Trocchi" rel="stylesheet">
<link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
<!--<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">-->
<link rel="stylesheet" type="text/css" href="{{ url('/css/details_produit.css') }}" />
<style>
  .w3-light-grey,.w3-hover-light-grey:hover,.w3-light-gray,.w3-hover-light-gray:hover{color:#000!important;background-color:#f1f1f1!important}
  .w3-black,.w3-hover-black:hover{color:#fff!important;background-color:#000!important}

</style>
<div class="containe" style="display: flex;justify-content: center; margin-top:20px">

            
{{ csrf_field() }}
<input name="article_id" type="hidden"  value="{{$idarticle}}">



@if($article['smessage']=='non trouvé')
      <div style="text-align: center;padding-top: 15%">Article non trouvé</div> 
      @else 
<div class="background"></div>
<div class="product-card">
    <div class="left-column">
      @if($article['sPhoto1']!="")
    
        <img id="image_principal" style="object-fit: contain"  src="{{$article['sPhoto1']}}">
  
      @endif

      
    </div>
    <div class="right-column">
        <div class="product-name">
            <ul class="row_containe" >

              @if($article['sPhoto1']!="")
              <li class="col_li" >
                <img style="cursor: pointer" onclick="change_image(this.src)" class="img_chontio" src="{{$article['sPhoto1']}}">
              </li>
              @endif
              @if($article['sPhoto2']!="")
              <li class="col_li" >
                <img style="cursor: pointer" onclick="change_image(this.src)" class="img_chontio" src="{{$article['sPhoto2']}}">
              </li>
              @endif
              @if($article['sPhoto3']!="")
              <li class="col_li" >
                <img style="cursor: pointer" onclick="change_image(this.src)" class="img_chontio" src="{{$article['sPhoto3']}}">
              </li>
              @endif
              @if($article['sPhoto4']!="")
              <li class="col_li" >
                <img style="cursor: pointer" onclick="change_image(this.src)" class="img_chontio" src="{{$article['sPhoto4']}}">
              </li>
              @endif
              @if($article['sPhoto5']!="")
              <li class="col_li" >
                <img style="cursor: pointer" onclick="change_image(this.src)" class="img_chontio" src="{{$article['sPhoto5']}}">
              </li>
              @endif

            </ul>
            <div class="title" style="margin-top:5px ;">
                <h1>{{$article['sNom_produit']}}</h1>
            </div>
        </div>
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


          {{--   <span class="star1"><img src="images/stars.png" class="img_stars"   alt=""></span>
            <span class="star1"><img src="images/stars.png" class="img_stars"   alt=""></span>
            <span class="star1"><img src="images/stars.png" class="img_stars"   alt=""></span>
            <span class="star1"><img src="images/stars.png" class="img_stars"   alt=""></span>
            <span class="star1"><img src="images/stars.png" class="img_stars"   alt=""></span> --}}
            
         
        </div>
        <div class="price" id="prix"></div>
        <div class="description">
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
        <button class="btn" type="submit">
            <i class="fas fa-shopping-cart"></i> ADD TO CART
        </button>
    </div>
</div>
</div>



































<p style="text-align: center;padding-top:50px"> Avis général :</p>


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
<div style="width: 70%;  margin: auto;">
  <div >
    <div class="row" style="align-items: center;padding-bottom:20px">
<div class="col-1" style="font-size: 40px">{{$nombre_format_francais}}</div><br>
<div class="col-8"></div>
<div class="col-3">basé sur {{$rate['nb_avis']." ".__('page_details_produit.avis')}}</div>
    </div>
  <div class="row" >
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

 <div class="row" style="align-items: center">
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
</div><br>

<div class="row" style="align-items: center">
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



<div class="row" style="align-items: center">
  2
<div class="col-1">
<i  class="star yellow fas fa-star" data-index="3"></i>
</div>
<div class="col-10">
<div class="w3-light-grey">
<div class="w3-black" style="height:15px;width:{{$poucentage2}}%"></div>
</div>
</div>
{{$rate['nb_2t']}}
</div><br>



<div class="row" style="align-items: center">
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
</div><br>
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