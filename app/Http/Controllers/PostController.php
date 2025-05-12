<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Posts;

class PostsController extends Controller
{
    /**
     * Affiche toutes les publications (Posts)
     */
    public function index()
    {
        $userType = Session::get('user_type');
        $posts = [];

        if ($userType === 'user') {
            // Un utilisateur voit ses propres posts
            $posts = Posts::where('user_id', Session::get('user_id'))->latest()->get();
        } elseif (in_array($userType, ['individu', 'entreprise'])) {
            // Un prestataire peut voir tous les posts
            $posts = Posts::with('user')->latest()->get();
        }

        return view('posts.index', compact('posts', 'userType'));
    }

    /**
     * Affiche le formulaire de création d'un nouveau post
     */
    public function create()
    {
        if (!Session::get('logged_in') || Session::get('user_type') !== 'user') {
            return redirect()->route('login.form')
                ->with('error', 'Action non autorisée');
        }

        return view('posts.create');
    }

    /**
     * Enregistre un nouveau post dans la base de données
     */
    public function store(Request $request)
    {
        if (!Session::get('logged_in') || Session::get('user_type') !== 'user') {
            return redirect()->route('login.form')
                ->with('error', 'Action non autorisée');
        }

        $validated = $request->validate([
            'description' => 'required|string|min:10|max:1000',
        ]);

        try {
            Posts::create([
                'user_id' => Session::get('user_id'),
                'description' => strip_tags($validated['description']),
            ]);

            return redirect()->route('posts.index')->with('success', 'Publication ajoutée avec succès !');

        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', "Erreur technique : " . $e->getMessage());
        }
    }

    /**
     * Affiche les détails d'une publication spécifique
     */
    public function show(Posts $post)
    {
        if (!Session::get('logged_in')) {
            return redirect()->route('login.form')
                ->with('error', 'Action non autorisée');
        }

        // Autoriser uniquement si c'est l'utilisateur du post ou un prestataire
        $userType = Session::get('user_type');
        if (($userType === 'user' && $post->user_id !== Session::get('user_id')) &&
            !in_array($userType, ['individu', 'entreprise'])) {
            abort(403);
        }

        return view('posts.show', compact('post'));
    }

    /**
     * Affiche le formulaire d'édition d'un post
     */
    public function edit(Posts $post)
    {
        if (!Session::get('logged_in') || Session::get('user_type') !== 'user') {
            return redirect()->route('login.form')
                ->with('error', 'Action non autorisée');
        }

        if (Session::get('user_id') !== $post->user_id) {
            abort(403);
        }

        return view('posts.edit', compact('post'));
    }

    /**
     * Met à jour un post existant
     */
    public function update(Request $request, Posts $post)
    {
        if (!Session::get('logged_in') || Session::get('user_type') !== 'user') {
            return redirect()->route('login.form')
                ->with('error', 'Action non autorisée');
        }

        if (Session::get('user_id') !== $post->user_id) {
            abort(403);
        }

        $validated = $request->validate([
            'description' => 'required|string|min:10|max:1000',
        ]);

        try {
            $post->update([
                'description' => strip_tags($validated['description']),
            ]);

            return redirect()->route('posts.index')->with('success', 'Publication mise à jour avec succès !');

        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', "Erreur technique : " . $e->getMessage());
        }
    }

    /**
     * Supprime un post
     */
    public function destroy(Posts $post)
    {
        if (!Session::get('logged_in') || Session::get('user_type') !== 'user') {
            return redirect()->route('login.form')
                ->with('error', 'Action non autorisée');
        }

        if (Session::get('user_id') !== $post->user_id) {
            abort(403);
        }

        try {
            $post->delete();
            return redirect()->route('posts.index')->with('success', 'Publication supprimée avec succès !');

        } catch (\Exception $e) {
            return back()->with('error', "Erreur lors de la suppression : " . $e->getMessage());
        }
    }
}