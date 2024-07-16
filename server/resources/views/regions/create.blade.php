@extends('regions.layout')
@section('content')

<div class="card" style="margin:20px;">
    <div class="card-header"><h1><b>Create New Region</b></h1></div>

    <div class="card-body">

        <form action="{{ url('regions') }}" method="post">
            {!! csrf_field() !!}
            <label for="">Code Région</label>
            <input type="text" name="code_region" id="code_region" class="form-control"><br>
            <label for="">Libellé </label>
            <input type="text" name="libelle_region" id="libelle_region" class="form-control"><br>
            <label for="">Taxe Régionale</label>
            <input type="text" name="taxe_regionale" id="taxe_regionale" class="form-control" placeholder="example: 0.123"><br>
            <input type="submit" value="Save" class="btn btn-success"><br>
        </form>
    </div>
</div>

@stop