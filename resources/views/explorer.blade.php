@extends('navbar')
@section('content')

<style>
     .imgprod { 
    position: relative;
    margin-bottom:20px;
    text-align: center;
  }
  .desc{
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
  }
  .desc2{
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
  }
</style>

@if(App::getlocale()=="ar")
<h1  style="padding: 20px;color:#263066;text-align:end">{{__('nav.explorer')}}</h1>
@else
<h1  style="padding: 20px;color:#263066;text-align:start">{{__('nav.explorer')}}</h1>
@endif


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
@endforeach













@endsection