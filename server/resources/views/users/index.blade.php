@extends('users.layout')
@section('content')
    <div class="container">
        <div class="row" style="margin:20px;">
            <div class="col-12">
                <div class="card">
                    <div align="center" class="card-header">
                        <h2>Users : </h2>
                    </div>
                    <div class="card-body w-full">
                        <a href="{{ url('/users/create') }}" class="btn btn-success btn-sm" title="Ajouter Utilisateur">
                            +Ajouter Nouveau
                        </a><br><br>
                        <form method="GET" action="{{ url('/users') }}" class="form-inline my-2 my-lg-0 float-right">
                            <input class="form-control mr-sm-2" type="search" name="search" placeholder="Rechercher" aria-label="Search"><br>
                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Rechercher</button>
                        </form>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>NOM</th>
                                        <th>PRENOM</th>
                                        <th>TELEPHONE</th>
                                        <th>ROLE</th>
                                        <th>PORT</th>
                                        <th>ETAT</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td>{{ $user->nom }}</td>
                                            <td>{{ $user->prenom }}</td>
                                            <td>{{ $user->telephone }}</td>
                                            <td>{{ $user->role }}</td>
                                            <td>{{ $user->port ? $user->port->libelle_port : 'N/A' }}</td>
                                            <td>
                                                @if ($user->etat == 1)
                                                    <span style="color: green;">Activé</span>
                                                @else
                                                    <span style="color: red;">Désactivé</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ url('/users/' . $user->id)}}" title="Voir Utilisateur"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i>Voir</button></a>
                                                <a href="{{ url('/users/' . $user->id . '/edit')}}" title="Modifier Utilisateur"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Modifier</button></a>
                                                @if ($user->etat == 1)
                                                <form method="POST" action="{{ url('/users' . '/' . $user->id) }}" accept-charset="UTF-8" style="display:inline">
                                                    {{ method_field('DELETE') }}
                                                    {{ csrf_field() }}
                                                    <button type="submit" class="btn btn-danger btn-sm" title="Déactiver Utilisateur"><i class="fa fa-trash-o" aria-hidden="true"></i> Désactiver</button>                            
                                                </form>
                                                @else
                                                <form method="POST" action="{{ url('/users' . '/' . $user->id) }}" accept-charset="UTF-8" style="display:inline">
                                                    {{ method_field('DELETE') }}
                                                    {{ csrf_field() }}
                                                    <button type="submit" class="btn btn-success btn-sm" title="Réactiver Utilisateur"><i class="fa fa-trash-o" aria-hidden="true"></i> Activer</button>                            
                                                </form>
                                                @endif
                                                <form method="POST" action="{{ url('/users/delete/' . $user->id) }}" accept-charset="UTF-8" style="display:inline">
                                                    {{ method_field('DELETE') }}
                                                    {{ csrf_field() }}
                                                    <button type="submit" class="btn btn-danger btn-sm" title="Supprimer Utilisateur"><i class="fa fa-trash" aria-hidden="true"></i> Supprimer</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper">
                                {{ $users->appends(['search' => Request::get('search')])->links('vendor.pagination.bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
