@extends('prestations.layout')
@section('content')

<div class="card" style="margin:20px;">
    <div class="card-header"><h1><b>Créer Nouvelle Prestation</b></h1></div>

    <div class="card-body">

        <form action="{{ url('prestations') }}" method="post">
            {!! csrf_field() !!}
            <label for="">Code Prestation</label>
            <input type="text" name="code" id="code" class="form-control"><br>
            <label for="">Libellé Prestation</label>
            <input type="text" name="libelle" id="libelle" class="form-control"><br>
            <label for="">Unité</label>
            <input type="text" name="unite" id="unite" class="form-control"><br>
            <label for="">Tarif</label>
            <input type="text" name="tarif" id="tarif" class="form-control"><br>
            <label for="">Taux TVA</label>
            <input type="tel" name="taux_TVA" id="taux_TVA" class="form-control"><br>
            <input type="submit" value="Save" class="btn btn-success"><br>
        </form>
    </div>
</div>

@stop