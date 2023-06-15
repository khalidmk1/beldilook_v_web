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
<div style="text-align: center">Nous vous remercions pour votre demande de conversion vendeur. Afin de valider votre statut vendeur, merci de payer 79 dhs dans un délai de 24H.</div>
<br>
<br>
<div style="text-align: center"><button onclick="window.location='{{route('payer_demande')}}'" class="btn_payer">Payer</button></div>
<br>
<br>
<br>
@endsection