<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailsFacture extends Model
{
    use HasFactory;
    protected $table = 'details_factures';

    protected $fillable = [
        'id_facture',

        'code_prestation',
        'quantite',
        'montant_ht',
        'montant_tva',
        'ancien_index',
        'nouvel_index',
    ];

    public function facture() {
        return $this->belongsTo(Facture::class, 'id_facture');
    }
    
}
