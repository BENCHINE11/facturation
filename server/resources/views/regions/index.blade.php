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
                        </a>
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
                                                <a href="{{ url('/regions/' . $region->id)}}" title="View Region"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i>View</button></a>
                                                <a href="{{ url('/regions/' . $region->id . '/edit')}}" title="Edit Region"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit</button></a>
                                                <form method="POST" action="{{ url('/regions' . '/' . $region->id) }}" accept-charset="UTF-8" style="display:inline">
                                                    {{ method_field('DELETE') }}
                                                    {{ csrf_field() }}
                                                    <button type="submit" class="btn btn-danger btn-sm" title="Delete Region" onclick="return confirm("Confirmer supression?")"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>                            
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