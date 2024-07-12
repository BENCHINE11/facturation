<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $table = 'clients';

    protected $fillable = [
        'ref_client',
        'CIN',
        'ICE',
        'raison_sociale',
        'adresse',
        'telephone',
        'caution',
        'min_garantie',
        'etat',
    ];
    public function poste()
    {
        return $this->hasMany(Poste::class, 'id_client');
    }
}
