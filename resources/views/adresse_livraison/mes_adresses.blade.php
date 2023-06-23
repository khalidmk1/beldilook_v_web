@extends('navbar')


@section('content')


<style>

  .table td, .table th{
    padding: 5px;
  }
  .btn_ajouter{
        background-color: #212951;
        border: #212951;
        width: 100px;
        font-size: 17px;
        color: white;
        height: 40px;
        border-radius: 30px;
    }

    .btn_ajouter:hover{
        background-color: #283991;
        border: #283991;
    }
</style>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{__('adresses_livraison.suppression_adresse')}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {{__('adresses_livraison.suppression_message')}}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('adresses_livraison.annuler')}}</button>
        <form action={{route('delete_adresse')}} method="POST">
          @csrf
          <input id="id_delete" type="hidden" name="id_delete" value="">
          <button type="submit" class="btn btn-danger">{{__('adresses_livraison.supprimer')}}</button>
        </form>
       
      </div>
    </div>
  </div>
</div>


<div class="container mt-5 mb-5">

    <div class="col-md-12  text-right">
        <button class="btn_ajouter mt-2" onclick="window.location='{{route('get_add_adresses')}}'">{{__('adresses_livraison.ajouter')}}</button>
{{--         <a class="btn btn-primary" href="{{route('get_add_adresses')}}">{{__('adresses_livraison.ajouter')}}</a>
 --}}    </div>
<h5>{{__('adresses_livraison.titre')}}</h5>
<br>
@if($adresses!=null)
<table class="table">
    <thead>
      <tr style="padding: 5px !important">
        
        <th scope="col">{{__('adresses_livraison.adresse')}}</th>
        <th scope="col">{{__('adresses_livraison.ville')}}</th>
        <th scope="col">{{__('adresses_livraison.secteur')}}</th>
        <th scope="col">{{__('adresses_livraison.code_postal')}}</th>
        <th scope="col"></th>
        
      </tr>
    </thead>
    <tbody style="padding: 5px !important">
@foreach($adresses as $adresse)

   <tr> 
    <td>{{$adresse['sAdresse']}}</td>
    <td>{{$adresse['sVille']}}</td>
    <td>{{$adresse['sSecteur']}}</td>
    <td>{{$adresse['sCodePostal']}}</td>
    <td style="text-align: center;">
       <a class="btn btn-success" href="{{route('get_update_adresse',$adresse['sIDLivraison'])}}"><i class="fas fa-edit"></i></a>
       <button id="delete_adresse" class="btn btn-danger" value="{{$adresse['sIDLivraison']}}"><i class="fas fa-trash"></i></button>

  </td>

  </tr>


@endforeach
</tbody>
</table>
@else
<p class="col-12" style="text-align: center;padding-top: 80px;">{{__('adresses_livraison.aucun')}}</p>
@endif

  </div>
  <script>
    $(document).ready(function(){
      $(document).on('click','#delete_adresse',function(e){
        e.preventDefault();
        var d=$(this).val();
         $('#id_delete').val(d);
         $('#exampleModal').modal('show');
      });
    });
   
  </script>
@endsection





    
      
     
      
 