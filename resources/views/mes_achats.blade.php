@extends('navbar')
@section('content')




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
    @media only screen and (max-width: 600px) {
  .prix_flex {
    display: flex;
  }
}
</style>



<!-- Modal annulation -->


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div  class="modal-header @if(App::getlocale()=="ar")  flex-row-reverse @endif">
          <h5 class="modal-title"  id="exampleModalLabel">{{__('mes_achats.titre')}}</h5>
          <div @if(App::getlocale()=="ar") style="text-align: end" @endif><button type="button" class="close pl-0" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button></div>
          
        </div>
        <div class="modal-body" @if(App::getlocale()=="ar") style="text-align: end" @endif>
          {{__('mes_achats.annuler_commande')}}
        </div>
        <div class="modal-footer @if(App::getlocale()=="ar")  flex-row-reverse @endif">
          <button style="width: 80px" type="button" class="btn btn-secondary" data-dismiss="modal">{{__('mes_achats.non')}}</button>
          <form action={{route('annuler_commande')}} method="POST">
            @csrf
            <input id="id_cancel" type="hidden" name="id_cancel" value="">
            <button style="width: 80px" type="submit" class="btn btn-danger">{{__('mes_achats.oui')}}</button>
          </form>
         
        </div>
      </div>
    </div>
  </div>

<!-- Modal reclamation -->


<div class="modal fade" id="exampleModal_reclamation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content" >
      <div class="modal-header @if(App::getlocale()=="ar")  flex-row-reverse @endif">
       
        <h5 class="modal-title"  id="exampleModalLabel">{{__('mes_achats.reclamation_button')}}</h5>
        <div @if(App::getlocale()=="ar") style="text-align: end" @endif>
        <button type="button" class="close pl-0" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>
      </div>
      <form action={{route('ajouter_reclamation')}} method="POST" >
        @csrf
      <div class="modal-body">
        <div @if(App::getlocale()=="ar")  style="text-align: end" @endif><label for="sujet" >{{__('mes_achats.sujet')}}</label></div>
        
        <input type="text" class="form-control @error('sujet') is-invalid @enderror" id="sujet"  name="sujet" value="{{ old('sujet') }}" required>
        <div @if(App::getlocale()=="ar")  style="text-align: end" @endif><label for="Description">{{__('mes_achats.description')}}</label></div>
        <textarea required class="form-control @error('description') is-invalid @enderror" id="description"  name="description" rows="12">{{ old('description') }}</textarea>
        <div  style="text-align: center;padding-top:15px">
       
          <input id="id_commande" type="hidden" name="id_commande" value="">
        <div>
            <button type="submit" class="btn btn-primary btn_suivi ">{{__('mes_achats.envoyer')}}</button>
          </div>
            
          </div>
      </div>
      
        
       
      </div>
    </form>
    </div>
  </div>
</div>







@if(App::getlocale()=="ar")
<h1  style="padding: 20px;color:#263066;text-align:end">{{__('nav.mes_achats')}}</h1>
@else
<h1  style="padding: 20px;color:#263066;text-align:start">{{__('nav.mes_achats')}}</h1>
@endif


@if(count($achats)==0)
<p class="col-12" style="text-align: center;padding-top: 80px;">{{__('mes_achats.aucun_achat')}}</p>
@endif



@foreach ($achats as $achat)
    
@if(App::getlocale()=="ar")

<!-- arabe -->



<div class="container">
    
    <div class="row  flex-row-reverse" >
        <div class="col-0 "></div>
        <div class="col-8">
            <b class="float-right"> {{__('mes_achats.commande')}} </b><b class="float-right" style="padding-right: 7px"> {{$achat['NumCommande']}}</b>
           
        </div>
       
        <div class="col-4 " >
          @if($achat['sStatut']=="E")
<button class="btn btn-primary float-left btn_annuler" id="annuler_commande" value="{{$achat['sId_commande']}}">{{__('mes_achats.annuler_button')}}</button>
          @endif
          @if($achat['sStatut']=="L")
          <button class="btn btn-primary float-left btn_annuler" id="reclamer_commande" value="{{$achat['sId_commande']}}">{{__('mes_achats.reclamation_button')}}</button>
          @endif
        </div>
        <div class="col-0"></div>
    </div>
    <div class="row">
        <div class="col-0 "></div>
        <div class="col-12">
           <b class="float-right">{{__('mes_achats.le')}} : {{$achat['DateCommande']}}</b>
        </div>
    </div>
    <div class="row flex-row-reverse" style="padding-top: 10px">
    
       
            <img height="200" width="200" src="{{$achat['sImg_premier_article']}}" alt="" style="object-fit: contain">
       
       
       <div class="col" > <div  style="padding-top: 30px;">
       
        <b  class="float-right"> {{__('mes_achats.montant_total')}}</b><b class="float-right" style="padding-right: 4px;padding-left:4px">  :  </b> <b class="float-right" >{{$achat['MontanTotal']}} DH </b>
       
       </div>
  
       <div  style="padding-top: 50px;">
        <b class="float-right"> {{__('mes_achats.mode_livraison')}}</b><b class="float-right" style="padding-right: 4px;padding-left:4px">  :  </b><b class="float-right">   {{$achat['sTypeLivraison']}}</b> 
       </div>
    @php
    $statut="";
        if($achat['sStatut']=="E")
        {
          $statut=__('mes_achats.en_attente');
        }
        if($achat['sStatut']=="EL")
        {
          $statut=__('mes_achats.en_livraison');
        }
        if($achat['sStatut']=="L")
        {
          $statut=__('mes_achats.livre');
        }
        if($achat['sStatut']=="A")
        {
          $statut=__('mes_achats.annuler');
        }
    @endphp
       <div  style="padding-top: 50px">
        <b class="float-right">{{__('mes_achats.status')}} </b><b class="float-right" style="padding-right: 4px;padding-left:4px">  :  </b><b class="float-right"> {{$statut}} </b>
       </div>
       <div style="padding-top: 30px">
        <button value="{{route('suivi_achat',$achat['sId_commande'])}}"  id="btn_suivi" class="btn btn-primary btn_suivi float-left" >{{__('mes_achats.suivi')}}</button>
       </div>
    </div>
           
       
    </div>
</div>








@else
<div class="container">
    
    <div class="row  " >
        <div class="col-0 "></div>
        <div class="col-8">
            <b> {{__('mes_achats.commande')}}  {{$achat['NumCommande']}}</b>
           
        </div>
       
        <div class="col-4 " >
          @if($achat['sStatut']=="E")
<button class="btn btn-primary float-right btn_annuler" id="annuler_commande" value="{{$achat['sId_commande']}}" >{{__('mes_achats.annuler_button')}}</button>
          @endif
          @if($achat['sStatut']=="L")
          <button class="btn btn-primary float-right btn_annuler" id="reclamer_commande" value="{{$achat['sId_commande']}}" >{{__('mes_achats.reclamation_button')}}</button>
          @endif
        </div>
        <div class="col-0"></div>
    </div>
    <div class="row">
        <div class="col-0 "></div>
        <div class="col-8">
           <b>{{__('mes_achats.le')}} : {{$achat['DateCommande']}}</b>
        </div>
    </div>
    <div class="row" style="padding-top: 10px">
    
       
            <img height="200" width="200" src="{{$achat['sImg_premier_article']}}" alt="" style="object-fit: contain">
       
       
       <div class="col" > <div  style="padding-top: 30px">
       
       <b>{{__('mes_achats.montant_total')}} : </b><b class="prix_flex" >{{$achat['MontanTotal']}} DH</b>
       
       </div>
  
       <div  style="padding-top: 30px">
       <b> {{__('mes_achats.mode_livraison')}} : {{$achat['sTypeLivraison']}}</b>
       </div>
    @php
    $statut="";
        if($achat['sStatut']=="E")
        {
          $statut=__('mes_achats.en_attente');
        }
        if($achat['sStatut']=="EL")
        {
          $statut=__('mes_achats.en_livraison');
        }
        if($achat['sStatut']=="L")
        {
          $statut=__('mes_achats.livre');
        }
        if($achat['sStatut']=="A")
        {
          $statut=__('mes_achats.annuler');
        }
    @endphp
       <div  style="padding-top: 30px">
        <b>{{__('mes_achats.status')}} : {{$statut}}</b>
       </div>
       <div style="padding-top: 30px">
        <button value="{{route('suivi_achat',$achat['sId_commande'])}}" id="btn_suivi" class="btn btn-primary float-right btn_suivi" >{{__('mes_achats.suivi')}}</button>
       </div>
    </div>
           
       
    </div>
</div>
@endif
<hr>
@endforeach


<script>
    $(document).ready(function(){
      $(document).on('click','#annuler_commande',function(e){
        e.preventDefault();
        var d=$(this).val();
         $('#id_cancel').val(d);
         $('#exampleModal').modal('show');
      });
    });


    $(document).ready(function(){
      $(document).on('click','#reclamer_commande',function(e){
        e.preventDefault();
        var d=$(this).val();
         $('#id_commande').val(d);
         $('#exampleModal_reclamation').modal('show');
      });
    });
    
    $(document).ready(function(){
      $(document).on('click','#btn_suivi',function(e){
        e.preventDefault();
        var d=$(this).val();
        window.location = d; 
      
      });
    });
   
  </script>
@endsection