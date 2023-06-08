@extends('navbar')
@section('content')

<style>
    .in_contact{
        display:block;
        margin-left: 5%;
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
    }

    .btn_contact:hover{
        background-color: rgb(65, 54, 54);
        color: white;
        width: 150px;
        border: 0px solid rgb(65, 54, 54);
        border-radius: 16px;
        height: 35px;
    }
   .titre_contact{
    margin-left: 5%;
    margin-top:30px;
   }
   .lab_contact{
    color:grey;
    display:block;
    margin-left: 5%;
   }
   .errors{
    color: red;
    margin-left: 5%;
   
   }
    @media only screen and (max-width: 600px) {
        .in_contact{
        display:block;
        margin-left: 5%;
        border-right:0px;
        border-left:0px;
        border-top:0px;
        border-bottom: 1px solid grey;
        width: 90%;
      
    }
    .are_contact{
        width: 90%;
        margin-left: 5%;
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
    margin-top:30px;
   }
   .lab_contact{
    color:grey;
    display:block;
    margin-left: 5%;
   }
}
</style>







<div>
    <div class="row" style="border: 1px solid black;margin:50px;border-radius:8px">
        <div class="col-lg-6 col-md-12 col-sm-12">
            <h3 class="titre_contact" >Contacter Nous</h3>

            <br>
            <form action="{{route('contacter_nous_post')}}" method="POST">
                @csrf
            <label class="lab_contact" for="nom_prenom" style="">Nom et prénom</label>
            <input class="in_contact @error('nom_prenom') in_contact_error @enderror"  type="text" name="nom_prenom" value="{{old('nom_prenom')}}" required>
            @error('nom_prenom')
            <span class="errors">{{$message}}</span>
            @enderror
            
<br>
            <label class="lab_contact" for="email" >Votre Email</label>
            <input class="in_contact @error('email') in_contact_error @enderror"  type="text" name="email" value="{{old('email')}}" required>
            @error('email')
            <span class="errors">{{$message}}</span>
            @enderror
            <br>
            <textarea name="message" class="are_contact @error('message') are_contact_error @enderror" placeholder="Message" style="" name="" id="" cols="50" rows="8" required>{{old('message')}}</textarea>
            @error('message')
            <span class="errors">{{$message}}</span>
            @enderror
            <br>
            <br>
     
            <input class="btn_contact" type="submit" style="margin-left: 30px" value="Envoyer">
            <br>
            <br>
        </form>
        </div>
        <div class="col-lg-6 col-md-12 col-sm-12" style="margin-bottom:-7px;padding-right:-10px">
            <iframe class="map_contact" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6646.800220239545!2d-7.643959760846243!3d33.59492165201726!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xda7d2f075e175e3%3A0x47c1b109b503954f!2sComplexe%20Sportif%20Bourgogne%2C%20Rue%20A%C3%AFn%20Oulmes%2C%20Casablanca%2020250!5e0!3m2!1sfr!2sma!4v1686215304634!5m2!1sfr!2sma" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></div>

    </div>
</div>



@endsection