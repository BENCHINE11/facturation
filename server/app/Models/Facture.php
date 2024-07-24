<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
    use HasFactory;
    protected $table = 'factures';
    protected $fillable = [
        'id_releve',
        'id_poste',
        'statut',

        'mois',
        'annee',

        'consommation_jour',
        'consommation_nuit',
        'consommation_pointe',
        'consommation_reactif',

        'e_active_jour_ancien',
        'e_active_nuit_ancien',
        'e_active_pointe_ancien',

        'e_active_jour_actuel',
        'e_active_nuit_actuel',
        'e_active_pointe_actuel',

        'pa',
        'cos_phi',

        'rdps',
        'v',

        'eaj_actuel',
        'ean_actuel',
        'eap_actuel',

        'eaj_ancien',
        'ean_ancien',
        'eap_ancien',
        
        'total_HT',
        'total_TVA',
        'total_TR',
        'total_TTC',
    ];

    public function releve()
    {
        return $this->belongsTo(Releve::class, 'id_releve');
    }

    public function poste()
    {
        return $this->belongsTo(Poste::class, 'id_poste');
    }

}
