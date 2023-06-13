@extends('navbar')
@section('content')
<link rel="stylesheet" type="text/css" href="{{ url('/css/details_produit.css') }}" />
<link href="https://fonts.googleapis.com/css?family=Bentham|Playfair+Display|Raleway:400,500|Suranna|Trocchi" rel="stylesheet">
<link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">

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



  <div class="container">
    <div class="row">
      <div class="col-sm-3">
        <div class="row">
          <div class="col-12 text-center">
            <img src="{{$boutique['photo']}}" alt="boutique" style="height: 100px " class="rounded-circle">
          </div>
          <div class="col-12">
            <div class="row ">
              <div class="col-8">
                <h1  style="color:#263066; ">{{$boutique['nom']}}</h1>
              </div>
              <div class="col-4">
                <img src="{{ asset('storage/verifier bl.png') }}" alt="" height="50" width="50">
              </div>
            </div>
           
          </div>
          <div class="col-12">
            <div class="row">
              <div class="col  p-2">
                @if($boutique_info['lien_facebook']!='')
                <a style="display: inline;text-decoration:none ; color: black" class="a_blue" href="{{$boutique_info['lien_facebook']}}" target="_blank">    
                  <div style="">Facebook 
                    <img src="{{ asset('storage/facebbok.png') }}" alt="" height="30px" width="30px"></div>
                </a>
                @endif
              </div>
              <div class="col  p-2">
                @if($boutique_info['lien_tiktok']!='')
                <a style="display: inline;text-decoration:none ; color: black" class="a_blue"  href="{{$boutique_info['lien_tiktok']}}" target="_blank">    
                  <div style="">Tiktok 
                    <img src="{{ asset('storage/tiktok.png') }}" alt="" height="30px" width="30px">
                  </div>
                </a>
                @endif

              </div>
              <div class="w-100"></div>
              <div class="col  p-2"> @if($boutique_info['lien_snapshat']!='')
                <a style="display: inline;text-decoration:none ; color: black"  href="{{$boutique_info['lien_snapshat']}}" target="_blank">    
                  <div style="">Snapshat <img src="{{ asset('storage/snapcaht.png') }}" alt="" height="30px" width="30px"></div>
                </a>
                @endif</div>
              <div class="col  p-2"> 
                @if($boutique_info['lien_youtube']!='')
                <a style="display: inline;text-decoration:none ; color: black" class="a_blue"  href="{{$boutique_info['lien_youtube']}}" target="_blank">    
                  <div style="">Youtube <img src="{{ asset('storage/youtube.png') }}" alt="" height="30px" width="30px"></div>
                </a>
                @endif
              </div>

              <div class="w-100"></div>
              <div class="col p-2">
                @if($boutique_info['lien_linkdin']!='')
                <a style="display: inline;text-decoration:none ; color: black" class="a_blue"  href="{{$boutique_info['lien_linkdin']}}" target="_blank">   
                   <div style="">Linkdin <img src="{{ asset('storage/Linkdin.png') }}" alt="" height="30px" width="30px"></div>
                </a>
                @endif
              </div>
              <div class="col  p-2">
                @if($boutique_info['lien_instagram']!='')
                <a style="display: inline;text-decoration:none ; color: black" class="a_blue"  href="{{$boutique_info['lien_instagram']}}" target="_blank">   
                   <div style="">Instagram <img src="{{ asset('storage/insta.png') }}" alt="" height="30px" width="30px"></div>
                </a>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-9">
        <div class="row">
          <div class="col-8 col-sm-6">
            Level 2: .col-8 .col-sm-6
          </div>
          <div class="col-4 col-sm-6">
            Level 2: .col-4 .col-sm-6
          </div>
        </div>
      </div>
    </div>
  </div>






{{-- 
<img src="{{ asset('storage/cover_boutique.jpg') }} " height="300px" width="100%" alt=""> --}}

@if(App::getlocale()=="ar")
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
    @endif


    <a style="display: inline;text-decoration:none"  href="{{route('actualites',$id_boutique)}}" class="a_yellow" >    <div style="padding-left: 20px;display:inline-block;padding-bottom:10px;">{{__('boutiqua.news')}} </div>
    </a>
    <a onclick="show_locals()" style="display: inline;text-decoration:none" class="a_blue"  href="#" >    <div style="padding-left: 20px;display:inline-block;padding-bottom:10px">{{__('boutiqua.notre_local')}} </div>
        
    </a>
  
</div>
</div>


<script>
    function show_locals(){
         $('#Modal_locals').modal('show');
}
</script>

@endsection