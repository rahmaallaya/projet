<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ServiceRequest;
use App\Models\Prestataire;

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


    public function store(Request $request, $prestataireId)
{
    if (!session('logged_in') || session('user_type') !== 'user') {
        return redirect()->route('login.form')
               ->with('error', 'Action non autorisée');
    }

    $validated = $request->validate([
        'description' => 'required|string|min:10|max:1000',
        'ville' => 'required|string|max:50',
        'gouvernorat' => 'required|string|max:50',
        'telephone' => 'required|digits:8' // Validation stricte
    ]);

    try {
        ServiceRequest::create([
            'user_id' => session('user_id'),
            'prestataire_id' => $prestataireId,
            'description' => strip_tags($validated['description']), // Sécurité
            'ville' => $validated['ville'],
            'gouvernorat' => $validated['gouvernorat'],
            'telephone' => $validated['telephone'],
            'status' => 'pending'
        ]);

        return back()->with('success', 'Demande envoyée!');

    } catch (\Exception $e) {
        return back()->withInput()
               ->with('error', "Erreur technique: ". $e->getMessage());
    }
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
