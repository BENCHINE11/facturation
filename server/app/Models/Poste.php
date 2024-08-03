<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poste extends Model
{
    use HasFactory;
    protected $table = 'postes';
    protected $fillable = [
        'id_port',
        'id_client',
        'ref_poste',
        'puissance_souscrite',
        'puissance_installee',
        'caution',
        'min_garanti',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'id_client');
    }

    public function port()
    {
        return $this->belongsTo(Port::class, 'id_port');
    }
    
    public function releve()
    {
        return $this->hasMany(Releve::class, 'id_poste');
    }

    public function factures()
    {
        return $this->hasMany(Facture::class, 'id_poste');
    }

}
