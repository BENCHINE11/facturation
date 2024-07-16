@extends('ports.layout')
@section('content')

<div class="card" style="margin:20px;">
    <div class="card-header"><h1><b>Create New Port</b></h1></div>

    <div class="card-body">

        <form action="{{ url('ports') }}" method="post">
            {!! csrf_field() !!}
            <label for="">Code Port </label>
            <input type="text" name="code_port" id="code_port" class="form-control"><br>
            <label for="">Libellé </label>
            <input type="text" name="libelle_port" id="libelle_port" class="form-control"><br>
            <label for="">Région </label>
            <select name="id_region" id="id_region" class="form-control">
                @foreach($regions as $region)
                <option value="{{$region->id}}">{{$region->libelle_region}}</option>
                @endforeach
            </select><br><br>
            <input type="submit" value="Save" class="btn btn-success"><br>
        </form>
    </div>
</div>

@stop