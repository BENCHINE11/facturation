<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Facture;
use App\Models\Poste;
use App\Models\Releve;
use App\Models\Prestation;
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

        list($currentReleve, $lastMonthReleve) = $this->getReleves($recentReleve->mois, $recentReleve->annee);
        if (!$currentReleve) {
            return redirect()->back()->with('error', 'Les relevés nécessaires ne sont pas disponibles.');
        }

        list($consommationJour, $consommationNuit, $consommationPointe, $consommationReactif) = $this->calculateConsommations($currentReleve, $lastMonthReleve);
        list($cr_jour, $cr_nuit, $cr_pointe) = $this->calculateCr($consommationJour, $consommationNuit, $consommationPointe);

        $e_active = $this->calculateEnergieActive($currentReleve, $lastMonthReleve, $cr_jour, $cr_nuit, $cr_pointe);

        $tg_phi = $consommationReactif / array_sum($e_active['actuel']);
        $cos_phi = sqrt(1 / (1 + pow($tg_phi, 2)));
        $pa = $currentReleve->indicateur_max / $cos_phi;
        $rp = $currentReleve->poste->puissance_souscrite;
        $rdps = $pa > $rp ? ($pa - $rp) : 0;

        $prestations = Prestation::whereIn('code', [
            '080101', '080102', '080121', '080103', '080108',
            '080104', '080105', '080106', '080112'
        ])->get()->keyBy('code');

        list($total_HT, $total_TVA, $total_TR, $total_TTC) = $this->calculateTotals($e_active['actuel'], $rdps, $cos_phi, $prestations, $currentReleve);

        return view('factures.create', compact(
            'postes', 
            'recentReleve', 
            'consommationJour', 
            'consommationNuit', 
            'consommationPointe', 
            'consommationReactif', 
            'pa', 
            'cos_phi', 
            'e_active_jour_actuel',
            'e_active_nuit_actuel', 
            'e_active_pointe_actuel', 
            'v',
            'total_HT',
            'total_TVA',
            'total_TR',
            'total_TTC'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'poste_id' => 'required|exists:postes,id',
        ]);

        $recentReleve = Releve::latest()->first();
        list($currentReleve, $lastMonthReleve) = $this->getReleves($recentReleve->mois, $recentReleve->annee);

        if (!$currentReleve || !$lastMonthReleve) {
            return redirect()->back()->with('error', 'Les relevés nécessaires ne sont pas disponibles.');
        }

        list($consommationJour, $consommationNuit, $consommationPointe, $consommationReactif) = $this->calculateConsommations($currentReleve, $lastMonthReleve);
        list($cr_jour, $cr_nuit, $cr_pointe) = $this->calculateCr($consommationJour, $consommationNuit, $consommationPointe);

        $e_active = $this->calculateEnergieActive($currentReleve, $lastMonthReleve, $cr_jour, $cr_nuit, $cr_pointe);

        $tg_phi = $consommationReactif / array_sum($e_active['actuel']);
        $cos_phi = sqrt(1 / (1 + pow($tg_phi, 2)));
        $pa = $currentReleve->indicateur_max / $cos_phi;
        $rp = $currentReleve->poste->puissance_souscrite;
        $rdps = $pa > $rp ? ($pa - $rp) : 0;

        $prestations = Prestation::whereIn('code', [
            '080101', '080102', '080121', '080103', '080108',
            '080104', '080105', '080106', '080112'
        ])->get()->keyBy('code');

        list($total_HT, $total_TVA, $total_TR, $total_TTC) = $this->calculateTotals($e_active['actuel'], $rdps, $cos_phi, $prestations, $currentReleve);

        $facture = Facture::create([
            'id_releve' => $currentReleve->id,
            'id_poste' => $request->poste_id,
            'statut' => '1', 
            'cos_phi' => $cos_phi,
            'total_HT' => $total_HT,
            'total_TVA' => $total_TVA,
            'total_TR' => $total_TR,
            'total_TTC' => $total_TTC,
            'mois' => $currentReleve->mois,
            'annee' => $currentReleve->annee,
            'consommation_jour' => $consommationJour,
            'consommation_nuit' => $consommationNuit,
            'consommation_pointe' => $consommationPointe,
            'consommation_reactif' => $consommationReactif,
            'pa' => $pa,
            'e_active_jour_actuel' => $e_active['actuel'][0],
            'e_active_nuit_actuel' => $e_active['actuel'][1],
            'e_active_pointe_actuel' => $e_active['actuel'][2],
            'rdps' => $rdps,
            'eaj_actuel' => $e_active['actuel'][3],
            'ean_actuel' => $e_active['actuel'][4],
            'eap_actuel' => $e_active['actuel'][5],
        ]);

        return redirect()->route('factures.index')->with('success', 'Facture créée avec succès.');
    }

    private function getReleves($currentMonth, $currentYear)
    {
        $currentReleve = Releve::where('mois', $currentMonth)
                                ->where('annee', $currentYear)
                                ->first();

        $lastMonthReleve = Releve::where('mois', '<', $currentMonth)
                                ->where('annee', $currentYear)
                                ->orWhere(function($query) use ($currentMonth, $currentYear) {
                                    $query->where('mois', '=', 12)
                                        ->where('annee', '=', $currentYear - 1);
                                })
                                ->orderBy('mois', 'desc')
                                ->first();
        
        return [$currentReleve, $lastMonthReleve];
    }

    private function calculateConsommations($currentReleve, $lastMonthReleve)
    {
        $consommationJour = $currentReleve->index_jour - $lastMonthReleve->index_jour;
        $consommationNuit = $currentReleve->index_nuit - $lastMonthReleve->index_nuit;
        $consommationPointe = $currentReleve->index_pointe - $lastMonthReleve->index_pointe;
        $consommationReactif = $currentReleve->index_reactif - $lastMonthReleve->index_reactif;

        return [$consommationJour, $consommationNuit, $consommationPointe, $consommationReactif];
    }

    private function calculateCr($consommationJour, $consommationNuit, $consommationPointe)
    {
        $cr_jour = $consommationJour * 0.03;
        $cr_nuit = $consommationNuit * 0.02;
        $cr_pointe = $consommationPointe * 0.1;

        return [$cr_jour, $cr_nuit, $cr_pointe];
    }

    private function calculateEnergieActive($currentReleve, $lastMonthReleve, $cr_jour, $cr_nuit, $cr_pointe)
    {
        $e_active_jour_actuel = ($currentReleve->index_jour + $cr_jour) - ($lastMonthReleve->index_jour + $cr_jour);
        $e_active_nuit_actuel = ($currentReleve->index_nuit + $cr_nuit) - ($lastMonthReleve->index_nuit + $cr_nuit);
        $e_active_pointe_actuel = ($currentReleve->index_pointe + $cr_pointe) - ($lastMonthReleve->index_pointe + $cr_pointe);

        return [
            'actuel' => [$e_active_jour_actuel, $e_active_nuit_actuel, $e_active_pointe_actuel, $e_active_jour_actuel, $e_active_nuit_actuel, $e_active_pointe_actuel]
        ];
    }

    private function calculateTotals($e_active_actuel, $rdps, $cos_phi, $prestations, $currentReleve)
    {
        $total_HT = array_sum([
            $e_active_actuel[0] * $prestations['080101']->tarif,
            $e_active_actuel[1] * $prestations['080102']->tarif,
            $e_active_actuel[2] * $prestations['080121']->tarif,
            $rdps * $prestations['080103']->tarif,
            $currentReleve->post_releve * $prestations['080108']->tarif,
        ]);

        $total_TVA = $total_HT * $prestations['080104']->tarif;
        $total_TR = $total_HT * $prestations['080105']->tarif;
        $total_TTC = $total_HT + $total_TVA + $total_TR;

        return [$total_HT, $total_TVA, $total_TR, $total_TTC];
    }
}

?>