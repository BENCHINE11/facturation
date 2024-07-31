<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Prestation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PrestationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prestations = Prestation::all();
        return view('prestations.index')->with('prestations', $prestations);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('prestations.create');
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
        $input['last_modified_by'] = Auth::user()->email; // Enregistrer l'email de l'utilisateur
        Prestation::create($input);
        return redirect('prestations')->with('flash_message', 'Prestation Ajoutée!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $prestations = Prestation::find($id);
        return view('prestations.show')->with('prestations', $prestations);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $prestations = Prestation::find($id);
        return view('prestations.edit')->with('prestations', $prestations);
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
        $prestation = Prestation::find($id);
        $input = $request->all();
        $input['last_modified_by'] = Auth::user()->email; // Enregistrer l'email de l'utilisateur
        $prestation->update($input);
        return redirect('prestations')->with('flash_message', 'Prestation Mise à Jour Avec Succès!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Prestation::destroy($id);
        return redirect('prestations')->with('flash_message', 'Prestation supprimée!');
    }
}