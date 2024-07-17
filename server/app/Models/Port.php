<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Port extends Model
{
    use HasFactory;
    protected $table = 'ports';

    protected $fillable = [
        'code_port',
        'libelle_port',
        'id_region',
    ];

    public function region()
    {
        return $this->belongsTo(Region::class, 'id_region');
    }

    public function user()
    {
        return $this->hasMany(User::class, 'id_port');
    }

    public function poste()
    {
        return $this->hasMany(Poste::class, 'id_port', 'id');
    }
}
