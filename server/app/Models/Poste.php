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
        'puissance_souscrite',
        'puissance_installee',
    ];
    public function port()
    {
        return $this->belongsTo(Port::class, 'id_port');
    }
    public function client()
    {
        return $this->belongsTo(Client::class, 'id_client');
    }
    public function releve()
    {
        return $this->belongsTo(Releve::class, 'id_poste');
    }
}
