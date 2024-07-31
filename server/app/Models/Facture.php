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

        'statut',
        'mois',
        'annee',
        
        'puissance_appelee',
        'cos_phi',
        'total_HT',
        'total_TVA',
        'total_TR',
        'total_TTC',
        
        'cree_par',
        'annulee_par',
        'reglee_par',
    ];

    public function releve()
    {
        return $this->belongsTo(Releve::class, 'id_releve');
    }

    public function poste()
    {
        return $this->belongsTo(Poste::class, 'id_poste');
    }

    public function details_factures()
    {
        return $this->hasMany(DetailsFacture::class, 'id_facture', 'id');
    }

}