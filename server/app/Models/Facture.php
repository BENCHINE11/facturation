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
        'mois_facturation',
        'date_emission',
        'statut',
        'puissance_appelee',
        'cos_phi',
        'total_HT',
        'total_TVA',
        'total_TTC',
    ];
    public function releve()
    {
        return $this->belongsTo(Releve::class, 'id_releve');
    }
}
