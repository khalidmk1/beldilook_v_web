@extends('navbar')
@section('content')

<link rel="stylesheet" type="text/css" href="{{ url('/css/style.css') }}" />




<div class="container items">

    @if(App::getlocale()=="ar")
<h1  style="padding: 20px 20px 20px 0;color:#263066;text-align:end">{{__('actualites.actualites')}}</h1>
@else
<h1  style="padding: 20px 20px 20px 0;color:#263066;text-align:start">{{__('actualites.actualites')}}</h1>
@endif
    <div class="row container">


        @forelse ($actualites as $actualite)
        <div class="  width_card col-lg-3 col-md-4 col-sm-6 col-6 p-1 d-flex justify-content-center">


            <div class="card card_content border-0">
                

                <a href="{{ $actualite['Lien']}}">
                <img src="{{ $actualite['Image']}} " alt="product_card"
                    class="card-img-top img_product img-fluid" alt="product_card">
                </a>  




                <div class="card-body p-2  ">


                    <h5 class="card-title mb-1 text-center">{{$actualite['Type']}}</h5>
                    
                   
                   
                </div>
            </div>






        </div>

    {{--     
        @forelse ($actualites as $actualite)
    <div class="col-lg-3 col-md-4 col-sm-6 col-6" style="padding-bottom: 20px;display:flex;justify-content:center;align-items:center">
    
        <div class="card card2" >
            <div class="imgprod">     
                <a href="{{ $actualite['Lien']}}">
                    <img class="card-img-top" src={{ $actualite['Image']}} alt="Card image cap" height="200" width="200" style="border-radius: 8px;object-fit: contain;">
                </a>     
          
        </div>
            <div class="card-body">
              <p style="font-size: 17px;text-align: center" class="card-title text" data-toggle="{{$actualite['Type']}}">{{$actualite['Type']}} </p>
             </div>
          </div>
    
    </div>  --}}



       @empty
<p class="col-12" style="text-align: center;padding-top: 80px;">{{__('actualites.aucun_actualite')}}</p>
       @endforelse
      
    </div>
</div>

<br>
<div style="text-align: center;padding-bottom:50px">
    @if ($page==1 or $page=='')
    @if(count($actualites)>0)
    <a class="paginationa" href="">❮</a>
    <a class="paginationa" href={{$request->fullUrlWithQuery(['page' => 2]) }}>❯</a>
    @endif
    @else
    <a class="paginationa" href={{$request->fullUrlWithQuery(['page' => $page-1]) }}>❮</a>
    <a class="paginationa" href={{$request->fullUrlWithQuery(['page' => $page+1]) }}>❯</a>
    @endif
 
@endsection