<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DetailsFacture;
use App\Models\EnteteFacture;
use App\Models\Facture;
use App\Models\Poste;
use App\Models\Releve;
use App\Models\Prestation;
use PDF;
use Illuminate\Http\Request;
use Carbon\Carbon;

class FactureController extends Controller
{
    public function index()
    {
        $factures = Facture::orderBy('created_at')->get();
        return view('factures.index', compact('factures'));
    }

    public function create()
    {
        $postes = Poste::all();
        $recentReleve = Releve::latest()->first();

        if (!$recentReleve) {
            return redirect()->back()->with('error', 'Aucun relevé trouvé. Veuillez ajouter un relevé avant de créer une facture.');
        }

        return view('factures.create', compact('postes', 'recentReleve'));
    }

    public function store(Request $request)
    {
        $postes = Poste::all();
        $recentReleve = Releve::latest()->first();

        if (!$recentReleve) {
            return redirect()->back()->with('error', 'Aucun relevé trouvé. Veuillez ajouter un relevé avant de créer une facture.');
        }

        if ($recentReleve->mois == 1) {
            $previousReleve = Releve::where('annee', $recentReleve->annee - 1)
                                    ->where('mois', 12)
                                    ->first();
        } else {
            $previousReleve = Releve::where('annee', $recentReleve->annee)
                                    ->where('mois', $recentReleve->mois - 1)
                                    ->first();
        }

        if (!$previousReleve) {
            $c_jour = $recentReleve->index_triJ ;
            $c_nuit = $recentReleve->index_triN ;
            $c_pointe = $recentReleve->index_triP ;
            $c_reactif = $recentReleve->index_reactif ;  
        }
        else {
            $c_jour = $recentReleve->index_triJ - $previousReleve->index_triJ;
            $c_nuit = $recentReleve->index_triN - $previousReleve->index_triN;
            $c_pointe = $recentReleve->index_triP - $previousReleve->index_triP;
            $c_reactif = $recentReleve->index_reactif - $previousReleve->index_reactif;
        }


        $cr_jour = ($c_jour / ($c_jour + $c_nuit + $c_pointe));
        $cr_nuit = ($c_nuit / ($c_jour + $c_nuit + $c_pointe));
        $cr_pointe = ($c_pointe / ($c_jour + $c_nuit + $c_pointe));

        $prestations = Prestation::whereIn('code', [
            '080101', '080102', '080121', '080103', '080108',
            '080104', '080105', '080106', '080112'
        ])->get()->keyBy('code');

        if (!$previousReleve) {
            $e_rev_jour = ($recentReleve->index_mono1  + $recentReleve->index_mono2  + $recentReleve->index_mono3 ) * $cr_jour;
            $e_rev_nuit = ($recentReleve->index_mono1  + $recentReleve->index_mono2  + $recentReleve->index_mono3 ) * $cr_nuit;
            $e_rev_pointe = ($recentReleve->index_mono1  + $recentReleve->index_mono2  + $recentReleve->index_mono3 ) * $cr_pointe;

        }
        else {
            $e_rev_jour = (($recentReleve->index_mono1 - $previousReleve->index_mono1) + ($recentReleve->index_mono2 - $previousReleve->index_mono2) + ($recentReleve->index_mono3 - $previousReleve->index_mono3)) * $cr_jour;
            $e_rev_nuit = (($recentReleve->index_mono1 - $previousReleve->index_mono1) + ($recentReleve->index_mono2 - $previousReleve->index_mono2) + ($recentReleve->index_mono3 - $previousReleve->index_mono3)) * $cr_nuit;
            $e_rev_pointe = (($recentReleve->index_mono1 - $previousReleve->index_mono1) + ($recentReleve->index_mono2 - $previousReleve->index_mono2) + ($recentReleve->index_mono3 - $previousReleve->index_mono3)) * $cr_pointe;
        }
        
        $ccd_globale = 0; // Assuming this needs to be calculated or provided

        $cbt_jour = $ccd_globale * $cr_jour;
        $cbt_nuit = $ccd_globale * $cr_nuit;
        $cbt_pointe = $ccd_globale * $cr_pointe;

        $e_active_jour = $e_rev_jour - $cbt_jour;
        $e_active_nuit = $e_rev_nuit - $cbt_nuit;
        $e_active_pointe = $e_rev_pointe - $cbt_pointe;

        $tg_phi = $c_reactif / ($e_active_jour + $e_active_nuit + $e_active_pointe);
        $cos_phi = sqrt(1 / (1 + pow($tg_phi, 2)));
        
        $puissance_appelee = $recentReleve->indicateur_max / $cos_phi;

        $rdps = 0 ;
        if ($puissance_appelee > $recentReleve->poste->puissance_souscrite) {
            $rdps = $puissance_appelee - $recentReleve->poste->puissance_souscrite;
        }

        $majoration = 0;
        if ($cos_phi < 0.8) {
            $majoration = 2 * (0.8 - $cos_phi) * ($e_active_jour * $prestations['080101']->tarif + $e_active_nuit * $prestations['080102']->tarif + $e_active_pointe * $prestations['080121']->tarif + $recentReleve->poste->puissance_souscrite * $prestations['080103']->tarif + $rdps * $prestations['080108']->tarif);
        }

        $facture = Facture::create([
            'id_releve' => $recentReleve->id,
            'mois' => $recentReleve->mois,
            'annee' => $recentReleve->annee,
            'puissance_appelee' => $puissance_appelee, // Example value
            'cos_phi' => $cos_phi,
            'total_HT' => 0, // Set these values according to your logic
            'total_TVA' => 0,
            'total_TR' => 0,
            'total_TTC' => 0,
        ]);
        

        foreach ($prestations as $prestation) {
            if ( $prestation->code == '080101') {//Energie Active Jour
                if ($previousReleve){
                    $ancien_index = ($previousReleve->index_mono1 + $previousReleve->index_mono2 + $previousReleve->index_mono3) * $cr_jour;
                    $nouvel_index = ($recentReleve->index_mono1 + $recentReleve->index_mono2 + $recentReleve->index_mono3) * $cr_jour;
                    $quantite = $nouvel_index - $ancien_index;
                    $montant_ht = $quantite * $prestation->tarif ;
                    $montant_tva = ($montant_ht * $prestation->taux_TVA) /100;
        
                    $detailsFacture = DetailsFacture::create([
                        'id_facture' => $facture->id,
                        'code_prestation' => $prestation->code,
                        'quantite' => $quantite,
                        'montant_ht' => $montant_ht,
                        'montant_tva' => $montant_tva,
                        'ancien_index' => $ancien_index,
                        'nouvel_index' => $nouvel_index,
                    ]);
                } else {
                    $ancien_index = 0;
                    $nouvel_index = ($recentReleve->index_mono1 + $recentReleve->index_mono2 + $recentReleve->index_mono3) * $cr_jour;
                    $quantite = $nouvel_index - $ancien_index;
                    $montant_ht = $quantite * $prestation->tarif ;
                    $montant_tva = ($montant_ht * $prestation->taux_TVA) /100;
        
                    $detailsFacture = DetailsFacture::create([
                        'id_facture' => $facture->id,
                        'code_prestation' => $prestation->code,
                        'quantite' => $quantite,
                        'montant_ht' => $montant_ht,
                        'montant_tva' => $montant_tva,
                        'ancien_index' => $ancien_index,
                        'nouvel_index' => $nouvel_index,
                    ]);
                }
                
            }
    
            elseif ( $prestation->code == '080102') { //Energie Active Nuit
                if ($previousReleve){
                    $ancien_index = ($previousReleve->index_mono1 + $previousReleve->index_mono2 + $previousReleve->index_mono3) * $cr_nuit;
                    $nouvel_index = ($recentReleve->index_mono1 + $recentReleve->index_mono2 + $recentReleve->index_mono3) * $cr_nuit;
                    $quantite = $nouvel_index - $ancien_index;
                    $montant_ht = $quantite * $prestation->tarif;
                    $montant_tva = ($montant_ht * $prestation->taux_TVA)/100;
        
                    $detailsFacture = DetailsFacture::create([
                        'id_facture'=> $facture->id,
                        'code_prestation' => $prestation->code,
                        'quantite' => $quantite,
                        'montant_ht' => $montant_ht,
                        'montant_tva' => $montant_tva,
                        'ancien_index' => $ancien_index,
                        'nouvel_index' => $nouvel_index,
                    ]);
                } else {
                    $ancien_index = 0;
                    $nouvel_index = ($recentReleve->index_mono1 + $recentReleve->index_mono2 + $recentReleve->index_mono3) * $cr_nuit;
                    $quantite = $nouvel_index - $ancien_index;
                    $montant_ht = $quantite * $prestation->tarif;
                    $montant_tva = ($montant_ht * $prestation->taux_TVA)/100;
        
                    $detailsFacture = DetailsFacture::create([
                        'id_facture'=> $facture->id,
                        'code_prestation' => $prestation->code,
                        'quantite' => $quantite,
                        'montant_ht' => $montant_ht,
                        'montant_tva' => $montant_tva,
                        'ancien_index' => $ancien_index,
                        'nouvel_index' => $nouvel_index,
                    ]);
                }
                
            }
    
            elseif ( $prestation->code == '080121') { //Energie Active Pointe
                if ($previousReleve) {
                    $ancien_index = ($previousReleve->index_mono1 + $previousReleve->index_mono2 + $previousReleve->index_mono3) * $cr_pointe;
                    $nouvel_index = ($recentReleve->index_mono1 + $recentReleve->index_mono2 + $recentReleve->index_mono3) * $cr_pointe;
                    $quantite = $nouvel_index - $ancien_index;
                    $montant_ht = $quantite * $prestation->tarif;
                    $montant_tva = ($montant_ht * $prestation->taux_TVA)/100;
        
                    $detailsFacture = DetailsFacture::create([
                        'id_facture'=> $facture->id,
                        'code_prestation' => $prestation->code,
                        'quantite' => $quantite,
                        'montant_ht' => $montant_ht,
                        'montant_tva' => $montant_tva,
                        'ancien_index' => $ancien_index,
                        'nouvel_index' => $nouvel_index,
                    ]);
                } else {
                    $ancien_index = 0;
                    $nouvel_index = ($recentReleve->index_mono1 + $recentReleve->index_mono2 + $recentReleve->index_mono3) * $cr_pointe;
                    $quantite = $nouvel_index - $ancien_index;
                    $montant_ht = $quantite * $prestation->tarif;
                    $montant_tva = ($montant_ht * $prestation->taux_TVA)/100;
        
                    $detailsFacture = DetailsFacture::create([
                        'id_facture'=> $facture->id,
                        'code_prestation' => $prestation->code,
                        'quantite' => $quantite,
                        'montant_ht' => $montant_ht,
                        'montant_tva' => $montant_tva,
                        'ancien_index' => $ancien_index,
                        'nouvel_index' => $nouvel_index,
                    ]);
                }
            }
    
            elseif ( $prestation->code == '080103') { //Redevance de Puissance
                $ancien_index = $nouvel_index = 0;
                $quantite = $recentReleve->poste->puissance_souscrite;
                $montant_ht = $quantite * $prestation->tarif;
                $montant_tva = ($montant_ht * $prestation->taux_TVA)/100;
    
                $detailsFacture = DetailsFacture::create([
                    'id_facture'=> $facture->id,
                    'code_prestation' => $prestation->code,
                    'quantite' => $quantite,
                    'montant_ht' => $montant_ht,
                    'montant_tva' => $montant_tva,
                    'ancien_index' => $ancien_index,
                    'nouvel_index' => $nouvel_index,
                ]);
            }
    
            elseif ( $prestation->code == '080108') { //Redevance de Dépassement de Puissance Souscrite
                $ancien_index = $nouvel_index = 0;
                $quantite = $rdps;
                $montant_ht = $quantite * $prestation->tarif;
                $montant_tva = ($montant_ht * $prestation->taux_TVA)/100;
    
                $detailsFacture = DetailsFacture::create([
                    'id_facture'=> $facture->id,
                    'code_prestation' => $prestation->code,
                    'quantite' => $quantite,
                    'montant_ht' => $montant_ht,
                    'montant_tva' => $montant_tva,
                    'ancien_index' => $ancien_index,
                    'nouvel_index' => $nouvel_index,
                ]);
            }
    
            elseif ($majoration != 0 && $prestation->code == '080104')  { //Majoration pour Déphasage
                    $ancien_index = $nouvel_index = 0;
                    $quantite = $majoration;
                    $montant_ht = $quantite * $prestation->tarif;
                    $montant_tva = ($montant_ht * $prestation->taux_TVA)/100;
    
                    $detailsFacture = DetailsFacture::create([
                        'id_facture'=> $facture->id,
                        'code_prestation' => $prestation->code,
                        'quantite' => $quantite,
                        'montant_ht' => $montant_ht,
                        'montant_tva' => $montant_tva,
                        'ancien_index' => $ancien_index,
                        'nouvel_index' => $nouvel_index,
                    ]);
                }

            else {
                $quantite = 1;
                $nouvel_index = $ancien_index = 0;
                $montant_ht = $prestation->tarif;
                $montant_tva = ($montant_ht * $prestation->taux_TVA)/100;
    
                $detailsFacture = DetailsFacture::create([
                    'id_facture'=> $facture->id,
                    'code_prestation' => $prestation->code,
                    'quantite' => $quantite,
                    'montant_ht' => $montant_ht,
                    'montant_tva' => $montant_tva,
                    'ancien_index' => $ancien_index,
                    'nouvel_index' => $nouvel_index,
                ]);
            }
        }

        // $total_HT = $e_active_jour * $prestations['080101']->tarif + $e_active_nuit * $prestations['080102']->tarif + $e_active_pointe * $prestations['080121']->tarif + $recentReleve->poste->puissance_souscrite * $prestations['080103']->tarif + $rdps * $prestations['080108']->tarif + $majoration * $prestations['080104']->tarif + $prestations['080105']->tarif + $prestations['080106']->tarif + $prestations['0801012']->tarif;
        // $total_TVA = $e_active_jour * $prestations['080101']->tarif * $prestations['080101']->taux_TVA + $e_active_nuit * $prestations['080102']->tarif * $prestations['080102']->taux_TVA + $e_active_pointe * $prestations['080121']->tarif * $prestations['080121']->taux_TVA + $recentReleve->poste->puissance_souscrite * $prestations['080103']->tarif * $prestations['080103']->taux_TVA + $rdps * $prestations['080108']->tarif * $prestations['080108']->taux_TVA + $majoration * $prestations['080104']->tarif * $prestations['080104']->taux_TVA + $prestations['080105']->tarif * $prestations['080105']->taux_TVA + $prestations['080106']->tarif * $prestations['080106']->taux_TVA + $prestations['0801012']->tarif * $prestations['080112']->taux_TVA;
        // $total_TR = $total_HT * $recentReleve->poste->port->region->taxe_regionale;
        // $total_TTC = $total_HT + $total_TVA + $total_TR ; 

        $total_HT = DetailsFacture::where('id_facture', $facture->id)->sum('montant_ht');
        $total_TVA = DetailsFacture::where('id_facture', $facture->id)->sum('montant_tva');
        $total_TR = $total_HT * $recentReleve->poste->port->region->taxe_regionale;
        $total_TTC = $total_TR + $total_HT + $total_TVA;
        

        $facture->statut = '1';
        $facture->total_HT = $total_HT;
        $facture->total_TVA = $total_TVA;
        $facture->total_TR = $total_TR;
        $facture->total_TTC = $total_TTC;

        $facture->save();        

        return redirect()->route('factures.index')->with('flash_message', 'Facture créée!');
    }


    public function show($id)
    {
        // $factures = Facture::find($id);
        $factures = Facture::with('details_factures')->find($id);

        // if (!$factures->entete_facture) {
        //     // Handle the case where entete_facture is missing
        //     return redirect()->back()->with('error', 'Entête Facture not found for this Facture.');
        // }

        $prestations = Prestation::all();

        return view('factures.show')->with([
            'factures' => $factures,
            'prestations' => $prestations
        ]);
    }

    public function destroy($id)
    {
        Facture::destroy($id);
        return redirect('factures')->with('flash_message', 'Facture supprimée !');
    }

    public function downloadPDF($id)
    {
        $factures = Facture::with(['releve.poste.client', 'details_factures'])->find($id);
        $prestations = Prestation::all(); // Make sure to load the prestations

        $pdf = PDF::loadView('factures.pdf', compact('factures', 'prestations'))
                    ->setPaper('a3'); // Set paper size to A3
        return $pdf->download('facture_' . $factures->id . '.pdf');
    }

}

?>