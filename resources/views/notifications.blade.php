@extends('navbar')
@section('content')
<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="{{ url('/css/app.css') }}">


<!-- Modal image -->
<div class="modal fade" id="Modal_image" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
    <div class="modal-dialog" role="document" >
      <div class="modal-content" >
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <img id="image_popup" src="" height="470" width="466" style="object-fit: contain">
        </div>
        <div class="modal-footer">
         
         
        </div>
      </div>
    </div>
  </div>



<section class="section-50">
    <div class="container">
      @if(App::getlocale()=="ar")
      <h3 class="m-b-50 "  style="text-align:end" >   <i class="fa fa-bell text-muted"></i> {{__('notification.notifications')}}</h3>
      @else
      <h3 class="m-b-50 "   >  {{__('notification.notifications')}} <i class="fa fa-bell text-muted"></i></h3>
      @endif
      @foreach ($liste_notif as $notif)
      <div  class="notification-ui_dd-content">
        <div class="notification-list notification-list--unread">
          <div class="notification-list_content">
            <div class="notification-list_img"> <img src="{{ asset('storage/logo.png') }}" style="background-color: #212951" alt="user"> </div>
            <div class="notification-list_detail">
              <p><b>{{$notif['titre']}}</b></p>
              <p class="text-muted">{{$notif['message_notif']}}</p>


              @php
              $diff_time ='';
              if(str_contains($notif['diff_date'],'jour')){
                if(str_contains($notif['diff_date'],'jours')){
                  $diff_time=str_replace('jours',__('notification.jours'),$notif['diff_date']);
                }else{
                  $diff_time=str_replace('jour',__('notification.jour'),$notif['diff_date']);
                }
              }
              if(str_contains($notif['diff_date'],'seconde')){
                if(str_contains($notif['diff_date'],'secondes')){
                  $diff_time=str_replace('secondes',__('notification.secondes'),$notif['diff_date']);
                }else{
                  $diff_time=str_replace('seconde',__('notification.seconde'),$notif['diff_date']);
                }
              }
              if(str_contains($notif['diff_date'],'minute')){
                if(str_contains($notif['diff_date'],'minutes')){
                  $diff_time=str_replace('minutes',__('notification.minutes'),$notif['diff_date']);
                }else{
                  $diff_time=str_replace('minute',__('notification.minute'),$notif['diff_date']);
                }
              }
              if(str_contains($notif['diff_date'],'heure')){
                if(str_contains($notif['diff_date'],'heures')){
                  $diff_time=str_replace('heures',__('notification.heures'),$notif['diff_date']);
                }else{
                  $diff_time=str_replace('heure',__('notification.heure'),$notif['diff_date']);
                }
              }
              if(str_contains($notif['diff_date'],'mois')){
                  
                $pieces = explode(" ", $notif['diff_date']);

                if($pieces[0]=='1'){
                  $diff_time=str_replace('mois',__('notification.moi'),$notif['diff_date']);
                }else{
                  $diff_time=str_replace('mois',__('notification.mois'),$notif['diff_date']);
                }
              }

              if(str_contains($notif['diff_date'],'année')){
                if(str_contains($notif['diff_date'],'années')){
                  $diff_time=str_replace('années',__('notification.années'),$notif['diff_date']);
                }else{
                  $diff_time=str_replace('année',__('notification.année'),$notif['diff_date']);
                }
              }
              @endphp
              




              <p class="text-muted"><small>{{$diff_time}}</small></p>
            </div>
          </div>
          @if($notif['image']!='')
          <div class="notification-list_feature-img"><img onclick="show_image(this.src)" src="{{$notif['image']}}" style="object-fit: contain;cursor: pointer"  alt="Feature image"></div>
                @endif
        </div>
      </div>
      @endforeach
    </div>
  </section>


<script>
    function show_image(src){
  $('#image_popup').attr("src",src);
         $('#Modal_image').modal('show');
}
</script>

@endsection