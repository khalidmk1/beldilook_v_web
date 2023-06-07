@extends('navbar')
@section('content')
@if(App::getlocale()=="ar")
<h1  style="padding: 20px;color:#263066;text-align:end">{{__('nav.decouvrez_formulaire')}}</h1>
@else
<h1  style="padding: 20px;color:#263066;text-align:start">{{__('nav.decouvrez_formulaire')}}</h1>
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
<div class="container">



    <div style="padding-bottom: 30px">
    <div >
        <img src="{{asset('storage/AdobeStock_324653936.jpeg')}}" alt="" height="200px" width="200px" style="object-fit: contain;padding-bottom:20px">
    </div>
<div >
    <h5>Pack gold</h5>
    <div>
    @php
        echo($gold);
    @endphp
    </div>
</div>
</div>



    <div style="padding-bottom: 30px">
    <div >
        <img src="{{asset('storage/AdobeStock_324653743.jpeg')}}" alt="" height="200px" width="200px" style="object-fit: contain">
    </div>
<div >
    <h5>Pack silver</h5>
    <div>
    @php
        echo($silver);
    @endphp
    </div>
</div>
</div>


<div style="padding-bottom: 30px">
    <div >
        <img src="{{asset('storage/AdobeStock_324653730.jpeg')}}" alt="" height="200px" width="200px" style="object-fit: contain;padding-bottom:20px">
    </div>
<div >
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