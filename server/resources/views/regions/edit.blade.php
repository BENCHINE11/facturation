@extends('regions.layout')
@section('content')

<div class="card" style="margin:20px;">
    <div class="card-header"><h1><b>Modifier Region</b></h1></div>
    <div class="card-body">
        <form action="{{ url('regions/' .$regions->id) }}" method="POST">
            {!! csrf_field() !!}
            @method("PATCH")
            <input type="hidden" name="id" id="id" value="{{ $regions->id }}" />
            <label for="">Code Region</label>
            <input type="text" name="code_region" id="code_region" value="{{ $regions->code_region}}" class="form-control"><br>
            <label for="">Libellé Region</label>
            <input type="text" name="libelle_region" id="libelle_region" value="{{ $regions->libelle_region}}" class="form-control"><br>
            <label for="">Taxe Regionale</label>
            <input type="text" name="taxe_regionale" id="taxe_regionale" value="{{ $regions->taxe_regionale}}" class="form-control"><br>
            <input type="submit" value="Modifier" class="btn btn-success" onclick="return confirm('Êtes-vous sûr de vouloir modifier cette region ?');"><br>
        </form>    
    </div>
</div>

@stop