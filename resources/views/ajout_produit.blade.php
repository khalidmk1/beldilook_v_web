@extends('navbar')
@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css"  />
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
<style>

.image_area {
		  position: relative;
		}

		


		.preview {
  			overflow: hidden;
  			width: 160px; 
  			height: 160px;
  			margin: 10px;
  			border: 1px solid red;
		}

		.modal-lg{
  			max-width: 1000px !important;
		}

		.overlay {
		  position: absolute;
		  bottom: 10px;
		  left: 0;
		  right: 0;
		  background-color: rgba(255, 255, 255, 0.5);
		  overflow: hidden;
		  height: 0;
		  transition: .5s ease;
		  width: 100%;
		}

		.image_area:hover .overlay {
		  height: 50%;
		  cursor: pointer;
		}

		.text {
		  color: #333;
		  font-size: 20px;
		  position: absolute;
		  top: 50%;
		  left: 50%;
		  -webkit-transform: translate(-50%, -50%);
		  -ms-transform: translate(-50%, -50%);
		  transform: translate(-50%, -50%);
		  text-align: center;
		}


  div.scrollmenu {
    overflow: auto;
    white-space: nowrap;
    
  }
  
  div.scrollmenu div {
    display: inline-block;
    color: rgba(0, 0, 0);
  
    padding: 14px;
    text-decoration: none;
  }
  
  .btn_tailles{
    border-radius: 50%;
   
    height: 30px;
  width: 30px;
    display: inline-block;
  margin-left: 20px;
  cursor: pointer;
  text-align: center;
  }
 .colors{
  height: 25px;
  width: 25px;
  border-radius: 50%;
  position: relative;
    top: 8px;
    left: 80px;
 
 }

 .colors2{
  height: 25px;
  width: 25px;
  border-radius: 50%;
  margin-left: 22px;
  display: inline-block;
  border:1px solid black;
  cursor: pointer;
 }

 .colors3{
  height: 25px;
  width: 25px;
  border-radius: 50%;
  margin-left: 6px;
  display: inline-block;
  border:1px solid black;
  cursor: pointer;
 }
 .selected_taille{
  background-color: #B09636;
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

  </style>

{{ csrf_field() }}


<div class="modal fade" id="modal_crop" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
      
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div style="margin: 0px">
              <div class="row d-flex justify-content-center">
                  <div class="col-md-12 p-0" style="max-width: 80%">
                      <img src="" id="sample_image" />
                  </div>
                  <div class="col-md-0 ">
                      <div class="preview5 d-flex justify-content-center" style="display: none"></div>
                  </div>
              </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" id="crop" class="btn btn-primary">Crop</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
    </div>
  </div>
</div>	

<div class="modal" id="modal_terme" tabindex="-1" role="dialog" data-backdrop="static">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">{{__('ajout_produit.titre_terme')}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

      </div>
      <div class="modal-body">
        <div style="text-align:center">
       
        <p>{{$text_terme}}</p>
          
        </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick=" accept_terme()">Accepter</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Refuser</button>
      </div>
    </div>
  </div>
</div>


<div class="modal" id="modal_succes" tabindex="-1" role="dialog" data-backdrop="static">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
       
        <button type="button" class="close" onclick="window.location='{{route('home')}}'" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

      </div>
      <div class="modal-body">
        <div style="text-align:center">
        <img src="{{asset('storage/check3.png') }}" alt="" height="150px" width="150px">
        <br>
        <br>
        <strong>{{__('ajout_produit.message_succes')}}</strong>
          
        </div>
        
      </div>
     
    </div>
  </div>
</div>





<div class="modal" id="modal_loading" tabindex="-1" role="dialog" data-backdrop="static">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content" style="background-color: transparent;border:transparent">
      
      <div class="modal-body">
        <div style="align-items: center;position:relative">

          <div class="loader"></div>
        </div>
        
      </div>
     
    </div>
  </div>
</div>






<div id="modal_colors" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" >Sélectionner votre couleur </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

<div style="text-align: center">

        <img class="image_obligatoire" src="{{ asset('storage/gold_color.jpg') }}" height="30px" width="30px" alt="" style="border-radius: 50%;cursor: pointer;" onclick="select_color2('#FFD700')"><p style="margin-left: 5px;display:inline-block;"> Dorée </p>           <img src="{{ asset('storage/silver_color.jpg') }}" class="image_obligatoire" height="30px" width="30px" alt="" style="border-radius: 50%;cursor: pointer;" onclick="select_color2('#C0C0C0')"><p style="margin-left: 5px;display:inline-block;"> Argentée </p> <br>
        
        <div class="colors3" style="background-color: #808000" onclick="select_color2('#808000')"></div>
<div class="colors3" style="background-color: #C0C000" onclick="select_color2('#C0C000')"></div>
<div class="colors3" style="background-color: #E6E600" onclick="select_color2('#E6E600')"></div>
<div class="colors3" style="background-color: #E1FF00" onclick="select_color2('#E1FF00')"></div>
<div class="colors3" style="background-color: #E4F37E" onclick="select_color2('#E4F37E')"></div>
<div class="colors3" style="background-color: #F3F1B4" onclick="select_color2('#F3F1B4')"></div>
<div class="colors3" style="background-color: #FAFECD" onclick="select_color2('#FAFECD')"></div>

<br>

<div class="colors3" style="background-color: #4F7800" onclick="select_color2('#4F7800')"></div>
<div class="colors3" style="background-color: #6DA600" onclick="select_color2('#6DA600')"></div>
<div class="colors3" style="background-color: #008000" onclick="select_color2('#008000')"></div>
<div class="colors3" style="background-color: #00C000" onclick="select_color2('#00C000')"></div>
<div class="colors3" style="background-color: #00FF00" onclick="select_color2('#00FF00')"></div>
<div class="colors3" style="background-color: #99FF99" onclick="select_color2('#99FF99')"></div>
<div class="colors3" style="background-color: #C1FECA" onclick="select_color2('#C1FECA')"></div>

<br>

<div class="colors3" style="background-color: #000080" onclick="select_color2('#000080')"></div>
<div class="colors3" style="background-color: #0000C0" onclick="select_color2('#0000C0')"></div>
<div class="colors3" style="background-color: #0000FF" onclick="select_color2('#0000FF')"></div>
<div class="colors3" style="background-color: #004FA0" onclick="select_color2('#004FA0')"></div>
<div class="colors3" style="background-color: #0080FF" onclick="select_color2('#0080FF')"></div>
<div class="colors3" style="background-color: #81BFFF" onclick="select_color2('#81BFFF')"></div>
<div class="colors3" style="background-color: #B7EEFE" onclick="select_color2('#B7EEFE')"></div>

<br>

<div class="colors3" style="background-color: #800080" onclick="select_color2('#800080')"></div>
<div class="colors3" style="background-color: #8000FF" onclick="select_color2('#8000FF')"></div>
<div class="colors3" style="background-color: #A800FF" onclick="select_color2('#A800FF')"></div>
<div class="colors3" style="background-color: #C000C0" onclick="select_color2('#C000C0')"></div>
<div class="colors3" style="background-color: #FF00FF" onclick="select_color2('#FF00FF')"></div>
<div class="colors3" style="background-color: #C040FF" onclick="select_color2('#C040FF')"></div>
<div class="colors3" style="background-color: #FF99FF" onclick="select_color2('#FF99FF')"></div>

<br>

<div class="colors3" style="background-color: #000000" onclick="select_color2('#000000')"></div>
<div class="colors3" style="background-color: #303030" onclick="select_color2('#303030')"></div>
<div class="colors3" style="background-color: #505050" onclick="select_color2('#505050')"></div>
<div class="colors3" style="background-color: #808080" onclick="select_color2('#808080')"></div>
<div class="colors3" style="background-color: #C0C0C0" onclick="select_color2('#C0C0C0')"></div>
<div class="colors3" style="background-color: #E0E0E0" onclick="select_color2('#E0E0E0')"></div>
<div class="colors3" style="background-color: #FFFFFF" onclick="select_color2('#FFFFFF')"></div>

<br>

<div class="colors3" style="background-color: #800000" onclick="select_color2('#800000')"></div>
<div class="colors3" style="background-color: #C00000" onclick="select_color2('#C00000')"></div>
<div class="colors3" style="background-color: #FF0000" onclick="select_color2('#FF0000')"></div>
<div class="colors3" style="background-color: #D74F00" onclick="select_color2('#D74F00')"></div>
<div class="colors3" style="background-color: #FF8000" onclick="select_color2('#FF8000')"></div>
<div class="colors3" style="background-color: #FFC040" onclick="select_color2('#FFC040')"></div>
<div class="colors3" style="background-color: #FFC080" onclick="select_color2('#FFC080')"></div>

</div>
      </div>
      
    </div>
  </div>
</div>





@if(App::getlocale()=="ar")
<h1  style="padding: 20px;color:#263066;text-align:end">{{__('ajout_produit.ajouter_produit')}}</h1>
@else
<h1  style="padding: 20px;color:#263066;text-align:start">{{__('ajout_produit.ajouter_produit')}}</h1>
@endif


<div class="mb-3 mt-3 ml-3 mr-3" @if(App::getlocale()=="ar") style="text-align: end" @endif>
    @if(App::getlocale()=="ar")
    <label for="name_product"> : {{__('ajout_produit.nom_produit')}}</label>
    @else
    <label for="name_product">{{__('ajout_produit.nom_produit')}} :</label>
    @endif
    
    <input @if(App::getlocale()=="ar") style="text-align: end" @endif type="text" class="form-control " id="name_product" placeholder="" name="name_product" value="">
   
    <div class="invalid-feedback" id="span_name"></div>
    
  </div>


  <div class="mb-3 mt-3 ml-3 mr-3">
    <label for="categorie">{{__('ajout_produit.categorie')}} :</label>
    <select class="form-select form-control" aria-label="Default select example" id="categorie" name="categorie" required>
      <option selected></option>
    @foreach ($categories as $categorie)
  
   <option value="{{$categorie['idcategorie']}}" >{{$categorie['Libelle']}}</option>
  
    @endforeach
    
     
    </select>

  
    <div class="invalid-feedback" id="span_categorie"></div>
    
  </div>



  <div class="mb-3 mt-3 ml-3 mr-3">
    <label for="genre">{{__('ajout_produit.genre')}} :</label>
    <select class="form-select form-control" aria-label="Default select example" id="genre" name="genre" required>
    
   
  
   <option selected>Aucun</option>
  
 <option>Homme</option>
 <option>Femme</option>
 <option>Garçon</option>
 <option>Fille</option>
     
    </select>

  
    <div class="invalid-feedback" id="span_genre"></div>
    
  </div>




  <div class="mb-3 mt-3 ml-3 mr-3">
    <label for="tissue">{{__('ajout_produit.tissue')}} :</label>
    <select class="form-select form-control" aria-label="Default select example" id="tissue" name="tissue" required>
      <option selected></option>
    @foreach ($tissues as $tissue)
  
   <option value="{{$tissue['idtissus']}}" >{{$tissue['Libelle']}}</option>
  
    @endforeach
    
     
    </select>

  
    <div class="invalid-feedback" id="span_tissue"></div>
    
  </div>




  <div class="mb-3 mt-3 ml-3 mr-3">
    <label for="etat_tenue">{{__('ajout_produit.etat_tenue')}} :</label>
    <select class="form-select form-control" aria-label="Default select example" id="etat_tenue" name="etat_tenue" required>
      <option selected></option>
    @foreach ($etats as $etat)
  
   <option value="{{$etat['id']}}" >{{$etat['Libelle']}}</option>
  
    @endforeach
    
     
    </select>

  
    <div class="invalid-feedback" id="span_etat"></div>
    
  </div>

  <div class="mb-3 mt-3 ml-3 mr-3">
  <div @if(App::getlocale()=="ar")  style="text-align: end" @endif><label for="Description">{{__('mes_achats.description')}}</label></div>
  <textarea required class="form-control" id="description"  name="description" rows="12" id="description"></textarea>
  <div class="invalid-feedback" id="span_description"></div>
  </div>





  <div class="mb-3 mt-3 ml-3 mr-3">
    <label for="etat_tenue">{{__('ajout_produit.tag1')}} :</label>
    <select class="form-select form-control" aria-label="Default select example" id="tag1" name="tag1" required>
      <option selected></option>
    @foreach ($tags1 as $tag1)
  
   <option value="{{$tag1['id_tag']}}" >{{$tag1['Libelle']}}</option>
  
    @endforeach
    
     
    </select>

  
    <div class="invalid-feedback" id="span_tag1"></div>
    
  </div>



  <div class="mb-3 mt-3 ml-3 mr-3">
    <label for="etat_tenue">{{__('ajout_produit.tag2')}} :</label>
    <select class="form-select form-control" aria-label="Default select example" id="tag2" name="tag2" required>
      <option selected></option>
    @foreach ($tags2 as $tag2)
  
   <option value="{{$tag2['id_tag']}}" >{{$tag2['Libelle']}}</option>
  
    @endforeach
    
     
    </select>

  
    <div class="invalid-feedback" id="span_tag2"></div>
    
  </div>



  <div class="mb-3 mt-3 ml-3 mr-3">
    <label for="etat_tenue">{{__('ajout_produit.tag3')}} :</label>
    <select class="form-select form-control" aria-label="Default select example" id="tag3" name="tag3" required>
      <option selected></option>
    @foreach ($tags3 as $tag3)
  
   <option value="{{$tag3['id_tag']}}" >{{$tag3['Libelle']}}</option>
  
    @endforeach
    
     
    </select>

  
    <div class="invalid-feedback" id="span_tag3"></div>
    
  </div>

  <div class="mb-3 mt-3 ml-3 mr-3">
    <label for="etat_tenue">{{__('ajout_produit.tag4')}} :</label>
    <select class="form-select form-control" aria-label="Default select example" id="tag4" name="tag4" required>
      <option selected></option>
    @foreach ($tags4 as $tag4)
  
   <option value="{{$tag4['id_tag']}}" >{{$tag4['Libelle']}}</option>
  
    @endforeach
    
     
    </select>

  
    <div class="invalid-feedback" id="span_tag4"></div>
    
  </div>

  <div style="text-align: center">
  <div class="btn_tailles" id="btn_XS" onclick="select_taille('XS')"><div style="font-size: 15px;position: relative;top:3px">XS</div></div>
<div class="btn_tailles selected_taille" id="btn_S" onclick="select_taille('S')"><div style="font-size: 15px;position: relative;top:3px">S</div></div>
<div class="btn_tailles" id="btn_M"  onclick="select_taille('M')"><div style="font-size: 15px;position: relative;top:3px">M</div></div>
<div class="btn_tailles" id="btn_L" onclick="select_taille('L')"><div style="font-size: 15px;position: relative;top:3px">L</div></div>
<div class="btn_tailles" id="btn_XL" onclick="select_taille('XL')"><div style="font-size: 15px;position: relative;top:3px">XL</div></div>
<div class="btn_tailles" id="btn_XXL" onclick="select_taille('XXL')"><div style="font-size: 15px;position: relative;top:3px">XXL</div></div>
<div class="btn_tailles" id="btn_3XL" onclick="select_taille('3XL')"><div style="font-size: 15px;position: relative;top:3px">3XL</div></div>
  </div>
<br>

<br>
<div style="text-align: center">
<div id="select_col" class="colors2" style="background-color: #FFFFFF" onclick="select_color('#FFFFFF')"></div>
<div class="colors2" style="background-color: #E6D0C5" onclick="select_color('#E6D0C5')"></div>
<div class="colors2" style="background-color: #E2E2E2" onclick="select_color('#E2E2E2')"></div>
<div class="colors2" style="background-color: #F0E6CC" onclick="select_color('#F0E6CC')"></div>
<div class="colors2" style="background-color: #DCE6F1" onclick="select_color('#DCE6F1')"></div>
<div class="colors2" style="background-color: #DAE8E3" onclick="select_color('#DAE8E3')"></div>
<div class="colors2" style="background-color: #CDDC39" onclick="select_color('#CDDC39')"></div>
<div class="colors2" style="background-color: #FFEB3B" onclick="select_color('#FFEB3B')"></div>
<div class="colors2" style="background-color: #FF9800" onclick="select_color('#FF9800')"></div>
<div class="colors2" style="background-color: #795548" onclick="select_color('#795548')"></div>
</div>
<br>
<br>
<div style="text-align: center">
<img class="image_obligatoire" src="{{ asset('storage/couleurselectionbl.png') }}" height="40px" width="40px" alt="" style="margin-left: 30px;cursor: pointer;" onclick="open_color()">
</div>
<br>
<div style="text-align:center"><span style="color:red;" id="span_colors"></span></div>
<br>

  <div class="scrollmenu" id="div_taille_XS">
    
 
  </div>

  <div class="scrollmenu" id="div_taille_S">

</div>


<div class="scrollmenu" id="div_taille_M">

</div>

<div class="scrollmenu" id="div_taille_L">

</div>



<div class="scrollmenu" id="div_taille_XL">

</div>

<div class="scrollmenu" id="div_taille_XXL">

</div>
  
<div class="scrollmenu" id="div_taille_3XL">

</div>

<input type="file" name="" id="select_im" style="display: none" accept="image/*" onchange="readURL(this);">
<br>
<br>
<div style="text-align: center" id="div_images">

</div>
<br>
<br>

<div style="text-align: center"><button class="btn btn-primary" onclick="select_image()">Ajouter une image</button></div>
<br>
<div style="text-align:center"><span style="color:red;" id="span_images"></span></div>

<br>
<div style="text-align: center"><button class="btn btn-primary" onclick="validation()">Continuer</button></div>
<br>
<br>
<div id="json_content"></div>
<script>
  
var taille_selected="S";
var image_delete="{{asset('storage/close.png') }}";
var taux="{{$taux['taux']}}";
var index_colors=1;
var acceptation_terme="{{$terme['message']}}";
var $modal = $('#modal_crop');
var image = document.getElementById('sample_image');
var cropper;
function validation(){
  
  
 


  var view_to_scroll="";
  $( "#name_product" ).removeClass( "is-invalid" );
  var name=$("#name_product").val();
  if(name.replace( / +/g, '')=="")
  {
    $( "#name_product" ).addClass( "is-invalid" );
    $('#span_name').html("Le nom est obligatoire");
    view_to_scroll="name_product";
  }


  $( "#categorie" ).removeClass( "is-invalid" );
  var category=$("#categorie").val();
  if(category.replace( / +/g, '')=="")
  {
    $( "#categorie" ).addClass( "is-invalid" );
    $('#span_categorie').html("La catégorie est obligatoire");
    if(view_to_scroll=="")
    {
      view_to_scroll="categorie";
    }
  }

  
  $( "#genre" ).removeClass( "is-invalid" );
  var genre=$("#genre").val();
  if(genre=="Aucun")
  {
    $( "#genre" ).addClass( "is-invalid" );
    $('#span_genre').html("Le genre est obligatoire");
    if(view_to_scroll=="")
    {
      view_to_scroll="genre";
    }
  }
  

  
  $( "#tissue" ).removeClass( "is-invalid" );
  var tissue=$("#tissue").val();
  if(tissue.replace( / +/g, '')=="")
  {
    $( "#tissue" ).addClass( "is-invalid" );
    $('#span_tissue').html("Le tissue est obligatoire");
    if(view_to_scroll=="")
    {
      view_to_scroll="tissue";
    }
  }

  
  $( "#etat_tenue" ).removeClass( "is-invalid" );
  var etat_tenue=$("#etat_tenue").val();
  if(etat_tenue.replace( / +/g, '')=="")
  {
    $( "#etat_tenue" ).addClass( "is-invalid" );
    $('#span_etat').html("L'état est obligatoire");
    if(view_to_scroll=="")
    {
      view_to_scroll="etat_tenue";
    }
  }


  $( "#description" ).removeClass( "is-invalid" );
  var description=$("#description").val();
  if(description.replace( / +/g, '')=="")
  {
    $( "#description" ).addClass( "is-invalid" );
    $('#span_description').html("La description est obligatoire");
    if(view_to_scroll=="")
    {
      view_to_scroll="description";
    }
  }

 
 
//alert(desc_position.top);

tabimgs = document.getElementsByClassName("images_cl");

if(tabimgs.length==0)
{
  $('#span_images').html("Veuillez ajouter une photo");
  if(view_to_scroll=="")
    {
      view_to_scroll="div_images";
    }
 
}else{
  $('#span_images').html("");
}


tabcolorsXS = document.getElementsByClassName("colors_XS");
 
tabcolorsS = document.getElementsByClassName("colors_S");

tabcolorsM = document.getElementsByClassName("colors_M");

tabcolorsL = document.getElementsByClassName("colors_L");

tabcolorsXL = document.getElementsByClassName("colors_XL");

tabcolorsXXL = document.getElementsByClassName("colors_XXL");

tabcolors3XL = document.getElementsByClassName("colors_3XL");

if(tabcolors3XL.length==0 && tabcolorsXXL.length==0 && tabcolorsXL.length==0 && tabcolorsL.length==0 && tabcolorsM.length==0 && tabcolorsS.length==0 && tabcolorsXS.length==0)
{
  $('#span_colors').html("Les couleurs sont obligatoire");
  
  if(view_to_scroll=="")
    {
      view_to_scroll="select_col";
    }
}else{

  $('#span_colors').html("");

  tabqteXS = document.getElementsByClassName("qte_XS");
 
 tabqteS = document.getElementsByClassName("qte_S");
 
 tabqteM = document.getElementsByClassName("qte_M");
 
 tabqteL = document.getElementsByClassName("qte_L");
 
 tabqteXL = document.getElementsByClassName("qte_XL");
 
 tabqteXXL = document.getElementsByClassName("qte_XXL");
 
 tabqte3XL = document.getElementsByClassName("qte_3XL");



 tabprixXS = document.getElementsByClassName("prix_XS");
 
 tabprixS = document.getElementsByClassName("prix_S");
 
 tabprixM = document.getElementsByClassName("prix_M");
 
 tabprixL = document.getElementsByClassName("prix_L");
 
 tabprixXL = document.getElementsByClassName("prix_XL");
 
 tabprixXXL = document.getElementsByClassName("prix_XXL");
 
 tabprix3XL = document.getElementsByClassName("prix_3XL");

 var bool_qte_prix=false;

 for (i = 0; i < tabqteXS.length; i++) {
  if(tabqteXS[i].value==0 || tabprixXS[i].value==0)
  {
    bool_qte_prix=true;
  }
    }

    for (i = 0; i < tabqteS.length; i++) {
  if(tabqteS[i].value==0 || tabprixS[i].value==0)
  {
    bool_qte_prix=true;
  }
    }

    for (i = 0; i < tabqteM.length; i++) {
  if(tabqteM[i].value==0 || tabprixM[i].value==0)
  {
    bool_qte_prix=true;
  }
    }

    for (i = 0; i < tabqteL.length; i++) {
  if(tabqteL[i].value==0 || tabprixL[i].value==0)
  {
    bool_qte_prix=true;
  }
    }

    for (i = 0; i < tabqteXL.length; i++) {
  if(tabqteXL[i].value==0 || tabprixXL[i].value==0)
  {
    bool_qte_prix=true;
  }
    }

    for (i = 0; i < tabqteXXL.length; i++) {
  if(tabqteXXL[i].value==0 || tabprixXXL[i].value==0)
  {
    bool_qte_prix=true;
  }
    }

    for (i = 0; i < tabqte3XL.length; i++) {
  if(tabqte3XL[i].value==0 || tabprix3XL[i].value==0)
  {
    bool_qte_prix=true;
  }
    }


if(bool_qte_prix==true)
{
  $('#span_colors').html("Veuillez remplir la quantité et le prix de tous les produits");
}
 
}


if(view_to_scroll!="")
{
  document.getElementById(view_to_scroll).scrollIntoView();
  var d=window.scrollY-100;
  window.scrollTo(0, d);
  return
}else{
  if(bool_qte_prix==true)
{
return
}
}



var obj= {};
var tab_XS=[];
var tab_S=[];
var tab_M=[];
var tab_L=[];
var tab_XL=[];
var tab_XXL=[];
var tab_3XL=[];

obj.nom_produit=$("#name_product").val();

obj.category=$("#categorie").val();

obj.genre=$("#genre").val();

obj.tissue=$("#tissue").val();

obj.etat_tenue=$("#etat_tenue").val();

obj.description=$("#description").val();

obj.tag1=$("#tag1").val();

obj.tag2=$("#tag2").val();

obj.tag3=$("#tag3").val();

obj.tag4=$("#tag4").val();

tabimgs = document.getElementsByClassName("images_cl");

obj.image1="";
obj.image2="";
obj.image3="";
obj.image4="";
obj.image5="";

for (i = 0; i < tabimgs.length; i++) {
 if(i==0){
  obj.image1=tabimgs[i].src;
 }
 if(i==1){
  obj.image2=tabimgs[i].src;
 }
 if(i==2){
  obj.image3=tabimgs[i].src;
 }
 if(i==3){
  obj.image4=tabimgs[i].src;
 }
 if(i==4){
  obj.image5=tabimgs[i].src;
 }
    }
    // XS
    tabcolorsXS = document.getElementsByClassName("colors_XS");
 
    tabprixXS = document.getElementsByClassName("prix_XS");
 
    tabqteXS = document.getElementsByClassName("qte_XS");

    for (i = 0; i < tabqteXS.length; i++) {
       tab_XS[i]=[tabprixXS[i].value,tabcolorsXS[i].getAttribute("donn"),tabqteXS[i].value];
    }
obj.XS=tab_XS;
    // S
    tabcolorsS = document.getElementsByClassName("colors_S");
 
    tabprixS = document.getElementsByClassName("prix_S");
 
    tabqteS = document.getElementsByClassName("qte_S");

    for (i = 0; i < tabqteS.length; i++) {
      tab_S[i]=[tabprixS[i].value,tabcolorsS[i].getAttribute("donn"),tabqteS[i].value];
    }
    obj.S=tab_S;
// M
    tabcolorsM = document.getElementsByClassName("colors_M");
 
    tabprixM = document.getElementsByClassName("prix_M");

    tabqteM = document.getElementsByClassName("qte_M");

 for (i = 0; i < tabqteM.length; i++) {
  tab_M[i]=[tabprixM[i].value,tabcolorsM[i].getAttribute("donn"),tabqteM[i].value];
 }
 obj.M=tab_M;
// L
 tabcolorsL = document.getElementsByClassName("colors_L");
 
 tabprixL = document.getElementsByClassName("prix_L");

 tabqteL = document.getElementsByClassName("qte_L");

for (i = 0; i < tabqteL.length; i++) {
  tab_L[i]=[tabprixL[i].value,tabcolorsL[i].getAttribute("donn"),tabqteL[i].value];
}
obj.L=tab_L;
// XL
tabcolorsXL = document.getElementsByClassName("colors_XL");
 
 tabprixXL = document.getElementsByClassName("prix_XL");

 tabqteXL = document.getElementsByClassName("qte_XL");

for (i = 0; i < tabqteXL.length; i++) {
  tab_XL[i]=[tabprixXL[i].value,tabcolorsXL[i].getAttribute("donn"),tabqteXL[i].value];
}
obj.XL=tab_XL;
// XXL
tabcolorsXXL = document.getElementsByClassName("colors_XXL");
 
 tabprixXXL = document.getElementsByClassName("prix_XXL");

 tabqteXXL = document.getElementsByClassName("qte_XXL");

for (i = 0; i < tabqteXXL.length; i++) {
  tab_XXL[i]=[tabprixXXL[i].value,tabcolorsXXL[i].getAttribute("donn"),tabqteXXL[i].value];
}
obj.XXL=tab_XXL;
// 3XL
tabcolors3XL = document.getElementsByClassName("colors_3XL");
 
 tabprix3XL = document.getElementsByClassName("prix_3XL");

 tabqte3XL = document.getElementsByClassName("qte_3XL");

for (i = 0; i < tabqte3XL.length; i++) {
  tab_3XL[i]=[tabprix3XL[i].value,tabcolors3XL[i].getAttribute("donn"),tabqte3XL[i].value];
}
obj.XXXL=tab_3XL;




  var js=JSON.stringify(obj);

  
  $('#modal_loading').modal('show');
          
           var _token=$('input[name="_token"]').val();
           $.ajax({
       url:("{{route('ajouter_produit_api')}}"),
       method:"POST",
       data:{data:js,
       _token:_token
       },
       success:function(data)
       {
        $('#modal_loading').modal('hide');
        if(data=='ok'){
          $('#modal_succes').modal('show');
        }else{
          
          alert("{{__('favoris.erreur')}}");
        }
   
       }
       ,error:function(error)
{
  $('#modal_loading').modal('hide');
  
alert("{{__('favoris.erreur')}}");

}
       });
        







}
function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
      tabimgs = document.getElementsByClassName("images_cl");

      if(tabimgs.length==5)
      {
         alert("{{__('ajout_produit.max_cinque_images')}}");
         return
      }
      

     

      var im=e.target.result;

     


      tabimgs = document.getElementsByClassName("images_cl");


      //for (i = 0; i < tabimgs.length; i++) {
        //alert(tabimgs[i].src);
      //}
      image.src = im;
      
			$modal.modal('show');
    };
    reader.readAsDataURL(input.files[0]);
   
  }
}


function select_image()
{if(acceptation_terme=="non")
{
  $('#modal_terme').modal('show');
}else{
  $('#select_im').click();
}

 
}
function accept_terme(){
  acceptation_terme="oui";
 
  $('#modal_terme').modal('hide');
  $('#select_im').click();

  var _token=$('input[name="_token"]').val();
           $.ajax({
       url:("{{route('api_accepte_terme')}}"),
       method:"POST",
       data:{
        _token:_token
       },
       success:function(data)
       {
     
   
       }
       ,error:function(error)
{


}
       });
  
}

function select_color(v)
{
 
  tabcolors = document.getElementsByClassName("colors_"+taille_selected);
 

    for (i = 0; i < tabcolors.length; i++) {
   if(tabcolors[i].getAttribute("donn")==v)
   {
    alert("{{__('ajout_produit.couleur_existe')}}");
    return
   }
    } 


 var content_div=$('#div_taille_'+taille_selected).html();
 content_div+=' <div >';
  content_div+=' Couleur : <div class="colors colors_'+taille_selected+'" style="background-color: '+v+'" donn="'+v+'"><img src="'+image_delete+'" height="20px" width="20px" alt="" style="position: absolute;right:-10px;top:-10px;" onclick=" this.parentNode.parentNode.parentNode.removeChild(this.parentNode.parentNode);"></div> <br> <br>';
  content_div+='Quantité : <input id="qte_'+index_colors+'" class="qte_'+taille_selected+'" type="number"  value="0" onchange="format_qte(this,'+index_colors+')"> <br>';
  content_div+='Prix : <input id="prix_'+index_colors+'" class="prix_'+taille_selected+'" style="margin-top: 10px;margin-left:36px" type="number" id="test2" value="0.00" onchange="format_prix(this,'+index_colors+')"> DH';
  content_div+='<br><p style="padding-top:10px;margin-bottom:0px;" id="tc'+index_colors+'">Comission : 0 DH</p>';
  content_div+='<p style="padding-top:10px;" id="np'+index_colors+'">Nouveau prix : 0 DH</p>';
  content_div+='</div>';
  $('#div_taille_'+taille_selected).html(content_div);
  index_colors++;
}


function select_color2(v)
{
 
  tabcolors = document.getElementsByClassName("colors_"+taille_selected);
 

    for (i = 0; i < tabcolors.length; i++) {
   if(tabcolors[i].getAttribute("donn")==v)
   {
    alert("Couleur existe déjà");
    return
   }
    } 
  
 var content_div=$('#div_taille_'+taille_selected).html();
 content_div+=' <div >';
  content_div+=' Couleur : <div class="colors colors_'+taille_selected+'" style="background-color: '+v+'" donn="'+v+'"><img src="'+image_delete+'" height="20px" width="20px" alt="" style="position: absolute;right:-10px;top:-10px;" onclick=" this.parentNode.parentNode.parentNode.removeChild(this.parentNode.parentNode);"></div> <br> <br>';
  content_div+='Quantité : <input id="qte_'+index_colors+'" class="qte_'+taille_selected+'" type="number"  value="0" onchange="format_qte(this,'+index_colors+')"> <br>';
  content_div+='Prix : <input id="prix_'+index_colors+'" class="prix_'+taille_selected+'" style="margin-top: 10px;margin-left:36px" type="number" id="test2" value="0.00" onchange="format_prix(this,'+index_colors+')"> DH';
  content_div+='<br><p style="padding-top:10px;margin-bottom:0px;" id="tc'+index_colors+'">Comission : 0 DH</p>';
  content_div+='<p style="padding-top:10px;" id="np'+index_colors+'">Nouveau prix : 0 DH</p>';

  content_div+='</div>';
  $('#div_taille_'+taille_selected).html(content_div);
  index_colors++;
  $('#modal_colors').modal('hide');
}

function open_color(){
  $('#modal_colors').modal('show');
}


function select_taille(taille)
{
 

  tabbtns = document.getElementsByClassName("btn_tailles");
    for (i = 0; i < tabbtns.length; i++) {
      tabbtns[i].classList.remove("selected_taille");
    }

    var d_select=document.getElementById("btn_"+taille);
  d_select.classList.add("selected_taille");

  tablinks = document.getElementsByClassName("scrollmenu");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].style.display = 'none';
    }
    var d=document.getElementById("div_taille_"+taille);
    d.style.display = 'block';

  taille_selected=taille;


  tabcolors = document.getElementsByClassName("colors_xs");
  tab_qte = document.getElementsByClassName("qte_XS");


}



function format_prix(v,index)
{
  var num=Number(v.value);

	var d						= (Number(num)*(taux/100));
	 var d2						= Number(num)+(Number(num)*(taux/100));

    //d=d.toFixed(2);
 d=d.toLocaleString(undefined, {minimumFractionDigits: 2});

 //d2=d2.toFixed(2);

 d2=d2.toLocaleString(undefined, {minimumFractionDigits: 2});

$('#tc'+index).html("Comission : "+d+" DH");
$('#np'+index).html("Nouveau prix : "+d2+" DH");

  var num=num.toFixed(2);
var num=num.toLocaleString();
v.value=num;
v.setAttribute("value", num);
}

function format_qte(v,index)
{
  var num=Number(v.value);
  var num=num.toFixed(0);

v.value=num;
v.setAttribute("value", num);
}

$modal.on('shown.bs.modal', function() {
		cropper = new Cropper(image, {
			aspectRatio: 11/9,
			viewMode: 2,
			preview:'.preview'
		});
	}).on('hidden.bs.modal', function(){
		cropper.destroy();
   		cropper = null;
	});

	$('#crop').click(function(){
		canvas = cropper.getCroppedCanvas({
      width:1000,
			height:818.18
		});

		canvas.toBlob(function(blob){
			url = URL.createObjectURL(blob);
			var reader = new FileReader();
			reader.readAsDataURL(blob);
			reader.onloadend = function(){
				var base64data = reader.result;
				//image2.src = base64data;
                $modal.modal('hide');


                var content_div=$('#div_images').html();


content_div+='<div style="display: inline-block">';
  content_div+='<img src="'+base64data+'" alt="" class="images_cl image_obligatoire" height="150px" width="150px"  style="padding-left:10px;object-fit:contain;" ><img src={{ asset('storage/close.png') }} height="20px" width="20px" alt="" style="position: relative;right:0px;top:-70px;" class="image_obligatoire" onclick=" this.parentNode.parentNode.removeChild(this.parentNode);">';
  content_div+='</div>';

      $('#div_images').html(content_div);


			};
		});
	});
</script>

@endsection


