@extends('factures.layout')
@section('content')

<div class="card" style="margin:20px;">
    <div class="card-header"><h1><b>Créer Nouvelle Facture</b></h1></div>

    <div class="card-body">
        <form action="{{ route('factures.store') }}" method="post">
            @csrf

            <label for="">Poste</label>
            <select name="poste_id" id="poste_id" class="form-control">
                @foreach($postes as $poste)
                <option value="{{ $poste->id }}">{{ $poste->ref_poste }}</option>
                @endforeach
            </select><br>

            <label for="">Mois</label>
            <input type="text" value="{{ isset($recentReleve) ? DateTime::createFromFormat('!m', $recentReleve->mois)->format('F') : '' }}" class="form-control" readonly><br>
            
            <label for="">Année</label>
            <input type="text" value="{{ isset($recentReleve) ? $recentReleve->annee : '' }}" class="form-control" readonly><br>

            <label for="">Total TTC (DH)</label>
            <input type="text" value="{{ number_format($total_TTC, 2) }}" class="form-control" readonly><br>

            <label for="">Total HT (DH)</label>
            <input type="text" value="{{ number_format($total_HT, 2) }}" class="form-control" readonly><br>

            <label for="">Total TVA (DH)</label>
            <input type="text" value="{{ number_format($total_TVA, 2) }}" class="form-control" readonly><br>

            <label for="">Total TR (DH)</label>
            <input type="text" value="{{ number_format($total_TR, 2) }}" class="form-control" readonly><br>

            <label for="">Consommation Jour</label>
            <input type="text" value="{{ $consommationJour }}" class="form-control" readonly><br>

            <label for="">Consommation Nuit</label>
            <input type="text" value="{{ $consommationNuit }}" class="form-control" readonly><br>

            <label for="">Consommation Pointe</label>
            <input type="text" value="{{ $consommationPointe }}" class="form-control" readonly><br>

            <label for="">Consommation Réactif</label>
            <input type="text" value="{{ $consommationReactif }}" class="form-control" readonly><br>

            <label for="">Puissance Appelée</label>
            <input type="text" name="puissance_appelee" value="{{ number_format($pa, 3) }}" class="form-control" readonly><br>

            <label for="">Cos Phi</label>
            <input type="text" name="cos_phi" value="{{ number_format($cos_phi, 20) }}" class="form-control" readonly><br>            

            <label for="">Indicateur de Maximum</label>
            <input type="text" value="{{ $recentReleve->indicateur_max }}" class="form-control" readonly><br>  
            
            <label for="">Energie Active Jour</label>
            <input type="text" name="e_active_jour" value="{{ number_format($e_active_jour_actuel, 2) }}" class="form-control" readonly><br>

            <label for="">Energie Active Nuit</label>
            <input type="text" name="e_active_nuit" value="{{ number_format($e_active_nuit_actuel, 2) }}" class="form-control" readonly><br>

            <label for="">Energie Active Pointe</label>
            <input type="text" name="e_active_pointe" value="{{ number_format($e_active_pointe_actuel, 2) }}" class="form-control" readonly><br>

            <label for="">Majoration pour déphasage</label>
            <input type="text" value="{{ number_format($v, 2) }}" class="form-control" readonly><br>

            <input type="hidden" name="id_releve" value="{{ $recentReleve->id }}">
            <input type="hidden" name="mois" value="{{ $recentReleve->mois }}">
            <input type="hidden" name="annee" value="{{ $recentReleve->annee }}">
            <input type="hidden" name="consommation_jour" value="{{ $consommationJour }}">
            <input type="hidden" name="consommation_nuit" value="{{ $consommationNuit }}">
            <input type="hidden" name="consommation_pointe" value="{{ $consommationPointe }}">
            <input type="hidden" name="consommation_reactif" value="{{ $consommationReactif }}">
            <input type="hidden" name="e_active_jour_actuel" value="{{ $e_active_jour_actuel }}">
            <input type="hidden" name="e_active_nuit_actuel" value="{{ $e_active_nuit_actuel }}">
            <input type="hidden" name="e_active_pointe_actuel" value="{{ $e_active_pointe_actuel }}">
            <input type="hidden" name="rdps" value="{{ $rdps }}">
            <input type="hidden" name="total_HT" value="{{ $total_HT }}">
            <input type="hidden" name="total_TVA" value="{{ $total_TVA }}">
            <input type="hidden" name="total_TR" value="{{ $total_TR }}">
            <input type="hidden" name="total_TTC" value="{{ $total_TTC }}">

            <input type="submit" value="Enregistrer" class="btn btn-success"><br>
        </form>
    </div>
</div>

@stop
