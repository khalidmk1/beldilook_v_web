@extends('navbar')
@section('content')







<div class="container mt-3">
    <h2 @if(App::getlocale()=="ar") style="text-align: end" @endif>{{__('login.reinit_password')}} </h2>
    <form action={{route('mot_de_passe_oublie_post')}} method="POST">
      @csrf
      <div class="mb-3 mt-3" @if(App::getlocale()=="ar") style="text-align: end" @endif>
        @if(App::getlocale()=="ar")
        <label for="email"> : {{__('login.email')}}</label>
        @else
        <label for="email">{{__('login.email')}} :</label>
        @endif
        
        <input  @if(App::getlocale()=="ar") style="text-align: end" @endif type="email" class="form-control border-top-0 border-right-0 border-left-0 @error('email') is-invalid @enderror" id="email" placeholder="{{__('login.entreemail')}}" name="email" value="{{ old('email') }}">
        @error('email')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
      </div>
      <div class="mb-3" @if(App::getlocale()=="ar") style="text-align: end" @endif>
        

      </div>
      <!--
      <div class="form-check mb-3">
        <label class="form-check-label">
          <input class="form-check-input" type="checkbox" name="remember"> Remember me
        </label>
      </div> -->
      <div   @if(App::getlocale()=="ar")  style="direction: rtl;" @endif>
      <button @if(App::getlocale()=="ar") style="margin-left:5px " @endif type="submit" class="btn btn-primary @if(App::getlocale()=="ar") float-right @endif">{{__('login.valider')}} </button>
    
         
          
         
          </div>
    </form>
   
  </div>















@endsection