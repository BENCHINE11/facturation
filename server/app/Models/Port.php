<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Port extends Model
{
    use HasFactory;
    protected $table = 'ports';

    protected $fillable = [
        'id_region',
        'code_port',
        'libelle',
    ];

    public function user()
    {
        return $this->hasMany(User::class, 'id_port');
    }
    public function region()
    {
        return $this->belongsTo(Region::class, 'id_region');
    }
    public function poste()
    {
        return $this->hasMany(Poste::class, 'id_port');
    }
}
