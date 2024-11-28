<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'specialty_id',
    ];

    public function specialty()
    {
        return $this->belongsTo(Specialty::class);
    }
    public function veterinarians()
{
    return $this->belongsToMany(Veterinarian::class);
}
}

