@extends('navbar')
@section('content')
<link rel="stylesheet" type="text/css" href="{{ url('/css/style.css') }}" />

<link rel="stylesheet" type="text/css" href="{{ url('/css/filter.css') }}" />
<style>
      .desc{
    position: absolute;
margin-left: auto;
margin-right: auto;
left: 0;
right: 0;
text-align: center;
top:150px;
color: white;
font-size: 20px;

width:400px;
  }
  div.scrollmenu {
    overflow: auto;
    white-space: nowrap;
    padding: 20px 20px 20px 20px;
    background-color: #F9F9F9;
  }
  .selected{
    border: #212951 1px solid;
    background-color: #212951;
    color: white;
    padding: 10px;
    border-radius: 10px;
    min-width: 50px;
    
  }
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
    .btn_sort:hover{
        background-color: #b1a8a8;
        border: 1px solid #000000;
    }
    .btn_sort{
        background-color: #ffffff;
        border: 1px solid #000000;
        width: 80px;
        font-size: 17px;
        width: 100px;
        color: #000000;
        height: 40px;
        border-radius: 30px;
    }
    .btn_ajouter:hover{
        background-color: #283991;
        border: #283991;
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



 <!-- Modal filtre -->
 <div class="modal" id="filter_modal" data-backdrop="static"  data-bs-keyboard="false" tabindex="-1"
 aria-labelledby="staticBackdropLabel" aria-hidden="true">
 <div class="modal-dialog">
     <div class="modal-content">
         <div class="modal-header">
             <h1 class="modal-title fs-5" id="staticBackdropLabel">{{__('filtre.filtres')}}</h1>
             <button onclick="close_filter()" type="button" class="close" aria-label="Close">
               <span aria-hidden="true">&times;</span>
             </button>
         </div>
         <div class="modal-body">

             <div class="row justify-content-center">
                 <div class="title col-12">{{__('filtre.prix_minimum')}}</div>
                 <input class="progress_input slider  p-0 " id="myRange_minimum" type="range" value="0" min="0" max="30000" />
                 <p class="col-12 RadialProgress radian pr-2"  style="position: relative; top: 11px;"> <span id="pix_minimum"></span> </p>

             </div>
             <div class="row justify-content-center">
                 <div class="title col-12">{{__('filtre.prix_maximum')}}</div>
                 <div class="slidecontainer text-center p-0">
                   <input type="range" min="0" max="30000" value="0" class="slider col-12 p-0 " id="myRange"> 
                   <p class="col-12 RadialProgress radian m-0 " style=" position: relative;
                   top: 11px;
                   right: -3px;"> <span id="demo"></span> </p>
                 </div>
                
             </div>




             
             <div class="container containe mt-5">

                 <div class="title">{{__('filtre.tailles')}}</div>

                 <div class="scrollable-tabs-container-tailles container" id="scrollable-tabs-container-tailles" style="height: 42px;">
                    
                     <ul class="tailles_responsive" >

                         <li  >
                           <a  class="shadow-sm class_tailles" style="padding-left: 16px;
                           padding-top: 15px;cursor: pointer;" donn="XS" >XS</a>
                         </li>
                 
                         <li>
                           <a  class="shadow-sm class_tailles" style="padding-top: 13px;
                           padding-left: 21px;cursor: pointer;" donn="S" >S</a>
                         </li>
                 
                         <li>
                           <a  class="shadow-sm class_tailles" style="padding-top: 13px;
                           padding-left: 18px;cursor: pointer;" donn="M" >M</a>
                         </li>
                 
                         <li>
                           <a  class="shadow-sm class_tailles" style="    padding-top: 13px;
                           padding-left: 20px;cursor: pointer;" donn="L" >L</a>
                         </li>
                 
                         <li>
                           <a  class="shadow-sm class_tailles" style="padding-top: 13px;
                           padding-left: 17px;cursor: pointer;" donn="XL" >XL</a>
                         </li>
                 
                         <li>
                           <a  class="shadow-sm class_tailles" style="padding-top: 13px;
                           padding-left: 12px;cursor: pointer;" donn="XXL" >XXL</a>
                         </li>
                 
                         <li>
                           <a  class="shadow-sm class_tailles" style="padding-top: 15px;
                           padding-left: 13px;cursor: pointer;" donn="3XL" >3XL</a>
                         </li>
               
                       </ul>

                    
                 </div>

             </div>







             <div class="container containe mt-5">

                 <div class="title">{{__('filtre.couleurs')}}</div>

                 <div class="scrollable-tabs-container container">
                     <div class="left-arrow d-none">
                         <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                             stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                             <path stroke-linecap="round" stroke-linejoin="round"
                                 d="M15.75 19.5L8.25 12l7.5-7.5" />
                         </svg>
                     </div>

                     <ul class="mt-1" style="height: 73px;">
@foreach ($colors as $color)
<li donn="{{$color}}" class="class_colors">
   <a  style="background-color: {{$color}};cursor: pointer;" class="shadow-sm p-3 mb-5" donn="{{$color}}" ></a>
 </li>
@endforeach
                       
                 
                         
                 
                       
               
                       </ul>

                     <div class="right-arrow active d-none">
                         <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                             stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                             <path stroke-linecap="round" stroke-linejoin="round"
                                 d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                         </svg>
                     </div>
                 </div>

             </div>


             <div class="row">
                 <div class="col text-start" style="font-weight: 500;
                 font-size: max(23px, 0.4rem);">{{__('filtre.categories')}}</div>
                 <div onclick="tout_selectionner_categories(this)" class="col cursor_link" style="text-align: end;" id="select_all">{{__('filtre.tout_selectionner')}}</div>
             </div>


             <div id="container-categorie" class="container-categorie h-50">
               <ul class=" p-0 mt-1 " id="Categories">
@foreach ($categories as $categorie)
<li class="col-12  li_align " >
   <a class="link_a" style="cursor: pointer;" donn="{{$categorie['idcategorie']}}">{{$categorie['Libelle']}}</a>
 </li>
 <hr class="m-0">
@endforeach
                 
                
        
               </ul>
             </div>

            <!--  etat tenue -->

             <div class="row mt-5">
                 <div class="col text-start" style="font-weight: 500;
                 font-size: max(23px, 0.4rem);">{{__('filtre.etat_tenue')}}</div>
                 <div onclick="tout_selectionner_etat(this)" class="col cursor_link"  style="text-align: end;" id="select_all">{{__('filtre.tout_selectionner')}}</div>
             </div>


             <div id="container-categorie" class="container-categorie h-50">
               <ul class=" p-0 " id="etat">
                   @foreach ($etats_tenues as $etats_tenue)
                 <li class="col-12  li_align " >
                   <a class="link_a" style="cursor: pointer;" donn="{{$etats_tenue['id']}}">{{$etats_tenue['Libelle']}}</a>
                  
                 </li>

                 <hr class="m-0">
                 @endforeach

                
                   
        
               </ul>
             </div>


         </div>
         <div class="modal-footer justify-content-center">
             <button type="button" class="btn btn-clear text-black bg-light  " onclick="effacer_filtre()">Effacer</button>
             <button type="button" onclick="valider_filtre('filtre')"  class="btn btn-submit">Appliquer</button>
         </div>
     </div>
 </div>
</div>


















<div class="col"  id="snackbar">Some text some message..</div>
<div style="position: relative;">
<img style="object-fit: cover;"  src="{{ $details['image_type'] }} " height="300px" width="100%" alt="">
<strong class="desc" >{{ $details['Libelle'] }}</strong>
</div>
<div class="row" style="margin-right: 0px">

    <div class="col">
        <h3 id="titre_id" style="padding: 20px 20px 5px 20px;color:#263066;">{{ $details['Libelle'] }}</h3>
    </div>
    <div class="col" style="text-align: end;margin:auto;margin-right:15px">
        <img src="{{asset('storage/parambl.png')}}" alt="" height="30px" width="30px" style="cursor: pointer " onclick="open_filter()">
    </div>
</div>
@if($details['nbr_articles']=='1')
<div id="div_nb_article" style="padding-left: 20px">{{$details['nbr_articles'].' '.__('produit_collection.article')}}</div>
@else
<div id="div_nb_article" style="padding-left: 20px">{{$details['nbr_articles'].' '.__('produit_collection.articles')}}</div>
@endif
@php
    $sous_categories=$details['tab_sous_categorie'];
@endphp
<div class="scrollmenu" style="margin: 20px 20px 20px 20px;">
    <div class="catgs selected" onclick="select_tag(this,'0')" style="display: inline-block;margin-right:20px;cursor:pointer;min-width: 50px;padding: 10px;">
      {{__('filtre.tout_afficher')}}
        </div>
@foreach ($sous_categories as $sous_categorie)
    <div class="catgs" onclick="select_tag(this,'{{$sous_categorie['id_sous_categorie']}}')" style="display: inline-block;margin-right:20px;cursor:pointer; min-width: 50px;padding: 10px;">
    {{$sous_categorie['libelle']}}
    </div>
@endforeach
</div>


@php
    $articles=$details['tab_articles'];
@endphp


<div  class="container items">
    <div id="div_articles" class="row">
       
        @forelse ($articles as $article)

        <div class="col  width_card col-lg-3 col-md-4 col-sm-6 col-6 p-1 d-flex justify-content-center">
                
                   
                
          <div class="card card_content border-0">

          
            
              <a href="{{route('details_produit',$article['idarticles'])}}">
                  <img src="{{ $article['photo1']}}" class="card-img-top img_product img-fluid"  alt="product_card" >
              </a>

              @if ($article['favoris5']==1)
             <img id="art{{$article['idarticles']}}" onclick="favoris({{$article['idarticles']}},this.id)" class="topright pointer" height="30" width="30" src={{ asset('storage/likeplein.png') }}  alt="">
              @else
             <img id="art{{$article['idarticles']}}"  onclick="favoris({{$article['idarticles']}},this.id)" class="topright pointer" height="30" width="30" src={{ asset('storage/likevide_1.png') }} alt="">
              @endif
             

                  @if ($article['nouveau']==1)
                  <span class="badge  bottomleft" >{{__('home.nouveau')}}</span>
                  @endif

                  @if ($article['rupture_stock']!='no')
                  <span class="badge bg-danger bottomright" >{{__('home.rupture_stock')}}</span>

                  @endif

              
            

            <div class="card-body p-2 ">
              <h5 class="card-title mb-1 " >{{$article['libellé']}}</h5>
              <p style="font-size: 14px" class="card-text mb-1"> {{__('boutique_une.etat')}} : {{$article['etat_tenu']}} </p>
              <p style="font-size: 14px" class="card-text mb-1">{{$article['prix']." DH"}}</p>
              <p class="mb-1"> <a href="{{route('boutiqua',$article['id_vendeur'])}}">{{$article['nom_vendeur']}}</a></p>
            </div>
          </div>
        </div>

{{-- 
    <div class="col-lg-3 col-md-4 col-sm-6 col-6" style="padding-bottom: 20px;display:flex;justify-content:center;align-items:center">
    
        <div class="card card2" >
            <div class="imgprod">
                <a href="{{route('details_produit',$article['idarticles'])}}">
                    <img class="card-img-top" src={{ $article['photo1']}} alt="Card image cap" height="200" width="200" style="border-radius: 8px;object-fit: contain;">
                </a>
            @if ($article['rupture_stock']!='no')
            <span class="badge bg-danger bottomright" >{{__('home.rupture_stock')}}</span>
            @endif
            @if ($article['nouveau']==1)
            <span class="badge bg-warning bottomleft" >{{__('home.nouveau')}}</span>
            @endif
            @if ($article['favoris5']==1)
            <img id="art{{$article['idarticles']}}" onclick="favoris({{$article['idarticles']}},this.id)" class="topright pointer" height="30" width="30" src={{ asset('storage/likeplein.png') }} alt="">
            @else
            <img id="art{{$article['idarticles']}}"  onclick="favoris({{$article['idarticles']}},this.id)" class="topright pointer" height="30" width="30" src={{ asset('storage/likevide_1.png') }} alt="">
            @endif
        </div>
            <div class="card-body">
              <p style="font-size: 17px" class="card-title text" data-toggle="{{$article['libellé']}}">{{$article['libellé']}} </p>
              <p style="font-size: 14px" class="card-text"> {{__('boutique_une.etat')}} : {{$article['etat_tenu']}} </p>
              <p style="font-size: 14px" class="card-text">{{$article['prix']." DH"}}</p>
              
                <a href="{{route('boutiqua',$article['idutilisateurs'])}}">{{'@'.$article['nom_vendeur']}}</a>
            </div>
          </div>
    
    </div>  --}}
       @empty
<p class="col-12" style="text-align: center;padding-top: 80px;">{{__('home.aucun_produit')}}</p>
       @endforelse

    </div>
 {{--    <div class="col-12"  onclick="afficher_plus()" style="text-align: center" id="afficher_plus">
      <button style="background-color: #6e6e6b70; border: none; border-radius: 50px;
    padding: 11px; height: 42px;width: 227px;">
    {{__('home.afficher_plus')}} 
    <span style="margin-left: 10px">-></span>
  </button>
      </div> --}}

</div>

<div class="mt-5" style="text-align: center;padding-bottom:50px">


  <a onclick="afficher_plus('-')"  class="paginationa" style="cursor: pointer">❮</a>


  <a onclick="afficher_plus('+')"  class="paginationa" style="cursor: pointer">❯</a>


</div>







<script>
     var id_collection='{{$id_collection}}';
     var id_tag_selected=0;
        var pagination=1;
        var min_valider=0;
        var max_valider=0;
        var min=0;
        var max=0;
        var tailles="";
    var tab_tailles = [];
    var colores="";
    var tab_colores = [];
    var categories="";
    var tab_categories = [];
    var etats="";
    var tab_etats = [];
    var myTimeout;
        function favoris(id,art)
        {
            var snack = document.getElementById("snackbar");
            snack.className = snack.className.replace("show", "");
           var _token=$('input[name="_token"]').val();
           $.ajax({
       url:("{{route('change_favoris')}}"),
       method:"POST",
       data:{idarticle:id,
       _token:_token
       
       },
       success:function(data)
       {
       
       
           var x = document.getElementById("snackbar");
       
       // Add the "show" class to DIV
       x.className = "show col";
       
       // After 3 seconds, remove the show class from DIV
       console.log(art);
       $("#snackbar").html(data);
       if(data=="{{__('favoris.like')}}"){
        $("#"+art).attr("src","{{ asset('storage/likeplein.png') }}");
       }else{
        $("#"+art).attr("src","{{ asset('storage/likevide_1.png') }}");
       }
       clearTimeout(myTimeout);
        myTimeout=setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
       }
       ,error:function(error)
{
// error alert message
console.log(error);
}
       });
        }
function select_tag(div_tag,id_tag)
{
  pagination=1;
    $('#modal_loading').modal('show');

    var _token=$('input[name="_token"]').val();
           $.ajax({
       url:("{{route('produit_collection_apî')}}"),
       method:"POST",
       data:{page:pagination,
       _token:_token,
       taille:tailles,
       categorie:categories,
       color:colores,
       etat:etats,
       prix_min:min,
       prix_max:max,
       id_sous_categorie:id_tag,
       id_collection:id_collection
       },
       success:function(data)
       {
        console.log(data);
       if(data!='erreur')
       {
        id_tag_selected=id_tag;
        tab_tags= document.getElementsByClassName("catgs");

for (i = 0; i < tab_tags.length; i++) {
    tab_tags[i].classList.remove("selected");
}
div_tag.classList.add("selected");
        $( "#afficher_plus" ).remove();
        $('#div_articles').html(data);
        if(pagination==1)
        {
            $('#div_nb_article').html($('#nb_articl').val());
        }
        
       }
       $('#modal_loading').modal('hide');
     
       }
       ,error:function(error)
{
// error alert message

$('#modal_loading').modal('hide');


console.log(error);
}
       });



}


var slider = document.getElementById("myRange");
var output = document.getElementById("demo");
output.innerHTML = slider.value + " " +'DH'; // Display the default slider value

// Update the current slider value (each time you drag the slider handle)
slider.oninput = function () {
  const value = `${this.value} DH`
  output.innerHTML = value;
  max=this.value;
}


/* first slide progress */

var input_minimum = document.getElementById("myRange_minimum");
var pix_minimum = document.getElementById("pix_minimum");

pix_minimum.innerHTML = input_minimum.value + " " + "DH"

input_minimum.oninput = function () {

  const value = `${this.value} DH`
  pix_minimum.innerHTML = value;
  min=this.value;
}




const tabs = document.querySelectorAll(".scrollable-tabs-container li");

const rightArrow = document.querySelector(
  ".scrollable-tabs-container .right-arrow svg"
);
const leftArrow = document.querySelector(
  ".scrollable-tabs-container .left-arrow svg"
);
const tabsList = document.querySelector(".scrollable-tabs-container ul");

const leftArrowContainer = document.querySelector(
  ".scrollable-tabs-container .left-arrow"
);
const rightArrowContainer = document.querySelector(
  ".scrollable-tabs-container .right-arrow"
);

/* const removeAllActiveClasses = () => {
  tabs.forEach((tab) => {
    tab.classList.remove("active");
  });
}; */

tabs.forEach((tab) => {
  tab.addEventListener("click", () => {
    if (tab.querySelector('img')) {
      tab.removeChild(tab.querySelector('img'));
    } else {
      var img = document.createElement('img');
      img.src = '{{asset('storage/Rectangle_4-removebg-preview.png')}}';
      img.setAttribute("donn", tab.getAttribute("donn"));
      img.className = 'img_link_color col';
      tab.appendChild(img);
    }
  });
});



const manageIcons = () => {
  if (tabsList.scrollLeft >= 20) {
    leftArrowContainer.classList.add("active");
  } else {
    leftArrowContainer.classList.remove("active");
  }

  let maxScrollValue = tabsList.scrollWidth - tabsList.clientWidth - 20;
  console.log("scroll width: ", tabsList.scrollWidth);
  console.log("client width: ", tabsList.clientWidth);

  if (tabsList.scrollLeft >= maxScrollValue) {
    rightArrowContainer.classList.remove("active");
  } else {
    rightArrowContainer.classList.add("active");
  }
};

rightArrow.addEventListener("click", () => {
  tabsList.scrollLeft += 200;
  manageIcons();
});

leftArrow.addEventListener("click", () => {
  tabsList.scrollLeft -= 200;
  manageIcons();
});

tabsList.addEventListener("scroll", manageIcons);

let dragging = false;

const drag = (e) => {
  if (!dragging) return;
  tabsList.classList.add("dragging");
  tabsList.scrollLeft -= e.movementX;
};

tabsList.addEventListener("mousedown", () => {
  dragging = true;
});

tabsList.addEventListener("mousemove", drag);

document.addEventListener("mouseup", () => {
  dragging = false;
  tabsList.classList.remove("dragging");
});






/* categorie */


var listItems = document.querySelectorAll('#Categories li');
var listItems_link = document.querySelectorAll('#Categories li a');

var listItems_link_etat = document.querySelectorAll('#etat li a');
var listItems_etat = document.querySelectorAll('#etat li');

var listItems_taille = document.querySelectorAll('#scrollable-tabs-container-tailles  a');
/* var all = document.getElementById('select_all'); */


listItems.forEach(function (item) {
  item.addEventListener('click', function () {
    if (this.querySelector('img')) {
      this.removeChild(this.querySelector('img'));
    } else {
      var img = document.createElement('img');
      img.src = '{{asset('storage/Rectangle_4-removebg-preview.png')}}';
      img.className = 'img_link col'
      this.appendChild(img);
    }
  });
});


listItems_etat.forEach(function (item) {
  item.addEventListener('click', function () {
    if (this.querySelector('img')) {
      this.removeChild(this.querySelector('img'));
    } else {
      var img = document.createElement('img');
      img.src = '{{asset('storage/Rectangle_4-removebg-preview.png')}}';
      img.className = 'img_link col'
      this.appendChild(img);
    }
  });
});

listItems_link.forEach(function (item) {
  item.addEventListener('click', function () {
    this.classList.toggle('change');
  });
})
listItems_link_etat.forEach(function (item) {
  item.addEventListener('click', function () {
    this.classList.toggle('change_etat');
  });
})

/* taille */

listItems_taille.forEach(function (item) {
  item.addEventListener('click', function () {
    this.classList.toggle('tailles');
  });
})








function open_filter()
{
    
    $('#filter_modal').modal('show');
}


function valider_filtre(type_modal)
{
    pagination=1;
    console.log(min);
    console.log(max);
 tailles="";

    tab_tailles = document.getElementsByClassName("tailles");
    for (i = 0; i < tab_tailles.length; i++) {
         if(i!=tab_tailles.length-1)
         {
            tailles+=tab_tailles[i].getAttribute("donn")+';';
         }else {
            tailles+=tab_tailles[i].getAttribute("donn");
         }
    }
    
    console.log(tailles);

      colores="";

tab_colores = document.getElementsByClassName("img_link_color");
for (i = 0; i < tab_colores.length; i++) {
     if(i!=tab_colores.length-1)
     {
        colores+=tab_colores[i].getAttribute("donn")+';';
     }else {
        colores+=tab_colores[i].getAttribute("donn");
     }
}

console.log(colores); 


 categories="";

tab_categories = document.getElementsByClassName("change");
for (i = 0; i < tab_categories.length; i++) {
     if(i!=tab_categories.length-1)
     {
        categories+=tab_categories[i].getAttribute("donn")+';';
     }else {
        categories+=tab_categories[i].getAttribute("donn");
     }
}

console.log(categories); 


 etats="";

tab_etats = document.getElementsByClassName("change_etat");
for (i = 0; i < tab_etats.length; i++) {
     if(i!=tab_etats.length-1)
     {
        etats+=tab_etats[i].getAttribute("donn")+';';
     }else {
        etats+=tab_etats[i].getAttribute("donn");
     }
}

console.log(etats); 

min_valider=min;
max_valider=max;



  $('#filter_modal').modal('hide');



$('#modal_loading').modal('show');
var _token=$('input[name="_token"]').val();
           $.ajax({
            url:("{{route('produit_collection_apî')}}"),
       method:"POST",
       data:{page:pagination,
       _token:_token,
       taille:tailles,
       categorie:categories,
       color:colores,
       etat:etats,
       prix_min:min,
       prix_max:max,
       id_sous_categorie:id_tag_selected,
       id_collection:id_collection
       },
       success:function(data)
       {
       if(data!='erreur')
       {
        $( "#afficher_plus" ).remove();
        $('#div_articles').html(data);
        if(pagination==1)
        {
            $('#div_nb_article').html($('#nb_articl').val());
        }
       }
       $('#modal_loading').modal('hide');
     
       }
       ,error:function(error)
{
// error alert message

$('#modal_loading').modal('hide');
if(type_modal=='filtre')
{
  $('#filter_modal').modal('show');
}
if(type_modal=='sort')
{
  $('#modal_sort').modal('show');
}

console.log(error);
}
       });



}







function afficher_plus(sign)
{



    if(sign=='+')
{
  pagination=pagination+1;
}
if(sign=='-')
{
  if(pagination==1)
{
  return
}
  pagination=pagination-1;
}
$('#modal_loading').modal('show');

    var _token=$('input[name="_token"]').val();
           $.ajax({
            url:("{{route('produit_collection_apî')}}"),
       method:"POST",
       data:{page:pagination,
       _token:_token,
       taille:tailles,
       categorie:categories,
       color:colores,
       etat:etats,
       prix_min:min,
       prix_max:max,
       id_sous_categorie:id_tag_selected,
       id_collection:id_collection
       },
       success:function(data)
       {
       if(data!='erreur')
       {
        $( "#afficher_plus" ).remove();
       /*  var content_d =$('#div_articles').html();
        content_d+=data;
         */
        $('#div_articles').html(data);
        document.getElementById('titre_id').scrollIntoView();
        $('#modal_loading').modal('hide');
       }
       
       }
       ,error:function(error)
{
// error alert message
console.log(error);
$('#modal_loading').modal('hide');
}
       });

}


function close_filter()
{
  $('#myRange_minimum').val(min_valider);
  $('#pix_minimum').html(min_valider+' DH');

  $('#myRange').val(max_valider);
  $('#demo').html(max_valider+' DH');

  // tailles close
  tab_tailles_close = document.getElementsByClassName("class_tailles");
  var myArray = tailles.split(";");
  for (i = 0; i < tab_tailles_close.length; i++) {
    tab_tailles_close[i].classList.remove('tailles');
    if(myArray.includes(tab_tailles_close[i].getAttribute("donn")))
    {
      tab_tailles_close[i].classList.add('tailles');
    } 
}

   
   // colors close
  tab_colors_close = document.getElementsByClassName("class_colors");
   myArray = colores.split(";");
  for (i = 0; i < tab_colors_close.length; i++) {


    if (tab_colors_close[i].querySelector('img')) {
    tab_colors_close[i].removeChild(tab_colors_close[i].querySelector('img'));
    }
    if(myArray.includes(tab_colors_close[i].getAttribute("donn")))
    {
      var img = document.createElement('img');
      img.src = '{{asset('storage/Rectangle_4-removebg-preview.png')}}';
      img.setAttribute("donn", tab_colors_close[i].getAttribute("donn"));
      img.className = 'img_link_color col';
      tab_colors_close[i].appendChild(img);
    } 
}

// close categories

var listItems2_close = document.querySelectorAll('#Categories li');
var listItems_link2_close = document.querySelectorAll('#Categories li a');


myArray = categories.split(";");


for (i = 0; i < listItems2_close.length; i++) {
  if (listItems2_close[i].querySelector('img')) {
    listItems2_close[i].removeChild(listItems2_close[i].querySelector('img'));
    listItems_link2_close[i].classList.remove('change');
} 

if(myArray.includes(listItems_link2_close[i].getAttribute("donn")))
    {
      var img = document.createElement('img');
      img.src = '{{asset('storage/Rectangle_4-removebg-preview.png')}}';
      img.className = 'img_link col'
      listItems2_close[i].appendChild(img);
      listItems_link2_close[i].classList.add('change');
    }
}


// close etat

var listItems_etat2_close = document.querySelectorAll('#etat li');
var listItems_link_etat2_close = document.querySelectorAll('#etat li a');

myArray = etats.split(";");

for (i = 0; i < listItems_etat2_close.length; i++) {
  if (listItems_etat2_close[i].querySelector('img')) {
    listItems_etat2_close[i].removeChild(listItems_etat2_close[i].querySelector('img'));
    listItems_link_etat2_close[i].classList.remove('change_etat');
} 

if(myArray.includes(listItems_link_etat2_close[i].getAttribute("donn")))
    {
      var img = document.createElement('img');
      img.src = '{{asset('storage/Rectangle_4-removebg-preview.png')}}';
      img.className = 'img_link col'
      listItems_etat2_close[i].appendChild(img);
      listItems_link_etat2_close[i].classList.add('change_etat');
    }
}


  $('#filter_modal').modal('hide');
}



function tout_selectionner_categories(select)
{
    var listItems2 = document.querySelectorAll('#Categories li');
var listItems_link2 = document.querySelectorAll('#Categories li a');


if(select.innerHTML=="Tout sélectionner")
{


listItems2.forEach(function (item) {

    if (item.querySelector('img')) {
       
    } else {
      var img = document.createElement('img');
      img.src = '{{asset('storage/Rectangle_4-removebg-preview.png')}}';
      img.className = 'img_link col'
      item.appendChild(img);
    }
 
});

listItems_link2.forEach(function (item) {
 
    item.classList.add('change');
 
})

select.innerHTML="Tout désélectionner";

}else{
 

    listItems2.forEach(function (item) {

if (item.querySelector('img')) {
    item.removeChild(item.querySelector('img'));
} 

});

listItems_link2.forEach(function (item) {

item.classList.remove('change');

})
select.innerHTML="Tout sélectionner";
}
}

function tout_selectionner_etat(select)
{
  

    var listItems_etat2 = document.querySelectorAll('#etat li');
var listItems_link_etat2 = document.querySelectorAll('#etat li a');


if(select.innerHTML=="Tout sélectionner")
{


    listItems_etat2.forEach(function (item) {

    if (item.querySelector('img')) {
       
    } else {
      var img = document.createElement('img');
      img.src = '{{asset('storage/Rectangle_4-removebg-preview.png')}}';
      img.className = 'img_link col'
      item.appendChild(img);
    }
 
});

listItems_link_etat2.forEach(function (item) {
 
    item.classList.add('change_etat');
 
})

select.innerHTML="Tout désélectionner";

}else{
 

    listItems_etat2.forEach(function (item) {

if (item.querySelector('img')) {
    item.removeChild(item.querySelector('img'));
} 

});

listItems_link_etat2.forEach(function (item) {

item.classList.remove('change_etat');

})
select.innerHTML="Tout sélectionner";
}




}

function effacer_filtre()
{
  $('#myRange_minimum').val(0);
  $('#pix_minimum').html(0+' DH');

  $('#myRange').val(0);
  $('#demo').html(0+' DH');

  // tailles close
  tab_tailles_close = document.getElementsByClassName("class_tailles");
  var myArray = tailles.split(";");
  for (i = 0; i < tab_tailles_close.length; i++) {
    tab_tailles_close[i].classList.remove('tailles');
 
}

   
   // colors close
  tab_colors_close = document.getElementsByClassName("class_colors");
   myArray = colores.split(";");
  for (i = 0; i < tab_colors_close.length; i++) {


    if (tab_colors_close[i].querySelector('img')) {
    tab_colors_close[i].removeChild(tab_colors_close[i].querySelector('img'));
    }

}

// close categories

var listItems2_close = document.querySelectorAll('#Categories li');
var listItems_link2_close = document.querySelectorAll('#Categories li a');


myArray = categories.split(";");


for (i = 0; i < listItems2_close.length; i++) {
  if (listItems2_close[i].querySelector('img')) {
    listItems2_close[i].removeChild(listItems2_close[i].querySelector('img'));
    listItems_link2_close[i].classList.remove('change');
} 


}


// close etat

var listItems_etat2_close = document.querySelectorAll('#etat li');
var listItems_link_etat2_close = document.querySelectorAll('#etat li a');

myArray = etats.split(";");

for (i = 0; i < listItems_etat2_close.length; i++) {
  if (listItems_etat2_close[i].querySelector('img')) {
    listItems_etat2_close[i].removeChild(listItems_etat2_close[i].querySelector('img'));
    listItems_link_etat2_close[i].classList.remove('change_etat');
} 


}
}







</script>



















@endsection