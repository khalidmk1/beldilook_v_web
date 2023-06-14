@extends('navbar')
@section('content')


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
  .btn2 {

  border: none;
  border-radius: 4px;
  opacity: 0.85;
  font-size: 17px;
 height: 40px;
}
  .fb {
  background-color: #3B5998;
  color: white;
}
.btn2:hover {
  background-color: #3B5998;
  color: white;
  opacity: 0.70;
  text-decoration: none; /* remove underline from anchors */
}
@media(max-width:768px)
{
  .marg{
    margin-top: 5px;
  }
}
</style>


<div  class="container mt-3">
    <h2 @if(App::getlocale()=="ar") style="text-align: end" @endif>{{__('register.creecompte')}} </h2>
    <form action={{route('register')}} method="POST">
      @csrf
      <div class="mb-3 mt-3" @if(App::getlocale()=="ar") style="text-align: end" @endif>
       
        @if(App::getlocale()=="ar")
        <label for="pwd"> : {{__('myaccount.prenom')}}</label>
        @else
        <label for="pwd">{{__('myaccount.prenom')}} :</label>
        @endif
        <input type="text" class="form-control border-top-0 border-right-0 border-left-0 @error('prenom') is-invalid @enderror" id="prenom"  name="prenom" value="{{ old('prenom') }}" required>
        
        @error('prenom')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
      </div>

      <div class="mb-3" @if(App::getlocale()=="ar") style="text-align: end" @endif>
        
        @if(App::getlocale()=="ar")
        <label for="pwd"> : {{__('myaccount.nom')}}</label>
        @else
        <label for="pwd">{{__('myaccount.nom')}} :</label>
        @endif
        <input type="text" class="form-control border-top-0 border-right-0 border-left-0 @error('nom') is-invalid @enderror" id="nom" name="nom" value="{{old('nom')}}" required>
       
        @error('nom')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
      </div>
      <div class="mb-3 mt-3" @if(App::getlocale()=="ar") style="text-align: end" @endif>
       

        @if(App::getlocale()=="ar")
        <label for="pwd"> : {{__('login.email')}}</label>
        @else
        <label for="pwd">{{__('login.email')}} :</label>
        @endif

        <input type="email" class="form-control border-top-0 border-right-0 border-left-0 @error('email') is-invalid @enderror" id="email"  name="email" value="{{ old('email') }}" required>
        @error('email')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
      </div>
      <div class="mb-3" @if(App::getlocale()=="ar") style="text-align: end" @endif>
        @if(App::getlocale()=="ar")
        <label for="pwd"> : {{__('login.password')}}</label>
        @else
        <label for="pwd">{{__('login.password')}} :</label>
        @endif
        <input type="password" class="form-control border-top-0 border-right-0 border-left-0 @error('pswd') is-invalid @enderror" id="pwd"  name="pswd" value="{{ old('pswd') }}" required>
        @error('pswd')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
      </div>
      <div @if(App::getlocale()=="ar")  style="direction: rtl;" @endif>
      <button  @if(App::getlocale()=="ar") style="margin-left:5px " @endif  type="submit" class="btn btn-primary @if(App::getlocale()=="ar") float-right @endif">{{__('nav.register')}} </button>
      <a  @if(App::getlocale()=="ar") style="margin-left:5px " @endif  class="btn btn-outline-dark @if(App::getlocale()=="ar") float-right @endif" href="{{route('google_auth')}}" role="button" style="text-transform:none">
        <img width="20px" style="margin-bottom:3px; margin-right:5px" alt="Google sign-in" src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/53/Google_%22G%22_Logo.svg/512px-Google_%22G%22_Logo.svg.png" />
        {{__('login.se_connecter_google')}}
      </a>
      
      <a  @if(App::getlocale()=="ar") style="margin-left:5px " @endif  href="{{route('facebook_auth')}}" class="btn fb btn2 @if(App::getlocale()=="ar") float-right @endif">
        <i class="fa fa-facebook fa-fw"></i>{{__('login.se_connecter_facebook')}}
       </a>
      </div>
    </form>
  </div>
  @if(App::getlocale()=="ar")
  <br>
  <br>
  @endif
@endsection