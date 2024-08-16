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
                <option value="{{ $poste->id }}">{{ $poste->ref_poste }}</option>
                @endforeach
            </select><br>

            <label for="">Mois</label>
            <input type="text" name="mois" value="{{ isset($recentReleve) ? DateTime::createFromFormat('!m', $recentReleve->mois)->format('F') : '' }}" class="form-control" readonly><br>
            
            <label for="">Année</label>
            <input type="text" name="annee" value="{{ isset($recentReleve) ? $recentReleve->annee : '' }}" class="form-control" readonly><br>

            <input type="submit" value="Valider" class="btn btn-success" onclick="return confirm('Êtes-vous sûr de vouloir valider cette facture ?');"><br>
        </form>
    </div>
</div>

@stop
