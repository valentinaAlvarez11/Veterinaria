<?php

// app/Models/Appointment.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'veterinarian_id',
        'appointment_date',
        'reason',
        'notes',
        'status',
        'rescheduled_date',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function veterinarian()
    {
        return $this->belongsTo(Veterinarian::class);
    }

    public function pet()
    {
        return $this->belongsTo(Pet::class);
    }
}
