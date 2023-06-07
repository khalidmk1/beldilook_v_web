
@if(count($articles)==0)
<div class="container"><p @if(App::getlocale()=="ar") style="text-align: end" @endif >{{__('boutique_une.0article')}}</p></div>

<p class="col-12" style="text-align: center;padding-top: 20px;"><img src="{{$user['Photo_Logo']}}" style="border-radius: 50%" alt="" height="200px" width="200px"><br><br><a style="font-size: 26px" href="{{route('boutiqua',$user['IDUtilisateurs'])}}">{{'@'.$user['Nom'].' '.$user['Prenom']}}</a></p>


@else
@if(count($articles)==1)
<div class="container"><p @if(App::getlocale()=="ar") style="text-align: end" @endif>{{count($articles).' '.__('boutique_une.1article')}}</p></div>
@else
<div class="container"><p @if(App::getlocale()=="ar") style="text-align: end" @endif >{{count($articles).' '.__('boutique_une.articles_trouve')}}</p></div>
@endif
@endif



@foreach ($articles as $article)

@if(App::getlocale()=="ar")

<!-- arabe -->



<div class="container">
    
    
  
    <div class="row flex-row-reverse" style="padding-top: 10px">
    
       
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
        <button onclick="window.location = '{{route('details_produit',$article['IDArticles'])}}'"  id="btn_suivi" class="btn btn-primary btn_suivi float-left" >{{__('boutique_une.consulter')}}</button>
       </div>
    </div>
           
       
    </div>
</div>








@else
<div class="container">
    
  
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
</div>
@endif
<hr>
@endforeach