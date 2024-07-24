@extends('users.layout')
@section('content')

<div class="card" style="margin:20px;">
    <div class="card-header"><h1><b>Modifier Utilisateur</b></h1></div>
    <div class="card-body">
        <form action="{{ url('users/' .$users->id) }}" method="post">
            @method("PATCH")
            {!! csrf_field() !!}
            <label for="">Nom</label>
            <input type="text" name="nom" id="nom" class="form-control" value="{{ $users->nom }}"><br>
            <label for="">Prenom</label>
            <input type="text" name="prenom" id="prenom" class="form-control" value="{{ $users->prenom }}"><br>
            <label for="">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ $users->email }}"><br>
            <label for="">Password</label>
            <input type="text" name="password" id="password" class="form-control" value="{{ $users->password }}"><br>
            <label for="">Telephone</label>
            <input type="tel" name="telephone" id="telephone" class="form-control" value="{{ $users->telephone }}"><br>
            <label for="id_port">Port</label>
            <select name="id_port" id="id_port" class="form-control">
                @foreach($ports as $port)
                <option value="{{ $port->id }}" {{ $port->id == $users->id_port ? 'selected' : '' }}>{{ $port->libelle_port }}</option>
                @endforeach
            </select><br>
            <label for="">Role</label>
            <select id="role" name="role" class="form-control">
                <option value="admin" {{ $users->role == 'admin' ? 'selected' : '' }}>Administrateur</option>
                <option value="infra" {{ $users->role == 'infra' ? 'selected' : '' }}>Infrastructure</option>
                <option value="finance" {{ $users->role == 'finance' ? 'selected' : '' }}>Finance</option>
                <option value="facturation" {{ $users->role == 'facturation' ? 'selected' : '' }}>Facturation</option>
            </select><br>
            <input type="submit" value="Modifier" class="btn btn-success"><br>
        </form>
    </div>
</div>

@stop