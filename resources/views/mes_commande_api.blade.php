@if(count($commandes)==0)
<p class="col-12" style="text-align: center;padding-top: 80px;">{{__('mes_achats.aucune_commande')}}</p>
@endif


@foreach ($commandes as $commande)
    
@if(App::getlocale()=="ar")

<!-- arabe -->



<div class="container">
    
    <div class="row  flex-row-reverse" >
        <div class="col-0 "></div>
        <div class="col-8">
            <b class="float-right"> {{__('mes_achats.commande')}} </b><b class="float-right" style="padding-right: 7px"> {{$commande['NumCommande']}}</b>
           
        </div>
       
        <div class="col-4 " >
        </div>
        <div class="col-0"></div>
    </div>
    <div class="row">
        <div class="col-0 "></div>
        <div class="col-12">
           <b class="float-right">{{__('mes_achats.le')}} : {{$commande['DateCommande']}}</b>
        </div>
    </div>
    <div class="row flex-row-reverse" style="padding-top: 10px">
    
       
            <img height="200" width="200" src="{{$commande['sImg_premier_article']}}" alt="" style="object-fit: contain">
       
       
       <div class="col" > <div  >
       
       
       </div>
  
       <div  style="padding-top: 50px;">
        <b class="float-right"> {{__('mes_achats.mode_livraison')}}</b><b class="float-right" style="padding-right: 4px;padding-left:4px">  :  </b><b class="float-right">   {{$commande['sTypeLivraison']}}</b> 
       </div>
    @php
    $statut="";
        if($commande['sStatut']=="E")
        {
          $statut=__('mes_achats.en_attente');
        }
        if($commande['sStatut']=="EL")
        {
            $statut=__('mes_achats.en_livraison');
        }
        if($commande['sStatut']=="L")
        {
            $statut=__('mes_achats.livre');
        }
        if($commande['sStatut']=="A")
        {
            $statut=__('mes_achats.annuler');
        }
    @endphp
       <div  style="padding-top: 50px">
        <b class="float-right">{{__('mes_achats.status')}} </b><b class="float-right" style="padding-right: 4px;padding-left:4px">  :  </b><b class="float-right"> {{$statut}} </b>
       </div>
       <div style="padding-top: 30px">
        <button id="btn_suivi"  value="{{route('suivi_commande',$commande['sId_commande'])}}" class="btn btn-primary btn_suivi float-left" >{{__('mes_achats.suivi')}}</button>
       </div>
    </div>
           
       
    </div>
</div>








@else
<div class="container">
    
    <div class="row  " >
        <div class="col-0 "></div>
        <div class="col-8">
            <b> {{__('mes_achats.commande')}}  {{$commande['NumCommande']}}</b>
           
        </div>
       
        <div class="col-4 " >
        </div>
        <div class="col-0"></div>
    </div>
    <div class="row">
        <div class="col-0 "></div>
        <div class="col-8">
           <b>{{__('mes_achats.le')}} : {{$commande['DateCommande']}}</b>
        </div>
    </div>
    <div class="row" style="padding-top: 10px">
    
       
            <img height="200" width="200" src="{{$commande['sImg_premier_article']}}" alt="" style="object-fit: contain ;border-radius: 10px">
       
       
       <div class="col" > <div  >
       
       
       </div>
  
       <div  style="padding-top: 30px">
       <b> {{__('mes_achats.mode_livraison')}} : {{$commande['sTypeLivraison']}}</b>
       </div>
    @php
    $statut="";
        if($commande['sStatut']=="E")
        {
         $statut=__('mes_achats.en_attente');
        }
        if($commande['sStatut']=="EL")
        {
            $statut=__('mes_achats.en_livraison');
        }
        if($commande['sStatut']=="L")
        {
            $statut=__('mes_achats.livre');
        }
        if($commande['sStatut']=="A")
        {
            $statut=__('mes_achats.annuler');
        }
    @endphp
       <div  style="padding-top: 30px">
        <b>{{__('mes_achats.status')}} : {{$statut}}</b>
       </div>
       <div style="padding-top: 30px">
        <button id="btn_suivi" value="{{route('suivi_commande',$commande['sId_commande'])}}" class="btn btn-primary float-right btn_suivi" >{{__('mes_achats.suivi')}}</button>
       </div>
    </div>
    
       
    </div>
</div>
@endif
<hr>
@endforeach
