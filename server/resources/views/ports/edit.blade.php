@extends('ports.layout')
@section('content')

<div class="card" style="margin:20px;">
    <div class="card-header">Edit Port</div>
    <div class="card-body">
        <form action="{{ url('ports/' .$ports->id) }}" method="POST">
            {!! csrf_field() !!}
            @method("PATCH")
            <input type="hidden" name="id" id="id" value="{{ $ports->id }}" />
            <label for="">Code Port</label>
            <input type="text" name="code_port" id="code_port" value="{{ $ports->code_port}}" class="form-control"><br>
            <label for="">Libellé Port</label>
            <input type="text" name="libelle_port" id="libelle_port" value="{{ $ports->libelle_port}}" class="form-control"><br>
            <label for="">Region</label>
            <select name="id_region" id="id_region" class="form-control">
                @foreach($regions as $region)
                <option value="{{ $region->id }}" {{ $ports->region->id == $region->id ? 'selected' : '' }}>{{ $region->libelle_region }}</option>
                @endforeach
            </select><br>
            <input type="submit" value="Update" class="btn btn-success"><br>
        </form>    
    </div>
</div>

@stop