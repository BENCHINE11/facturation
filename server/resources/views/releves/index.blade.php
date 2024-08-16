@extends('releves.layout')
@section('content')
    <div class="container">
        <div class="row" style="margin:20px;">
            <div class="col-12">
                <div class="card">
                    <div align="center" class="card-header">
                        <h2>Relevés : </h2>
                    </div>
                    <div class="card-body w-full">
                        <a href="{{ url('/releves/create') }}" class="btn btn-success btn-sm" title="Ajouter Releve">
                            +Ajouter Nouveau
                        </a><br><br>
                        <form method="GET" action="{{ url('/releves') }}" class="form-inline my-2 my-lg-0 float-right">
                            <input class="form-control mr-sm-2" type="search" name="search" placeholder="Rechercher" aria-label="Search"><br>
                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Rechercher</button>
                        </form>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Mois de Consommation</th>
                                        <th>Validé Le</th>
                                        <th>Client</th>
                                        <th>Port</th>
                                        <th>Ref Poste</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($releves as $releve)
                                        <tr>
                                            <td>{{ $releve->id }}</td>
                                            <td>{{ $releve->mois }} / {{ $releve->annee }}</td>
                                            <td>{{ $releve->created_at }}</td>
                                            <td>{{ $releve->poste->client->raison_sociale }}</td>
                                            <td>{{ $releve->poste->port->libelle_port }}</td>
                                            <td>{{ $releve->poste->ref_poste }}</td>
                                            <td>
                                                <a href="{{ url('/releves/' . $releve->id)}}" title="Voir Relevé"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i>Voir</button></a>
                                                <form method="POST" action="{{ url('/releves' . '/' . $releve->id) }}" accept-charset="UTF-8" style="display:inline">
                                                    {{ method_field('DELETE') }}
                                                    {{ csrf_field() }}
                                                    <button type="submit" class="btn btn-danger btn-sm" title="Supprimer Relevé" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce relevé ?');"><i class="fa fa-trash-o" aria-hidden="true"</i> Supprimer</button>                            
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper">
                                {{ $releves->appends(['search' => Request::get('search')])->links('vendor.pagination.bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection