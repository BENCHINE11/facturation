<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;
    protected $table = 'regions';

    protected $fillable = [
        'code_region',
        'libelle_region',
        'taxe_regionale',
    ];

    public function port()
    {
        return $this->hasMany(Port::class, 'id_region', 'id');
    }

}
