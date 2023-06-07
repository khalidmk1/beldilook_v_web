
@extends('navbar')
@section('content')


    <link rel="stylesheet" type="text/css" href="{{ url('/css/chat1.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('/css/style.css') }}" />



<!-- Modal  envoi image -->


<div class="modal fade" id="exampleModal_message_image" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content" >
      <div class="modal-header @if(App::getlocale()=="ar")  flex-row-reverse @endif">
       
        <h5 class="modal-title"  id="exampleModalLabel">{{__('suivi_achat.ajouter_avis')}}</h5>
        <div @if(App::getlocale()=="ar") style="text-align: end" @endif>
        <button onclick="vider_image()" type="button" class="close pl-0" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>
      </div>
      <form id="msg_image" action={{route('send_message_image')}} method="POST" >
        @csrf
      <div class="modal-body">

        <div style="text-align:center">
          <img id="image_produit" src="" alt="" height="250" width="250">
        </div>
      <br>
 
       
      <input type="file" name="imagemsg" id="image_msg" hidden accept="image/*" onchange="readURL(this)"  >
        <div @if(App::getlocale()=="ar")  style="text-align: end" @endif><label for="commentaire">{{__('suivi_achat.commentaire')}}</label></div>
        <textarea class="form-control @error('commentaire') is-invalid @enderror" id="commentaire"  name="commentaire" rows="3">{{ old('commentaire') }}</textarea>
        <div  style="text-align: center;padding-top:15px">
       
        <div>
            <button onclick="send_message_image()" class="btn btn-primary btn_suivi ">{{__('mes_achats.envoyer')}}</button>
          </div>
            
          </div>
      </div>
    </form>
    </div>
 


</div>
</div>








<div onclick="go_to_top()" style="z-index: 2000000;cursor: pointer;" class="col"  id="snackbar">{{__('chat_support.new_message')}}</div>
    <h3 style="padding: 20px;@if(App::getlocale()=="ar") text-align:right; @endif">{{__('chat_support.support')}}</h3>
    <div style="padding-left: 10px; " class="container1">
        <ol id="div_chat" class="chat" >
    
            @php
            //dd($messages);
            @endphp
    @foreach($messages as $message)

@if($message['expediteur']!=0)
<li class="self">
              
    <div class="msg msg_2">
      <p>{{$message['messag']}}</p>
      @if($message['image2']!='')
      <img style="object-fit: contain" height="300px"  src="{{$message['image2']}}" draggable="false"/>
      @endif
      
    </div>
  </li>
@else
<div class="row1">
    <div class="col1">
        <img src="{{ asset('storage/logo.png') }}" style="background-color: #212951" alt=""  class="logo">
    </div>
    <div class="col1">
        <li class="other">
            <div class="msg msg_1">
                <div class="user">Beldilook<span class="range admin">support</span></div>
                <p>{{$message['messag']}}</p>
              @if($message['image2']!='')
              <img style="object-fit: contain" height="300px"  src="{{$message['image2']}}" draggable="false"/>
              @endif
              
            </div>
          </li>
    </div>
</div> 
@endif


    @endforeach
    
      
            
    
    
            
               
            
            </ol>
            <br>
            <div class="typezone">
            <form id="msg_normal" action="{{route('send_message')}}" method="post" enctype="multipart/form-data">  {{ csrf_field() }}<textarea id="msg" name="msg" type="text" placeholder="Say something" class="textarea2"></textarea><input type="submit" class="send" value="" onclick="send_message()" style="background-image: url('{{asset('storage/send-message.png')}}')" />
            
            </form>
            <div onclick="select_image()" class="emojis" style=" background-image: url('{{asset('storage/attach-file.png')}}') ;"></div></div>
    </div>

<script>
  var nb_ligne=0;
  var nb_ligne_prec=0;
     $(document).ready(function(){
      //fetch_data();
      window.scrollTo(0, document.body.scrollHeight);
      setInterval(function()
{
    fetch_data();
}
  ,5000  );
    });
  function fetch_data()
{
  var _token=$('input[name="_token"]').val();
    $.ajax({
      
        url:("{{route('chat_support_api')}}"),
        method:"POST",
       data:{
       _token:_token
       },
        success:function(data){
  var html="";
 var ass="{{ asset('storage/logo.png') }}";
  

nb_ligne_prec=nb_ligne;
nb_ligne=data.length;



  for(var count=0 ; count<data.length ; count++)
  {
    if(data[count]['expediteur']!=0)
  {
    html+='<li class="self"><div class="msg msg_2"><p>'+data[count]['messag']+'</p>';
                if(data[count]['image2']!=''){
                  html+='<img style="object-fit: contain" height="300px"  src="'+data[count]['image2']+'" draggable="false"/>';
                }
                
                html+='</div></li>';
  }else{

     
    html+='<div class="row1"><div class="col1">';
      html+=' <img src="'+ass+'" style="background-color: #212951" alt=""  class="logo"></div><div class="col1"><li class="other"><div class="msg msg_1"><div class="user">Beldilook<span class="range admin">support</span></div>';
    
        html+='<p>'+data[count]['messag']+'</p>';
        
                
        if(data[count]['image2']!=''){
          html+='<img style="object-fit: contain" height="300px"  src="'+data[count]['image2']+'" draggable="false"/> ';
         }
         html+='</div></li></div></div>';

  }
  }
  
  $('#div_chat').html(html);
        }
    });
    if(nb_ligne!=nb_ligne_prec){
      if(nb_ligne_prec!=0){
      var x = document.getElementById("snackbar");
       
       x.className = "show col";
       
      
      
      
       
       setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
      }
      
    }
}
function go_to_top()
{
  window.scrollTo(0, document.body.scrollHeight);
}
function send_message(){


  $('#msg_normal').ajaxForm({
            beforeSend:function(){
            
            },
            uploadProgress:function(event, position, total, percentComplete){
               
            },
            success:function(data)
            {
              var input=document.getElementById('image_msg');
              input.value="";
              console.log(data);
              document.getElementById("msg").value="";
              fetch_data();
              go_to_top();
                    
                
                
            },
            error:function(data2)
            { console.log(data2)
              

            }
            

        });





}


function send_message_image(){


$('#msg_image').ajaxForm({
          beforeSend:function(){
          
          },
          uploadProgress:function(event, position, total, percentComplete){
             
          },
          success:function(data)
          {
            var input=document.getElementById('image_msg');
            input.value="";
            var input2=document.getElementById('commentaire');
            input2.value="";
            console.log(data);
            document.getElementById("msg").value="";
            $('#exampleModal_message_image').modal('hide')
            fetch_data();
            go_to_top();
                  
              
              
          },
          error:function(data2)
          { console.log(data2)
            

          }
          

      });





}


function select_image(){
  var input=document.getElementById('image_msg');
  input.click();
}
function vider_image()
{
  var input=document.getElementById('image_msg');
            input.value="";
}
function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
      $('#image_produit')
        .attr('src', e.target.result);
    };
    reader.readAsDataURL(input.files[0]);
    var input=document.getElementById('msg');
            var input2=document.getElementById('commentaire');
            input2.value=input.value;
    $('#exampleModal_message_image').modal('show');
  }
}
</script>

@endsection
























