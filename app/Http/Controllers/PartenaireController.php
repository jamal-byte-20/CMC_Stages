<?php

namespace App\Http\Controllers;

use App\Models\Partenaire;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PartenaireController extends Controller
{
    public function index()
    {
        $partenaires = User::whereHas('partenaire')->with('partenaire')->get();

        return view('partenaires.index', [
            'partenaires' => $partenaires,
        ]);
    }

    public function create()
    {
        return view('partenaires.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'phone' => 'nullable|string|max:50',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        $user->partenaire()->create([
            'phone' => $data['phone'] ?? null,
            'address' => $data['address'] ?? null,
            'city' => $data['city'] ?? null,
        ]);

        return redirect()->route('partenaires.index')->with('status', 'Partenaire créé avec succès.');
    }

    public function edit(Partenaire $partenaire)
    {
        return view('partenaires.edit', [
            'partenaire' => $partenaire,
        ]);
    }

    public function update(Request $request, Partenaire $partenaire)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $partenaire->user->id,
            'password' => 'nullable|string|min:8',
            'phone' => 'nullable|string|max:50',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
        ]);

        $userData = [
            'name' => $data['name'],
            'email' => $data['email'],
        ];

        if (!empty($data['password'])) {
            $userData['password'] = bcrypt($data['password']);
        }

        $partenaire->user->update($userData);

        $partenaire->update([
            'phone' => $data['phone'] ?? null,
            'address' => $data['address'] ?? null,
            'city' => $data['city'] ?? null,
        ]);

        return redirect()->route('partenaires.index')->with('status', 'Partenaire mis à jour.');
    }

    public function destroy(Partenaire $partenaire)
    {
        $partenaire->user->delete();

        return redirect()->route('partenaires.index')->with('status', 'Partenaire supprimé.');
    }
}
