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
                        </a>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Mois de Consommation</th>
                                        <th>Validé Le</th>
                                        <th>Ref Poste</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($releves as $releve)
                                        <tr>
                                            <td>{{ $releve->id }}</td>
                                            <td>{{ $releve->periode_consommation }}</td>
                                            <td>{{ $releve->created_at }}</td>
                                            <td>{{ $releve->poste->ref_poste }}</td>
                                            <td>
                                                <a href="{{ url('/releves/' . $releve->id)}}" title="Voir Relevé"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i>Voir</button></a>
                                                <form method="POST" action="{{ url('/releves' . '/' . $releve->id) }}" accept-charset="UTF-8" style="display:inline">
                                                    {{ method_field('DELETE') }}
                                                    {{ csrf_field() }}
                                                    <button type="submit" class="btn btn-danger btn-sm" title="Supprimer Relevé"><i class="fa fa-trash-o" aria-hidden="true"></i> Supprimer</button>                            
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