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
        'cin',
        'ice',
        'raison_sociale',
        'adresse',
        'telephone',
    ];

    public function poste()
    {
        return $this->hasMany(Poste::class, 'id_client', 'id');
    }
}
