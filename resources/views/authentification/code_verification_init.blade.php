@extends('navbar')
@section('content')
<div class="container mt-3">


<h5>{{__('register.email_envoi').' '.$email}}</h5>

<p>{{__('register.tentative_restante').' '.Session::get('tentative_init').'.'}}</p>
    <form action={{route('code_change_password_post_init')}} method="POST">
      @csrf
      <div class="mb-3 mt-3">
        <label for="code">{{__('register.code')}} :</label>
       
        <input type="text" class="form-control @error('code') is-invalid @enderror" id="code"  name="code" value="{{ old('code') }}" required>
        
        @error('code')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
      </div>

     
      
      <button type="submit" class="btn btn-primary">{{__('myaccount.valider')}} </button>
    </form>
  </div>
@endsection