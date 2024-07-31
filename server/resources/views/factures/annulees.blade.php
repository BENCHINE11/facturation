@extends('factures.layout')
@section('content')
    <div class="container">
        <div class="row" style="margin:20px;">
            <div class="col-12">
                <div class="card">
                    <div align="center" class="card-header">
                        <h2>Factures Annulées :</h2>
                    </div>
                    <div class="card-body w-full">
                        <a href="{{ url('/factures') }}" class="btn btn-success btn-sm" title="Retour aux Factures">
                            Retour aux Factures
                        </a><br><br>
                        <form method="GET" action="{{ url('/factures/annulees') }}" class="form-inline my-2 my-lg-0 float-right">
                            <input class="form-control mr-sm-2" type="search" name="search" placeholder="Rechercher" aria-label="Search"><br>
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
                                        <th>Annulée par</th>
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
                                            <td>{{ $facture->annulee_par}}</td>
                                            <td>
                                                <a href="{{ url('/factures/' . $facture->id)}}" title="Voir Relevé">
                                                    <button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> Voir</button>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {{ $factures->appends(['search' => Request::get('search')])->links() }} </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
