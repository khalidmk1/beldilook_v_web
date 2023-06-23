@extends('navbar')
@section('content')

<style>

  
.input_style input {
  border: solid var(--color-primary) 1px;
    border-radius: 10px;
    margin-top: 5px;
    color: var(--color-primary) !important;
    font-weight: 400 !important;
}

  .btn_ajouter{
        background-color: #212951;
        border: #212951;
        width: 100px;
        font-size: 17px;
        color: white;
        height: 40px;
        border-radius: 30px;
    }
  
    .btn_ajouter:hover{
        background-color: #283991;
        border: #283991;
    }
  </style>


<div class="container mt-5 mb-5">


<h5>{{__('register.email_envoi').' '.$email}}</h5>

<p>{{__('register.tentative_restante').' '.Session::get('tentative_change_password').'.'}}</p>
    <form class="input_style" action={{route('code_change_password_post')}} method="POST">
      @csrf
      <div class="mb-3 mt-3">
        <label for="code">{{__('register.code')}} :</label>
       
        <input type="text" class="form-control  @error('code') is-invalid @enderror" id="code"  name="code" value="{{ old('code') }}" required>
        
        @error('code')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
      </div>

     
      
      <button type="submit" class="btn_ajouter">{{__('myaccount.valider')}} </button>
    </form>
  </div>
@endsection