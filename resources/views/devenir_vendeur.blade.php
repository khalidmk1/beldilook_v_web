@extends('navbar')
@section('content')


<style>
      .imgprod { 
    position: relative;
    margin-bottom:30px;
    text-align: center;
  }
  .desc{
    position: absolute;
margin-left: auto;
margin-right: auto;
left: 0;
right: 0;
text-align: center;
top:200px;
color: white;
font-size: 20px;

width:200px;
  }
  .btn_boutique{
        background-color: #212951;
        border: #212951;
        width: 80px;
        font-size: 17px;
        width: 200px;
        color: white;
        height: 40px;
        border-radius: 30px;
    }
    .btn_boutique:hover{
        background-color: #283991;
        border: #283991;
    }
    .btn_particulier{
        background-color: #B09636;
        border: #B09636;
        width: 80px;
        font-size: 17px;
        width: 200px;
        color: white;
        height: 40px;
        border-radius: 30px;
    }
    .btn_particulier:hover{
        background-color: #d3a913;
        border: #d3a913;
    }
  @media only screen and (max-width: 600px) {
      .photo{
height: 300px;
width: 300px;
}
.desc{
    position: absolute;
margin-left: auto;
margin-right: auto;
left: 0;
right: 0;
text-align: center;
top:150px;
color: white;
font-size: 20px;

width:200px;
  }
}
</style>




<div class="container" style="margin-top: 100px">
<div class="row">
<div class="col-lg-6 imgprod">
<img class="photo" src="{{asset('storage/Image.png1.png')}}" style="border-radius:20px" alt="" height="400px" width="400px">
<button class="desc btn_boutique" onclick="window.location='{{route('completer_profile_boutique')}}'">{{__('nav.devenir_boutique')}}</button>


</div>

<div class="col-lg-6 imgprod">
    <img class="photo" src="{{asset('storage/Maskbackground.png')}}" style="border-radius:20px"  alt="" height="400px" width="400px">
    <button class="desc btn_particulier" onclick="window.location='{{route('completer_profile_demande')}}'">{{__('nav.devenir_particulier')}}</button>
</div>
</div>
</div>










@endsection