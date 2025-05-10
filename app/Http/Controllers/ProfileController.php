<?php

// app/Http/Controllers/ProfileController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Prestataire;

class ProfileController extends Controller
{
    public function edit()
    {
        if (session('type') === 'user') {
            $user = User::find(session('user_id'));
            return view('profile.edit', compact('user'));
        }
        
        $prestataire = Prestataire::find(session('prestataire_id'));
        return view('profile.edit', compact('prestataire'));
    }

    public function update(Request $request)
{
    $user = auth()->user();
    $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,'.$user->id,
        'password' => 'nullable|min:8|confirmed'
    ];

    if ($user->isProvider()) {
        $rules['description'] = 'required|string|min:20';
        $rules['image'] = 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048';
    }

    $validated = $request->validate($rules);

    // Update common fields
    $user->name = $validated['name'];
    $user->email = $validated['email'];
    
    if (!empty($validated['password'])) {
        $user->password = Hash::make($validated['password']);
    }

    // Handle provider-specific fields
    if ($user->isProvider()) {
        $provider = $user->provider; // Assuming you have this relationship
        
        $provider->description = $validated['description'];
        
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($provider->image) {
                Storage::delete('public/images/'.$provider->image);
            }
            
            $imageName = time().'.'.$request->image->extension();
            $request->image->storeAs('public/images', $imageName);
            $provider->image = $imageName;
        } elseif ($request->has('remove_image')) {
            Storage::delete('public/images/'.$provider->image);
            $provider->image = null;
        }
        
        $provider->save();
    }

    $user->save();

    return redirect()->route('profile.edit')->with('success', 'Profile updated successfully!');
}
}
