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

    .input_style input,
.input_style textarea,
.input_style select {
  border: solid var(--color-primary) 1px;
    border-radius: 10px;
    margin-top: 5px;
    color: var(--color-primary) !important;
    font-weight: 400 !important;
}

@media screen and (max-width:900px) {
  
  .container_add_livraison
  {
    width:80% !important;
  }
 
  
}
</style>
<div class="container container_add_livraison mt-5 mb-5 input_style" style="width:45%; margin:0 auto;">

    <h2 class="text-center" @if(App::getlocale()=="ar") style="" @endif>{{__('adresses_livraison.add_adresse')}} </h2>
    <form action={{route('add_adresses')}} method="POST" class="mt-5">
      @csrf
      <div class="mb-3 mt-3" @if(App::getlocale()=="ar") style="text-align: end" @endif>
        <label for="adresse">{{__('adresses_livraison.adresse')}} :</label>
       
        <input @if(App::getlocale()=="ar") style="text-align: end" @endif type="text" class="form-control @error('adresse') is-invalid @enderror" id="adresse"  name="adresse" value="{{ old('adresse') }}" required>
        
        @error('adresse')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
      </div>

      <div class="mb-3" @if(App::getlocale()=="ar") style="text-align: end" @endif>
        <label for="ville">{{__('adresses_livraison.ville')}} :</label>
       
        <select @if(App::getlocale()=="ar") style="text-align: end" @endif class="form-select form-control @error('ville') is-invalid @enderror" aria-label="Default select example" id="ville" name="ville" required onchange="select_ville()">
          <option selected></option>
        @foreach ($villes as $ville)
        @if(old('ville')==null)
       <option value="{{$ville['id']}}">{{$ville['displayName']}}</option>
       @else
       <option value="{{$ville['id']}}" @if ($ville['id']==old('ville')) {{"selected"}} @endif>{{$ville['displayName']}}</option>
       @endif
        @endforeach
        
         
        </select>       
        @error('ville')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
      </div>




      <div class="mb-3" @if(App::getlocale()=="ar") style="text-align: end" @endif>
        <label for="secteur">{{__('adresses_livraison.secteur')}} :</label>
       
        <select @if(App::getlocale()=="ar") style="text-align: end" @endif class="form-select form-control @error('secteur') is-invalid @enderror" aria-label="Default select example" id="secteur" name="secteur" required>
          <option selected></option> 
        </select>       
        @error('secteur')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
      </div>





      <div class="mb-3 mt-3" @if(App::getlocale()=="ar") style="text-align: end" @endif>
        <label for="code_postal">{{__('adresses_livraison.code_postal')}} :</label>
        <input @if(App::getlocale()=="ar") style="text-align: end" @endif type="text" class="form-control @error('code_postal') is-invalid @enderror" id="code_postal"  name="code_postal" value="{{ old('code_postal') }}" required>
        @error('code_postal')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
      </div>
      <button type="submit" class="btn_ajouter">{{__('adresses_livraison.valider')}} </button>
    </form>

  </div>
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





    
      
     
      
 