@extends('postes.layout')
@section('content')
    <div class="container">
        <div class="row" style="margin:20px;">
            <div class="col-12">
                <div class="card">
                    <div align="center" class="card-header">
                        <h2>Postes : </h2>
                    </div>
                    <div class="card-body w-full">
                        <a href="{{ url('/postes/create') }}" class="btn btn-success btn-sm" title="Add Poste">
                            +Ajouter Nouveau
                        </a><br><br>
                        <form method="GET" action="{{ url('/postes') }}" class="form-inline my-2 my-lg-0 float-right">
                            <input class="form-control mr-sm-2" type="search" name="search" placeholder="Rechercher" aria-label="Search"><br>
                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Rechercher</button>
                        </form>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>REFERENCE</th>
                                        <th>CLIENT</th>
                                        <th>PORT</th>
                                        <th>P. SOUSCRITE</th>
                                        <th>P. INSTALLEE</th>
                                        <th>CAUTION</th>
                                        <th>MIN. GARANTI</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($postes as $poste)
                                        <tr>
                                            <td>{{ $poste->ref_poste }}</td>
                                            <td>{{ $poste->client ? $poste->client->raison_sociale : 'N/A' }}</td>
                                            <td>{{ $poste->port ? $poste->port->libelle_port : 'N/A' }}</td>
                                            <td>{{ $poste->puissance_souscrite }}</td>
                                            <td>{{ $poste->puissance_installee }}</td>
                                            <td>{{ $poste->caution }}</td>
                                            <td>{{ $poste->min_garanti }}</td>
                                            <td>
                                                <a href="{{ url('/postes/' . $poste->id)}}" title="View Poste"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i>Voir</button></a>
                                                <a href="{{ url('/postes/' . $poste->id . '/edit')}}" title="Edit Poste"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Modifier</button></a>
                                                <form method="POST" action="{{ url('/postes' . '/' . $poste->id) }}" accept-charset="UTF-8" style="display:inline">
                                                    {{ method_field('DELETE') }}
                                                    {{ csrf_field() }}
                                                    <button type="submit" class="btn btn-danger btn-sm" title="Supprimer Poste"><i class="fa fa-trash-o" aria-hidden="true"></i>Supprimer</button>                            
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {{ $postes->appends(['search' => Request::get('search')])->links() }} </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
