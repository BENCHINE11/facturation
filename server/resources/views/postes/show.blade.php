@extends('postes.layout')
@section('content')

<div class="card" style="margin:20px;">
    <div class="card-header">Informations Poste</div>
    <div align="center" class="card-body">
        <h5 class="card-title">{{ $postes->ref_poste }}</h5><br>

        <p class="card-text">P. Souscrite : {{ $postes->puissance_souscrite }} </p>
        <p class="card-text">P. Installée : {{ $postes->puissance_installee }}</p>
        <p class="card-text">Caution : {{ $postes->caution }} MAD</p>
        <p class="card-text">Minimum Garanti : {{ $postes->min_garanti }}</p>
        <p class="card-text">Port : <b><a href="{{ url('/ports/' . $postes->port->id)}}">{{ $postes->port->libelle_port }} </a></b></p>
        <p class="card-text">Client : <b><a href="{{ url('/clients/' . $postes->client->id)}}">{{ $postes->client->raison_sociale }} </a></b></p>
        <p class="card-text">Date de creation : {{ $postes->created_at }}</p>
        <p class="card-text">Date de creation : {{ $postes->updated_at }}</p>
    </div>
</div>
@stop