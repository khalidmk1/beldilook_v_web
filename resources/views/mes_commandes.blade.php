@extends('navbar')
@section('content')




<style>
     .btn_ajouter{
        background-color: #212951;
        border: #212951;
        width: 80px;
        font-size: 17px;
        width: 100px;
        color: white;
        height: 40px;
        border-radius: 30px;
    }

    .btn_ajouter:hover{
        background-color: #283991;
        border: #283991;
    }
    .btn_annuler{
        background-color: #222d66;
        border: #222d66;
        width: 80px;
    }


    .btn_annuler:hover{
  background-color: #1c2241;
        border: #1c2241;;
    }
    .btn_suivi{
        background-color: #B09636;
        border: #B09636;
        width: 80px;
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
.loader {
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid #B09636;
  width: 120px;
  height: 120px;
  -webkit-animation: spin 2s linear infinite; /* Safari */
  animation: spin 2s linear infinite;
  position: relative;
  left: 35%;
}

/* Safari */
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

.input_style input {
  border: solid var(--color-primary) 1px;
    border-radius: 10px;
    margin-top: 5px;
    color: var(--color-primary) !important;
    font-weight: 400 !important;
}
.input_style select{
  border: solid var(--color-primary) 1px;
    border-radius: 10px;
    margin-top: 5px;
    color: var(--color-primary) !important;
    font-weight: 400 !important;
}


.btn_valider{
  color:#fff;
  background-color: var(--color-primary);
  border: solid 2px transparent;
  border-radius:10px;
  padding:8px;
  margin-bottom:20px;
    }

    .btn_valider:hover{
       
  background:#EFEFEF;
  color:var(--color-primary);
  border: solid 2px var(--color-primary);
  transition:.2s;
 
    }

    .input_style label{
  
  color: var(--color-primary);
    font-weight: 400;
    letter-spacing: .1px;
    font-size: 16px;
    font-family: var(--font-secondary);
}



</style>



<!-- Modal -->


<div class="modal" id="modal_loading" tabindex="-1" role="dialog" data-backdrop="static" >
    <div class="modal-dialog modal-dialog-centered" role="document" >
      <div class="modal-content" style="background-color: transparent;border:transparent">
      
        <div class="modal-body">
          <div style="align-items: center;position:relative">
  
            <div class="loader"></div>
          </div>
          
        </div>
       
      </div>
    </div>
  </div>


  {{ csrf_field() }}




@if(App::getlocale()=="ar")
<h1  style="color:#263066;text-align:center" class="mt-5 text-center">{{__('nav.mes_commandes')}}</h1>
@else
<h1  style="color:#263066;text-align:center" class="mt-5 text-center">{{__('nav.mes_commandes')}}</h1>
@endif



<div class="container mt-5" >
    
    <div class="row justify-content-center input_style">
        <div class="col-lg-3 col-sm-6">
            <label for="startDate">{{__('mes_achats.du')}} : </label>
            <input id="startDate" class="form-control" type="date" />
         
        </div>
        <div class="col-lg-3 col-sm-6">
            <label for="endDate">{{__('mes_achats.au')}} : </label>
            <input id="endDate" class="form-control" type="date" />
            
        </div>
    </div>


    <div class="row justify-content-center">
    <div class="mb-3 mt-3 ml-3 mr-3 input_style" style="width: 30%">
        <label for="etat">{{__('mes_achats.etat')}} :</label>
        <select class="form-select form-control" aria-label="Default select example" id="etat" name="etat" required>
        
    
      
       <option selected value="">{{__('mes_achats.aucun')}}</option>
      
     <option value="E">{{__('mes_achats.en_attente')}}</option>
     <option value="EL">{{__('mes_achats.en_livraison')}}</option>
     <option value="L">{{__('mes_achats.livre')}}</option>
     <option value="A">{{__('mes_achats.annuler')}}</option>
         
        </select>
    
      
        <div class="invalid-feedback" id="span_genre"></div>
        
      </div>
    </div>
    <div style="text-align: center"> <button class="btn_valider" style=" width: 100px !important;" onclick="valider_filtre()"> {{__('home.filtre')}} </button></div>

   
</div>

<br>

<div id="principal" class="mt-5" style="margin-bottom:60px;">

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
           {{__('mes_achats.le')}} : {{$commande['DateCommande']}}
        </div>
    </div>
    <div class="row" style="padding-top: 10px">
    
       
            <img height="200" width="200" style="border-radius: 10px ;object-fit: contain" src="{{$commande['sImg_premier_article']}}" alt="" >
       
       
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
        <b>{{__('mes_achats.status')}}</b> : {{$statut}}
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

</div>

<script>
   
    
    $(document).ready(function(){
      $(document).on('click','#btn_suivi',function(e){
        e.preventDefault();
        var d=$(this).val();
        window.location = d; 
      
      });
    });
   



 
function valider_filtre()
{
    var start_date=$('#startDate').val();
    var end_date=$('#endDate').val();

    if(start_date!="" || end_date!="")
    {
        if(start_date=="" || end_date=="")
    {
        alert('Vous devez remplir les deux dates');
    }
    }
        var etat_selected=$('#etat').val();
  


        $('#modal_loading').modal('show');
var _token=$('input[name="_token"]').val();
           $.ajax({
       url:("{{route('mes_commandes_api')}}"),
       method:"POST",
       data:{
       _token:_token,
       etat:etat_selected,
       start_date:start_date,
       end_date:end_date
       },
       success:function(data)
       {
       if(data!='erreur')
       {
       
        $('#principal').html(data);
       }
       $('#modal_loading').modal('hide');
     
       }
       ,error:function(error)
{
// error alert message

$('#modal_loading').modal('hide');
alert('{{__('favoris.erreur')}}');
console.log(error);
}
       });




}


  </script>

@endsection