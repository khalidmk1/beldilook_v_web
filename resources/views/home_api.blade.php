
@if($page==1)






        


         




  {{ csrf_field() }}



          
  @forelse ($articles as $article)

<div class="col   col-lg-4 col-md-4 col-sm-4 col-xl-4  ">
  
     
  
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
      <p class="mb-1"> <a href="{{route('boutiqua',$article['idutilisateurs'])}}">{{$article['nom_vendeur']}}</a></p>
      <h5 class="card-title mb-1 " >{{$article['libellé']}}</h5>
      <p style="font-size: 14px" class="card-text mb-1"> {{__('boutique_une.etat')}} : {{$article['etat_tenu']}} </p>
      <p style="font-size: 14px" class="card-text mb-1">{{$article['prix']." DH"}}</p>
    </div>
  </div>
</div>





@empty
<p class="col-12" style="text-align: center;padding-top: 80px;">{{__('home.aucun_produit')}}</p>
@endforelse








       














{{-- 
    <div id="div_articles" class="row">
        {{ csrf_field() }}
        @forelse ($articles as $article)
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
    
    </div> 




       @empty
       @if($page==1)
<p class="col-12" style="text-align: center;padding-top: 80px;">{{__('home.aucun_produit')}}</p>
@endif
       @endforelse

    </div> --}}
    
    @if(count($articles)!=0)
    <div onclick="afficher_plus()" class="col-12" style="text-align: center" id="afficher_plus"><button>{{__('home.afficher_plus')}}</button></div>
    @endif

@else





    
       
@forelse ($articles as $article)

<div class="col   col-lg-4 col-md-4 col-sm-4 col-xl-4  ">
  
     
  
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
      <p class="mb-1"> <a href="{{route('boutiqua',$article['idutilisateurs'])}}">{{$article['nom_vendeur']}}</a></p>
      <h5 class="card-title mb-1 " >{{$article['libellé']}}</h5>
      <p style="font-size: 14px" class="card-text mb-1"> {{__('boutique_une.etat')}} : {{$article['etat_tenu']}} </p>
      <p style="font-size: 14px" class="card-text mb-1">{{$article['prix']." DH"}}</p>
    </div>
  </div>
</div>





@empty
<p class="col-12" style="text-align: center;padding-top: 80px;">{{__('home.aucun_produit')}}</p>
@endforelse

   
    @if(count($articles)!=0)
    <div onclick="afficher_plus()" class="col-12" style="text-align: center" id="afficher_plus"><button>{{__('home.afficher_plus')}}</button></div>
    @endif



@endif