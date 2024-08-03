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
                            <label for="motif_refus">{{ __('Motif de refus') }}</label>
                            <textarea class="form-control" id="motif_refus" name="motif_refus" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir annuler cette facture ?');">{{ __('Annuler Facture') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
