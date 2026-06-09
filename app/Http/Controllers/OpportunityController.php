<?php

namespace App\Http\Controllers;

use App\Models\Opportunity;
use App\Models\Secteur;
use App\Models\Type;
use Illuminate\Http\Request;

class OpportunityController extends Controller
{
    protected function validateOpportunity(Request $request): array
    {
        return $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'secteur' => 'nullable|string|max:255',
            'type' => 'nullable|string|max:255',
            'secteur_id' => 'nullable|exists:secteurs,id',
            'type_id' => 'nullable|exists:types,id',
            'niveau' => 'nullable|string|max:255',
            'profil_requis' => 'nullable|string|max:1000',
            'ville' => 'nullable|string|max:255',
        ]);
    }

    public function index(Request $request)
    {
        $user = auth()->user();

        $query = Opportunity::visibleTo($user)->latest();

        if ($request->filled('title')) {
            $query->where('title', 'like', '%' . $request->input('title') . '%');
        }
        
        // i only have the secteur and type id but i need their name to compare with the input

        if ($request->filled('secteur')) {
            $query->whereHas('secteur', fn($q) => $q->where('title', 'like', '%' . $request->input('secteur') . '%'));
        }
        if ($request->filled('type')) {
            $query->whereHas('type', fn($q) => $q->where('title', 'like', '%' . $request->input('type') . '%'));
        }

        return view('opportunities.index', [
            'opportunities' => $query->get(),
            'filters' => $request->only(['title', 'secteur', 'type']),
            'isCmc' => $user->isCmc(),
        ]);
    }

    public function create()
    {
        abort_unless(auth()->user()->isPartenaire(), 403);

        $secteurs = Secteur::all();
        $types = Type::all();

        return view('opportunities.create', compact('secteurs', 'types'));
    }

    public function store(Request $request)
    {
        $partenaire = auth()->user()->partenaire;

        abort_unless($partenaire, 403);

        $partenaire->opportunities()->create($this->validateOpportunity($request));

        return redirect()->route('opportunities.index')->with('status', 'Opportunité créée.');
    }

    public function edit(Opportunity $opportunity)
    {
        abort_unless(auth()->user()->partenaire && auth()->user()->partenaire->id === $opportunity->partenaire_id, 403);

        $secteurs = Secteur::all();
        $types = Type::all();

        return view('opportunities.edit', compact('opportunity', 'secteurs', 'types'));
    }

    public function update(Request $request, Opportunity $opportunity)
    {
        abort_unless(auth()->user()->partenaire && auth()->user()->partenaire->id === $opportunity->partenaire_id, 403);

        $opportunity->update($this->validateOpportunity($request));

        return redirect()->route('opportunities.index')->with('status', 'Opportunité mise à jour.');
    }

    public function destroy(Opportunity $opportunity)
    {
        abort_unless(auth()->user()->partenaire && auth()->user()->partenaire->id === $opportunity->partenaire_id, 403);

        $opportunity->delete();

        return redirect()->route('opportunities.index')->with('status', 'Opportunité supprimée.');
    }
}