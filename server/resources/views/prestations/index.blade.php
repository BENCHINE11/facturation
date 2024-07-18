@extends('prestations.layout')
@section('content')
    <div class="container">
        <div class="row" style="margin:20px;">
            <div class="col-12">
                <div class="card">
                    <div align="center" class="card-header">
                        <h2>Prestations : </h2>
                    </div>
                    <div class="card-body w-full">
                        <a href="{{ url('/prestations/create') }}" class="btn btn-success btn-sm" title="Ajouter Prestation">
                            +Ajouter Nouvelle
                        </a>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Code Prestation</th>
                                        <th>Libellé</th>
                                        <th>Unité</th>
                                        <th>Tarif</th>
                                        <th>Taux TVA</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($prestations as $prestation)
                                        <tr>
                                            <td>{{ $prestation->code }}</td>
                                            <td>{{ $prestation->libelle }}</td>
                                            <td>{{ $prestation->unite }}</td>
                                            <td>{{ $prestation->tarif }}</td>
                                            <td>{{ $prestation->taux_TVA }} %</td>
                                            <td>
                                                <a href="{{ url('/prestations/' . $prestation->id)}}" title="Voir Relevé"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i>Voir</button></a>                                                
                                                <a href="{{ url('/prestations/' . $prestation->id . '/edit')}}" title="Modifier Prestation"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Modifier</button></a>
                                                <form method="POST" action="{{ url('/prestations' . '/' . $prestation->id) }}" accept-charset="UTF-8" style="display:inline">
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