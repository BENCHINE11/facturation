@extends('prestations.layout')
@section('content')

<div class="card" style="margin:20px;">
    <div class="card-header">Modifier Prestation</div>
    <div class="card-body">
        <form action="{{ url('prestations/' .$prestations->id) }}" method="POST">
            {!! csrf_field() !!}
            @method("PATCH")
            <input type="hidden" name="id" id="id" value="{{ $prestations->id }}" />
            <label for="">Code Prestation</label>
            <input type="text" name="code" id="code" value="{{ $prestations->code}}" class="form-control"><br>
            <label for="">Libellé Prestation</label>
            <input type="text" name="libelle" id="libelle" value="{{ $prestations->libelle}}" class="form-control"><br>
            <label for="">Unité</label>
            <input type="text" name="unite" id="unite" value="{{ $prestations->unite}}" class="form-control"><br>
            <label for="">Tarif</label>
            <input type="text" name="tarif" id="tarif" value="{{ $prestations->tarif}}" class="form-control"><br>
            <label for="">Taux TVA</label>
            <input type="tel" name="taux_TVA" id="taux_TVA" value="{{ $prestations->taux_TVA}}" class="form-control"><br>
            <input type="submit" value="Update" class="btn btn-success"><br>
        </form>    
    </div>
</div>

@stop