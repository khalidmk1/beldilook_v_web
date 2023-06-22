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
.form_connect_container h2 {
  font-family:var(--font-secondary);
  font-size:24px;
}
.form_connect label
{
  color:var(--color-primary);
  font-weight:400;
  letter-spacing:.1px;
  font-size:16px;
  font-family:var(--font-secondary);

}

.form_connect input{
 border: solid var(--color-primary) 1px;
 border-radius:10px;
 margin-top:5px;
 color:var(--color-primary) !important;
 font-weight:400 !important;
}

.form_connect .mot_de_pass_oublie_txt a
{
  
  position:relative;
  bottom:10px;
  text-decoration:none;
  color: #bbbbbb;
  font-size:15px;
  
  
}
.form_connect .mot_de_pass_oublie_txt a:hover
{
  color:var(--color-primary);
}

.form_connect button{
  color:#fff;
  background-color: var(--color-primary);
  border: solid 2px transparent;
  border-radius:10px;
  padding:8px;
  margin-bottom:20px;
}

.form_connect button:hover
{
  background:#EFEFEF;
  color:var(--color-primary);
  border: solid 2px var(--color-primary);
  transition:.2s;
}

.form_connect .fb_connect,
.form_connect .google_connect
{
  color:var(--color-primary);
  border: solid 1px #dadada;
  border-radius:10px;
  font-size:14px;
  line-height:1.7rem;
  width:240px !important;

}
.form_connect .fb_connect:hover,
.form_connect .google_connect:hover
{
  color:var(--color-primary);
  background-color: #3B5998;
  opacity: 0.70;
  text-decoration: none;
}

.form_connect .fa-facebook
{
  font-size:18px;
  position:relative;
  top:2px;
  
}

@media screen and (max-width:1160px) {
  .form_connect_container > div:first-of-type
  {
    width:60% !important;
  }
}

@media screen and (max-width:900px) {
  .form_connect_container > div:first-of-type
  {
    width:60% !important;
  }

  .form_connect_container .connect_link_container
  {
    flex-direction:column !important;
  }

.form_connect .fb_connect,
.form_connect .google_connect
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

.form_connect_container .connect_link_container
{
  margin-top:40px;
}

</style>




<div class="container form_connect_container mt-3 pb-5 pt-5">
   <div class="row" style="width:46%; margin:0 auto;">
   <div class="col-12">
   <h2 @if(App::getlocale()=="ar") style="text-align: end;" @endif class="" style="">{{__('login.login')}} </h2>

   <form action={{route('seconnecter')}} method="POST" class="form_connect d-flex  flex-column pt-2" style=""> 
      @csrf
      <div class="mb-3 mt-3" @if(App::getlocale()=="ar") style="text-align: end" @endif>
        @if(App::getlocale()=="ar")
        <label for="email"> : {{__('login.email')}}</label>
        @else
        <label for="email">{{__('login.email')}} :</label>
        @endif
        
        <input @if(App::getlocale()=="ar") style="text-align: end" @endif type="email" class="form-control  @error('email') is-invalid @enderror" id="email" placeholder="{{__('login.entreemail')}}" name="email" value="{{ old('email') }}" required>
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

        <input @if(App::getlocale()=="ar") style="text-align: end" @endif type="password" class="form-control @error('pswd') is-invalid @enderror" id="pwd" placeholder="{{__('login.entrepassword')}}" name="pswd" value="{{ old('pswd') }}" required>
        @error('pswd')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
      </div>
      <!--
      <div class="form-check mb-3">
        <label class="form-check-label">
          <input class="form-check-input" type="checkbox" name="remember"> Remember me
        </label>
      </div> -->
      <div   @if(App::getlocale()=="ar")  style="direction: rtl;" @endif class="text-right mot_de_pass_oublie_txt"> <a href="{{route('mot_de_passe_oublie_get')}}">{{__('login.mot_de_passe_oublie')}}</a> </div> <br>
      <div   @if(App::getlocale()=="ar")  style="direction: rtl;" @endif>
      <button @if(App::getlocale()=="ar") style="width:100%; " @endif type="submit" style="width:100%;" class="btn">{{__('login.login')}} </button>
      
      <div class="or_separator text-center">or</div>
     
          <div class="connect_link_container d-flex flex-row justify-content-between">
          <a @if(App::getlocale()=="ar") style="background-color:#fff;" @endif class="btn google_connect @if(App::getlocale()=="ar") float-right @endif" href="{{route('google_auth')}}" role="button" style="text-transform:none; background-color:#fff;">
            <img width="20px" style="margin-bottom:3px; margin-right:5px" alt="Google sign-in" src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/53/Google_%22G%22_Logo.svg/512px-Google_%22G%22_Logo.svg.png" />
            {{__('login.se_connecter_google')}}
          </a>
          
          <a @if(App::getlocale()=="ar") style="background-color:#fff; " @endif href="{{route('facebook_auth')}}" style="background-color:#fff; "class="btn fb fb_connect btn2 marg @if(App::getlocale()=="ar") float-right @endif">
            <i class="fa fa-facebook fa-fw"></i> {{__('login.se_connecter_facebook')}}
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