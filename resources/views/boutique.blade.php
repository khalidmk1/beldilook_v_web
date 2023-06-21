@extends('navbar')
@section('content')
<link rel="stylesheet" type="text/css" href="{{ url('/css/style.css') }}" />
<div class="col" id="snackbar">Some text some message..</div>
    <div class="container items boutique_page_container" style="padding-top:7px">
        <div class="row">
            {{ csrf_field() }}
            @forelse ($boutiques as $boutique)


            <div class="col  width_card col-lg-3 col-md-4 col-sm-6 col-6 p-1 d-flex justify-content-center">
                
                   
                
                <div class="card card_content border-0">

                   {{--  <a href="{{route('boutiqua',$boutique['id_utilisateur'])}}">
                        <img class="card-img-top" src={{ $boutique['image']}} alt="Card image cap" height="200" width="200" style="border-radius: 8px;object-fit: contain;">
                    </a> --}}
                  
                    <a href="{{route('boutiqua',$boutique['id_utilisateur'])}}">
                        <img src="{{ $boutique['image']}} " class="card-img-top img_product img-fluid"  alt="product_card" >
                    </a>


                    {{-- @if ($boutique['favori']=="Vrai")
                    <img id="art{{$boutique['id_utilisateur']}}" onclick="favoris({{$boutique['id_utilisateur']}},this.id)" class="topright pointer" height="30" width="30" src={{ asset('storage/likeplein.png') }} alt="">
                    @else
                    <img id="art{{$boutique['id_utilisateur']}}"  onclick="favoris({{$boutique['id_utilisateur']}},this.id)" class="topright pointer" height="30" width="30" src={{ asset('storage/likevide_1.png') }} alt="">
                    @endif --}}


                    @if ($boutique['favori']=="Vrai")
                   <img id="art{{$boutique['id_utilisateur']}}" onclick="favoris({{$boutique['id_utilisateur']}},this.id)" class="topright pointer" height="30" width="30" src={{ asset('storage/likeplein.png') }}  alt="">
                    @else
                   <img id="art{{$boutique['id_utilisateur']}}"  onclick="favoris({{$boutique['id_utilisateur']}},this.id)" class="topright pointer" height="30" width="30" src={{ asset('storage/likevide_1.png') }} alt="">
                    @endif



                    
                  

                  <div class="card-body p-2 ">
                     <p class="card-title text" data-toggle="{{$boutique['nom']}}">{{$boutique['nom']}} </p>
                  </div>
                </div>
              </div>






        {{-- <div class="col-lg-3 col-md-4 col-sm-6 col-6" style="padding-bottom: 20px;display:flex;justify-content:center;align-items:center;padding-top:5px">
        
            <div class="card card2">
                <div class="imgprod">
                    <a href="{{route('boutiqua',$boutique['id_utilisateur'])}}">
                        <img class="card-img-top" src={{ $boutique['image']}} alt="Card image cap" height="200" width="200" style="border-radius: 8px;object-fit: contain;">
                    </a>
                @if ($boutique['favori']=="Vrai")
                <img id="art{{$boutique['id_utilisateur']}}" onclick="favoris({{$boutique['id_utilisateur']}},this.id)" class="topright pointer" height="30" width="30" src={{ asset('storage/likeplein.png') }} alt="">
                @else
                <img id="art{{$boutique['id_utilisateur']}}"  onclick="favoris({{$boutique['id_utilisateur']}},this.id)" class="topright pointer" height="30" width="30" src={{ asset('storage/likevide_1.png') }} alt="">
                @endif
            </div>
                <div class="card-body">
                  <p class="card-title text" data-toggle="{{$boutique['nom']}}">{{$boutique['nom']}} </p>
                </div>
              </div>
        
        </div>  --}}
           @empty
    <p class="col-12" style="text-align: center;padding-top: 80px;">{{__('home.aucun_boutique')}}</p>
           @endforelse

        </div>
    </div>
   
<div style="text-align: center;padding-bottom:60px;">
    @if ($page==1)
    <a class="paginationa" href="">❮</a>
    @else
    <a class="paginationa" href={{route('boutique',$page-1) }}>❮</a>
    @endif
  
    <a class="paginationa" href={{route('boutique',$page+1) }}>❯</a>
</div>
    <script>
         var myTimeout;
        function favoris(id,art)
        {
            var snack = document.getElementById("snackbar");
            snack.className = snack.className.replace("show", "");
           var _token=$('input[name="_token"]').val();
           $.ajax({
       url:("{{route('change_favoris_boutique')}}"),
       method:"POST",
       data:{idboutique:id,
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
       if(data=="{{__('favoris.like_boutique')}}"){
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


