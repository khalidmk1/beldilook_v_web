@extends('navbar')
@section('content')

<style>
    .in_contact{
        display:block;
        margin-left: 5%;
        margin-right: 5%;
        border-right:0px;
        border-left:0px;
        border-top:0px;
        border-bottom: 1px solid grey;
        width: 90%;
    }
    .in_contact_error{
        border-bottom: 1px solid rgb(238, 9, 9);
    }
    .in_contact:focus {
        border-bottom: 1px solid rgb(43, 109, 207);
}
.are_contact:focus{
       border-color:  rgb(43, 109, 207);
    }
    .are_contact{
        width: 90%;
        margin-left: 5%;
        margin-right: 5%;
        border-radius:8px;
        padding:10px;
    }
    .are_contact_error{
        border-color:  rgb(238, 9, 9);
        margin-top:5px;
    }
    .map_contact{
        width:100%;
         height:98%; 
    }
    .btn_contact{
        background-color: black;
        color: white;
        width: 150px;
        border: 0px solid black;
        border-radius: 16px;
        height: 35px;
        margin-left: 5%;
        margin-right: 5%;
    }

    .btn_contact:hover{
        background-color: rgb(65, 54, 54);
        color: white;
        width: 150px;
        border: 0px solid rgb(65, 54, 54);
        border-radius: 16px;
        height: 35px;
        margin-left: 5%;
        margin-right: 5%;
    }
   .titre_contact{
    margin-left: 5%;
    margin-right: 5%;
    margin-top:30px;
   }
   .lab_contact{
    color:grey;
    display:block;
    margin-left: 5%;
    margin-right: 5%;
   }
   .errors{
    color: red;
    margin-left: 5%;
    margin-right: 5%;
   
   }
   .div_colap{
    padding: 100px;
   }
    @media only screen and (max-width: 600px) {
        .in_contact{
        display:block;
        margin-left: 5%;
        margin-right: 5%;
        border-right:0px;
        border-left:0px;
        border-top:0px;
        border-bottom: 1px solid grey;
        width: 90%;
      
    }
    .are_contact{
        width: 90%;
        margin-left: 5%;
        margin-right: 5%;
        border-radius:8px;
        padding:10px;
    }
    .map_contact{
       
        width:100%;
         height:250px; 
         margin-bottom: 20px;
    }
    .titre_contact{
    margin-left: 5%;
    margin-right: 5%;
    margin-top:30px;
   }
   .lab_contact{
    color:grey;
    display:block;
    margin-left: 5%;
    margin-right: 5%;
   }
   .div_colap{
    padding: 20px;
   }
}
</style>







<div>
    <div class="row @if(App::getlocale()=="ar") flex-row-reverse @endif" style="border: 1px solid black;margin:50px;border-radius:8px;">
        <div class="col-lg-6 col-md-12 col-sm-12">
            <h3 class="titre_contact" @if(App::getlocale()=="ar") style="text-align: end" @endif>{{__('contacter_nous.titre')}}</h3>

            <br>
            <form action="{{route('contacter_nous_post')}}" method="POST">
                @csrf
            <label class="lab_contact" for="nom_prenom" @if(App::getlocale()=="ar") style="text-align: end" @endif>{{__('contacter_nous.nom_prenom')}}</label>
            <input @if(App::getlocale()=="ar") style="text-align: end" @endif class="in_contact @error('nom_prenom') in_contact_error @enderror"  type="text" name="nom_prenom" value="{{old('nom_prenom')}}" required>
            @error('nom_prenom')
            <div @if(App::getlocale()=="ar") style="text-align: end" @endif>            <span class="errors" >{{$message}}</span>
            </div>
            @enderror
            
<br>
            <label @if(App::getlocale()=="ar") style="text-align: end" @endif class="lab_contact" for="email" >{{__('contacter_nous.votre_email')}}</label>
            <input @if(App::getlocale()=="ar") style="text-align: end" @endif class="in_contact @error('email') in_contact_error @enderror"  type="text" name="email" value="{{old('email')}}" required>
            @error('email')
            <div @if(App::getlocale()=="ar") style="text-align: end" @endif>            <span  class="errors">{{$message}}</span>
            </div>
            @enderror
            <br>
            <textarea @if(App::getlocale()=="ar") style="text-align: end" @endif name="message" class="are_contact @error('message') are_contact_error @enderror" placeholder="{{__('contacter_nous.message')}}"  name="" id="" cols="50" rows="8" required>{{old('message')}}</textarea>
            @error('message')
            <div @if(App::getlocale()=="ar") style="text-align: end" @endif >            <span class="errors">{{$message}}</span>
            </div>
            @enderror
            <br>
            <br>
     <div @if(App::getlocale()=="ar") style="text-align: end" @endif><input class="btn_contact" type="submit" style="margin-left: 30px" value="{{__('contacter_nous.envoyer')}}"></div>
            
            <br>
            <br>
        </form>
        </div>
        <div class="col-lg-6 col-md-12 col-sm-12" style="margin-bottom:-7px;padding-right:-10px">
            <iframe class="map_contact" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6646.800220239545!2d-7.643959760846243!3d33.59492165201726!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xda7d2f075e175e3%3A0x47c1b109b503954f!2sComplexe%20Sportif%20Bourgogne%2C%20Rue%20A%C3%AFn%20Oulmes%2C%20Casablanca%2020250!5e0!3m2!1sfr!2sma!4v1686215304634!5m2!1sfr!2sma" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></div>

    </div>
</div>


<div>
<h1 style="text-align: center">{{__('contacter_nous.foire_aux_question')}} 
</h1>

</div>

<div style="background-color:#E1E2E7;margin:70px">

    <div class="row div_colap">




<div class="col-lg-6 dol-md-6 col-sm-12">  <div class="col-lg-12" style="margin-bottom: 10px">
    <div style="background-color: #FFFFFF;">
    <button onclick="colapse_div(this)" style="background-color: #FFFFFF;border:0px solid black;padding:10px;width:100%;text-align:left"class="" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
        <img src="{{asset('storage/plus.png')}}" alt="" height="12px" width="12px">
        Link with href
      </button>
      <div class="collapse" id="collapseExample" >
        <div class="" style="background-color: #FFFFFF;padding:10px;">
          Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
        </div>
      </div>
</div>
</div>


<div class="col-lg-12"  style="margin-bottom: 10px">
    <div style="background-color: #FFFFFF;">
        
    <button onclick="colapse_div(this)" style="background-color: #FFFFFF;border:0px solid black;padding:10px;width:100%;text-align:left"class="" data-toggle="collapse" href="#collapseExample3" role="button" aria-expanded="false" aria-controls="collapseExample3">
        <img src="{{asset('storage/plus.png')}}" alt="" height="12px" width="12px">
        Link with href
      </button>
      <div class="collapse" id="collapseExample3" >
        <div class="" style="background-color: #FFFFFF;padding:10px;">
          Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
        </div>
      </div>
</div>
</div>

</div>




<div class="col-lg-6 dol-md-6 col-sm-12"> <div class="col-lg-12"  style="margin-bottom: 10px">
    <div style="background-color: #FFFFFF;">
    <button onclick="colapse_div(this)"  style="background-color: #FFFFFF;border:0px solid black;padding:10px;width:100%;text-align:left"class="" data-toggle="collapse" href="#collapseExample2" role="button" aria-expanded="false" aria-controls="collapseExample2">
        <img src="{{asset('storage/plus.png')}}" alt="" height="12px" width="12px">
        Link with href
      </button>
      <div class="collapse" id="collapseExample2" >
        <div class="" style="background-color: #FFFFFF;padding:10px;">
          Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
        </div>
      </div>
</div>
</div></div>












      



   





    </div>
</div>

<script>
    function colapse_div(parent_div)
    {
     
        if(parent_div.getAttribute('aria-expanded')=='false')
        {
            parent_div.children[0].src="{{asset('storage/signe-moins.png')}}";
        }else{
            parent_div.children[0].src="{{asset('storage/plus.png')}}";
        }

    }
</script>

@endsection