<?php

// app/Models/Pet.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'breed', 
        'age', 
        'medical_conditions', 
        'client_id',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}