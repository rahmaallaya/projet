<?php
namespace App\Http\Controllers;

use App\Models\ContactRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail; // Add this import
use App\Mail\ContactResponse;
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
        if  (session('type') !== 'super_admin') {
            abort(403);
        }

        $requests = ContactRequest::latest()->paginate(10);
        return view('contact-requests.index', compact('requests'));
    }
  
public function response(Request $request, $id)
{
    if (session('type') !== 'super_admin') {
        abort(403);
    }

    $contactRequest = ContactRequest::findOrFail($id);
    $validated = $request->validate([
        'message' => 'required|string|min:10',
    ]);

    // Send the email
    Mail::to($contactRequest->email)->send(new ContactResponse($validated['message']));

    return redirect()->route('contact-requests.index')
        ->with('success', 'Response sent to ' . $contactRequest->email);
}

    // Delete a contact request
    public function destroy($id)
    {
        if (session('type') !== 'super_admin') {
            abort(403);
        }

        $contactRequest = ContactRequest::findOrFail($id);
        $contactRequest->delete();

        return redirect()->route('contact-requests.index')
            ->with('success', 'Request deleted successfully.');
    }

    public function show($id)
    {
        if (session('type') !== 'super_admin') {
            abort(403);
        }

        $request = ContactRequest::findOrFail($id);
        return view('contact-requests.show', compact('request'));
    }
}
