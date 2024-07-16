@extends('releves.layout')
@section('content')

<div class="card" style="margin:20px;">
    <div class="card-header">Informations du Relevé</div>
    <div class="card-body">
        <h5 class="card-title" align="">{{ $releves->id }}</h5>
        <p class="card-text">Mois de consommatioin : {{ $releves->periode_consommation }}</p>
        <p class="card-text">Reference du poste {{ $releves->poste->ref_poste }}</p>
        <ul>
            <li><p class="card-text">Index Monophasé 1 : {{ $releves->index_mono1 }}</p></li>
            <li><p class="card-text">Index Monophasé 2 : {{ $releves->index_mono2 }}</p></li>
            <li><p class="card-text">Index Monophasé 3 : {{ $releves->index_mono3 }}</p></li>
            <li><p class="card-text">Index Triphasé Jour : {{ $releves->index_triJ }}</p></li>
            <li><p class="card-text">Index Triphasé Nuit : {{ $releves->index_triN }}</p></li>
            <li><p class="card-text">Index Triphasé Pointe : {{ $releves->index_triP }}</p></li>
            <li><p class="card-text">Index Réactif : {{ $releves->index_reactif }}</p></li>
            <li><p class="card-text">Indicateur de Maximum : {{ $releves->indicateur_max }}</p></li>
        </ul>        
        <p class="card-text">Validé Le : {{ $releves->created_at }}</p>

    </div>
</div>
@stop