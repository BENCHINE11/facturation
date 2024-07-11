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
}
