@extends('postes.layout')
@section('content')

<div class="card" style="margin:20px;">
    <div class="card-header">Modifier poste</div>
    <div class="card-body">
        <form action="{{ url('postes/' .$postes->id) }}" method="POST">
            {!! csrf_field() !!}
            @method("PATCH")
            <input type="hidden" name="id" id="id" value="{{ $postes->id }}" />
            <label for="">Reference poste </label>
            <input type="text" name="ref_poste" id="ref_poste" value="{{ $postes->ref_poste }}" class="form-control"><br>
            <label for="">Puissance Souscrite</label>
            <input type="text" name="puissance_souscrite" value="{{ $postes->puissance_souscrite }}" id="puissance_souscrite" class="form-control"><br>
            <label for="">Puissance Installee</label>
            <input type="text" name="puissance_installee" value="{{ $postes->puissance_installee }}" id="puissance_installee" class="form-control"><br>
            <label for="">Caution</label>
            <input type="text" name="caution" id="caution" value="{{ $postes->caution }}" class="form-control"><br>
            <label for="">Minimum Garanti</label>
            <input type="text" name="min_garanti" id="min_garanti" value="{{ $postes->min_garanti }}" class="form-control"><br>
            <label for="">Port</label>
            <select name="id_port" id="id_port" class="form-control">
                @foreach($ports as $port)
                <option value="{{ $port->id }}">{{ $port->libelle_port }}</option>
                @endforeach
            </select><br>
            <label for="">Client</label>
            <select name="id_client" id="id_client" class="form-control">
                @foreach($clients as $client)
                <option value="{{ $client->id }}">{{ $client->raison_sociale }}</option>
                @endforeach
            </select><br>
            <input type="submit" value="Update" class="btn btn-success"><br>
        </form>    
    </div>
</div>

@stop