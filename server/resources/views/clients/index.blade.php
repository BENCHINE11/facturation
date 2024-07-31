@extends('clients.layout')
@section('content')
    <div class="container">
        <div class="row" style="margin:20px;">
            <div class="col-12">
                <div class="card">
                    <div align="center" class="card-header">
                        <h2>Clients : </h2>
                    </div>
                    <div class="card-body w-full">
                        <a href="{{ url('/clients/create') }}" class="btn btn-success btn-sm" title="Add Client">
                            +Ajouter Nouveau
                        </a><br><br>
                        <form method="GET" action="{{ url('/clients') }}" class="form-inline my-2 my-lg-0 float-right">
                            <input class="form-control mr-sm-2" type="search" name="search" placeholder="Rechercher" aria-label="Search"><br>
                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Rechercher</button>
                        </form>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Code</th>
                                        <th>Raison Sociale</th>
                                        <th>CIN</th>
                                        <th>ICE</th>
                                        <th>Telephone</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($clients as $client)
                                        <tr>
                                            <td>{{ $client->ref_client }}</td>
                                            <td>{{ $client->raison_sociale }}</td>
                                            <td>{{ $client->cin }}</td>
                                            <td>{{ $client->ice }}</td>
                                            <td>{{ $client->telephone }}</td>
                                            <td>
                                                <a href="{{ url('/clients/' . $client->id)}}" title="View Client"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i>Afficher</button></a>
                                                <a href="{{ url('/clients/' . $client->id . '/edit')}}" title="Edit Client"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Modifier</button></a>
                                                <form method="POST" action="{{ url('/clients' . '/' . $client->id) }}" accept-charset="UTF-8" style="display:inline">
                                                    {{ method_field('DELETE') }}
                                                    {{ csrf_field() }}
                                                    <button type="submit" class="btn btn-danger btn-sm" title="Delete Client"><i class="fa fa-trash-o" aria-hidden="true"></i>Supprimer</button>                            
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {{ $clients->appends(['search' => Request::get('search')])->links() }} </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
