@extends('clients.layout')
@section('content')

<div class="card" style="margin:20px;">
    <div class="card-header">Client Infos</div>
    <div class="card-body" align="center">
        <h5 class="card-text">{{ $clients->raison_sociale }}</h5>
        <p class="card-title">Code Client : {{ $clients->ref_client }}</p>
        <p class="card-text">CIN : {{ $clients->cin }}</p>
        <p class="card-text">ICE : {{ $clients->ice }}</p>
        <p class="card-text">Telephone : {{ $clients->telephone }}</p>
        <p class="card-text">Adresse : {{ $clients->adresse }}</p>
        <p class="card-text">Date de creation : {{ $clients->created_at }}</p>
        <p class="card-text">Dernière Modification : {{ $clients->updated_at }}</p>
        <h5 class="card-title mt-4">Postes du Client</h5>
        <ul class="list-group">
            @foreach($clients->poste as $poste)
                <li class="list-group-item">
                Reference: <a href="{{ url('postes/' . $poste->id) }}">{{ $poste->ref_poste }}</a> | Port: {{ $poste->port->libelle_port }}
                </li>
            @endforeach
        </ul>
    </div>
</div>
@stop