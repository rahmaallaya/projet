<?php

namespace App\Http\Controllers;

use App\Models\Prestataire;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Session;

class ApprovalController extends Controller
{
    // Liste des prestataires en attente d'approbation
    public function index()
    {
        $prestataires = Prestataire::where('isConfirmed', 'desactive')->get();
        $categories = Category::all();
        return view('admin.approvals', compact('prestataires', 'categories'));
    }

    // Détails d'un prestataire
    public function show($id)
    {
        $prestataire = Prestataire::findOrFail($id);
        $categories = Category::all();

        return view('admin.prestataire_details', compact('prestataire', 'categories'));
    }

    // Approuver un prestataire
    public function approve($id)
    {
        $prestataire = Prestataire::findOrFail($id);
        $prestataire->isConfirmed = 'active';
        $prestataire->id_categorie = request('category'); // Save the selected category
        $prestataire->save();
    
        return redirect()->route('approvals.index')->with('success', 'Prestataire approuvé.');
    }

    // Rejeter un prestataire
    public function reject($id)
    {
        $prestataire = Prestataire::findOrFail($id);
        $prestataire->delete();
        return redirect()->route('approvals.index')->with('success', 'Prestataire rejeté.');
    }
}