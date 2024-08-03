@extends('factures.layout')

@section('content')

<style>
    th, td {
        border: 1px solid black;
        padding: 8px;
        text-align: left;
    }
    .container-top {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
    }
    .left, .right {
        width: 45%;
    }
    .container-total {
        display: flex;
        justify-content: flex-end;
    }
</style>


<div class="container">
    <div class="card">
        <div class="card-header">Facture #{{ $factures->id }}</div>
        <div class="card-body">

            <a href="{{ route('factures.downloadPDF', $factures->id) }}" class="btn btn-success" style="margin-bottom: 20px;">
                Download PDF
            </a>

            <br>

            <div class="container-top">
                <div class="left">
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
                                <th>{{ $factures->id }}</th>
                                <th>{{ $factures->created_at }}</th>
                                @if ($factures->statut == 0)
                                    <th style="color: red;">Annulée</th>
                                @elseif ($factures->statut == 1)
                                    <th style="color: orange;">Impayée</th>
                                @else
                                    <th style="color: green;">Réglée</th>
                                @endif
                            </tr>
                        </tbody>
                    </table>
                </div>


                <div class="right">
                    <table>
                        <thead>
                            <tr>
                                <th>Code Client :</th>
                                <th>{{ $factures->releve->poste->client->ref_client }}</th>
                            </tr>
                            <tr>
                                <th>Nom Client :</th>
                                <th>{{ $factures->releve->poste->client->raison_sociale }}</th>
                            </tr>
                            <tr>
                                <th>Adresse Client :</th>
                                <th>{{ $factures->releve->poste->client->adresse }}</th>
                            </tr>
                            <tr>
                                @if (!$factures->releve->poste->client->cin)
                                    <th>ICE :</th>
                                    <th>{{ $factures->releve->poste->client->ice }}</th>
                                @elseif (!$factures->releve->poste->client->ice)
                                    <th>ICE :</th>
                                    <th>{{ $factures->releve->poste->client->ice }}</th>
                                @endif    
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            

            <br>

            <table>
                <thead>
                    <tr>
                        <th>Puissance appelée</th>
                        <th>Indicateur Maximum</th>
                        <th>Cos PHI</th>
                        <th>Minimum Garantie</th>
                        <th>Puissance Installée</th>
                        <th>Puissance Souscrite</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>{{ $factures->puissance_appelee }}</th>
                        <th>{{ $factures->releve->indicateur_max }}</th>
                        <th>{{ $factures->cos_phi }}</th>
                        <th>{{ $factures->releve->poste->min_garanti }}</th>
                        <th>{{ $factures->releve->poste->puissance_installee }}</th>
                        <th>{{ $factures->releve->poste->puissance_souscrite }}</th>
                    </tr>
                </tbody>
            </table>

            <br>

            <table>
                <thead>
                    <tr>
                        <th>Réf. Poste</th>
                        <th>Mois Facturation</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>{{ $factures->releve->poste->ref_poste }}</th>
                        <th>{{ $factures->releve->mois }}/{{ $factures->releve->annee }}</th>
                    </tr>
                </tbody>
            </table>

            <br>

            <hr>

            <h2><strong>Détails Facture : </strong></h2>
            <table style="width:100%; border-collapse: collapse;">
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
            
            <hr>
            <br>

            <div class="container-total">
                <table>
                    <thead>
                        <tr>
                            <th>Total HT</th>
                            <th>{{ $factures->total_HT }} dh</th>
                        </tr>
                        <tr>
                            <th>Total TR</th>
                            <th>{{ $factures->total_TR }} dh</th>
                        </tr>
                        <tr>
                            <th>Total TVA</th>
                            <th>{{ $factures->total_TVA }} dh</th>
                        </tr>
                        <tr>
                            <th>Total TTC</th>
                            <th>{{ $factures->total_TTC }} dh</th>
                        </tr>
                        <tr>
                            <td colspan="2"><strong>{{ number_to_currency_words($factures->total_TTC, 'fr', 'dirhams', 'centimes') }}</strong></td>
                        </tr>
                    </thead>
                </table>
            </div>

        </div>
    </div>
</div>
@endsection

