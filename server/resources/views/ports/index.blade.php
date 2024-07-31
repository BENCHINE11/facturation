@extends('ports.layout')
@section('content')
    <div class="container">
        <div class="row" style="margin:20px;">
            <div class="col-12">
                <div class="card">
                    <div align="center" class="card-header">
                        <h2>Ports : </h2>
                    </div>
                    <div class="card-body w-full">
                        <a href="{{ url('/ports/create') }}" class="btn btn-success btn-sm" title="Add Port">
                            +Ajouter Nouveau
                        </a><br><br>
                        <form method="GET" action="{{ url('/ports') }}" class="form-inline my-2 my-lg-0 float-right">
                            <input class="form-control mr-sm-2" type="search" name="search" placeholder="Rechercher" aria-label="Search"><br>
                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Rechercher</button>
                        </form>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>CODE</th>
                                        <th>LIBELLE</th>
                                        <th>REGION</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ports as $port)
                                        <tr>
                                            <td>{{ $port->code_port }}</td>
                                            <td>{{ $port->libelle_port }}</td>
                                            <td>{{ $port->region ? $port->region->libelle_region : 'Aucune région' }}</td>
                                            <td>
                                                <a href="{{ url('/ports/' . $port->id)}}" title="View Port"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i>Voir</button></a>
                                                <a href="{{ url('/ports/' . $port->id . '/edit')}}" title="Edit Port"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Modifier</button></a>
                                                <!-- <form method="POST" action="{{ url('/ports' . '/' . $port->id) }}" accept-charset="UTF-8" style="display:inline">
                                                    {{ method_field('DELETE') }}
                                                    {{ csrf_field() }}
                                                    <button type="submit" class="btn btn-danger btn-sm" title="Delete Port" onclick="return confirm('Confirmer suppression?')"><i class="fa fa-trash-o" aria-hidden="true"></i> Supprimer</button>                            
                                                </form> -->
                                            </td>
                                        </tr>
                                    @endforeach
                                    
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {{ $ports->appends(['search' => Request::get('search')])->links() }} </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
