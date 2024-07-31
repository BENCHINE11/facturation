@extends('prestations.layout')
@section('content')

<div class="card" style="margin:20px;">
    <div class="card-header">Informations de la Prestation</div>
    <div align="center" class="card-body">
        <h5 class="card-title" align="">{{ $prestations->libelle }}</h5> <br>
        <p class="card-text">Code : {{ $prestations->code }}</p>
        <p class="card-text">Unite : {{ $prestations->unite }}</p>
        <p class="card-text">Tarif : {{ $prestations->tarif }} MAD</p>
        <p class="card-text">Taux TVA : {{ $prestations->taux_TVA }}%</p>
        <p class="card-text">Créé Le : {{ $prestations->created_at }}</p>
        <p class="card-text">Dernière Modification: {{ $prestations->updated_at }} par: {{ $prestations->last_modified_by }}</p>
    </div>
</div>
@stop