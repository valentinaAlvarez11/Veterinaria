<?php

// app/Models/Appointment.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    // Asegúrate de incluir los nuevos campos en $fillable
    protected $fillable = [
        'client_id',
        'veterinarian_id',
        'appointment_date',
        'reason',
        'notes',
        'status',           // Nuevo campo: estado de la cita
        'rescheduled_date', // Nuevo campo: fecha de reprogramación
    ];

    // Relación con Client
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    // Relación con Veterinarian
    public function veterinarian()
    {
        return $this->belongsTo(Veterinarian::class);
    }

    // Relación con Pet
    public function pet()
    {
        return $this->belongsTo(Pet::class);
    }

    // Métodos relacionados con el estado de la cita
    public function isPending()
    {
        return $this->status === 'pending';
    }

    public function isAccepted()
    {
        return $this->status === 'accepted';
    }

    public function isRejected()
    {
        return $this->status === 'rejected';
    }

    public function isRescheduled()
    {
        return $this->status === 'rescheduled';
    }

    public function reschedule($newDate)
    {
        $this->update([
            'appointment_date' => $newDate,
            'status' => 'rescheduled',
            'rescheduled_date' => now(),  // Marca la fecha de reprogramación
        ]);
    }
}
