<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Prestataire;

class ServiceController extends Controller
{
    // Liste des services entreprises
    public function corporateList()
    {
        $categories = Category::where('type', 'entreprise')->get();
        return view('services.corporate.list', compact('categories'));
    }

    // Liste des services individuels
    public function individualList()
    {
        $categories = Category::where('type', 'individu')->get();
        return view('services.individual.list', compact('categories'));
    }

    // Détails d'une catégorie
    public function show($id)
    {
        $category = Category::findOrFail($id);
        $prestataires = Prestataire::where('id_categorie', $id)
                                   ->where('isConfirmed', 'active')
                                   ->get();
        
        return view('prestataires', compact('category', 'prestataires'));
    }

    public function showIndividualPrestataires(Category $category)
    {
        $prestataires = $category->prestataires()
                                ->where('role', 'individu')
                                ->whereNotNull('name')
                                ->get();
    
        return view('prestataires.list', compact('category', 'prestataires'));
    }
    // Prestataires entreprises d'une catégorie
    public function showCorporatePrestataires(Category $category)
    {
        $prestataires = $category->prestataires()
                                ->where('role', 'entreprise')
                                ->whereNotNull('name')
                                ->get();
        return view('prestataires.list', compact('category', 'prestataires'));
    }
}