<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Releve extends Model
{
    use HasFactory;
    protected $table = 'releves';

    protected $fillable = [
        'id_poste',
        'mois',
        'annee',
        'index_mono1',
        'index_mono2',
        'index_mono3',
        'index_triJ',
        'index_triN',
        'index_triP',
        'index_reactif',
        'indicateur_max',
    ];

    public function poste()
    {
        return $this->belongsTo(Poste::class, 'id_poste');
    }
    public function facture()
    {
        return $this->hasOne(Port::class, 'id_releve');
    }

}