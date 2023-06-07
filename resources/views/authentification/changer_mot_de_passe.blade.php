@extends('navbar')
@section('content')





<div class="container mt-3">
    <h2 @if(App::getlocale()=="ar") style="text-align: end" @endif>{{__('login.login')}} </h2>
    <form action={{route('changer_mot_de_passe')}} method="POST">
      @csrf
      <div class="mb-3 mt-3" @if(App::getlocale()=="ar") style="text-align: end" @endif>
        @if(App::getlocale()=="ar")
        <label for="new_password"> : {{__('change_password.new_password')}}</label>
        @else
        <label for="new_password">{{__('change_password.new_password')}} :</label>
        @endif
        
        <input @if(App::getlocale()=="ar") style="text-align: end" @endif type="password" class="form-control @error('new_password') is-invalid @enderror" id="new_password" placeholder="{{__('change_password.enter_new_password')}}" name="new_password" value="{{ old('new_password') }}">
        @error('new_password')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
      </div>
      <div class="mb-3" @if(App::getlocale()=="ar") style="text-align: end" @endif>
        

        @if(App::getlocale()=="ar")
        <label for="new_password_confirme"> : {{__('change_password.confirm_new_password')}}</label>
        @else
        <label for="new_password_confirme">{{__('change_password.confirm_new_password')}} :</label>
        @endif

        <input @if(App::getlocale()=="ar") style="text-align: end" @endif type="password" class="form-control @error('new_password_confirme') is-invalid @enderror" id="new_password_confirme" placeholder="{{__('change_password.enter_new_password')}}" name="new_password_confirme" value="{{ old('new_password_confirme') }}">
        @error('new_password_confirme')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
      </div>
      
      <div   @if(App::getlocale()=="ar")  style="direction: rtl;" @endif>
        <button @if(App::getlocale()=="ar") style="margin-left:5px " @endif type="submit" class="btn btn-primary @if(App::getlocale()=="ar") float-right @endif">Valider </button>
      </div>
   
    </form>
   
  </div>
@endsection