@extends('navbar')
@section('content')

<style>

  .btn_ajouter{
        background-color: #212951;
        border: #212951;
        width: 100px;
        font-size: 17px;
        color: white;
        height: 40px;
        border-radius: 30px;
    }
  
    .btn_ajouter:hover{
        background-color: #283991;
        border: #283991;
    }
  </style>

<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>

<div class="container mt-3 mb-5">
    <h2>{{__('myaccount.title')}} </h2>
    <form action={{route('modifier_compte')}} method="POST" enctype="multipart/form-data">
      @csrf
    <div class="row justify-content-center">
      <div class="col" style="text-align: center">
        @if ($data['Photo_Logo']=='')
       <img style="border-radius: 50%" width="200" height="200" src="{{ asset('storage/user.png') }}" alt="" id="image_profile">
       @else
       <img style="border-radius: 50%" width="200" height="200" src="{{$data['Photo_Logo']}}" alt="" id="image_profile">
       @endif
      </div>
       <br><br>
       <div class="col position-absolute d-flex justify-content-center h-30">
        <img src="{{asset('storage/change-icon-png-0.jpg')}}" class="position-absolute" style="bottom: 80px;" height="40" alt="">
       @if(old('image')==null)
       <input name="image" type='file' style="height: 201px; z-index: 100; opacity: 0;" class="border-top-0 border-right-0 border-left-0 " accept="image/*" onchange="readURL(this);" />
       @else
       <input value="{{old('image')}}" style="height: 201px; z-index: 100; opacity:0" class="border-top-0 border-right-0 border-left-0" name="image" type='file' accept="image/*" onload="readURL(this)" onchange="readURL(this);" />
       @endif
       @error('image')
       <div style="color: red">{{$message}}</div>
       @enderror
      </div>
    </div>


    <div class="mb-3">
      <label for="sexe">{{__('myaccount.sexe')}} </label>
      @if(old('sexe')==null)
      <select class="form-select form-control border-top-0 border-right-0 border-left-0 @error('sexe') is-invalid @enderror" aria-label="Default select example" id="sexe" name="sexe" required>
        <option selected ></option>
        <option value="1" @if ('H'==$data['Sexe']) {{"selected"}} @endif>Homme</option>
        <option value="2" @if ('F'==$data['Sexe']) {{"selected"}} @endif>Femme</option>
      </select>
      @else
      <select class="form-select form-control border-top-0 border-right-0 border-left-0 @error('sexe') is-invalid @enderror" aria-label="Default select example" id="sexe" name="sexe" required>
        <option selected></option>
        <option value="1" @if ('1'==old('sexe')) {{"selected"}} @endif>Homme</option>
        <option value="2" @if ('2'==old('sexe'))  {{"selected"}} @endif>Femme</option>
      </select>
      @endif

      @error('sexe')
      <div class="invalid-feedback">{{$message}}</div>
      @enderror
    </div>

      <div class="mb-3 mt-3">
        <label for="prenom">{{__('myaccount.prenom')}} </label>
        @if(old('prenom')==null)
        <input type="text" class="form-control border-top-0 border-right-0 border-left-0 @error('prenom') is-invalid @enderror" id="prenom"  name="prenom" value="{{ $data['Prenom'] }}" required>
        @else
        <input type="text" class="form-control border-top-0 border-right-0 border-left-0 @error('prenom') is-invalid @enderror" id="prenom"  name="prenom" value="{{ old('prenom') }}" required>
        @endif
        @error('prenom')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="nom">{{__('myaccount.nom')}} </label>
        @if(old('nom')==null)
        <input type="text" class="form-control border-top-0 border-right-0 border-left-0 @error('nom') is-invalid @enderror" id="nom" name="nom" value="{{$data['Nom']}}" required>
        @else
        <input type="text" class="form-control border-top-0 border-right-0 border-left-0 @error('nom') is-invalid @enderror" id="nom" name="nom" value="{{old('nom')}}" required>
        @endif
        @error('nom')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
      </div>

      
      <div class="mb-3">
        <label for="telephone">{{__('myaccount.telephone')}} </label>
        @if(old('telephone')==null)
        <input type="text" class="form-control border-top-0 border-right-0 border-left-0 @error('telephone') is-invalid @enderror" id="telephone" name="telephone" value="{{$data['Telephone']}}" required>
        @else
        <input type="text" class="form-control border-top-0 border-right-0 border-left-0 @error('telephone') is-invalid @enderror" id="telephone" name="telephone" value="{{old('telephone')}}" required>
        @endif
        @error('telephone')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="pays">{{__('myaccount.pays')}} </label>
        <select class="form-select form-control border-top-0 border-right-0 border-left-0 @error('pays') is-invalid @enderror" aria-label="Default select example" id="pays" name="pays" required>
          <option selected></option>
        @foreach ($pays as $pay)
        @if(old('pays')==null)
       <option @if ($pay['sNom']==$data['Pays_Langue']) {{"selected"}} @endif>{{$pay['sNom']}}</option>
       @else
       <option @if ($pay['sNom']==old('pays')) {{"selected"}} @endif>{{$pay['sNom']}}</option>
       @endif
        @endforeach
        
         
        </select>

        @error('pays')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="ville">{{__('adresses_livraison.ville')}} </label>
       
        <select class="form-select form-control border-top-0 border-right-0 border-left-0 @error('ville') is-invalid @enderror" aria-label="Default select example" id="ville" name="ville" required onchange="select_ville()">
          <option selected></option>
        @foreach ($villes as $ville)
        @if(old('ville')==null)
       <option value="{{$ville['id']}}"  @if ($ville['id']==$data['id_ville']) {{"selected"}} @endif >{{$ville['displayName']}}</option>
       @else
       <option value="{{$ville['id']}}" @if ($ville['id']==old('ville')) {{"selected"}} @endif>{{$ville['displayName']}}</option>
       @endif
        @endforeach
        
         
        </select>       
        @error('ville')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
      </div>




      <div class="mb-3">
        <label for="secteur">{{__('adresses_livraison.secteur')}} </label>
       
        <select class="form-select form-control border-top-0 border-right-0 border-left-0 @error('secteur') is-invalid @enderror" aria-label="Default select example" id="secteur" name="secteur" required>
          <option selected></option> 
          @foreach ($secteurs as $secteur)
          @if(old('secteur')==null)
         <option value="{{$secteur['id']}}"  @if ($secteur['id']==$data['id_secteur']) {{"selected"}} @endif >{{$secteur['name']}}</option>
         @else
         <option value="{{$secteur['id']}}" @if ($secteur['id']==old('secteur')) {{"selected"}} @endif>{{$secteur['name']}}</option>
         @endif
          @endforeach
        </select>       
        @error('secteur')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
      </div>
      
      <div class="mb-3">
        <label for="adresse">{{__('myaccount.adresse')}} </label>
        @if(old('adresse')==null)
        <input type="text" class="form-control border-top-0 border-right-0 border-left-0 @error('adresse') is-invalid @enderror" id="adresse" name="adresse" value="{{$data['adresse1']}}" required>
        @else
        <input type="text" class="form-control border-top-0 border-right-0 border-left-0 @error('adresse') is-invalid @enderror" id="adresse" name="adresse" value="{{old('adresse')}}" required>
        @endif
        @error('adresse')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
      </div>
@php
    $user=Session::get('user');
   // dd($user);
@endphp
@if ($user['Type']!='A')
      <div class="mb-3">
        <label for="adresse2">{{__('myaccount.adresse2')}} </label>
        @if(old('adresse2')==null)
        <input type="text" class="form-control border-top-0 border-right-0 border-left-0 @error('adresse2') is-invalid @enderror" id="adresse2" name="adresse2" value="{{$data['adresse2']}}" required>
        @else
        <input type="text" class="form-control border-top-0 border-right-0 border-left-0 @error('adresse2') is-invalid @enderror" id="adresse2" name="adresse2" value="{{old('adresse2')}}" required>
        @endif
        @error('adresse2')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
      </div>
@endif
      <button type="submit" class="btn_ajouter">{{__('myaccount.valider')}} </button>
    </form>
  </div>

  <script>
    function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
      $('#image_profile')
        .attr('src', e.target.result);
    };
    reader.readAsDataURL(input.files[0]);
  }
}
</script>

@endsection


<script>
  function select_ville()
  {
    
    var idville=$('#ville').val();
    
    var _token=$('input[name="_token"]').val();
           $.ajax({
       url:("{{route('select_ville')}}"),
       method:"POST",
       data:{id_ville:idville,
       _token:_token,
       },
       success:function(data)
       {
        $('#secteur')
    .find('option')
    .remove()
    .end()
    .append('<option ></option>')
    .val('')
;
$.each(data, function (i, sector) {
    $('#secteur').append($('<option>', { 
        value: sector['id'],
        text : sector['name'] 
    }));
});
     console.log(data);
       }
       ,error:function(error)
{
// error alert message


}
       });
  }
</script>