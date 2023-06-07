@extends('navbar')
@section('content')
<link rel="stylesheet" type="text/css" href="{{ url('/css/style.css') }}" />
<div class="col" id="snackbar">Some text some message..</div>
<div style="text-align: center">
    @if($vendeur['photo']!='no' && $vendeur['photo']!='')
    <img style="border-radius: 50%" src="{{ $vendeur['photo'] }}" alt="" height="150px" width="150px">
    @else
    <img style="border-radius: 50%" src="{{ asset('storage/user.png') }}" alt="" height="150px" width="150px">
    @endif
</div>
<div style="text-align: center">
    <h3>{{$vendeur['nom']}}</h3>
</div>
<hr>



<div class="container items">
    <div class="row">
        {{ csrf_field() }}
        @forelse ($articles as $article)
    <div class="col-lg-3 col-md-4 col-sm-6 col-6 " style="padding-bottom: 20px;display:flex;justify-content:center;align-items:center">
    
        <div class="card card2" >
            <div class="imgprod">
                <a href="{{route('details_produit',$article['idarticles'])}}">
                    <img class="card-img-top " src={{ $article['photo1']}} alt="Card image cap" height="200" width="200" style="border-radius: 8px;object-fit: contain;">
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
    
    </div> 
       @empty
<p class="col-12" style="text-align: center;padding-top: 80px;">{{__('home.aucun_produit')}}</p>
       @endforelse

    </div>
</div>


<div style="text-align: center;padding-bottom:50px">
@if ($page==1 or $page=='')
@if(count($articles)>0)
<a class="paginationa" href="">❮</a>
<a class="paginationa" href={{$request->fullUrlWithQuery(['page' => 2]) }}>❯</a>
@endif
@else
<a class="paginationa" href={{$request->fullUrlWithQuery(['page' => $page-1]) }}>❮</a>
<a class="paginationa" href={{$request->fullUrlWithQuery(['page' => $page+1]) }}>❯</a>

@endif

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