<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Facture;
use App\Models\Releve;
use Illuminate\Http\Request;
use App\Models\Prestation;
use Carbon\Carbon;

class FactureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $factures = Facture::orderBy('created_at')->get();
        return view('factures.index', compact('factures'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $factures = Facture::find($id);
        return view('factures.show')->with('factures', $factures);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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

    public function createFactureFromReleve($id_releve)
    {
        // Récupérer le relevé
        $releve = Releve::findOrFail($id_releve);

        // Calculer les différentes valeurs nécessaires
        $c_jour = $releve->index_triJ;
        $c_nuit = $releve->index_triN;
        $c_pointe = $releve->index_triP;
        $c_reactif = $releve->index_reactif;

        $cr_jour = ($c_jour / ($c_jour + $c_nuit + $c_pointe)) * 100;
        $cr_nuit = ($c_nuit / ($c_jour + $c_nuit + $c_pointe)) * 100;
        $cr_pointe = ($c_pointe / ($c_jour + $c_nuit + $c_pointe)) * 100;

        $e_rev_jour = ($releve->index_mono1 + $releve->index_mono2 + $releve->index_mono3) * $cr_jour / 100;
        $e_rev_nuit = ($releve->index_mono1 + $releve->index_mono2 + $releve->index_mono3) * $cr_nuit / 100;
        $e_rev_pointe = ($releve->index_mono1 + $releve->index_mono2 + $releve->index_mono3) * $cr_pointe / 100;

        $ccd_globale = 0; // Valeur à définir

        $cbt_jour = $ccd_globale * $cr_jour / 100;
        $cbt_nuit = $ccd_globale * $cr_nuit / 100;
        $cbt_pointe = $ccd_globale * $cr_pointe / 100;

        $e_active_jour = $e_rev_jour - $cbt_jour;
        $e_active_nuit = $e_rev_nuit - $cbt_nuit;
        $e_active_pointe = $e_rev_pointe - $cbt_pointe;

        $tg_phi = $c_reactif / ($e_active_jour + $e_active_nuit + $e_active_pointe);
        $cos_phi = sqrt(1 / (1 + pow($tg_phi, 2)));

        $i_max = $releve->indicateur_max;
        $pa = $i_max / $cos_phi;

        // Tarifs des prestations (à adapter selon les prestations en base de données)
        $tarif_eaj = 1.0332;
        $tarif_ean = 1.0448;
        $tarif_eap = 1.4448;
        $tarif_rp = 0.8410;
        $tarif_v = 0.8410;

        $eaj = $e_active_jour * $tarif_eaj;
        $ean = $e_active_nuit * $tarif_ean;
        $eap = $e_active_pointe * $tarif_eap;
        $rp = $releve->poste->puissance_souscrite * $tarif_rp;

        $rdps = 0;
        if ($pa > $releve->poste->puissance_souscrite) { // Puissance souscrite
            $rdps = ($pa - $releve->poste->puissance_souscrite) * $tarif_rp;
        }

        $v = 0;
        if ($cos_phi < 0.8) {
            $v = 2 * (0.8 - $cos_phi) * ($eaj + $ean + $eap + $rp + $rdps) * $tarif_v;
        }

        // Total HT
        $total_ht = $eaj + $ean + $eap + $rp + $v;

        // Calculs de TVA et autres taxes
        $tva = $total_ht * 0.2; // 20% de TVA
        $tr = $total_ht * 0.03; // 3% de taxe régionale

        $total_ttc = $total_ht + $tva + $tr;

        // Créer la facture
        $facture = new Facture([
            'id_releve' => $id_releve,
            'statut' => '1', // non encaissée
            'puissance_appelee' => $pa,
            'cos_phi' => $cos_phi,
            'total_HT' => $total_ht,
            'total_TVA' => $tva,
            'total_TTC' => $total_ttc,
        ]);

        $facture->save();

        return redirect()->route('factures.show', $facture->id)->with('success', 'Facture créée avec succès!');
    }
}
