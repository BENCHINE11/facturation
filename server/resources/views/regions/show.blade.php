@extends('regions.layout')
@section('content')

<div class="card" style="margin:20px;">
    <div class="card-header">Informations Region</div>
    <div align="center" class="card-body">
        <h5 class="card-title" >{{ $regions->libelle_region }}</h5><br>
        <p class="card-text">Code Region : {{ $regions->code_region }}</p>
        <p class="card-text">Taxe Régionale : {{ $regions->taxe_regionale * 100 }} % </p>
        <p class="card-text">Date de creation : {{ $regions->created_at }}</p>
        <p class="card-text">Date de mise à jour : {{ $regions->updated_at }}</p>
    </div>
</div>
@stop