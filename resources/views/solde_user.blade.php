@extends('navbar')
@section('content')


<br>
<h3 style="text-align: center">{{__('solde.details_solde')}}</h3>


<div style="padding: 20px">
@foreach ($details_soldes as $details_solde)
      @if($details_solde['IDCommande']!=0)
<div>
<div>{{__('solde.num_commande')}} : <strong>{{$details_solde['N_Commande']}}</strong></div>
<div>{{__('solde.acheteur')}} : <strong>{{$details_solde['Acheteur']}}</strong></div>
  @if($details_solde['Type']!='A')
@php
$montant=number_format($details_solde['MontantSansCommission'], 2, ',', ' ');
@endphp
<div>{{__('solde.montant')}} : <strong>{{$montant}} DH</strong></div>
  @else
@php
$montant_sans_comission=number_format($details_solde['MontantSansCommission'], 2, ',', ' ');
$montant_avec_comission=number_format($details_solde['MontantAvecCommission'], 2, ',', ' ');
@endphp
<div>{{__('solde.montant_sans_comission')}} : <strong>{{$montant_sans_comission}} DH</strong></div>
<div>{{__('solde.montant_avec_comission')}} : <strong>{{$montant_avec_comission}} DH</strong></div>

  @endif
</div>
<hr>
       @else
<div>
    <div>{{__('solde.num_commande')}} : <strong>{{__('solde.non_defini')}}</strong></div>
    <div>{{__('solde.acheteur')}} : <strong>{{__('solde.non_defini')}}</strong></div>
    @php
$montant=number_format($details_solde['MontantSansCommission'], 2, ',', ' ');
@endphp
<div>{{__('solde.montant')}} : <strong>{{$montant}} DH</strong></div>
</div>
<hr>
       @endif
@endforeach

</div>











@endsection