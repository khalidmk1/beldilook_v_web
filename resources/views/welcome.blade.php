@extends('navbar')
@section('content')





    <!--<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css" >-->



    <link rel="stylesheet" type="text/css" href="{{ url('/css/story.css') }}" />


    <style>
        .btn_blogs{
            background-color: white;
            padding: 5px;
            border-radius: 20px;
            width: 130px;
        }
        .btn_blogs:hover{
            background-color: rgb(219, 214, 214);
        }
         .text2 {
    overflow: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
    -webkit-line-clamp: 2; /* number of lines to show */
            line-clamp: 2; 
    -webkit-box-orient: vertical;
    font-size: 12px;
 }
 .titre2 {
    overflow: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
    -webkit-line-clamp: 2; /* number of lines to show */
            line-clamp: 2; 
    -webkit-box-orient: vertical;
    
 }
        .blogs{
        background:#ffff;
         margin: 30px 15px 15px 15px;
         padding: 16px 15px 25px 15px;
      text-align: center;
           border-radius: 30px;
        }
        .div_blogs{
           text-align: center;
           margin: 0px;
        }
        .image_blog{
            
            width: 100%;
            height: 220px;
            border-radius: 19px;
           
        }
        .image_blog + h5 {
           margin-top:23px !important; 
        }


      div.scrollmenu {
    overflow: auto;
    white-space: nowrap;
    padding: 20px 20px 20px 20px;
    border: #212951 1px solid;
  }
  .selected{
    border: #EFEFEF 1px solid;
    background-color: #EFEFEF;
    color: #212529;
    padding: 10px;
    border-radius: 10px;
    min-width: 50px;
    
  }
        .div_right {
            /* height: 400px; */
            position: absolute;
            background-color: transparent;
            width: 80px;
            height: 432px;
            bottom: 50px;
            /* float: right; */
            right: 1px;
        }

        .div_left {
            /* height: 400px; */
            position: absolute;
            background-color: transparent;
            width: 80px;
            height: 432px;
            bottom: 50px;
            /* float: right; */
            left: 1px;
        }

        .w3-white,
        .w3-hover-white:hover {
            color: #000 !important;
            background-color: #fff !important
        }

        .btn_suivi {
            background-color: #B09636;
            border: #B09636;
            width: 100%;
        }

        .btn_suivi:hover {
            background-color: #86732b;
            border: #86732b;
        }

        .img_stor {
        
    object-fit: contain;
    height:100%;
    width: 100%;
    
  
        }

        @media only screen and (max-width: 600px) {
            .img_stor {
               /* width: 300px;
                height: 300px;
                */
            }
        }



        .loader {
            border: 16px solid #f3f3f3;
            border-radius: 50%;
            border-top: 16px solid #B09636;
            width: 120px;
            height: 120px;
            -webkit-animation: spin 2s linear infinite;
            /* Safari */
            animation: spin 2s linear infinite;
            position: relative;
            left: 35%;
        }

        @media (max-width:960px){
          .title_botique{
            padding: 0 !important;
          }
        }

        /* Safari */
        @-webkit-keyframes spin {
            0% {
                -webkit-transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(360deg);
            }
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>



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


    <!-- Modal image -->
    <div class="modal fade" id="Modal_image" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true" style="margin: 0 auto; ">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content" style="">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button onclick="close_story()" type="button" class="close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                </div>
                <div class="modal-body">
                    <div style="">  <!--  -->
                        <div id="progress" class="w3-white" style="height:7px;width:0%"></div>
                    </div>
                    <div style="padding-bottom: 10px; padding-left:10px;" class="story_user"> <!--  -->
                        <img id="img_user" style="border-radius: 50%;background-color:white"
                            src={{ asset('storage/user.png') }} alt="" height="30" width="30">
                        <div id="name_user" style="display: inline;padding-left:5px;color:#212529;">test</div>
                    </div>
                    
                    <div style="text-align: center; "><img onclick="detail_produit()" id="image_popup"
                            src="{{ asset('storage/A_black_image.jpg') }}" class="img_stor img-fluid">
                        <div onclick="right()" class="div_right"></div>
                        <div onclick="left()" class="div_left"> </div>
                    </div>
                    
                    
                </div>
                <div class="modal-footer justify-content-center" style="border:none;">
                <div style="text-align: center;font-size:20px;color:#212529;" id="lib_article"></div>
                </div>
            </div>
        </div>
    </div>



    
    <div style="background:#EFEFEF;  padding-top:40px; padding-bottom:80px;">
    
    <div class=" containe container" style="margin-top:45px;">
    <div class="row d-flex" style="justify-content:center;">   
        @if (App::getlocale() == 'ar')
        
      <h1 class=" title_botique"  style="margin-left:15px;">{{ __('boutique_une.titre') }}</h1>
       
     @else
     
      <h1 class="title_botique" style="text-align:start ; margin-left:15px; ">{{ __('boutique_une.titre') }}</h1>
      
     @endif
     </div>
     
        {{ csrf_field() }}
    </div>

    <div class="containe container mt-2">
        <div class="row d-flex justify-content-center m-0">
        <div class="scrollable-tabs-container container" style="max-width: 740px;">
        
        <div class="left-arrow">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
            </svg>
        </div> 

        @if (count($boutiques) == 0)
            <p class="col-12" style="text-align: center;padding-top: 80px;">{{ __('home.aucun_boutique') }}</p>
        @endif
        <ul>
            @foreach ($boutiques as $boutique)
                @php
                    $btq_image = '"' . $boutique['image'] . '"';
                    $name = '"' . $boutique['nom'] . '"';
                @endphp
                <li class="text-center d-flex flex-column justify-content-center"
                    @if ($boutique['story'] == '1') onclick="show_image({{ $boutique['id_utilisateur'] . ',' . $btq_image . ',' . $name }})" @else onclick="" @endif>
                    <a href="#" @if ($boutique['story'] == '1') class="active" @endif>
                        <div class="bg">
                            @if ($boutique['image'] == '')
                                <img src="{{ asset('storage/user.png') }} " class="image_story" alt="#">
                            @else
                                <img src="{{ $boutique['image'] }}" class="image_story" alt="#">
                            @endif


                        </div>
                    </a>
                    <p class="text-center">{{ $boutique['nom'] }}</p>
                </li>
            @endforeach


        </ul>

        <div class="right-arrow active">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
            </svg>
        </div>
    </div>
        </div>
    </div>
    </div>
<div style="" class="home_category_list_container">
@foreach ($type_tags as $type_tag)

@php
    $tags=$type_tag['tags'];
@endphp
<div class="container">
 <div class="row mt-5 ml-0">
   <h1 class="home_category_title">{{$type_tag['libelle']}}</h1>
 </div>
 <div class="row ml-0" style="">
 <div class="" style="margin: 5px 0; "> <!-- Removed scrollmenu class -->
    @foreach ($tags as $tag)
    <div onclick="window.location='{{route('produit_sous_categorie',['id_type'=>$type_tag['id_type'], 'id_tag'=>$tag['id_tag']]) }}'" 
    class="catgs selected" style="display: inline-block;margin-right:12px; letter-spacing:1px; margin-top:10px; cursor:pointer; min-width: 50px;padding: 10px 27px;">
        {{ mb_strtoupper($tag['libelle'], 'UTF-8')}}
        </div>
    @endforeach

 </div>
 </div>

</div>

@endforeach
</div>

<div style="background-color: #EFEFEF; padding-top:50px; padding-bottom:100px; margin-top:150px;">
<div class="container home_blog_and_actu"  style="">

<div class="row  justify-content-center">
<h3 style="@if(App::getlocale()=="ar") text-align:end;margin-right:100px; @endif">{{__('nav.blogs_actus')}}</h3>
</div>

<div class="row div_blogs justify-content-center " >
    
    <div class="col-lg-4 col-md-4 col-sm-6 blogs">
<img  class="image_blog" src="https://www.blog.beldilook.ma/wp-content/uploads/2023/05/caftan-toute-occas-1-1024x576.webp" alt="">
<h5 style="margin-top: 10px" class="titre2">Comment porter son caftan en toute occasion : De la tenue décontractée à l’événement formel</h5>
<p class="text2">Le caftan est une tenue traditionnelle marocaine qui peut être portée lors de différentes occasions, qu’elles soient décontractées ou formelles. Voici quelques conseils pour porter un caftan en toute occasion :</p>
<button onclick="window.location='https://www.blog.beldilook.ma/comment-porter-son-caftan-en-toute-occasion-de-la-tenue-decontractee-a-levenement-formel/'" class="btn_blogs">{{__('nav.lire_suite')}}</button>
    </div>
    <div class="col-lg-1 col-md-1 col-sm-12">
       
    </div>
    <div class="col-lg-4 col-md-4 col-sm-6 blogs">
        <img class="image_blog" src="https://www.blog.beldilook.ma/wp-content/uploads/2021/07/repass-new-1024x576.jpg" alt="">
        <h5 style="margin-top: 10px" class="titre2">Comment bien repasser ses tenues traditionnelles Marocaines ?</h5>
        <p class="text2">Le caftan est une tenue traditionnelle marocaine qui peut être portée lors de différentes occasions, qu’elles soient décontractées ou formelles. Peu importe l’occasion, n’importe quelle tenue Marocaine est mise en valeur que si elle est bien repassée et entretenue.</p>
        <button onclick="window.location='https://www.blog.beldilook.ma/comment-bien-repasser-ses-tenues-traditionnelles-marocaines/'" class="btn_blogs">{{__('nav.lire_suite')}}</button>
    </div>

</div>
</div>
</div>

  
    

        <script src="{{ url('/js/story.js') }}"></script>
       

        <script>
            var progr = 0;
            var i = 0;
            var data2;
            var myInterval;
            var show_loading_visible = false;
            var ass = "{{ asset('storage/A_black_image.jpg') }}";

            function show_image(id, img, name) {
                $('#img_user').attr("src", img);
                $('#name_user').html(name);
                get_prod_story(id);

            }

            function progres() {
                if (progr < 100) {
                    progr = progr + 1;
                }


                if (progr == 100) {
                    console.log(i);
                    console.log(data2.length);
                    progr = 0;
                    $("#progress").width(0);
                    i++;
                    if (i < data2.length) {
                        i--;
                        i++;
                        $('#image_popup').attr("src", data2[i]['photo1']);
                        $('#lib_article').html(data2[i]['libellé']);
                    } else {

                        clearInterval(myInterval);
                        $("#progress").width(0);
                        i = 0;
                        progr = 0;
                        $('#image_popup').attr("src", ass);
                        $('#lib_article').html("");
                        $('#Modal_image').modal('hide');
                    }
                }

                $("#progress").animate({
                    width: progr + "%"
                }, {
                    duration: 1,
                    complete: function() {

                    }
                });

            }

            function get_prod_story(id_user) {

               
                $('#modal_loading').modal('show');
                var _token = $('input[name="_token"]').val();
                $.ajax({

                    url: ("{{ route('produit_story') }}"),
                    method: "POST",
                    data: {
                        _token: _token,
                        id_utilisateur: id_user
                    },
                    success: function(data) {
                        i = 0;
                        data2 = data;
                        $('#image_popup').attr("src", data[0]['photo1']);
                        $('#lib_article').html(data[0]['libellé']);
                        $('#modal_loading').modal('hide');
                        $('#Modal_image').modal('show');


                        myInterval = setInterval(function() {
                            progres();
                        }, 60);


                        //console.log(data);


                    },
                    error: function(request, status, error) {
                        //alert(request.responseText);
                        $('#modal_loading').modal('hide');
                    }
                });
            }

            function close_story() {

                $('#image_popup').attr("src", ass);
                clearInterval(myInterval);
                $("#progress").width(0);
                i = 0;
                $('#lib_article').html("");
                progr = 0;
                $('#Modal_image').modal('hide');
            }

            function right() {
                i++;
                if (i < data2.length) {
                    i--;
                    i++;
                    $('#image_popup').attr("src", data2[i]['photo1']);
                    $('#lib_article').html(data2[i]['libellé']);
                    progr = 0;
                    $("#progress").width(0);
                } else {

                    clearInterval(myInterval);
                    $("#progress").width(0);
                    i = 0;
                    progr = 0;
                    $('#image_popup').attr("src", ass);
                    $('#lib_article').html("");
                    $('#Modal_image').modal('hide');
                }
            }


            function left() {


                if (i == 0) {
                    progr = 0;
                    $("#progress").width(0);
                    return
                }
                i--;
                $('#image_popup').attr("src", data2[i]['photo1']);
                $('#lib_article').html(data2[i]['libellé']);
                progr = 0;
                $("#progress").width(0);

            }

            function detail_produit() {
                clearInterval(myInterval);
                $("#progress").width(0);

                progr = 0;
                $('#image_popup').attr("src", ass);
                $('#lib_article').html("");
                $('#Modal_image').modal('hide');
                window.location = '/produit/' + data2[i]['idarticles'];
            }



          
        </script>




    @endsection
