<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class Prestataire extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guard = 'prestataire';

    protected $fillable = [
        'role', 'name', 'email', 'password', 
        'id_categorie', 'isConfirmed', 'image', 'description'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];


    public function category()
    {
        return $this->belongsTo(Category::class, 'id_categorie');
    }
    
public function prestataires()
{
    return $this->hasMany(Prestataire::class, 'id_categorie');
}
public function serviceRequests()
{
    return $this->hasMany(ServiceRequest::class);
}
}
