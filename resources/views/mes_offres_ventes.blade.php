@extends('navbar')
@section('content')
<link rel="stylesheet" type="text/css" href="{{ url('/css/style.css') }}" />

<style>
  .title{
    color: #212951;
  }
</style>

<!-- Modal articles -->
<div class="modal fade" id="Modal_article" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{__('adresses_livraison.suppression_adresse')}}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          {{__('favoris.suppression_article')}}
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('adresses_livraison.annuler')}}</button>
          <form action={{route('delete_article')}} method="POST">
            @csrf
            <input id="id_delete_article" type="hidden" name="idarticle" value="">
            <button type="submit" class="btn btn-danger">{{__('adresses_livraison.supprimer')}}</button>
          </form>
         
        </div>
      </div>
    </div>
  </div>


<div class="container items">
    <br>
    <div class="text-center "><h1 class="title">{{__('offre_vente.titre')}}</h1></div>
    <br>
    <div class="row">



      @forelse ($articles as $article)
              <div class="col  width_card col-lg-3 col-md-4 col-sm-6 col-6 p-1 d-flex justify-content-center">
                
                   
                
                <div class="card card_content border-0">

                
                  
                    <a href="{{route('get_modifier_produit',$article['idarticles'])}}">
                        <img src="{{ $article['photo1']}}" class="card-img-top img_product img-fluid"  alt="product_card" >
                    </a>


                  

                 
                   <img id="art{{$article['idarticles']}}" onclick="delete_article({{$article['idarticles']}})"  class="topright pointer" height="30" width="30" src={{ asset('storage/supp2_new.png') }}  alt="">
                   
                   

                      

                        @if ($article['rupture_stock']!='no')
                        <span class="badge bg-danger bottomright" >{{__('home.rupture_stock')}}</span>

                        @endif

                    
                  

                  <div class="card-body p-2 ">
                   
                    <h5 class="card-title mb-1 " >{{$article['libellé']}}</h5>
                   
                    <p style="font-size: 14px" class="card-text mb-1">{{$article['prix']." DH"}}</p>
                  </div>
                </div>
              </div>









       
       {{--  @forelse ($articles as $article)
    <div class="col-lg-3 col-md-4 col-sm-6 col-6" style="padding-bottom: 20px;display:flex;justify-content:center;align-items:center">
    
        <div class="card card2" >
            <div class="imgprod">
                <a href="{{route('get_modifier_produit',$article['idarticles'])}}">
                    <img class="card-img-top" src={{ $article['photo1']}} alt="Card image cap" height="200" width="200" style="border-radius: 8px;object-fit: contain;">
                </a>
            @if ($article['rupture_stock']!='no')
            <span class="badge bg-danger bottomright" >Rupture stock</span>
            @endif
          
           
            <img onclick="delete_article({{$article['idarticles']}})" class="topright pointer" height="30" width="30" src={{ asset('storage/supp2_new.png') }} alt="">
            
        </div>
            <div class="card-body">
              <p style="font-size: 17px" class="card-title text" data-toggle="{{$article['libellé']}}">{{$article['libellé']}} </p>
              <p style="font-size: 14px" class="card-text">{{$article['prix']." DH"}}</p>
              
            </div>
          </div>
    
    </div>  --}}
       @empty
<p class="col-12 " style="text-align: center;padding-top: 80px;">{{__('home.aucun_produit')}}</p>
       @endforelse

    </div>
</div>

<div style="text-align: center;padding-bottom:50px ; margin-top: 20px">
    @if ($page==1 or $page=='')
    <a class="paginationa" href="">❮</a>
    <a class="paginationa" href={{$request->fullUrlWithQuery(['page' => 2]) }}>❯</a>
    @else
    <a class="paginationa" href={{$request->fullUrlWithQuery(['page' => $page-1]) }}>❮</a>
    <a class="paginationa" href={{$request->fullUrlWithQuery(['page' => $page+1]) }}>❯</a>
    @endif
  
    
</div>
<script>
        function delete_article(id){
  $('#id_delete_article').val(id);
         $('#Modal_article').modal('show');
}
</script>
@endsection