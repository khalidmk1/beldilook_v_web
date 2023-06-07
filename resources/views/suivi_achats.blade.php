@extends('navbar')
@section('content')
<link rel="stylesheet" type="text/css" href="{{ url('/css/progresse.css') }}" />

<link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
<style>
    .btn_annuler{
        background-color: #222d66;
        border: #222d66;
        width: 120px;
    }


    .btn_annuler:hover{
  background-color: #1c2241;
        border: #1c2241;;
    }
    .btn_suivi{
        background-color: #B09636;
        border: #B09636;
        width: 120px;
    }
    .btn_suivi:hover{
        background-color: #86732b;
        border: #86732b;
    }
    .stars {
	margin: 50px;
	text-align: center;
}

.stargrey {
	color: #96969d;
}

.yellow {
	color: #fedc18;
}
  
  

</style>



<!-- Modal ajouter avis -->


<div class="modal fade" id="exampleModal_avis" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content" >
      <div class="modal-header @if(App::getlocale()=="ar")  flex-row-reverse @endif">
       
        <h5 class="modal-title"  id="exampleModalLabel">{{__('suivi_achat.ajouter_avis')}}</h5>
        <div @if(App::getlocale()=="ar") style="text-align: end" @endif>
        <button type="button" class="close pl-0" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>
      </div>
      <form action={{route('ajouter_avis')}} method="POST" >
        @csrf
      <div class="modal-body">


       

        <div id="nom_produit"  style="text-align:center" ></div>
        <div style="text-align:center">
          <img id="image_produit" src="" alt="" height="250" width="250">
        </div>
      <br>
        <div style="text-align: center;cursor: pointer"> <i style="cursor: pointer" onclick="change_etoile(1)" class="star yellow fas fa-star tablinks" data-index="0"></i>
          <i style="cursor: pointer" onclick="change_etoile(2)" class="star yellow fas fa-star tablinks" data-index="1"></i>
          <i style="cursor: pointer" onclick="change_etoile(3)" class="star stargrey fas fa-star tablinks" data-index="2"></i>
          <i style="cursor: pointer" onclick="change_etoile(4)" class="star stargrey fas fa-star tablinks" data-index="3"></i>
          <i style="cursor: pointer" onclick="change_etoile(5)" class="star stargrey fas fa-star tablinks" data-index="4"></i></div>
       
        
        <div @if(App::getlocale()=="ar")  style="text-align: end" @endif><label for="commentaire">{{__('suivi_achat.commentaire')}}</label></div>
        <textarea required class="form-control @error('commentaire') is-invalid @enderror" id="commentaire"  name="commentaire" rows="3">{{ old('commentaire') }}</textarea>
        <div  style="text-align: center;padding-top:15px">
       
          <input id="id_commande" type="hidden" name="id_commande" value="{{$IDCommande}}">
          <input id="id_article" type="hidden" name="id_article" value="">
          <input id="nb_etoile" type="hidden" name="nb_etoile" value="1">
        <div>
            <button type="submit" class="btn btn-primary btn_suivi ">{{__('mes_achats.envoyer')}}</button>
          </div>
            
          </div>
      </div>
    </form>
    </div>
 


</div>
</div>






@if(App::getlocale()=="ar")
<h1  style="padding: 20px;color:#263066;text-align:end">{{__('suivi_achat.suivi_commande')}}</h1>
@else
<h1  style="padding: 20px;color:#263066;text-align:start">{{__('suivi_achat.suivi_commande')}}</h1>
@endif

@if(App::getlocale()=="ar")
<h5  style="padding: 20px;color:#263066;text-align:end"> {{$commande['sIdCommande']}} : {{__('suivi_achat.commande')}} </h5>
@else
<h5  style="padding: 20px;color:#263066;text-align:start">{{__('suivi_achat.commande')}} : {{$commande['sIdCommande']}}</h5>
@endif


<div class="container-fluid">



  <!--  ****************************************** progresse ************************************************************* -->
  @if($commande['sStatut']=='A')

        <p style="text-align: center">{{__('suivi_achat.commande_annulee')}}</p>
      
        
@else


    <div class="stepper-wrapper">

        @if($commande['sStatut']=='E')

        <div class="stepper-item completed">
          <div class="step-counter"></div>
          <div class="step-name">{{__('suivi_achat.en_attente')}}</div>
        </div>
        <div class="stepper-item ">
          <div class="step-counter"></div>
          <div class="step-name">{{__('suivi_achat.en_livraison')}}</div>
        </div>
        <div class="stepper-item ">
          <div class="step-counter"></div>
          <div class="step-name">{{__('suivi_achat.livre')}}</div>
        </div>
        @endif

        @if($commande['sStatut']=='EL')

        <div class="stepper-item completed">
          <div class="step-counter"></div>
          <div class="step-name">{{__('suivi_achat.en_attente')}}</div>
        </div>
        <div class="stepper-item completed">
          <div class="step-counter"></div>
          <div class="step-name">{{__('suivi_achat.en_livraison')}}</div>
        </div>
        <div class="stepper-item ">
          <div class="step-counter"></div>
          <div class="step-name">{{__('suivi_achat.livre')}}</div>
        </div>
        @endif

        @if($commande['sStatut']=='L')

        <div class="stepper-item completed">
          <div class="step-counter"></div>
          <div class="step-name">{{__('suivi_achat.en_attente')}}</div>
        </div>
        <div class="stepper-item completed">
          <div class="step-counter"></div>
          <div class="step-name">{{__('suivi_achat.en_livraison')}}</div>
        </div>
        <div class="stepper-item completed">
          <div class="step-counter"></div>
          <div class="step-name">{{__('suivi_achat.livre')}}</div>
        </div>
        @endif


     

      </div>
      @endif

      @if(App::getlocale()=="ar")
      <div style="text-align: end">
      <label style="padding-top:10px;font-size:20px;"><strong > : {{__('suivi_achat.adresse_livraison')}} </strong></label>
    </div>
      @else
      <label style="padding-top:10px;font-size:20px"> <strong>{{__('suivi_achat.adresse_livraison')}}  : </strong></label>
      @endif
      <p @if(App::getlocale()=="ar") style="text-align: end" @endif>{{$commande['sAdresse']}}</p>

      @if(App::getlocale()=="ar")
      <div style="text-align: end">
      <label style="padding-top:10px;font-size:20px;"><strong> : {{__('suivi_achat.mode_livraison')}} </strong></label>
      </div>
      @else
      <label style="padding-top:10px;font-size:20px"> <strong> {{__('suivi_achat.mode_livraison')}} : </strong></label>
      @endif
      @if(App::getlocale()=="ar")
      <p style="text-align: end">{{$commande['Libele_mode_livraison']}} {{$commande['sTotalLivraison']}} Dh</p>
      @else
      <p>{{$commande['Libele_mode_livraison']}} {{$commande['sTotalLivraison']}} Dh</p>
      @endif

      @if(App::getlocale()=="ar")
      <div style="text-align: end">
      <label style="padding-top:10px;font-size:20px"><strong> : {{__('suivi_achat.total_achats')}} </strong></label>
      </div>
      @else
      <label style="padding-top:10px;font-size:20px"> <strong>{{__('suivi_achat.total_achats')}} : </strong></label>
      @endif
      @if(App::getlocale()=="ar")
      <p style="text-align: end"> {{$commande['sTotalProduit']}} DH</p>
      @else
      <p>{{$commande['sTotalProduit']}} DH</p>
      @endif

      @if(App::getlocale()=="ar")
      <div style="text-align: end">
        
      <label style="padding-top:10px;font-size:20px"><strong> : {{__('suivi_achat.total_commande')}} </strong></label>
      </div>
      @else
      <label style="padding-top:10px;font-size:20px"> <strong> {{__('suivi_achat.total_commande')}} :</strong></label>
      @endif
      <p @if(App::getlocale()=="ar") style="text-align: end" @endif>{{$commande['sTotal']}} DH</p>



      @foreach ($details_commande as $details)


      <div class="row @if(App::getlocale()=="ar") flex-row-reverse @endif" style="padding: 10px">
    
       
            <img height="200" width="200" src="{{$details['Image']}}" alt="" style="object-fit: contain">
       
       
       <div class="col" > <div >
        <div  style="font-size:20px;@if(App::getlocale()=="ar") text-align:end @endif"> <strong> {{$details['Libellé']}}</strong></div>
        </div>
        <div style="padding-top:17px;@if(App::getlocale()=="ar") text-align:end @endif">
            @if(App::getlocale()=="ar")
            <div > {{$details['Tailless']}} : {{__('suivi_achat.taille')}} </div>
            @else
            <div > {{__('suivi_achat.taille')}}  : {{$details['Tailless']}}</div>
            @endif
            </div>
            <div style="padding-top:0px;@if(App::getlocale()=="ar") text-align:end @endif">  
                @if(App::getlocale()=="ar")
                    <div > <div style="border-radius: 100%;background-color:{{$details['html_couleur']}};width:30px;height:30px;display:inline-block;position:relative;bottom:-9px;"></div> : {{__('suivi_achat.couleur')}} </div>
                    @else
                    <div >{{__('suivi_achat.couleur')}} : <div style="border-radius: 100%;background-color:{{$details['html_couleur']}};width:30px;height:30px;display:inline-block;position:relative;bottom:-9px;"></div></div>
                    @endif
                </div>
                <div style="padding-top:17px;@if(App::getlocale()=="ar") text-align:end @endif">
                    @if(App::getlocale()=="ar")
                    <div > {{$details['qte']}} : {{__('suivi_achat.quantite')}}</div>
                    @else
                    <div > {{__('suivi_achat.quantite')}} : {{$details['qte']}}</div>
                    @endif
                    </div>
                    <div style="padding-top:17px;@if(App::getlocale()=="ar") text-align:end @endif">
                        @if(App::getlocale()=="ar")
                        <div >  {{$details['Prix']}} DH : {{__('suivi_achat.prix')}}</div>
                        @else
                        <div > {{__('suivi_achat.prix')}} : {{$details['Prix']}} DH</div>
                        @endif
                        </div>
       </div>

      </div>
    @if($commande['sStatut']=="L")
      @if($details['avis']=="ok")
      @if(App::getlocale()=="ar")
      <div class="row flex-row-reverse" style="padding-top:10px;padding-right:50px">
        <button onclick="getdetailsproduit('{{$details['Libellé']}}','{{$details['Image']}}','{{$details['IdProduit']}}')" id="ajouter_avis" class="btn btn-primary btn_annuler"> {{__('suivi_achat.donner_avis')}}</button>
      </div>
      @else
      <div class="row" style="padding-top:10px;padding-left:50px">
        <button onclick="getdetailsproduit('{{$details['Libellé']}}','{{$details['Image']}}','{{$details['IdProduit']}}')"  id="ajouter_avis" class="btn btn-primary btn_annuler">{{__('suivi_achat.donner_avis')}}</button>
      </div>
      @endif
      @endif
      @endif
      <hr>
      @endforeach



  </div>

<script>

  function change_etoile(nb_etoile){
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace("yellow", "stargrey");
    }
    for (i = 0; i < nb_etoile; i++) {
      tablinks[i].classList = tablinks[i].className.replace("stargrey", "yellow");
    }

    
    $('#nb_etoile').val(nb_etoile);
  }
  function getdetailsproduit(nom_produit,image_produit,id_produit){
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 1; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace("yellow", "stargrey");
    }
   
    $('#id_article').val(id_produit);
    $("#image_produit").attr("src",image_produit);
    $('#nom_produit').html(nom_produit);
         $('#exampleModal_avis').modal('show');
  }
   
</script>

@endsection