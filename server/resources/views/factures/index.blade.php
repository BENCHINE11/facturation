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
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Mois de Consommation</th>
                                        <th>Emise Le</th>
                                        <th>Total TTC</th>
                                        <th>Poste</th>
                                        <th>Statut</th>
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
                                            <td>
                                                <a href="{{ url('/factures/' . $facture->id)}}" title="Voir Relevé"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i>Voir</button></a>
                                                <form method="POST" action="{{ url('/factures' . '/' . $facture->id) }}" accept-charset="UTF-8" style="display:inline">
                                                    {{ method_field('DELETE') }}
                                                    {{ csrf_field() }}
                                                    <button type="submit" class="btn btn-danger btn-sm" title="Supprimer Relevé" onclick="return confirm("Confirmer supression?")"><i class="fa fa-trash-o" aria-hidden="true"></i> Supprimer</button>                            
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection