@extends('clients.layout')
@section('content')

<div class="card" style="margin:20px;">
    <div class="card-header"><h1><b>Créer Nouveau Client</b></h1></div>

    <div class="card-body">

        <form action="{{ url('clients') }}" method="post">
            {!! csrf_field() !!}
            <label for="">Code Client</label>
            <input type="text" name="ref_client" id="ref_client" class="form-control"><br>
            <label for="">Raison Sociale</label>
            <input type="text" name="raison_sociale" id="raison_sociale" class="form-control"><br>
            <label for="">CIN</label>
            <input type="text" name="cin" id="cin" class="form-control"><br>
            <label for="">ICE</label>
            <input type="text" name="ice" id="ice" class="form-control"><br>
            <label for="">Telephone</label>
            <input type="tel" name="telephone" id="telephone" class="form-control"><br>
            <label for="">Adresse</label>
            <input type="text" name="adresse" id="adresse" class="form-control"><br>
            <input type="submit" value="Save" class="btn btn-success"><br>
        </form>
    </div>
</div>

@stop