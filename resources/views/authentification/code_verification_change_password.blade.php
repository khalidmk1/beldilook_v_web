@extends('navbar')
@section('content')
<div class="container mt-3">


<h5>{{__('register.email_envoi').' '.$email}}</h5>

<p>{{__('register.tentative_restante').' '.Session::get('tentative_change_password').'.'}}</p>
    <form action={{route('code_change_password_post')}} method="POST">
      @csrf
      <div class="mb-3 mt-3">
        <label for="code">{{__('register.code')}} :</label>
       
        <input type="text" class="form-control border-top-0 border-right-0 border-left-0 @error('code') is-invalid @enderror" id="code"  name="code" value="{{ old('code') }}" required>
        
        @error('code')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
      </div>

     
      
      <button type="submit" class="btn btn-primary">{{__('myaccount.valider')}} </button>
    </form>
  </div>
@endsection