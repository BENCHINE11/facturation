@extends('releves.layout')
@section('content')

<div class="card" style="margin:20px;">
    <div class="card-header"><h1><b>Créer Nouveau Relevé</b></h1></div>

    <div class="card-body">

        <form action="{{ url('releves') }}" method="post">
            {!! csrf_field() !!}
            <label for="">Poste</label>
            <select name="id_poste" id="id_poste" class="form-control">
                @foreach($postes as $poste)
                <option value="{{$poste->id}}">{{$poste->ref_poste}}</option>
                @endforeach
            </select><br>
            <label for="">Mois de Consommation</label>
            <input type="text" name="periode_consommation" id="periode_consommation" class="form-control"><br>
            <label for="">Index Monophasé 1</label>
            <input type="text" name="index_mono1" id="index_mono1" class="form-control"><br>
            <label for="">Index Monophasé 2</label>
            <input type="text" name="index_mono2" id="index_mono2" class="form-control"><br>
            <label for="">Index Monophasé 3</label>
            <input type="text" name="index_mono3" id="index_mono3" class="form-control"><br>
            <label for="">Index Triphasé Jour</label>
            <input type="tel" name="index_triJ" id="index_triJ" class="form-control"><br>
            <label for="">Index Triphasé Nuit</label>
            <input type="text" name="index_triN" id="index_triN" class="form-control"><br>
            <label for="">Index Triphasé Pointe</label>
            <input type="text" name="index_triP" id="index_triP" class="form-control"><br>
            <label for="">Index Réactif</label>
            <input type="text" name="index_reactif" id="index_reactif" class="form-control"><br>
            <label for="">Indicateur de Maximum</label>
            <input type="text" name="indicateur_max" id="indicateur_max" class="form-control"><br>
            <input type="submit" value="Ajouter" class="btn btn-success"><br>
        </form>
    </div>
</div>

@stop