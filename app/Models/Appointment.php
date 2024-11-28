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

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    public function veterinarian()
    {
        return $this->belongsTo(Veterinarian::class);
    }
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
