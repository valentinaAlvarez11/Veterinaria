<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disponibilidad extends Model
{
    use HasFactory;

    protected $fillable = [
        'veterinario_id', 'dia', 'hora_inicio', 'hora_fin',
    ];

    protected $casts = [
        'hora_inicio' => 'time',
        'hora_fin' => 'time',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function veterinario()
    {
        return $this->belongsTo(Veterinario::class);
    }
}
