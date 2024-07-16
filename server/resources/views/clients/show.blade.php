@extends('clients.layout')
@section('content')

<div class="card" style="margin:20px;">
    <div class="card-header">Client Infos</div>
    <div class="card-body">
        <h5 class="card-text" align="">{{ $clients->raison_sociale }}</h5>
        <p class="card-title">Code Client : {{ $clients->ref_client }}</p>
        <p class="card-text">CIN : {{ $clients->cin }}</p>
        <p class="card-text">ICE : {{ $clients->ice }}</p>
        <p class="card-text">Telephone : {{ $clients->telephone }}</p>
        <p class="card-text">Adresse : {{ $clients->adresse }}</p>
        <p class="card-text">Date de creation : {{ $clients->created_at }}</p>
        <p class="card-text">Dernière Modification : {{ $clients->updated_at }}</p>
    </div>
</div>
@stop