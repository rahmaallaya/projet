<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Prestataire;
class ServiceController extends Controller
{// List corporate services
    public function corporateList()
    {
        $categories = Category::where('type', 'entreprise')->get();
        return view('services.corporate.list', compact('categories'));
    }

    // List individual services
    public function individualList()
    {
        $categories = Category::where('type', 'individu')->get();
        return view('services.individual.list', compact('categories'));
    }

    // Show category details
    public function show($id)
    {
        $category = Category::findOrFail($id);
        $prestataires = Prestataire::where('id_categorie', $id)->where('isConfirmed', 'active')->get();
        return view('services.' . ($category->type === 'entreprise' ? 'corporate' : 'individual') . '.show', compact('category', 'prestataires'));
    }
    // app/Http/Controllers/ServiceController.php

public function showIndividualPrestataires(Category $category)
{
    $prestataires = $category->prestataires()->where('role', 'individu')->get();
    return view('prestataires.list', compact('category', 'prestataires'));
}

public function showCorporatePrestataires(Category $category)
{
    $prestataires = $category->prestataires()->where('role', 'entreprise')->get();
    return view('prestataires.list', compact('category', 'prestataires'));
}
}