<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Port;
use App\Models\Region;
use Illuminate\Http\Request;

class PortController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $search = $request->get('search');
        $ports = Port::when($search, function($query, $search) {
            return $query->where('code_port', 'like', '%' . $search . '%')
                        ->orWhere('libelle_port', 'like', '%' . $search . '%')
                        ->orWhereHas('region', function($q) use ($search) {
                            $q->where('libelle_region', 'like', '%' . $search . '%');
                        });
        })
        ->orderBy('code_port', 'asc')
        ->paginate(10);

        return view('ports.index')->with('ports', $ports);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $regions = Region::all();
        return view('ports.create', compact('regions'));
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
        Port::create($input);
        return redirect('ports')->with('flash_message', 'Port ajouté !');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ports = Port::find($id);
        return view('ports.show')->with('ports', $ports);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ports = Port::find($id);
        $regions = Region::all(); // Assuming you have a Region model to get all regions
        return view('ports.edit', compact('ports', 'regions'));
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
        $ports = Port::find($id);
        $input = $request->all();
        $ports->update($input);
        return redirect('ports')->with('flash_message', 'Port modifié avec succes !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
