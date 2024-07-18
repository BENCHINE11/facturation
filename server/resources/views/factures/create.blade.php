@extends('factures.layout')
@section('content')

<div class="card" style="margin:20px;">
    <div class="card-header"><h1><b>Créer Nouvelle Facture</b></h1></div>

    <div class="card-body">

        <form action="{{ url('factures') }}" method="post">
            {!! csrf_field() !!}
            
            <label for="id_poste">Poste</label>
            <select name="id_poste" id="id_poste" class="form-control">
                @foreach($postes as $poste)
                    <option value="{{$poste->id}}">{{$poste->ref_poste}}</option>
                @endforeach
            </select>
            <br>  

            <label for="id_releve">Relevé</label>
            <select name="id_releve" id="id_releve" class="form-control">
                @foreach($releves as $releve)
                    <option value="{{$releve->id}}">{{$poste->periode_consommation}}</option>
                @endforeach
            </select>
            <br>  
            <label for="">Energie </label>
            <label for="">Cos Phi</label>
            <input type="text" value="{{ $poste->releves->indicateur_max / (1 + $poste->releves) }}" />

            <input type="submit" value="Save" class="btn btn-success">
            <br>
        </form>
    </div>
</div>

@stop
