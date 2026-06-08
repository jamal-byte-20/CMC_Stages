<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PartenaireController extends Controller
{
    public function showPartnerForm()
    {
        return view('register-partner');
    }

    public function registerPartner(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email', 
            'password' => 'required|string|min:8|confirmed', 
        ], [
            'email.unique' => 'Cet email est déjà utilisé.',
            'password.confirmed' => 'Les deux mots de passe ne correspondent pas.',
        ]);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        return redirect()->route('login')->with('success', 'Compte Partenaire créé avec succès !');
    }
}
