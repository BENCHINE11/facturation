<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index(Request $request) {
        $clients = [
            [
                'codecli' => '00000001',
                'raison_sociale' => 'BENCHINE Abdelilah',
                'adresse' => 'Rue de la liberté',
                'telephone' => '+212 6 61 61 61 61',
                'cin' => 'BE931871',
                'ice' => '',
                'caution' => '',
                'minimum_garanti' => ''
            ],
            [
                'codecli' => '00000002',
                'raison_sociale' => 'MARSA MAROC',
                'adresse' => 'Rue de la liberté',
                'telephone' => '+212 6 61 61 61 61',
                'cin' => 'BE931871',
                'ice' => '',
                'caution' => '',
                'minimum_garanti' => ''
            ],
            [
                'codecli' => '00000003',
                'raison_sociale' => 'SOMAPORT',
                'adresse' => 'Rue de la liberté',
                'telephone' => '+212 6 61 61 61 61',
                'cin' => 'BE931871',
                'ice' => '',
                'caution' => '',
                'minimum_garanti' => ''
            ]
        ];

        return view('tables.clients', compact('clients'));
    }
    //
}
