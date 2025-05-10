<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceRequest extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 
        'prestataire_id', 
        'description', 
        'status',
        'ville',
        'gouvernorat',
        'telephone'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function prestataire()
    {
        return $this->belongsTo(Prestataire::class);
    }
}
