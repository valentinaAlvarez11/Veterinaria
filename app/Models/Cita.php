<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente_id', 'mascota_id', 'veterinario_id', 'servicio_id', 'fecha', 'hora', 'estado'
    ];

    protected $casts = [
        'fecha' => 'date',
        'hora' => 'time',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function mascota()
    {
        return $this->belongsTo(Mascota::class);
    }

    public function veterinario()
    {
        return $this->belongsTo(Veterinario::class);
    }

    public function servicio()
    {
        return $this->belongsTo(Servicio::class);
    }
}
