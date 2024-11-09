<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre', 'email', 'telefono', 'direccion'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function mascotas()
    {
        return $this->hasMany(Mascota::class);
    }

    public function citas()
    {
        return $this->hasMany(Cita::class);
    }
}
