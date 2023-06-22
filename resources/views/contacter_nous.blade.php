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
    padding: 100px 30px 100px 30px;
    
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

.foire_au_questions h1
   {
    font-size:60px;
    font-weight:600;
    color:#33286e;
   }

   .foire_au_questions .question_div,
   .foire_au_questions .question_div button
   {
    border-radius:10px;
   }

   .foire_au_questions .question_div button + div>div
   {
    border-bottom-left-radius:10px;
    border-bottom-right-radius:10px;
   }

</style>







<div class="container">
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

</div>
<div class="container">
<div style="background-color:#EFEFEF; padding-top:50px;" class="foire_au_questions">

<h1 style="text-align: center">{{__('contacter_nous.foire_aux_question')}} 
</h1>

    <div class="row div_colap container ">




<div class="col-lg-6 dol-md-6 col-sm-12">  <div class="col-lg-12" style="margin-bottom: 10px">
    <div style="background-color: #FFFFFF;" class="question_div">
    <button onclick="colapse_div(this)" style="background-color: #FFFFFF;border:0px solid black;padding:10px;width:100%;text-align:left;"class="" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
        <img src="{{asset('storage/plus.png')}}" alt="" height="12px" width="12px">
        Comment devenir vendeur ?
      </button>
      <div class="collapse" id="collapseExample" >
        <div class="" style="background-color: #FFFFFF;padding:10px;">
            Il suffit de créer votre compte et activer le switch vendeur en payant le montant de 79 dhs pour activer votre statut vendeur. Petite précision : ce montant n’est payé qu’une fois. Une fois votre statut activé, amusez-vous à prendre de belles photos de vos tenues en les mettant en valeur.
        </div>
      </div>
</div>
</div>


<div class="col-lg-12"  style="margin-bottom: 10px">
    <div style="background-color: #FFFFFF;"  class="question_div">
        
    <button onclick="colapse_div(this)" style="background-color: #FFFFFF;border:0px solid black;padding:10px;width:100%;text-align:left"class="" data-toggle="collapse" href="#collapseExample3" role="button" aria-expanded="false" aria-controls="collapseExample3">
        <img src="{{asset('storage/plus.png')}}" alt="" height="12px" width="12px">
        Pourquoi payer le montant de 79 dhs pour devenir vendeur ?
      </button>
      <div class="collapse" id="collapseExample3" >
        <div class="" style="background-color: #FFFFFF;padding:10px;">
            Il est important pour Beldi Look d’assurer un service de qualité, c’est pour cela que nous voulons que nos vendeurs soient engagés avec nous et fournissent des articles conformes aux photos. Nous voulons attirer des vendeurs sérieux et qui utiliseront l’application sur le court et le long terme.        </div>
      </div>
</div>
</div>

<div class="col-lg-12"  style="margin-bottom: 10px">
    <div style="background-color: #FFFFFF;"  class="question_div">
        
    <button onclick="colapse_div(this)" style="background-color: #FFFFFF;border:0px solid black;padding:10px;width:100%;text-align:left"class="" data-toggle="collapse" href="#collapseExample4" role="button" aria-expanded="false" aria-controls="collapseExample4">
        <img src="{{asset('storage/plus.png')}}" alt="" height="12px" width="12px">
        Comment se fait le paiement pour devenir vendeur ?
      </button>
      <div class="collapse" id="collapseExample4" >
        <div class="" style="background-color: #FFFFFF;padding:10px;">
            Vous pouvez payer pour devenir vendeur à travers votre carte bancaire ou à travers Barid Cash.         </div>
      </div>
</div>
</div>

<div class="col-lg-12"  style="margin-bottom: 10px">
    <div style="background-color: #FFFFFF;"  class="question_div">
        
    <button onclick="colapse_div(this)" style="background-color: #FFFFFF;border:0px solid black;padding:10px;width:100%;text-align:left"class="" data-toggle="collapse" href="#collapseExample5" role="button" aria-expanded="false" aria-controls="collapseExample5">
        <img src="{{asset('storage/plus.png')}}" alt="" height="12px" width="12px">
        Qu’est-ce que je dois faire pour vendre mes tenues ?
      </button>
      <div class="collapse" id="collapseExample5" >
        <div class="" style="background-color: #FFFFFF;padding:10px;">
            Assure toi d’abord que tes tenues sont toujours de bonne qualité (même si elles sont anciennes), et qu’il soit dans un état correct. Voici les degrés d’usure que nous acceptons sur Beldi Look :

            Neuf : l’article n’a jamais été porté ou utilisé. Il est donc comme neuf.
            Excellent état : l’article n’a presque pas été porté ou utilisé et ne présente quasiment aucun signe d’usure.
            Très bon état : l'article a été utilisé ou porté et présente quelques signes d'usure mais a toujours fière allure.
            Bon état : l'article a été utilisé ou porté et montre des signes modérés d'usure mais a toujours fière allure.
            État modéré : l'article présente des signes évidents d'usure (fils de couture, tâches, perles qui manquent).
            Nettoyez soigneusement les articles que vous souhaitez vendre. Pensez à les faire laver par un professionnel afin qu'ils soient en parfait état. Ceci augmentera vos chances d’avoir un client fidèle.
            
            Active ton statut vendeur et commence à prendre de belles photos. Au moins une photo de bonne qualité doit être téléchargée. Les photos doivent refléter la qualité réelle et l'aspect extérieur de l'article, ainsi que la présence éventuelle de défauts sur l'article. Ne négligez pas les détails des coutures, les couleurs etc. Mentionnez l’état d’usure de votre article dans la description de votre article, ainsi que la taille en centimètres. Remplissez les filtres pour avoir plus de visibilité. Il faut décrire l'article le plus précisément possible, indiquer les défauts éventuels et préciser le prix de l'article.
            
            Une fois que ta tenue a trouvé son acheteur, nous vous enverrons un mail qui vous annonce que votre tenue est vendue. Nous vous enverrons également un bon de livraison que vous devrez imprimer. Emballez votre tenue soigneusement et collez le bon de livraison sur l’emballage.
            
            Un livreur vous contactera pour venir récupérer votre tenue et la ramènera à son nouveau propriétaire.
       </div>
      </div>
</div>
</div>

</div>




<div class="col-lg-6 dol-md-6 col-sm-12">
     <div class="col-lg-12"  style="margin-bottom: 10px">
    <div style="background-color: #FFFFFF;"  class="question_div">
    <button onclick="colapse_div(this)"  style="background-color: #FFFFFF;border:0px solid black;padding:10px;width:100%;text-align:left"class="" data-toggle="collapse" href="#collapseExample6" role="button" aria-expanded="false" aria-controls="collapseExample6">
        <img src="{{asset('storage/plus.png')}}" alt="" height="12px" width="12px">
        Une fois mon article vendu, comment est-ce que je vais être payé ?
      </button>
      <div class="collapse" id="collapseExample6" >
        <div class="" style="background-color: #FFFFFF;padding:10px;">
            Une fois que l’acheteur a reçu sa commande et qu’il est satisfait de ce qu’il a reçu, Beldi Look vous versera le montant de votre commande par virement bancaire.        </div>
      </div>
</div>
</div>



<div class="col-lg-12"  style="margin-bottom: 10px">
    <div style="background-color: #FFFFFF;"  class="question_div">
    <button onclick="colapse_div(this)"  style="background-color: #FFFFFF;border:0px solid black;padding:10px;width:100%;text-align:left"class="" data-toggle="collapse" href="#collapseExample7" role="button" aria-expanded="false" aria-controls="collapseExample7">
        <img src="{{asset('storage/plus.png')}}" alt="" height="12px" width="12px">
        Quels articles puis-je vendre sur l’application Beldi Look ?     
     </button>
      <div class="collapse" id="collapseExample7" >
        <div class="" style="background-color: #FFFFFF;padding:10px;">
            Vous pouvez vendre toute tenue traditionnelle que vous avez. Qu’il s’agit de caftan, tekchita, djellaba etc.. Le plus important c’est qu’elle soit TRADITIONNELLE.            </div>
      </div>
</div>
</div>

<div class="col-lg-12"  style="margin-bottom: 10px">
    <div style="background-color: #FFFFFF;"  class="question_div">
    <button onclick="colapse_div(this)"  style="background-color: #FFFFFF;border:0px solid black;padding:10px;width:100%;text-align:left"class="" data-toggle="collapse" href="#collapseExample8" role="button" aria-expanded="false" aria-controls="collapseExample8">
        <img src="{{asset('storage/plus.png')}}" alt="" height="12px" width="12px">
        Où trouver mon bon de livraison ?    
     </button>
      <div class="collapse" id="collapseExample8" >
        <div class="" style="background-color: #FFFFFF;padding:10px;">
            Votre étiquette d'expédition vous sera envoyée par e-mail dans les 48 heures suivant la vente de votre tenue.      </div>
</div>
</div>

</div>



<div class="col-lg-12"  style="margin-bottom: 10px">
    <div style="background-color: #FFFFFF;"  class="question_div">
    <button onclick="colapse_div(this)"  style="background-color: #FFFFFF;border:0px solid black;padding:10px;width:100%;text-align:left"class="" data-toggle="collapse" href="#collapseExample9" role="button" aria-expanded="false" aria-controls="collapseExample9">
        <img src="{{asset('storage/plus.png')}}" alt="" height="12px" width="12px">
        Mon article est-il couvert contre la perte ou les dommages ?
         </button>
      <div class="collapse" id="collapseExample9" >
        <div class="" style="background-color: #FFFFFF;padding:10px;">
            Vous êtes responsable de tout risque de perte ou de dommage concernant votre article jusqu'à ce que nous en prenions physiquement possession à son arrivée à notre entrepôt. Nous acceptons le risque de perte ou de dommage des articles uniquement lorsque (i) nous prenons physiquement possession du ou des articles, ou lorsque (ii) vous utilisez notre étiquette d'expédition prépayée et approuvée ainsi que l'expédition approuvée et que l'étiquette est traitée dans le système de suivi de notre partenaire d'expédition approuvé. Si un article est endommagé, volé ou perdu pendant qu'il est en notre possession ou durant l'expédition approuvée, et que la perte est confirmée par le service d'expédition, il sera traité comme vendu et nous vous rembourserons la valeur de l'article.          </div>
</div>
</div>

</div>










      



   





    </div>
</div>
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