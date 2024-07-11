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
}
