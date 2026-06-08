<?php

namespace App\Http\Controllers;

use App\Models\Opportunity;
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
        if ($request->filled('secteur')) {
            $query->where('secteur', 'like', '%' . $request->input('secteur') . '%');
        }
        if ($request->filled('type')) {
            $query->where('type', 'like', '%' . $request->input('type') . '%');
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

        return view('opportunities.create');
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

        return view('opportunities.edit', ['opportunity' => $opportunity]);
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
