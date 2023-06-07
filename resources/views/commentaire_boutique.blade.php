@extends('navbar')
@section('content')
<link rel="stylesheet" type="text/css" href="{{ url('/css/style.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ url('/css/details_produit.css') }}" />
<link href="https://fonts.googleapis.com/css?family=Bentham|Playfair+Display|Raleway:400,500|Suranna|Trocchi" rel="stylesheet">
<link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">

@if(App::getlocale()=="ar")
<h1  style="padding: 20px;color:#263066;text-align:end">Commentaires</h1>
@else
<h1  style="padding: 20px;color:#263066;text-align:start">Commentaires</h1>
@endif


@foreach($commentaires as $commentaire)
<div style="padding: 20px">
<div style="display: inline-block;"><img height="30" width="30" style="border-radius: 100%" src="{{$commentaire['photo_profile']}}" alt=""><p style="padding-left: 10px;display: inline-block;">{{$commentaire['nom']." ".$commentaire['prenom']." : "}}</p>

  @if($commentaire['nb_etoile']==1)
  <i class="star yellow fas fa-star" data-index="0"></i>
  <i class="star stargrey fas fa-star" data-index="1"></i>
  <i class="star stargrey fas fa-star" data-index="2"></i>
  <i class="star stargrey fas fa-star" data-index="3"></i>
  <i class="star stargrey fas fa-star" data-index="4"></i>
  @endif
  @if($commentaire['nb_etoile']==2)
  <i class="star yellow fas fa-star" data-index="0"></i>
  <i class="star yellow fas fa-star" data-index="1"></i>
  <i class="star stargrey fas fa-star" data-index="2"></i>
  <i class="star stargrey fas fa-star" data-index="3"></i>
  <i class="star stargrey fas fa-star" data-index="4"></i>
  @endif
  @if($commentaire['nb_etoile']==3)
  <i class="star yellow fas fa-star" data-index="0"></i>
  <i class="star yellow fas fa-star" data-index="1"></i>
  <i class="star yellow fas fa-star" data-index="2"></i>
  <i class="star stargrey fas fa-star" data-index="3"></i>
  <i class="star stargrey fas fa-star" data-index="4"></i>
  @endif
  @if($commentaire['nb_etoile']==4)
  <i class="star yellow fas fa-star" data-index="0"></i>
  <i class="star yellow fas fa-star" data-index="1"></i>
  <i class="star yellow fas fa-star" data-index="2"></i>
  <i class="star yellow fas fa-star" data-index="3"></i>
  <i class="star stargrey fas fa-star" data-index="4"></i>
  @endif
  @if($commentaire['nb_etoile']==5)
  <i class="star yellow fas fa-star" data-index="0"></i>
  <i class="star yellow fas fa-star" data-index="1"></i>
  <i class="star yellow fas fa-star" data-index="2"></i>
  <i class="star yellow fas fa-star" data-index="3"></i>
  <i class="star yellow fas fa-star" data-index="4"></i>
  @endif
<br>
</div>
@if($commentaire['commentaire1']!="")
<div>{{$commentaire['commentaire1']}}</div>
@endif
</div>
@endforeach
<div style="text-align: center;padding-bottom:50px">
    @if ($page==1 or $page=='')
    <a class="paginationa" href="">❮</a>
    <a class="paginationa" href={{$request->fullUrlWithQuery(['page' => 2]) }}>❯</a>
    @else
    <a class="paginationa" href={{$request->fullUrlWithQuery(['page' => $page-1]) }}>❮</a>
    <a class="paginationa" href={{$request->fullUrlWithQuery(['page' => $page+1]) }}>❯</a>
    @endif
    
    
    </div>

@endsection