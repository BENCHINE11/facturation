<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Port;
use App\Models\Poste;
use Illuminate\Http\Request;

class PosteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $postes = Poste::all();
        return view('postes.index')->with('postes', $postes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ports = Port::all();
        $clients = Client::all();
        return view('postes.create', compact('ports', 'clients'));
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
        Poste::create($input);
        return redirect('postes')->with('flash_message', 'Poste Ajouté !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $postes = Poste::find($id);
        return view('postes.show')->with('postes', $postes);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $postes = Poste::find($id);
        $ports = Port::all(); // Assuming you have a Region model to get all regions
        $clients = Client::all();
        return view('postes.edit', compact('postes', 'ports','clients'));
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
        $postes = Poste::find($id);
        $input = $request->all();
        $postes->update($input);
        return redirect('postes')->with('flash_message', 'Poste modifié avec succes!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Poste::destroy($id);
        return redirect('postes')->with('flash_message', 'Poste supprimé');
    }
}
