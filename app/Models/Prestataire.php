<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestataire extends Model
{
    use HasFactory;
    protected $fillable = [
       'role', 'name', 'email', 'password', 'id_categorie', 'isConfirmed', 'image', 'description',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'id_categorie');
    }
    
public function prestataires()
{
    return $this->hasMany(Prestataire::class, 'id_categorie');
}
}
