@extends('navbar')
@section('content')

<link rel="stylesheet" type="text/css" href="{{ url('/css/style.css') }}" />
<div class="col"  id="snackbar">Some text some message..</div>

<style>
  .btn_suivi{
  background-color: #B09636;
  border: #B09636;
  width: 80px;
  font-size: 20px;
  width: 210px;
  color: white;
  height: 50px;
  border-radius: 30px;
}
.btn_suivi:hover{
  background-color: #86732b;
  border: #86732b;
}
.btn_suivi_click{
  background-color: #463b16;
  border: #B09636;
  width: 80px;
  font-size: 20px;
  width: 210px;
  color: white;
  height: 50px;
  border-radius: 30px;
}

.loader {
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid #3498db;
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


</style>


<link rel="stylesheet" type="text/css" href="{{ url('/css/style.css') }}" />

{{ csrf_field() }}
<input style="display:none" id="image" name="image" type='file' accept="image/*" onchange="readURL(this);" />

<input style="display:none" type="text" id="id_blog">




<div class="modal" id="Modal_delete_blog" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{__('adresses_livraison.suppression_adresse')}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        vous êtes sur de vouloir supprimer ce Blog ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('adresses_livraison.annuler')}}</button>

          <button class="btn btn-danger" onclick="validate_delete()">{{__('adresses_livraison.supprimer')}}</button>
        
       
      </div>
    </div>
  </div>
</div>







<div class="modal" id="modal_loading" tabindex="-1" role="dialog" data-backdrop="static" style="z-index: 100000">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      
      <div class="modal-body">
        <div style="align-items: center;position:relative">

          <div class="loader"></div>
        </div>
        
      </div>
     
    </div>
  </div>
</div>


<div class="modal" id="modal_ajout" tabindex="-1" role="dialog" >
    <div class="modal-dialog modal-dialog-centered" role="document" >
      <div class="modal-content">
        <div class="modal-header">
          
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div style="text-align: center">  <img id="image_profile" style="object-fit: contain" src="{{ asset('storage/image1.png') }}" alt="" height="200px" width="300px"></div>
            <br>
            <div style="color: red;text-align:center"  id="span_image"></div>
            <br>
            <div style="text-align: center">
                <div style="display: inline-block"> <strong id="strong_span">Ajouter blog</strong> </div>
                <div style="display: inline-block;cursor: pointer;" onclick="select_image()"><img style="margin-right: 10px;margin-left:60px" src="{{asset('storage/camajoutblogbl .png')}}" alt="" height="30px" width="30px"><div style="display: inline-block">Ajouter</div></div>
            </div>
            


            <div class="mb-3 mt-3 ml-3 mr-3">
                <label for="categorie">Type :</label>
                <select class="form-select form-control" aria-label="Default select example" id="type" name="type" required>
                  <option selected>Aucun</option>
                  <option >Apparitions presse</option>
                  <option >Médias</option>
                  <option >Participation foire</option>
                  <option >Défilé</option>
                  <option >Magazines</option>
                </select>
            
              
                <div class="invalid-feedback" id="span_type"></div>
                
              </div>


              <div class="mb-3 mt-3 ml-3 mr-3">
                <label for="lien">Lien :</label>
              
                <input type="text" class="form-control" id="lien"  name="lien" value="" required>
                
              
                <div id="span_lien" class="invalid-feedback"></div>
                
              </div>

              <div style="text-align: center">
                <input id="confirmer" type="button" value="Confirmer" class="btn_suivi"  onmouseup="mouseUp()" onmousedown="mouseDown()" onmouseout="mouseUp()" onclick="traitement_blog()">
              </div>
        
        </div>
      </div>
    </div>
  </div>



<div id="global_div">


<div style="display: flex ; justify-content: space-between">
@if(App::getlocale()=="ar")
<h1  style="padding: 20px;color:#263066;text-align:end;display:inline-block">Mes blogs</h1>
@else
<h1  style="padding: 20px;color:#263066;text-align:start;display:inline-block">Mes blogs</h1>
@endif

<div style="text-align: end;cursor: pointer;position: relative;
text-align: end;
cursor: pointer;
top: 35px;
right:20px;
"><img src="{{asset('storage/add.png')}}" onclick="ajout_blog()" height="35px" width="35px" alt=""></div>
</div>
<div class="container items">
    <div class="row" id="div_element">
        
        @forelse ($actualites as $actualite)
    <div class="col-lg-3 col-md-4 col-sm-6 col-6" style="padding-bottom: 20px;display:flex;justify-content:center;align-items:center">
    
        <div class="card card2" >
            <div class="imgprod">          
                    <img class="card-img-top" src={{ $actualite['Image']}} alt="Card image cap" height="200" width="200" style="border-radius: 8px;object-fit: contain;cursor: pointer;" onclick="afficher_blog('{{$actualite['Lien']}}','{{$actualite['Type']}}','{{ $actualite['Image']}}','{{ $actualite['idblog']}}')">
                    <img id="delete_blog" onclick="delete_blog('{{ $actualite['idblog']}}',this)" class="topright pointer" height="30" width="30" src={{ asset('storage/supprimer.png') }} alt="">

        </div>
            <div class="card-body">
              <p style="font-size: 17px;text-align: center" class="card-title text" data-toggle="{{$actualite['Type']}}">{{$actualite['Type']}} </p>
             </div>
          </div>
    
    </div> 
       @empty
<p class="col-12" style="text-align: center;padding-top: 80px;">Aucune actualité</p>
       @endforelse
      
    </div>
</div>

<br>
<div id="div_paginate" style="text-align: center;padding-bottom:50px">
    @if ($page==1 or $page=='')
    @if(count($actualites)>0)
    <a class="paginationa" href="">❮</a>
    <a class="paginationa" href={{$request->fullUrlWithQuery(['page' => 2]) }}>❯</a>
    @endif
    @else
    <a class="paginationa" href={{$request->fullUrlWithQuery(['page' => $page-1]) }}>❮</a>
    <a class="paginationa" href={{$request->fullUrlWithQuery(['page' => $page+1]) }}>❯</a>
    @endif





  </div>

</div>



    <script>
      var id_deleted_blog;
      var element_deleted;
      var traitement;
      var page="{{$page}}";
      var page=Number(page);
      var myTimeout;
        function ajout_blog()
        {
          $('#image_profile').attr('src',"{{asset('storage/image1.png')}}");
          $("#lien").val("");
          $("#type").val("Aucun");
          $('#strong_span').html('Ajouter blog');
            $('#modal_ajout').modal('show');
            traitement="ajout";
        }
        function mouseDown() {
  
  $( "#confirmer" ).removeClass( "btn_suivi" );
  $( "#confirmer" ).addClass( "btn_suivi_click" );
}

function mouseUp() {
  $( "#confirmer" ).removeClass( "btn_suivi_click" );
  $( "#confirmer" ).addClass( "btn_suivi" );
}
function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
      $('#image_profile')
        .attr('src', e.target.result);
    };
    reader.readAsDataURL(input.files[0]);
  }
}
function select_image()
{
  $('#image').click();
}

function ajouter_blog_ajax()
{


  var bool_validate=false;
  var image=$('#image_profile').attr('src');

  $( "#image_profile" ).removeClass( "is-invalid" );
  if(image=="{{asset('storage/image1.png')}}")
  {
    $('#span_image').html("L'image est obligatoire");
    bool_validate=true;
  }else{
    $('#span_image').html("");
  }
 
  $( "#lien" ).removeClass( "is-invalid" );
  var lien=$("#lien").val();
  if(lien.replace( / +/g, '')=="")
  {
    bool_validate=true;
    $( "#lien" ).addClass( "is-invalid" );
    $('#span_lien').html("Le lien est obligatoire");
    
  }

  $( "#type" ).removeClass( "is-invalid" );
  var type=$("#type").val();
  if(type=="Aucun")
  {
    bool_validate=true;
    $( "#type" ).addClass( "is-invalid" );
    $('#span_type').html("Le type est obligatoire");
    
  }
  
  if(bool_validate==true)
  {
    return
  }
  $('#modal_ajout').modal('hide');
  $('#modal_loading').modal('show');  

  var _token=$('input[name="_token"]').val();
  $.ajax({
       url:("{{route('add_blog')}}"),
       method:"POST",
       data:{type:type,
       _token:_token,
       lien:lien,
       image:image
       },
       success:function(data)
       {
        //$('#modal_loading').modal('hide');
        if(data='ok'){
          $('#modal_loading').modal('hide');
          $('#modal_ajout').modal('hide');
          $('#image_profile').attr('src',"{{asset('storage/image1.png')}}");
          $("#lien").val("");
          $("#type").val("Aucun");
          var x = document.getElementById("snackbar");
       
       // Add the "show" class to DIV
       x.className = "show col";
       
     
       $("#snackbar").html("Votre blog est en cours de modération.");
      
       clearTimeout(myTimeout);
        myTimeout=setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);

        }else{
          

          $('#modal_loading').modal('hide');
          $('#modal_ajout').modal('show');
          var x = document.getElementById("snackbar");
       
       // Add the "show" class to DIV
       x.className = "show col";
       
     
       $("#snackbar").html("Erreur veuillez réessayer");
      
       clearTimeout(myTimeout);
        myTimeout=setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
        }
   
       }
       ,error:function(error)
{
  $('#modal_loading').modal('hide');
  $('#modal_ajout').modal('show');
  var x = document.getElementById("snackbar");
       
       // Add the "show" class to DIV
       x.className = "show col";
       
     
       $("#snackbar").html("Erreur veuillez réessayer");
      
       clearTimeout(myTimeout);
        myTimeout=setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);

}
       });





}

function afficher_blog(lien,type,image,idblog)
{
  $('#image_profile').attr('src',image);
          $("#lien").val(lien);
          $("#type").val(type);
          $('#strong_span').html('Modifier blog');
          $('#modal_ajout').modal('show');
          $('#id_blog').val(idblog);
          traitement="modification";
}
function modifier_blog()
{
  var bool_validate=false;
  var image=$('#image_profile').attr('src');

  $( "#image_profile" ).removeClass( "is-invalid" );
  if(image=="{{asset('storage/image1.png')}}")
  {
    $('#span_image').html("L'image est obligatoire");
    bool_validate=true;
  }else{
    $('#span_image').html("");
  }
 
  $( "#lien" ).removeClass( "is-invalid" );
  var lien=$("#lien").val();
  if(lien.replace( / +/g, '')=="")
  {
    bool_validate=true;
    $( "#lien" ).addClass( "is-invalid" );
    $('#span_lien').html("Le lien est obligatoire");
    
  }

  $( "#type" ).removeClass( "is-invalid" );
  var type=$("#type").val();
  if(type=="Aucun")
  {
    bool_validate=true;
    $( "#type" ).addClass( "is-invalid" );
    $('#span_type').html("Le type est obligatoire");
    
  }
  
  if(bool_validate==true)
  {
    return
  }

  var idblog=$('#id_blog').val();


  $('#modal_ajout').modal('hide');
  $('#modal_loading').modal('show');  

  var _token=$('input[name="_token"]').val();
  $.ajax({
       url:("{{route('edit_blog')}}"),
       method:"POST",
       data:{type:type,
       _token:_token,
       lien:lien,
       image:image,
       idblog:idblog
       },
       success:function(data)
       {
        //$('#modal_loading').modal('hide');
        if(data='ok'){
          $('#modal_loading').modal('hide');
          $('#modal_ajout').modal('hide');
          $('#image_profile').attr('src',"{{asset('storage/image1.png')}}");
          $("#lien").val("");
          $("#type").val("Aucun");
          var x = document.getElementById("snackbar");
       
       // Add the "show" class to DIV
       x.className = "show col";
       
     
       $("#snackbar").html("Les modifications effectuées sont en cours de modération.");
      
       clearTimeout(myTimeout);
        myTimeout=setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);

        }else{
          

          $('#modal_loading').modal('hide');
          $('#modal_ajout').modal('show');
          var x = document.getElementById("snackbar");
       
       // Add the "show" class to DIV
       x.className = "show col";
       
     
       $("#snackbar").html("Erreur veuillez réessayer");
      
       clearTimeout(myTimeout);
        myTimeout=setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
        }
   
       }
       ,error:function(error)
{
  $('#modal_loading').modal('hide');
  $('#modal_ajout').modal('show');
  var x = document.getElementById("snackbar");
       
       // Add the "show" class to DIV
       x.className = "show col";
       
     
       $("#snackbar").html("Erreur veuillez réessayer");
      
       clearTimeout(myTimeout);
        myTimeout=setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);

}
       });


}

function traitement_blog()
{
  
  if(traitement=="ajout")
  {
    ajouter_blog_ajax();
  }else{
    modifier_blog();
  }
}

function delete_blog(id,elem)
{

  element_deleted=elem;
    id_deleted_blog=id;

$('#Modal_delete_blog').modal('show');
}
function validate_delete()
{
  
  $('#Modal_delete_blog').modal('hide');
  $('#modal_loading').modal('show');
  var _token=$('input[name="_token"]').val();
  $.ajax({
       url:("{{route('delete_blog')}}"),
       method:"POST",
       data:{id_blog:id_deleted_blog,
       _token:_token
       },
       success:function(data)
       {
        console.log(data);
        //$('#modal_loading').modal('hide');
      
        if(data='ok'){
          $('#modal_loading').modal('hide');
          $('#Modal_delete_blog').modal('hide');
          var x = document.getElementById("snackbar");
       
       // Add the "show" class to DIV
       x.className = "show col";
       
       element_deleted.parentNode.parentNode.parentNode.parentNode.removeChild(element_deleted.parentNode.parentNode.parentNode);
       tabimgs = document.getElementsByClassName("imgprod");
      
       if(tabimgs.length==0)
       {
        $('#div_paginate').hide();
        $('#div_element').html('<p class="col-12" style="text-align: center;padding-top: 80px;">Aucune actualité</p>');
       }
       $("#snackbar").html("Le blog a été supprimé avec success.");
      
       clearTimeout(myTimeout);
        myTimeout=setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);

        }else{
          

          $('#modal_loading').modal('hide');
          $('#Modal_delete_blog').modal('show');
          var x = document.getElementById("snackbar");
       
       // Add the "show" class to DIV
       x.className = "show col";
       
     
       $("#snackbar").html("Erreur veuillez réessayer");
      
       clearTimeout(myTimeout);
        myTimeout=setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
        }
   
       }
       ,error:function(error)
{
  $('#modal_loading').modal('hide');
  $('#Modal_delete_blog').modal('show');
  var x = document.getElementById("snackbar");
       
       // Add the "show" class to DIV
       x.className = "show col";
       
     
       $("#snackbar").html("Erreur veuillez réessayer");
      
       clearTimeout(myTimeout);
        myTimeout=setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);

}
       });




}



    </script>
@endsection