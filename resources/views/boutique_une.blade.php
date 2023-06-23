@extends('navbar')
@section('content')





    <!--<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css" >-->


    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ url('/css/story.css') }}" />

    <style>
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
        
        object-fit: cover;
        height:400px;
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
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content"  style="height:580px;">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button onclick="close_story()" type="button" class="close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                </div>
                <div class="modal-body">
                    <div style="padding-bottom: 15px">
                        <div id="progress" class="w3-white" style="height:7px;width:0%"></div>
                    </div>
                    <div style="padding-bottom: 10px; padding-left:10px;">
                        <img id="img_user" style="border-radius: 50%;background-color:white"
                            src={{ asset('storage/user.png') }} alt="" height="30" width="30">
                        <div id="name_user" style="display: inline;padding-left:5px;color:#212529;">test</div>
                    </div>
                    <div style="text-align: center"><img onclick="detail_produit()" id="image_popup"
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
    <div class="containe container" style="margin-top:45px;">
      @if (App::getlocale() == 'ar')
      <h1 class=" title_botique d-flex justify-content-center"  style="color:#263066;text-align:end;">{{ __('boutique_une.titre') }}</h1>
  @else
      <h1 class="title_botique d-flex justify-content-center" style="color:#263066;text-align:start ;">{{ __('boutique_une.titre') }}</h1>
  @endif
        {{ csrf_field() }}
        <div class="scrollable-tabs-container container" style="max-width: 740px; margin-top:32px;">
        
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
                        @if ($boutique['story'] == '1') onclick="show_image({{ $boutique['id_utilisateur'] . ',' . $btq_image . ',' . $name }})" @else onclick="get_prod_user({{ $boutique['id_utilisateur'] }})" @endif>
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

    <!-- div articles -->
    <div id="div_articles" style="margin-top: 40px; margin-bottom:20px;">

        @if (count($articles) == 0)
            <div class="container">
                <p @if (App::getlocale() == 'ar') style="text-align: end " @else style="padding-left: 13%;"  @endif>{{ __('boutique_une.0article') }}</p>
            </div>

            <p class="col-12" style="text-align: center;padding-top: 20px;"><img src="{{ $user['Photo_Logo'] }}"
                    style="border-radius: 50%" alt="" height="200px" width="200px"><br><br><a
                    style="font-size: 26px"
                    href="{{ route('boutiqua', $user['IDUtilisateurs']) }}">{{ '@' . $user['Nom'] . ' ' . $user['Prenom'] }}</a>
            </p>
        @else
            @if (count($articles) == 1)
                <div class="container">
                    <p @if (App::getlocale() == 'ar') style="text-align: end" @endif>
                        {{ count($articles) . ' ' . __('boutique_une.1article') }}</p>
                </div>
            @else
                <div class="container">
                    <p @if (App::getlocale() == 'ar') style="text-align: end" @endif>
                    <img src="{{asset('storage/icon-article-shop.png')}}" class="image_obligatoire" style="height:30px;"  alt="icon-article">
                        {{ count($articles) . ' ' . __('boutique_une.articles_trouve') }}</p>
                </div>
            @endif
        @endif







    



        <div class="container articles_boutique_une">
            <div class="row " style="">




                @foreach ($articles as $article)
                  
   
        <div class="  width_card col-lg-3 col-md-4 col-sm-6 col-6 p-1 d-flex justify-content-center">


            <div class="card card_content border-0">
      
        
                <img src="{{$article['Image']}}" alt="product_card" class="card-img-top img_product img-fluid"  alt="product_card">
      
      
              
            
      
            <div class="card-body p-2  ">
             
              <h5 class="card-title mb-2 @if(App::getlocale()=="ar") text-right @endif"  @if(App::getlocale()=="ar") dir="rtl" @endif >{{$article['Libelle']}}</h5>
              <p style="font-size: 14px; margin-bottom:0;" class=" @if(App::getlocale()=="ar") text-right d-flex justify-content-end  @endif  card-text " >  
                {{$article['Prix']}} 
                <span class="ml-1"> DH</span> 
            </p>
              <p style="font-size: 14px" class="card-text mb-1  @if(App::getlocale()=="ar") text-right @endif"  @if(App::getlocale()=="ar") dir="rtl" @endif>{{__('boutique_une.etat')}} : {{$article['etat_tenu']}}</p>
              <div class="text-center">
                <button onclick="window.location = '{{route('details_produit',$article['IDArticles'])}}'"  id="btn_suivi" class="btn text-light  btn_suivi" >{{__('boutique_une.consulter')}}</button>
              </div>
            </div>
          </div>


       
     
           
       
    </div>



                    {{--   <div class="row flex-row-reverse" style="padding-top: 10px">
      
         
              <img height="200" width="150" src="{{$article['Image']}}" alt="" style="object-fit: contain">
         
         
         <div class="col" > <div  style="padding-top: 10px;">
         
          <b class="float-right" style="font-size: 20px">{{$article['Libelle']}} </b>
         
         </div>
    
         <div  style="padding-top: 50px;">
          <b class="float-right">   {{$article['Prix']}} DH</b> 
         </div>
   
         <div  style="padding-top: 50px">
          <b class="float-right">{{__('boutique_une.etat')}} </b><b class="float-right" style="padding-right: 4px;padding-left:4px">  :  </b><b class="float-right"> {{$article['etat_tenu']}} </b>
         </div>
         <div style="padding-top: 30px">
          <button onclick="window.location = '{{route('details_produit',$article['IDArticles'])}}'"  id="btn_suivi" class="btn btn-primary btn_suivi float-left" style="" >{{__('boutique_une.consulter')}}</button>
         </div>
      </div>
             
         
      </div> --}}










                    {{--  <div class="container">


    
      <div class="row" style="padding-top: 10px">
      
         
              <img height="200" width="150" src="{{$article['Image']}}" alt="" style="object-fit: contain">
         
         
         <div class="col" > <div  style="padding-top: 10px">
         
         <b class="prix_flex"  style="font-size: 20px">{{$article['Libelle']}} </b>
         
         </div>
    
         <div  style="padding-top: 30px">
         <b>  {{$article['Prix']}} DH</b>
         </div>
    
         <div  style="padding-top: 30px">
          <b>{{__('boutique_une.etat')}} : {{$article['etat_tenu']}}</b>
         </div>
         <div style="padding-top: 30px">
          <button onclick="window.location = '{{route('details_produit',$article['IDArticles'])}}'"  id="btn_suivi" class="btn btn-primary float-right btn_suivi" >{{__('boutique_une.consulter')}}</button>
         </div>
      </div>
             
         
      </div>
  </div> --}}
                @endforeach
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

                get_prod_user(id_user);
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



            function get_prod_user(id_user) {

                $('#modal_loading').modal('show');
                show_loading_visible = true;
                var _token = $('input[name="_token"]').val();
                $.ajax({

                    url: ("{{ route('get_produit_story') }}"),
                    method: "POST",
                    data: {
                        _token: _token,
                        id_utilisateur: id_user
                    },
                    success: function(data5) {



                        $('#div_articles').html(data5);

                        $('#modal_loading').modal('hide');

                    },
                    error: function(request, status, error) {
                        //alert(request.responseText);
                        $('#modal_loading').modal('hide');
                    }
                });
            }
        </script>




    @endsection
