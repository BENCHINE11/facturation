@extends('users.layout')
@section('content')

<div class="card" style="margin:20px;">
    <div class="card-header">Informations Utilisateur</div>
    <div class="card-body">
        <h5 class="card-title" align="">{{ $users->nom }} {{ $users->prenom }}</h5><br>
        <p class="card-text">Email : {{ $users->email }}</p>
        <p class="card-text">Password : {{ $users->password }}</p>
        <p class="card-text">Téléphone : {{ $users->telephone }}</p>
        <p class="card-text">Port : <a href="{{ url('/ports/' . $users->port->id)}}">{{ $users->port->libelle_port }}</a></p>
        <p class="card-text">Rôle : {{ $users->role }}</p>
        <div class="">
            <p class="card-text">Etat de compte : 
                @if ($users->etat == 1)
                    <span style="color: green;">Activé</span>
                @else
                    <span style="color: red;">Désactivé</span>
                @endif
            </p>
        
        </div>
    </div>
</div>
@stop