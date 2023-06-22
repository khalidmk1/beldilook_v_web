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





.form_register_container h2 {
  font-family:var(--font-secondary);
  font-size:24px;
}

.form_register label
{
  color:var(--color-primary);
  font-weight:400;
  letter-spacing:.1px;
  font-size:16px;
  font-family:var(--font-secondary);

}

.form_register input
{
 border: solid var(--color-primary) 1px;
 border-radius:10px;
 margin-top:5px;
 color:var(--color-primary) !important;
 font-weight:400 !important;
}


.form_register button
{
  color:#fff;
  background-color: var(--color-primary);
  border: solid 2px transparent;
  border-radius:10px;
  padding:8px;
  margin-bottom:20px;
}

.form_register button:hover
{
  background:#EFEFEF;
  color:var(--color-primary);
  border: solid 2px var(--color-primary);
  transition:.2s;
}

.form_register .fb_connect,
.form_register .google_connect
{
  color:var(--color-primary);
  border: solid 1px #dadada;
  border-radius:10px;
  font-size:14px;
  line-height:1.7rem;
  width:240px !important;

}
.form_register .fb_connect:hover,
.form_register .google_connect:hover
{
  color:var(--color-primary);
  background-color: #3B5998;
  opacity: 0.70;
  text-decoration: none;
}

.form_register .fa-facebook
{
  font-size:18px;
  position:relative;
  top:2px;
  
}

@media screen and (max-width:1160px) {
  .form_register_container > div:first-of-type
  {
    width:60% !important;
  }
}

@media screen and (max-width:900px) {
  .form_register_container > div:first-of-type
  {
    width:60% !important;
  }

  .form_register_container .connect_link_container
  {
    flex-direction:column !important;
  }

.form_register .fb_connect,
.form_register .google_connect
{
  font-size:13px; 
  margin-top:5px;
  width:100% !important;
}
}

.or_separator
{
 color:#bbbbbb;
 position:relative;
 margin-top:20px;
}
.or_separator::before,
.or_separator::after {
	content: "";
	height: .5px !important;
	position: absolute;
	background-color: #bbbbbb;
  z-index:100;
}

.or_separator::before {
right:1px;
width:45%;
}

.or_separator::after {
	left:1px;
  width:45%;
}

.or_separator::after, 
.or_separator::before{
  bottom:10px;
}

.form_register_container .connect_link_container
{
  margin-top:40px;
}
</style>


<div  class="container form_register_container mt-3 pb-5 pt-5">
  <div class="row" style="width:46%; margin:0 auto;">
    <div class="col-12">
    <h2 @if(App::getlocale()=="ar") style="text-align: end" @endif>{{__('register.creecompte')}} </h2>
    <form action={{route('register')}} method="POST" class="form_register">
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
      <button  @if(App::getlocale()=="ar") style="margin-left:5px; width:100%;" @endif  type="submit" style="width:100%;" class="btn btn-primary @if(App::getlocale()=="ar") float-right @endif">{{__('nav.register')}} </button>
      <div class="or_separator text-center">or</div>
      <div class="connect_link_container d-flex flex-row justify-content-between">
      <a  @if(App::getlocale()=="ar") style="margin-left:5px; background-color:#fff; " @endif  class="btn google_connect @if(App::getlocale()=="ar") float-right @endif" href="{{route('google_auth')}}" role="button" style="text-transform:none; background-color:#fff;">
        <img width="20px" style="margin-bottom:3px; margin-right:5px" alt="Google sign-in" src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/53/Google_%22G%22_Logo.svg/512px-Google_%22G%22_Logo.svg.png" />
        {{__('login.se_connecter_google')}}
      </a>
      
      <a  @if(App::getlocale()=="ar") style="background-color:#fff;" @endif  href="{{route('facebook_auth')}}" style="background-color:#fff;" class="btn fb fb_connect btn2 @if(App::getlocale()=="ar") float-right @endif">
        <i class="fa fa-facebook fa-fw"></i>{{__('login.se_connecter_facebook')}}
       </a>
      </div>
      </div>
    </form>
    </div>

  </div>
  </div>
  @if(App::getlocale()=="ar")
  <br>
  <br>
  @endif
@endsection