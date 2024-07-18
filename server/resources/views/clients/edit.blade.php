@extends('clients.layout')
@section('content')

<div class="card" style="margin:20px;">
    <div class="card-header">Modifier Client</div>
    <div class="card-body">
        <form action="{{ url('clients/' .$clients->id) }}" method="POST">
            {!! csrf_field() !!}
            @method("PATCH")
            <input type="hidden" name="id" id="id" value="{{ $clients->id }}" />
            <label for="">Code Client</label>
            <input type="text" name="ref_client" id="ref_client" value="{{ $clients->ref_client}}" class="form-control"><br>
            <label for="">Raison Sociale</label>
            <input type="text" name="raison_sociale" id="raison_sociale" value="{{ $clients->raison_sociale}}" class="form-control"><br>
            <label for="">CIN</label>
            <input type="text" name="cin" id="cin" value="{{ $clients->cin}}" class="form-control"><br>
            <label for="">ICE</label>
            <input type="text" name="ice" id="ice" value="{{ $clients->ice}}" class="form-control"><br>
            <label for="">Telephone</label>
            <input type="tel" name="telephone" id="telephone" value="{{ $clients->telephone}}" class="form-control"><br>
            <label for="">Adresse</label>
            <input type="text" name="adresse" id="adresse" value="{{ $clients->adresse}}" class="form-control"><br>
            <input type="submit" value="Update" class="btn btn-success"><br>
        </form>    
    </div>
</div>

@stop