@extends('regions.layout')
@section('content')
    <div class="container">
        <div class="row" style="margin:20px;">
            <div class="col-12">
                <div class="card">
                    <div align="center" class="card-header">
                        <h2>Regions : </h2>
                    </div>
                    <div class="card-body w-full">
                        <a href="{{ url('/regions/create') }}" class="btn btn-success btn-sm" title="Add Client">
                            +Ajouter Nouveau
                        </a><br><br>
                        <form method="GET" action="{{ url('/regions') }}" class="form-inline my-2 my-lg-0 float-right">
                            <input class="form-control mr-sm-2" type="search" name="search" placeholder="Rechercher" aria-label="Search"><br>
                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Rechercher</button>
                        </form>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Code</th>
                                        <th>Libellé</th>
                                        <th>Taxe Régionale</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($regions as $region)
                                        <tr>
                                            <td>{{ $region->code_region }}</td>
                                            <td>{{ $region->libelle_region }}</td>
                                            <td>{{ $region->taxe_regionale }}</td>
                                            <td>
                                                <a href="{{ url('/regions/' . $region->id)}}" title="View Region"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i>Afficher</button></a>
                                                <a href="{{ url('/regions/' . $region->id . '/edit')}}" title="Edit Region"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Modifier</button></a>
                                                
                                            </td>
                                        </tr>
                                    @endforeach
                                    
                                </tbody>
                            </table>
                            <div class="pagination-wrapper">
                                {{ $regions->appends(['search' => Request::get('search')])->links('vendor.pagination.bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection