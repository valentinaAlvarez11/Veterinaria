<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Veterinarian extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'veterinarians';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'specialty',
        'email',
        'phone',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function services()
    {
        return $this->belongsToMany(Service::class);
    }

    public function pets()
    {
        return $this->belongsToMany(Pet::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
    public function consultations()
    {
    return $this->hasMany(Consultation::class);
    }

    public function availabilities()
{
    return $this->hasMany(Availability::class);
}

}
