@extends('factures.layout')
@section('content')

<div class="card" style="margin:20px;">
    <div class="card-header"><h1><b>Créer Nouvelle Facture</b></h1></div>

    <div class="card-body">
        <form action="{{ route('factures.store') }}" method="post">
            @csrf

            <label for="">Poste</label>
            <select name="id_poste" id="id_poste" class="form-control">
                @foreach($postes as $poste)
                <option value="{{ $recentReleve->poste->id }}">{{ $recentReleve->poste->ref_poste }}</option>
                @endforeach
            </select><br>

            <label for="">Mois</label>
            <input type="text" name="mois" value="{{ isset($recentReleve) ? DateTime::createFromFormat('!m', $recentReleve->mois)->format('F') : '' }}" class="form-control" readonly><br>
            
            <label for="">Année</label>
            <input type="text" name="annee" value="{{ isset($recentReleve) ? $recentReleve->annee : '' }}" class="form-control" readonly><br>

            <input type="submit" value="Enregistrer" class="btn btn-success"><br>
        </form>
    </div>
</div>

@stop