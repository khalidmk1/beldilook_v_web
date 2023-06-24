@extends('navbar')
@section('content')

<style>
        .btn_suivi{
        background-color: #B09636;
        border: #B09636;
        width: 80px;
        font-size: 20px;
        width: 210px;
        color: white;
        height: 50px;
        border-radius: 30px;
    }
    .btn_suivi:hover{
        background-color: #86732b;
        border: #86732b;
    }


    .btn_ajouter{
        background-color: #212951;
        border: #212951;
        width: 80px;
        font-size: 17px;
        width: 192px;
        color: white;
        height: 40px;
        border-radius: 30px;
    }
    .btn_ajouter:hover{
        background-color: #283991;
        border: #283991;
    }
    .a_yellow{
        color:goldenrod;
    }
    .a_blue:hover{
color: blue;
    }
    .a_yellow:hover{
color: rgba(117, 119, 5, 0.562);
    }
    .photo_local{
margin-top: 20px;
border: 1px solid black;
}
    @media only screen and (max-width: 600px) {
      .photo_local2{
height: 300px;
width: 300px;
}
}

.pack_txt
{
  font-size:60px;
  font-weight:600;
  letter-spacing:.1px;
}

@media screen and (max-width:948px) {

   .container_title_socialm, .container_social
   {
    width:80% !important;
   }
  
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
          @if($info_social['photol1']=='' && $info_social['photol2']=='' && $info_social['photol3']=='')
          <p style="text-align: center">{{__('boutiqua.aucune_photo')}}</p>
          @endif
          @if($info_social['photol1']!='')
        <img class="photo_local2" id="image_popup" src="{{ $info_social['photol1'] }}" height="470" width="466" style="object-fit: contain">
        @endif
        @if($info_social['photol2']!='')
        <img class="photo_local2" id="image_popup" src="{{$info_social['photol2']}}" height="470" width="466" style="object-fit: contain">
        @endif
        @if($info_social['photol3']!='')
        <img class="photo_local2" id="image_popup" src="{{$info_social['photol3']}}" height="470" width="466" style="object-fit: contain">
        @endif
      </div>
      <div class="modal-footer">
       
       
      </div>
    </div>
  </div>
</div>

<input type="file" name="" id="select_im" style="display: none" accept="image/*" onchange="readURL(this);">

@if($pack['pack']=='SILVER')
<div style="position: relative;" class="text-center"><div  style="width: 100%;height:150px;background-color:#D7D8DA" class=" d-flex justify-content-center align-items-center pack_txt">
{{__('boutiqua.pack_silver')}}</div>
</div>
@endif


@if($pack['pack']=='BRONZE')

<div style="" class="text-center"> <div  style="width:100%;height:150px;background-color:#B3961E;" class="pack_txt d-flex justify-content-center align-items-center"> 
{{__('boutiqua.pack_bronze')}}</div>
</div>
@endif

@if($pack['pack']=='GOLD')
<div style="" class=""><div  style="width:100%;height:150px;background-color:#B3961E" class="pack_txt d-flex justify-content-center align-items-center">{{__('boutiqua.pack_gold')}}</div>
</div>

@endif


<div class="d-flex justify-content-center mt-5">

@if(App::getlocale()=="ar")
<h3  style="color:#263066;  position:relative; top:5px;" class="text-center">{{$boutique['nom']}}</h3>
@else
<h3  style="color:#263066;  position:relative; top:5px; " class="">{{$boutique['nom']}} </h3>
@endif
<img src="{{ asset('storage/verifier bl.png') }}" alt="" height="50" width="50">

</div>
<div style="padding-top: 40px;text-align:center">
    @foreach ($produits as $produit)
    <div style="display: inline">
        <a href="{{route('details_produit',$produit['idarticles'])}}">        <img style="border-radius: 50%;margin-right:15px"  src="{{ $produit['photo1'] }}" alt="" height="150" width="150">
        </a>
    </div>
    @endforeach
    @if(count($produits)!=0)
    <a href="{{route('page_vendeur',$iduser)}}">{{__('boutiqua.voir_plus')}}</a>
    @else
    <p class="col-12" style="text-align: center;padding-top: 80px;">{{__('home.aucun_produit')}}</p>
    @endif
</div>
<br>
<br>
<div style="text-align: center" class="mb-3">

<button class="btn_ajouter" style="margin-bottom:10px;" onclick="window.location='{{route('ajout_produit')}}'">{{__('home.btn_ajouter_produit')}}</button>
</div>
<br>
@if($pack['pack']=='GOLD' || $pack['pack']=='SILVER')
@if(App::getlocale()=="ar")
<h3 style="padding: 10px; position:relative; top:15px" class="text-center">{{__('boutiqua.ajouter_images_locale')}} </h3>
@else
<h3 style="padding: 10px; position:relative; top:15px" class="text-center">{{__('boutiqua.ajouter_images_locale')}} </h3>
@endif

<div id="photos_local" style="text-align: center">
@if($info_social['photol1']!='')
<div style="display: inline">
    <img src="{{ $info_social['photol1'] }}" alt="" class="photo_local" height="150px" width="150px" style="margin-left:10px;" ><img src={{ asset('storage/close.png') }} height="20px" width="20px" alt="" style="position: relative;right:0px;top:-70px;" onclick=" this.parentNode.parentNode.removeChild(this.parentNode);">
</div>
@endif
@if($info_social['photol2']!='')
<div style="display: inline">
    <img src="{{ $info_social['photol2'] }}" alt="" class="photo_local" height="150px" width="150px" style="margin-left:10px;" ><img src={{ asset('storage/close.png') }} height="20px" width="20px" alt="" style="position: relative;right:0px;top:-70px;" onclick=" this.parentNode.parentNode.removeChild(this.parentNode);">
</div>
@endif
@if($info_social['photol3']!='')
<div style="display: inline">
    <img src="{{ $info_social['photol3'] }}" alt="" class="photo_local" height="150px" width="150px" style="margin-left:10px;" ><img src={{ asset('storage/close.png') }} height="20px" width="20px" alt="" style="position: relative;right:0px;top:-70px;" onclick=" this.parentNode.parentNode.removeChild(this.parentNode);">
</div>
@endif
</div>
<br>
<br>

<div style="text-align: center;" class="">
<button class="btn_ajouter" onclick="select_image()">{{__('boutiqua.ajouter')}}</button>
</div>
@endif
<br>







<div class="container container_title_socialm" style="width:50%;margin-top:60px;">
    @if(App::getlocale()=="ar")
<div class="row flex-row-reverse">
    @else
    <div class="row">
    @endif
@if(App::getlocale()=="ar")

<div class="col-6 " style="text-align: end"><h5  style="margin: 40px 0px 0px 0px;color:#263066;text-align:end;display:inline;position: relative;top:10px">@if($pack['pack']=='GOLD') {{__('boutiqua.reseau_sociaux')}} @endif</h5>
</div>
@else
<div class="col-6 "><h5  style="font-size:25px;margin: 40px 0px 0px 0px;color:#263066;text-align:start;display:inline;position: relative;top:10px">@if($pack['pack']=='GOLD') {{__('boutiqua.reseau_sociaux')}} @endif</h5>
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
         
        </div>


        {{--   <span class="star1"><img src="images/stars.png" class="img_stars"   alt=""></span>
          <span class="star1"><img src="images/stars.png" class="img_stars"   alt=""></span>
          <span class="star1"><img src="images/stars.png" class="img_stars"   alt=""></span>
          <span class="star1"><img src="images/stars.png" class="img_stars"   alt=""></span>
          <span class="star1"><img src="images/stars.png" class="img_stars"   alt=""></span> --}}
          
       
      </div>
    </a>
</div>
@else

<div class="col-6" style="text-align: end">
    
    <a href="@if($rate_user['nb_avis']!=0) {{route('commentaires',$iduser)}} @else # @endif" style="text-decoration: none;color: black" class="a_blue" >

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

<div class="container container_social"  style="width:50%;"  >
  
<form action="{{route('modifier_ma_boutique')}}" method="post">
@csrf
    <input type="hidden" id="photol1" name="photol1" value="{{ $info_social['photol1'] }}">
<input type="hidden" id="photol2" name="photol2" value="{{ $info_social['photol2'] }}">
<input type="hidden" id="photol3" name="photol3" value="{{ $info_social['photol3'] }}">
@if($pack['pack']=='GOLD')
<div class="mb-3 mt-3 ml-3 mr-3" @if(App::getlocale()=="ar") style="text-align: end" @endif>
    @if(App::getlocale()=="ar")
    <img src="{{ asset('storage/facebook-app-symbol.png') }}" style="margin-right: 5px; margin-bottom:5px;"  alt="" height="23px" width="23px"><label for="facebook">  Facebook</label> 
    @else
    <img src="{{ asset('storage/facebook-app-symbol.png') }}" alt="" style=" margin-bottom:5px;" height="23px" width="23px"> <label for="facebook">Facebook </label> 
    @endif
    
    <input @if(App::getlocale()=="ar") style="text-align: end;margin-top:10px;" @else style="margin-top:10px;" @endif type="text" class="form-control " id="facebook" placeholder="" name="facebook" value="{{ $info_social['lienface'] }}">
    
  </div>


  <div class="mb-3 mt-3 ml-3 mr-3" @if(App::getlocale()=="ar") style="text-align: end" @endif>
    @if(App::getlocale()=="ar")
    <img src="{{ asset('storage/youtube-symbol.png') }}" style="margin-right: 10px"  alt="" height="30px" width="30px"><label for="youtube">  Youtube</label> 
    @else
     <img src="{{ asset('storage/youtube-symbol.png') }}" alt="" height="30px" width="30px"> <label for="youtube" style="margin-left:5px;">Youtube </label>
    @endif
    
    <input @if(App::getlocale()=="ar") style="text-align: end;margin-top:10px;" @else style="margin-top:10px;" @endif type="text" class="form-control " id="youtube" placeholder="" name="youtube" value="{{ $info_social['lienyout'] }}">
    
  </div>


  <div class="mb-3 mt-3 ml-3 mr-3" @if(App::getlocale()=="ar") style="text-align: end" @endif>
    @if(App::getlocale()=="ar")
    <img src="{{ asset('storage/snapchat.png') }}" style="margin-right: 10px" alt="" height="28px" width="28px"><label for="snapshat">  Snapchat</label> 
    @else
     <img src="{{ asset('storage/snapchat.png') }}" alt="" height="28px" width="28px"> <label for="snapshat" style="margin-left:3px;">Snapchat </label>
    @endif
    
    <input @if(App::getlocale()=="ar") style="text-align: end;margin-top:10px;" @else style="margin-top:10px;" @endif type="text" class="form-control " id="snapshat" placeholder="" name="snapshat" value="{{ $info_social['liensnap'] }}">
    
  </div>

  <div class="mb-3 mt-3 ml-3 mr-3" @if(App::getlocale()=="ar") style="text-align: end" @endif>
    @if(App::getlocale()=="ar")
    <img src="{{ asset('storage/linkedin-symbol.png') }}" style="margin-right: 10px;margin-bottom:10px;" alt="" height="24px" width="24px"><label for="linkdin">  Linked-in</label> 
    @else
     <img src="{{ asset('storage/linkedin-symbol.png') }}" alt="" height="24px" width="24px" style="margin-right:8px;margin-bottom:12px;"><label for="linkdin" >Linked-in </label>
    @endif
    
    <input @if(App::getlocale()=="ar") style="text-align: end;margin-top:10px;" @else style="margin-top:10px;" @endif type="text" class="form-control " id="linkdin" placeholder="" name="linkdin" value="{{ $info_social['lienlink'] }}">
    
  </div>

  <div class="mb-3 mt-3 ml-3 mr-3" @if(App::getlocale()=="ar") style="text-align: end" @endif>
    @if(App::getlocale()=="ar")
    <img src="{{ asset('storage/instagram.png') }}" style="margin-right: 10px" alt="" height="25px" width="25px"><label for="instagram">  Instagram</label> 
    @else
    <img src="{{ asset('storage/instagram.png') }}" alt="" height="25px" width="25px" style="margin-right:5px;"> <label for="instagram">Instagram </label> 
    @endif
    
    <input @if(App::getlocale()=="ar") style="text-align: end;margin-top:10px;" @else style="margin-top:10px;" @endif type="text" class="form-control " id="instagram" placeholder="" name="instagram" value="{{ $info_social['lieninst'] }}">
    
  </div>

  <div class="mb-3 mt-3 ml-3 mr-3" @if(App::getlocale()=="ar") style="text-align: end" @endif>
    @if(App::getlocale()=="ar")
    <img src="{{ asset('storage/tik-tok.png') }}" style="margin-right: 10px" alt="" height="25px" width="25px" style="margin-bottom:3px;"><label for="tiktok">  Tiktok</label> 
    @else
    <img src="{{ asset('storage/tik-tok.png') }}" alt="" height="25px" width="25px" style="margin-right:8px; margin-bottom:3px;"><label for="tiktok">Tiktok </label> 
    @endif
    
    <input @if(App::getlocale()=="ar") style="text-align: end;margin-top:10px;" @else style="margin-top:10px;" @endif type="text" class="form-control " id="tiktok" placeholder="" name="tiktok" value="{{ $info_social['lienti'] }}">
    
  </div>


  
  <div class="mb-3 mt-3 ml-3 mr-3" @if(App::getlocale()=="ar") style="text-align: end" @endif>
    @if(App::getlocale()=="ar")
    <label for="visite"> : {{__('boutiqua.visite_virtuelle')}} </label> 
    @else
    <label for="visite">{{__('boutiqua.visite_virtuelle')}} : </label> 
    @endif
    
    <input @if(App::getlocale()=="ar") style="text-align: end;margin-top:10px;" @else style="margin-top:10px;" @endif type="text" class="form-control " id="visite" placeholder="" name="visite" value="{{ $info_social['lienvisit3d'] }}">
    
  </div>
  @endif
  <br>
  <div style="text-align: center">
   
    <a style="display: inline;text-decoration:none"  href="{{route('gestion_actualites')}}" class="a_yellow">    <div style="padding-left: 20px;display:inline-block;padding-bottom:10px;"> {{__('boutiqua.news')}} </div>
    </a>
   
    @if($pack['pack']=='GOLD' || $pack['pack']=='SILVER')
    <a onclick="show_locals()" style="display: inline;text-decoration:none" class="a_blue" href="#" >    <div style="padding-left: 20px;display:inline-block;padding-bottom:10px">{{__('boutiqua.notre_local')}}  </div>
        
    </a>
    @endif
  </div>
 
  <br>
  @if($pack['pack']=='GOLD' || $pack['pack']=='SILVER')
  <div style="text-align: center">
    <input type="submit" value="{{__('boutiqua.confirmer')}}" class="btn_suivi">
  </div>
  @endif
  <br>
  <br>

</form>
</div>

<script>
function select_image()
{
  $('#select_im').click();
}


function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
      tabimgs = document.getElementsByClassName("photo_local");

      if(tabimgs.length==3)
      {
         alert("{{__('boutiqua.max_trois_images')}}");
         return
      }
      

      var content_div=$('#photos_local').html();

      var im=e.target.result;



content_div+='<div style="display: inline-block">';
  content_div+='<img src="'+im+'" alt="" class="photo_local" height="150px" width="150px" style="margin-left:10px;" ><img src={{ asset('storage/close.png') }} height="20px" width="20px" alt="" style="position: relative;right:0px;top:-70px;" onclick=" this.parentNode.parentNode.removeChild(this.parentNode);">';
  content_div+='</div>';


  if(tabimgs.length==0)
      {
        var v=document.getElementById('photol1');
        v.setAttribute("value", im);
      }
      if(tabimgs.length==1)
      {
        var v=document.getElementById('photol2');
        v.setAttribute("value", im);
      }
      if(tabimgs.length==2)
      {
        var v=document.getElementById('photol3');
        v.setAttribute("value", im);
      }

      $('#photos_local').html(content_div);


     
    };
    reader.readAsDataURL(input.files[0]);
  }
}
function show_locals(){
       $('#Modal_locals').modal('show');
}
</script>





@endsection