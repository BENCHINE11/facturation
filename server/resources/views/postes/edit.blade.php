@extends('postes.layout')
@section('content')

<div class="card" style="margin:20px;">
    <div class="card-header"><h1><b>Modifier poste</b></h1></div>
    <div class="card-body">
        <form action="{{ url('postes/' .$postes->id) }}" method="POST">
            {!! csrf_field() !!}
            @method("PATCH")
            <input type="hidden" name="id" id="id" value="{{ $postes->id }}" />
            <label for="">Reference poste</label>
            <input type="text" name="ref_poste" id="ref_poste" value="{{ $postes->ref_poste }}" class="form-control"><br>
            <label for="">Puissance Souscrite (kW)</label>
            <input type="text" name="puissance_souscrite" value="{{ $postes->puissance_souscrite }}" id="puissance_souscrite" class="form-control"><br>
            <label for="">Puissance Installee (kW)</label>
            <input type="text" name="puissance_installee" value="{{ $postes->puissance_installee }}" id="puissance_installee" class="form-control"><br>
            <label for="">Caution (MAD)</label>
            <input type="text" name="caution" id="caution" value="{{ $postes->caution }}" class="form-control"><br>
            <label for="">Minimum Garanti (kW)</label>
            <input type="text" name="min_garanti" id="min_garanti" value="{{ $postes->min_garanti }}" class="form-control"><br>
            <label for="">Port</label>
            <select name="id_port" id="id_port" class="form-control">
                @foreach($ports as $port)
                <option value="{{ $port->id }}" {{ $postes->port->id == $port->id ? 'selected' : '' }}>{{ $port->libelle_port }}</option>
                @endforeach
            </select><br>
            <label for="">Client</label>
            <select name="id_client" id="id_client" class="form-control">
                @foreach($clients as $client)
                <option value="{{ $client->id }}" {{ $postes->client->id == $client->id ? 'selected' : '' }}>{{ $client->raison_sociale }}</option>                @endforeach
            </select><br>
            <input type="submit" value="Modifier" class="btn btn-success" onclick="return confirm('Êtes-vous sûr de vouloir modifier ce poste ?');"><br>
        </form>    
    </div>
</div>

@stop