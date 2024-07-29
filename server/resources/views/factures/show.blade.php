@extends('factures.layout')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">Facture #{{ $factures->id }}</div>
        <div class="card-body">
            <p><strong>Mois :</strong> {{ $factures->mois }}</p>
            <p><strong>Année :</strong> {{ $factures->annee }}</p>
            <p><strong>Poste :</strong> {{ $factures->releve->poste->ref_poste }}</p>
            <p><strong>Puissance appelée :</strong> {{ $factures->puissance_appelee }}</p>
            <p><strong>Cos phi :</strong> {{ $factures->cos_phi }}</p>

            <style>
                table {
                    width: 100%;
                    border-collapse: collapse;
                }
                th, td {
                    border: 1px solid black;
                    padding: 8px;
                    text-align: left;
                }
            </style>

            <span>
                <table>
                    <thead>
                        <tr>
                            <th>N° Facture</th>
                            <th>Date d'Emission</th>
                            <th>Statut Facture</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $factures->id }}</td>
                            <td>{{ $factures->created_at }}</td>
                            @if ($factures->statut == 0)
                                <td style="color: red;">Annulée</td>
                            @elseif ($factures->statut == 1)
                                <td style="color: yellow;">Non Encaissée</td>
                            @else
                                <td style="color: green;">Encaissée</td>
                            @endif
                        </tr>
                    </tbody>
                </table>
            </span>

            <h2><strong>Total : </strong></h2>
            <table>
                <thead>
                    <tr>
                        <th>Total HT</th>
                        <th>Total TR</th>
                        <th>Total TVA</th>
                        <th>Total TTC</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $factures->total_HT }} dh</td>
                        <td>{{ $factures->total_TR }} dh</td>
                        <td>{{ $factures->total_TVA }} dh</td>
                        <td>{{ $factures->total_TTC }} dh</td>
                    </tr>
                </tbody>
            </table>

            <strong>--------------------------------------------------------------------------------------------------------------------------------</strong>

            <h2><strong>Détails Facture : </strong></h2>
            <table>
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Libellé</th>
                        <th>Quantité</th>
                        <th>Unité</th>
                        <th>Tarif</th>
                        <th>Montant HT</th>
                        <th>Taux TVA</th>
                        <th>Montant TVA</th>
                        <th>Ancien Index</th>
                        <th>Nouvel Index</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($factures->details_factures as $details_facture)
                    <tr>
                        @foreach ($prestations as $prestation)
                            @if ($details_facture->code_prestation == $prestation->code)
                                <td>{{ $details_facture->code_prestation }}</td>
                                <td>{{ $prestation->libelle }}</td>
                                <td>{{ $details_facture->quantite }}</td>
                                <td>{{ $prestation->unite }}</td>
                                <td>{{ $prestation->tarif }}</td>
                                <td>{{ $details_facture->montant_ht }}</td>
                                <td>{{ $prestation->taux_TVA }}</td>
                                <td>{{ $details_facture->montant_tva }}</td>
                                <td>{{ $details_facture->ancien_index }}</td>
                                <td>{{ $details_facture->nouvel_index }}</td>
                            @endif
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <strong>--------------------------------------------------------------------------------------------------------------------------------</strong>
        </div>
    </div>
</div>
@endsection
