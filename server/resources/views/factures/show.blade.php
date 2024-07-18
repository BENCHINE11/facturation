@extends('factures.layout')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">Facture #{{ $factures->id }}</div>
        <div class="card-body">
            <p><strong>Puissance appelée :</strong> {{ $factures->puissance_appelee }}</p>
            <p><strong>Cos phi :</strong> {{ $factures->cos_phi }}</p>
            <p><strong>Total HT :</strong> {{ $factures->total_HT }}</p>
            <p><strong>Total TVA :</strong> {{ $factures->total_TVA }}</p>
            <p><strong>Total TTC :</strong> {{ $factures->total_TTC }}</p>
        </div>
    </div>
</div>
@endsection
