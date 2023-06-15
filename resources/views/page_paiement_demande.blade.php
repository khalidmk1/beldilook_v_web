@extends('navbar')
@section('content')
<style>
    .btn_payer{
        border: 3px solid #B09636;
        background-color: #B09636;
        color: white;
        border-radius: 16px;
        width: 120px;
        padding: 2px;
    }
    .btn_payer:hover{
        border: 3px solid #887530;
        background-color: #887530;
        color: white;
        border-radius: 16px;
        width: 120px;
        padding: 2px;
    }
</style>
<br>
<br>
<br>
<div style="text-align: center">{{__('paiement.text')}}</div>
<br>
<br>
<div style="text-align: center"><button onclick="window.location='{{route('payer_demande')}}'" class="btn_payer">{{__('paiement.payer')}}</button></div>
<br>
<br>
<br>
@endsection