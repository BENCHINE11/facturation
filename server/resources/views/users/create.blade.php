@extends('users.layout')
@section('content')

<div class="card" style="margin:20px;">
    <div class="card-header"><h1><b>Create New User</b></h1></div>

    <div class="card-body">

        <form action="{{ url('users') }}" method="post">
            {!! csrf_field() !!}
            <label for="">Nom</label>
            <input type="text" name="nom" id="nom" class="form-control"><br>
            <label for="">Prenom</label>
            <input type="text" name="prenom" id="prenom" class="form-control"><br>
            <label for="">Email</label>
            <input type="email" name="email" id="email" class="form-control"><br>
            <label for="">Password</label>
            <input type="text" name="password" id="password" class="form-control"><br>
            <label for="">Telephone</label>
            <input type="tel" name="telephone" id="telephone" class="form-control"><br>
            <label for="id_port">Port</label>
            <select name="id_port" id="id_port" class="form-control">
                @foreach($ports as $port)
                <option value="{{ $port->id }}">{{ $port->libelle_port }}</option>
                @endforeach
            </select><br><br>
            <label for="">Role</label>
            <select id="role">
                <option value="admin">Administrateur</option>
                <option value="infra">Infrastructure</option>
                <option value="finance">Finance</option>
                <option value="facturation">Facturation</option>
            </select><br><br>
            <input type="submit" value="Save" class="btn btn-success"><br>
        </form>
    </div>
</div>

@stop