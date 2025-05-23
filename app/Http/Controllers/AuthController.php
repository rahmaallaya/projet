<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Prestataire;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    // Afficher le formulaire d'inscription
    public function showRegisterForm()
    {
        $categories = Category::all();
        return view('auth.register', ['categories' => $categories]);
    }

    // Gérer l'inscription
    public function register(Request $request)
    {
        // Validation des données
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users|unique:prestataires',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'nullable|in:individu,entreprise',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048|required_if:role,individu,entreprise',
            'category' => 'nullable|in:' . implode(',', array_merge(Category::pluck('id')->toArray(), ['NULL'])), // Allow NULL
            'description' => 'nullable|string',
        ]);
    
        if ($request->role) {
            // Inscription comme prestataire
            $imageName = '';
            if ($request->hasFile('image')) {
                $imageName = time() . '.' . $request->image->extension();
                $request->image->move(public_path('images'), $imageName);
            }
    
            // Handle "Other" category by setting it to NULL
            $categoryId = $request->category === 'NULL' ? null : $request->category;
    
            Prestataire::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
                'id_categorie' => $categoryId, // Use processed category ID
                'isConfirmed' => 'desactive',
                'image' => $imageName,
                'description' => $request->description,
            ]);
    
            return redirect()->route('login.form')->with('pending', 'Votre inscription est en attente d’approbation par le super admin.');
        } else {
            // Inscription comme utilisateur normal
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
    
            return redirect()->route('login.form')->with('success', 'Inscription réussie. Veuillez vous connecter.');
        }
    
    }

    // Afficher le formulaire de connexion
    public function showLoginForm()
    {
        return view('auth.login');
    }

    //Gérer la connexion
public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    // Tentative de connexion UTILISATEUR
    $user = User::where('email', $request->email)->first();
    if ($user && Hash::check($request->password, $user->password)) {
        Session::put([
            'user_id' => $user->id,
            'user_type' => 'user', // Type clairement différencié
            'user_name' => $user->name,
            'logged_in' => true
        ]);
        return redirect()->route('home');
    }

    // Tentative de connexion PRESTATAIRE
    $prestataire = Prestataire::where('email', $request->email)->first();
    if ($prestataire && Hash::check($request->password, $prestataire->password)) {
        if ($prestataire->isConfirmed === 'desactive') {
            return back()->withErrors(['compte' => 'Compte en attente de validation']);
        }

        Session::put([
            'prestataire_id' => $prestataire->id, // Clé distincte pour Prestataire
            'prestataire_role' => $prestataire->role,
            'user_type' => 'prestataire', // Type clairement différencié
            'user_name' => $prestataire->name,
            'logged_in' => true
        ]);
        return redirect()->route('home');
    }

    return back()->withErrors(['email' => 'Identifiants invalides']);
}

public function logout(Request $request)
{
    // Supprimer toutes les clés de session spécifiques
    Session::forget(['user_id', 'prestataire_id', 'user_type', 'user_name', 'logged_in']);
    
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    
    return redirect()->route('home');
}
}
    
   
