@extends('navbar')
@section('content')




<link rel="stylesheet" type="text/css" href="{{ url('/css/style.css') }}" />


<style>
    .cont_title h1
    {
        font-size:40px;
        font-weight:600;
        letter-spacing:.1px;
    }

</style>


<div class="col" id="snackbar">Some text some message..</div>

<div class="container cont_title mt-5 mb-2">
    <h1 style="color:#263066" class="text-center" >{{$lib_type_tag}}</h1>

<h5 style="color:#bd8c2f" class="text-center" >{{$lib_tag}}</h5>
</div>



<div class="container items articles_boutique_une mt-5">
    
   
    <div class="row " style="padding-top:10px">
        {{ csrf_field() }}
          
                @forelse ($articles as $article)
              <div class="width_card col-lg-3 col-md-4 col-sm-6 col-6 p-1 d-flex justify-content-center">
                
                   
                
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
           
        


   {{--  <div class="col-lg-3 col-md-4 col-sm-6 col-6" style="padding-bottom: 20px;display:flex;justify-content:center;align-items:center;padding-top:5px">
    
        <div class="card card2" style="width: 12rem;">
            <div class="imgprod">
                <a href="{{route('details_produit',$article['idarticles'])}}">
                    <img class="card-img-top" src={{ $article['photo1']}} alt="Card image cap" height="200" width="200" style="border-radius: 8px;object-fit: contain;">
                </a>
            @if ($article['rupture_stock']!='no')
            <span class="badge bg-danger bottomright" >{{__('home.rupture_stock')}}</span>
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
            </div>
          </div>
    
    </div>  --}}
       @empty
<p class="col-12" style="text-align: center;padding-top: 80px;">{{__('home.aucun_produit')}}</p>
       @endforelse

    </div>
</div>

<div class="mt-5" style="text-align: center;padding-bottom:50px">

    @if ($page==1)
    <a class="paginationa" href="">❮</a>
    @else
    <a class="paginationa" href={{route('produit_sous_categorie',['id_type'=>$type_tag, 'id_tag'=>$tag,'page'=>$page-1]) }}>❮</a>
    @endif
  
    <a class="paginationa" href={{route('produit_sous_categorie',['id_type'=>$type_tag, 'id_tag'=>$tag,'page'=>$page+1]) }}>❯</a>


</div>
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

@endsection