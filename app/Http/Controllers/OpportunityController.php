<?php

namespace App\Http\Controllers;

use App\Models\Opportunity;
use App\Models\Secteur;
use App\Models\Type;
use Illuminate\Http\Request;

class OpportunityController extends Controller
{
    public function index()
    {
        $opportunities = Opportunity::with(['secteur', 'type'])->get();
        return view('opportunities.index', compact('opportunities'));
    }

    public function create()
    {
        $secteurs = Secteur::all();
        $types = Type::all();

        return view('opportunities.create', compact('secteurs', 'types'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'secteur_id' => 'required|integer|exists:secteurs,id',
            'type_id' => 'required|integer|exists:types,id',
            'ville' => 'required|string|max:255',
        ]);

        Opportunity::create($validatedData);

        return redirect()->route('opportunities.index')
                         ->with('success', 'Opportunity added successfully!');
    }

    public function show(Opportunity $opportunity)
    {
        $opportunity->load(['secteur', 'type']);
        return view('opportunities.show', compact('opportunity'));
    }

    public function edit(Opportunity $opportunity)
    {
        $secteurs = Secteur::all();
        $types = Type::all();

        return view('opportunities.edit', compact('opportunity', 'secteurs', 'types'));
    }

    public function update(Request $request, Opportunity $opportunity)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'secteur_id' => 'required|integer|exists:secteurs,id',
            'type_id' => 'required|integer|exists:types,id',
            'ville' => 'required|string|max:255',
        ]);

        $opportunity->update($validatedData);

        return redirect()->route('opportunities.index')
                         ->with('success', 'Opportunity updated successfully!');
    }

    public function destroy(Opportunity $opportunity)
    {
        $opportunity->delete();

        return redirect()->route('opportunities.index')
                         ->with('success', 'Opportunity deleted successfully!');
    }
}