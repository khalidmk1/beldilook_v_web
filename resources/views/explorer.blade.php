@extends('navbar')
@section('content')

<style>
     .imgprod { 
    position: relative;
    margin-bottom:20px;
    text-align: center;
  }

  .card-img-overlay {
  background-color: rgba(#00000023, 0.4);
}

 /*  .desc{
    position: absolute;
margin-left: auto;
margin-right: auto;
left: 0;
right: 0;
text-align: center;
top:200px;
color: white;
font-size: 20px;
background-color: rgb(0, 0, 0,0.5);
width:400px;
  } */
 /*  .desc2{
    position: absolute;
margin-left: auto;
margin-right: auto;
left: 0;
right: 0;
text-align: center;
top:250px;
color: white;
font-size: 20px;
background-color: rgb(0, 0, 0,0.5);
width:400px;
  } */


  .container_explorer img
  {
      height:300px;
      
      object-fit:cover;
      border-radius:30px;
  }

  .container_explorer{
    padding-bottom:50px;
    padding-top:60px; 
  }

  .container_explorer .card
  {
    width:450px;
    position:relative;
    border:none;
  }
  .container_explorer h1
  {
   color: #33286e;
   font-size:60px;
   font-weight:600;
   display:flex;
   justify-content:center;
   
  }

  .container_explorer .card-title,
  .container_explorer .card-text {
  position: relative;
  z-index: 2;
}


.gradient-background-text::after {
  content: '';
  position: absolute;
  bottom: 0;
  left: 0;
  width: 100%;
  height: 60%;
  background: linear-gradient(to top, rgba(38,48,102,1) 
, rgba(38,48,102,0) 
);
  z-index: 199;
}
.container_explorer .card{
  border-radius:30px;
  overflow:hidden
}
</style>



<div class="container container_explorer">
  @if(App::getlocale()=="ar")
<h1  style="padding: 20px;color:#263066;text-align:end">{{__('nav.explorer')}}</h1>
@else
<h1  style="padding: 20px;color:#263066;text-align:start">{{__('nav.explorer')}}</h1>
@endif
  <div class="row pt-2" style="    max-width: 980px;
  margin: auto;
">
    @foreach ($collection as $item)
    <div class="col-12 col-xl-6 col-lg-6 col-md-12 col-sm-12 p-3">
      <div class="card">
        <a href="{{route('produit_collection',$item['id_type_tag'])}}" style="position: relative ; z-index: 100;">
          <img class="card-img img-fluid " src="{{$item['image_type']}}" alt="tags">
        
        <div class="card-img-overlay text-white d-flex flex-column justify-content-end gradient-background-text">
          <h4 style="position: relative ; z-index: 200;" class="card-title">{{$item['Libelle']}}</h4>
          <p style="position: relative ; z-index: 200;" class="card-text">{{$item['description']}}
          </p>
        </div>
        </a>
      </div>
    </div>
    @endforeach
  </div>
</div>

{{-- 
@foreach ($collection as $item)
    <div class="imgprod" >
        <a href="{{route('produit_collection',$item['id_type_tag'])}}"><img src="{{$item['image_type']}}" alt="" height="400px" width="400px"></a>
        
        @if($item['Libelle_Visible']==true)
        <div class="desc">{{$item['Libelle']}}</div>
        @endif
        @if($item['Description_Visible']==true)
        <div class="desc2">{{$item['description']}}</div>
        @endif
    </div>
@endforeach --}}













@endsection