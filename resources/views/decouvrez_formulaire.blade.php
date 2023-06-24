@extends('navbar')
@section('content')

<style>
.pack_image img
{
    width:300px;
    height:400px;
    object-fit: cover;
}
.pack_image + div h5
{
  color:#bd8c2f;
  font-size:25px;
}

.pack_image + div h5 + div
{
  line-height:28px;
}
</style>

@if(App::getlocale()=="ar")
<h1  style="padding: 20px;color:#33286e;text-align:center;font-size:60px;font-weight:600;" class="mt-5">{{__('nav.decouvrez_formulaire')}}</h1>
@else
<h1  style="padding: 20px;color:#33286e;text-align:center;font-size:60px;font-weight:600;" class="mt-5">{{__('nav.decouvrez_formulaire')}}</h1>
@endif
@php
 
$str     = $avantage_pack['gold'];
$order   = array("\r\n", "\n", "\r");
$replace = '<br>';

$gold = str_replace($order, $replace, $str);

$str     = $avantage_pack['silver'];
$order   = array("\r\n", "\n", "\r");
$replace = '<br>';

$silver = str_replace($order, $replace, $str);

$str     = $avantage_pack['bronze'];
$order   = array("\r\n", "\n", "\r");
$replace = '<br>';

$bronze = str_replace($order, $replace, $str);
@endphp
<div class="container" style="width:50%; margin:0 auto" >



    <div style="padding-bottom: 30px;" class="d-flex flex-row mt-5">
    <div class="pack_image">
        <img src="{{asset('storage/AdobeStock_324653936.jpeg')}}" alt="" height="" width="" style="padding-bottom:20px">
    </div>
<div class="ml-5" >
    <h5>Pack gold</h5>
    <div>
    @php
        echo($gold);
    @endphp
    </div>
</div>
</div>



    <div style="padding-bottom: 30px" class="d-flex flex-row">
    <div class="pack_image">
        <img src="{{asset('storage/AdobeStock_324653743.jpeg')}}" alt="" height="" width="" style="">
    </div>
<div class="ml-5">
    <h5>Pack silver</h5>
    <div>
    @php
        echo($silver);
    @endphp
    </div>
</div>
</div>


<div style="padding-bottom: 30px" class="d-flex flex-row">
    <div class="pack_image">
        <img src="{{asset('storage/AdobeStock_324653730.jpeg')}}" alt="" height="" width="" style="padding-bottom:20px">
    </div>
<div class="ml-5" >
    <h5>Pack bronze</h5>
    <div>
    @php
        echo($bronze);
    @endphp
    </div>
</div>
</div>

</div>



















@endsection