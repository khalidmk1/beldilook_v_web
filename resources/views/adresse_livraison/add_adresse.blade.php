@extends('navbar')
@section('content')
<div class="container mt-3">

    <h2>{{__('adresses_livraison.add_adresse')}} </h2>
    <form action={{route('add_adresses')}} method="POST">
      @csrf
      <div class="mb-3 mt-3">
        <label for="adresse">{{__('adresses_livraison.adresse')}} :</label>
       
        <input type="text" class="form-control @error('adresse') is-invalid @enderror" id="adresse"  name="adresse" value="{{ old('adresse') }}" required>
        
        @error('adresse')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="ville">{{__('adresses_livraison.ville')}} :</label>
       
        <select class="form-select form-control @error('ville') is-invalid @enderror" aria-label="Default select example" id="ville" name="ville" required onchange="select_ville()">
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




      <div class="mb-3">
        <label for="secteur">{{__('adresses_livraison.secteur')}} :</label>
       
        <select class="form-select form-control @error('secteur') is-invalid @enderror" aria-label="Default select example" id="secteur" name="secteur" required>
          <option selected></option> 
        </select>       
        @error('secteur')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
      </div>





      <div class="mb-3 mt-3">
        <label for="code_postal">{{__('adresses_livraison.code_postal')}} :</label>
        <input type="text" class="form-control @error('code_postal') is-invalid @enderror" id="code_postal"  name="code_postal" value="{{ old('code_postal') }}" required>
        @error('code_postal')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
      </div>
      <button type="submit" class="btn btn-primary">{{__('adresses_livraison.valider')}} </button>
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





    
      
     
      
 