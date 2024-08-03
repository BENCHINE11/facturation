@extends('factures.layout')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Encaisser Facture') }}</div>
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
                    <form method="POST" action="{{ url('/factures/encaisser/' . $facture->id) }}">
                        @csrf
                        <div class="form-group">
                            <label for="mode_reglement">{{ __('Mode de règlement') }}</label>
                            <select class="form-control" id="mode_reglement" name="mode_reglement" required>
                                <option value="cash">Espèces</option>
                                <option value="virement">Virement bancaire</option>
                                <option value="check">Chèque</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="montant">{{ __('Montant payé') }}</label>
                            <input type="number" step="0.01" class="form-control" id="montant" name="montant" required>
                        </div>
                        <button type="submit" class="btn btn-primary" onclick="return confirm('Êtes-vous sûr de vouloir encaisser cette facture ?');">{{ __('Encaisser') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
