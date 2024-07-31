<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Port;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $users = User::when($search, function($query, $search) {
            return $query->where('nom', 'like', '%' . $search . '%')
                        ->orWhere('prenom', 'like', '%' . $search . '%')
                        ->orWhere('telephone', 'like', '%' . $search . '%')
                        ->orWhere('role', 'like', '%' . $search . '%')
                        ->orWhereHas('port', function($q) use ($search) {
                            $q->where('libelle_port', 'like', '%' . $search . '%');
                        });
        })->paginate(10);

        return view('users.index')->with('users', $users);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ports = Port::all();
        return view('users.create', compact('ports'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $input['password']=Hash::make($input['password']);
        User::create($input);
        return redirect('users')->with('flash_message', 'Utilisateur ajouté !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $users = User::find($id);
        return view('users.show')->with('users', $users);
    }

/**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = User::find($id);
        $ports = Port::all(); 
        return view('users.edit', compact('users', 'ports'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $users = User::find($id);
        $input = $request->all();
        $users->update($input);
        return redirect('users')->with('flash_message', 'Utlilisateur modifié avec Succès!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if ($user->etat == '1'){
        $user->etat = '0';
        $user->save();
        return redirect('users')->with('flash_message', 'Utilisateur désactivé avec succès!');
        }
        else{
        $user->etat = '1';
        $user->save();
        return redirect('users')->with('flash_message', 'Utilisateur activé avec succès!');
        }
    }
    public function deleteUser($id)
    {
    $user = User::find($id);

    if ($user) {
        $user->delete();
        return redirect('users')->with('flash_message', 'Utilisateur supprimé avec succès!');
    }

    return redirect('users')->with('error_message', 'Utilisateur non trouvé!');
    }

    // public function enable(User $user)
    // {
    //     $user->etat = '1';
    //     $user->save();
    //     return redirect('users')->with('flash_message', 'Utilisateur activé avec succès!');

    // }
    
}
