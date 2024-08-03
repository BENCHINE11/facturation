@extends('ports.layout')
@section('content')

<div class="card" style="margin:20px;">
    <div class="card-header">Informations Port</div>
    <div align="center" class="card-body">
        <h5 class="card-title">{{ $ports->libelle_port }}</h5><br>

        <p class="card-text">Code Port : {{ $ports->code_port }}</p>
        <p class="card-text">Région : <b><a href="{{ url('/regions/' . $ports->region->id)}}">{{ $ports->region->libelle_region }} </a></b></p>
        <p class="card-text">Date de creation : {{ $ports->created_at }}</p>
        <p class="card-text">Date de creation : {{ $ports->updated_at }}</p>
    </div>
</div>
@stop