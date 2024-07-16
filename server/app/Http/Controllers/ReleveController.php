<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Poste;
use App\Models\Releve;
use Illuminate\Http\Request;

class ReleveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $releves = Releve::orderBy('created_at')->get();
        return view('releves.index', compact('releves'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $postes = Poste::all();
        return view('releves.create', compact('postes'));
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
        Releve::create($input);
        return redirect('releves')->with('flash_message', 'Relevé Ajouté!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $releves = Releve::find($id);
        return view('releves.show')->with('releves', $releves);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $releves = Releve::find($id);
        // $postes = Poste::all(); // Assuming you have a poste model to get all postes
        // return view('releves.edit', compact('releves', 'postes'));
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
        // $releves = Releve::find($id);
        // $input = $request->all();
        // $releves->update($input);
        // return redirect('releves')->with('flash_message', 'Relevé Mis à Jour avec Succès!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Releve::destroy($id);
        return redirect('releves')->with('flash_message', 'Relevé Supprimé!');
    }
}
