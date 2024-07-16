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
                        </a>
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
                                                <a href="{{ url('/clients/' . $client->id)}}" title="View Client"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i>View</button></a>
                                                <a href="{{ url('/clients/' . $client->id . '/edit')}}" title="Edit Client"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit</button></a>
                                                <form method="POST" action="{{ url('/clients' . '/' . $client->id) }}" accept-charset="UTF-8" style="display:inline">
                                                    {{ method_field('DELETE') }}
                                                    {{ csrf_field() }}
                                                    <button type="submit" class="btn btn-danger btn-sm" title="Delete Client" onclick="return confirm("Confirmer supression?")"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>                            
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