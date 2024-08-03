<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FACTURE N°{{ $factures->id }} PDF</title>
</head>
<body>
    <style>
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
    </style>

    <div style="display: flex; align-items: center; justify-content: space-between; text-align: center;">
        <div style="flex: 1;">
            ROYAUME DU MAROC <br>
            AGENCE NATIONALE DES PORTS
        </div>

        <br>

        <img src="{{ public_path('anp-logo.jpg') }}" alt="anp logo" style="width: 100px; height: auto;">
    </div>

    <div>
        Port : {{$factures->releve->poste->port->libelle_port}}
    </div>

    <br>

    <div class="container">
        <div class="card">
            <div class="card-body">

            <div style="display: flex; justify-content: space-between;">
                <div style="flex: 1;">
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
                                    <td style="color: orange;">Impayée</td>
                                @else
                                    <td style="color: green;">Réglée</td>
                                @endif
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div style="flex: 1;">
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
                        <tr>
                            <p>TOUS REGLEMENT EFFECTUE EN ESPECE EST SOUMIS AUX DROITS DE TIMBRE DE 0.25% DU MONTANT DE LA FACTURE.</p>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</body>
</html>

