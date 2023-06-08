<link rel="stylesheet" href="{{asset('css/style.css')}}">


@if(count($articles)==0)
<div class="container">
    <p @if(App::getlocale()=="ar") style="padding-left: 13%;text-align: end" @endif >{{__('boutique_une.0article')}}</p></div>

<p class="col-12" style="padding-left: 13%;text-align: center;padding-top: 20px;"><img src="{{$user['Photo_Logo']}}" style="border-radius: 50%" alt="" height="200px" width="200px"><br><br><a style="font-size: 26px" href="{{route('boutiqua',$user['IDUtilisateurs'])}}">{{'@'.$user['Nom'].' '.$user['Prenom']}}</a></p>


@else
@if(count($articles)==1)
<div class="container"><p @if(App::getlocale()=="ar") style="padding-left: 13%;text-align: end" @endif>{{count($articles).' '.__('boutique_une.1article')}}</p></div>
@else
<div class="container"><p @if(App::getlocale()=="ar") style="padding-left: 13%; text-align: end" @endif >{{count($articles).' '.__('boutique_une.articles_trouve')}}</p></div>
@endif
@endif




<!-- arabe -->



<div class="container">

   
    <div class="row mr-0">
    @foreach ($articles as $article)



  
   
        <div class="  width_card col-lg-3 col-md-4 col-sm-6 col-6 p-1 d-flex justify-content-center">


            <div class="card card_content border-0">
      
        
                <img src="{{$article['Image']}}" alt="product_card" class="card-img-top img_product img-fluid"  alt="product_card">
      
      
              
            
      
            <div class="card-body p-2  ">
             
              <h5 class="card-title mb-1 @if(App::getlocale()=="ar") text-right @endif"  @if(App::getlocale()=="ar") dir="rtl" @endif >{{$article['Libelle']}}</h5>
              <p style="font-size: 14px" class=" @if(App::getlocale()=="ar") text-right d-flex justify-content-end  @endif  card-text mb-1  " >  
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

         {{--   <img height="200" width="150" src="{{$article['Image']}}" alt="" style="object-fit: contain">
       
       
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
        <button onclick="window.location = '{{route('details_produit',$article['IDArticles'])}}'"  id="btn_suivi" class="btn btn-primary btn_suivi float-left" >{{__('boutique_une.consulter')}}</button>
       </div>
    </div> --}}



   
{{-- <div class=" col width_card col-lg-3 col-md-4 col-sm-6 col-6 p-1 d-flex justify-content-center">
            
               
            
    <div class="card card_content border-0">
      
        
          <img src="{{$article['Image']}}" alt="product_card" class="card-img-top img_product img-fluid"  alt="product_card">


        
      

      <div class="card-body p-2 ">
       
        <h5 class="card-title mb-1" >{{$article['Libelle']}}</h5>
        <p style="font-size: 14px" class="card-text mb-1">  {{$article['Prix']}} DH </p>
        <p style="font-size: 14px" class="card-text mb-1">{{__('boutique_une.etat')}} : {{$article['etat_tenu']}}</p>
        <button onclick="window.location = '{{route('details_produit',$article['IDArticles'])}}'"  id="btn_suivi" class="btn btn-primary float-right btn_suivi" >{{__('boutique_une.consulter')}}</button>
      </div>
    </div>
  </div> --}}


 
  @endforeach
</div>
</div>








   
    
  
 {{--    <div class="row" style="padding-top: 10px">
    
       
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
           
       
    </div> --}}

