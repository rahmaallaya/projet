<?php

namespace App\Http\Controllers;

use App\Models\ServiceRequest;
use App\Models\Prestataire;
use Illuminate\Http\Request;

class RequestController extends Controller
{
    public function index()
    {
        $userType = session('type');
        $requests = [];
        
        if ($userType === 'user') {
            $requests = ServiceRequest::with('prestataire')
                ->where('user_id', session('user_id'))
                ->latest()
                ->get();
        } elseif (in_array($userType, ['individu', 'entreprise'])) {
            $requests = ServiceRequest::with('user')
                ->where('prestataire_id', session('prestataire_id'))
                ->latest()
                ->get();
        }

        return view('requests.index', compact('requests', 'userType'));
    }


    public function store(Request $request, Prestataire $prestataire)
{
    $request->validate([
        'description' => 'required|string|min:10',
        'ville' => 'required|string|max:255',
        'gouvernorat' => 'required|string|max:255',
        'telephone' => 'required|string|max:20'
    ]);

    ServiceRequest::create([
        'user_id' => auth()->id(),
        'prestataire_id' => $prestataire->id,
        'description' => $request->description,
        'ville' => $request->ville,
        'gouvernorat' => $request->gouvernorat,
        'telephone' => $request->telephone,
        'status' => 'pending'
    ]);

    return redirect()->back()->with('success', 'Demande envoyée avec succès!');
}
    
    public function update(Request $request, ServiceRequest $serviceRequest)
    {
        $this->authorizePrestataire($serviceRequest);
        
        $request->validate(['status' => 'required|in:accepted,rejected']);
        $serviceRequest->update(['status' => $request->status]);
    
        return back()->with('success', 'Statut mis à jour');
    }
    private function authorizePrestataire($serviceRequest)
    {
        if (session('prestataire_id') !== $serviceRequest->prestataire_id) {
            abort(403);
        }
    }
}
