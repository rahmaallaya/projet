<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name_categorie', 'description', 'type', 'image'];

    public function prestataires()
    {
        return $this->hasMany(Prestataire::class, 'id_categorie')->whereNotNull('name');
    }
}
