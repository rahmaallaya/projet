<?php
namespace App\Http\Controllers;

use App\Models\ContactRequest;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    // Afficher la page de contact
    public function create()
    {
        return view('contact');
    }

    // Traiter le formulaire
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|min:10'
        ]);

        ContactRequest::create($validated);

        return redirect()->back()
            ->with('success', 'Your message has been sent successfully!');
    }

    // Liste des demandes (admin)
    public function index()
    {
        if(auth()->user()->role !== 'super_admin') {
            abort(403);
        }

        $requests = ContactRequest::latest()->paginate(10);
        return view('admin.contact-requests', compact('requests'));
    }
}
