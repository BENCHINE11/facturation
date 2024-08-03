@extends('factures.layout')
@section('content')
    <div class="container">
        <div class="row" style="margin:20px;">
            <div class="col-12">
                <div class="card">
                    <div align="center" class="card-header">
                        <h2>Factures : </h2>
                    </div>
                    <div class="card-body w-full">
                        <a href="{{ url('/factures/create') }}" class="btn btn-success btn-sm" title="Ajouter Facture">
                            +Ajouter Nouveau
                        </a>
                        <a href="{{ url('/factures/annulees') }}" class="btn btn-danger btn-sm" title="Voir Factures Annulées">
                            Voir Factures Annulées
                        </a><br><br>
                        <form method="GET" action="{{ url('/factures') }}" class="form-inline my-2 my-lg-0 float-right">
                            <input class="form-control mr-sm-2" type="search" name="search" placeholder="Rechercher" aria-label="Search">
                            <label>Date Début</label><input class="form-control mr-sm-2" type="text" name="date_debut" placeholder="MM/YYYY" aria-label="Date Début">
                            <label>Date Fin</label><input class="form-control mr-sm-2" type="text" name="date_fin" placeholder="MM/YYYY" aria-label="Date Fin">
                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Rechercher</button>
                        </form>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Mois de Consommation</th>
                                        <th>Emise Le</th>
                                        <th>Total TTC</th>
                                        <th>Client</th>
                                        <th>Poste</th>
                                        <th>Statut</th>
                                        <th>Crée par</th>
                                        <th>Réglée par</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($factures as $facture)
                                        <tr>
                                            <td>{{ $facture->id }}</td>
                                            <td>{{ $facture->mois }} / {{ $facture->annee }}</td>
                                            <td>{{ $facture->created_at }}</td>
                                            <td>{{ $facture->total_TTC }}</td>
                                            <td>{{ $facture->releve->poste->client->raison_sociale }}</td>
                                            <td>{{ $facture->releve->poste->ref_poste }}</td>
                                            <td>
                                                @if ($facture->statut == 0)
                                                    <span style="color: red;">Annulée</span>
                                                @elseif ($facture->statut == 1)
                                                    <span style="color: orange;">Impayée</span>
                                                @else
                                                    <span style="color: green;">Réglée</span>
                                                @endif
                                            </td>
                                            <td>{{ $facture->cree_par }}</td>
                                            <td>{{ $facture->reglee_par }}</td>
                                            <td>
                                                <a href="{{ url('/factures/' . $facture->id)}}" title="Voir Relevé">
                                                    <button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> Voir</button>
                                                </a>
                                                @if ($facture->statut == 1 )
                                                <a href="{{ url('/factures/encaisser/' . $facture->id) }}" class="btn btn-success btn-sm" title="Encaisser Facture">
                                                    <i class="fa fa-check" aria-hidden="true"></i> Encaisser
                                                </a>
                                                <form method="GET" action="{{ url('/factures/annuler/' . $facture->id) }}" accept-charset="UTF-8" style="display:inline">
                                                    {{ csrf_field() }}
                                                    <button type="submit" class="btn btn-warning btn-sm" title="Annuler Facture"><i class="fa fa-ban" aria-hidden="true"></i> Annuler</button>
                                                </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper">
                                {{ $factures->appends(['search' => Request::get('search'), 'date_debut' => Request::get('date_debut'), 'date_fin' => Request::get('date_fin')])->links('vendor.pagination.bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
