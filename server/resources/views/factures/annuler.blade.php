@extends('factures.layout')
@section('content')
@extends('factures.layout')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Annuler Facture') }}</div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="POST" action="{{ url('/factures/annuler/' . $facture->id) }}">
                        @csrf
                        <div class="form-group">
                            <label for="motif_refus">{{ __('Motif annulation') }}</label>
                            <select class="form-control" id="motif_refus" name="motif_refus" required>
                                <option value="Erreur système">Erreur système</option>
                                <option value="Erreur taxateur">Erreur taxateur</option>
                                <option value="Double facturation">Double facturation</option>
                            </select>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir annuler cette facture ?');">{{ __('Annuler Facture') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
