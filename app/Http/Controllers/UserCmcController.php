<?php

namespace App\Http\Controllers;

use App\Models\UserCmc;
use Illuminate\Http\Request;

class UserCmcController extends Controller
{
    public function index()
    {
        $userCmc = auth()->user()->userCmc;

        return view('user-cmcs.index', [
            'userCmcs' => $userCmc ? collect([$userCmc]) : collect(),
        ]);
    }

    public function create()
    {
        if (auth()->user()->userCmc) {
            return redirect()->route('user-cmcs.index');
        }

        return view('user-cmcs.create');
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        if ($user->userCmc) {
            return redirect()->route('user-cmcs.index')->with('status', 'Vous avez déjà un profil CMC.');
        }

        $user->userCmc()->create($request->validate([
            'post' => 'required|string|max:255',
        ]));

        return redirect()->route('user-cmcs.index')->with('status', 'Profil CMC créé.');
    }

    public function show(UserCmc $userCmc)
    {
        abort_unless(auth()->id() === $userCmc->user_id, 403);

        return view('user-cmcs.show', ['userCmc' => $userCmc]);
    }

    public function edit(UserCmc $userCmc)
    {
        abort_unless(auth()->id() === $userCmc->user_id, 403);

        return view('user-cmcs.edit', ['userCmc' => $userCmc]);
    }

    public function update(Request $request, UserCmc $userCmc)
    {
        abort_unless(auth()->id() === $userCmc->user_id, 403);

        $userCmc->update($request->validate([
            'post' => 'required|string|max:255',
        ]));

        return redirect()->route('user-cmcs.index')->with('status', 'Profil CMC mis à jour.');
    }

    public function destroy(UserCmc $userCmc)
    {
        abort_unless(auth()->id() === $userCmc->user_id, 403);

        $userCmc->delete();

        return redirect()->route('user-cmcs.index')->with('status', 'Profil CMC supprimé.');
    }
}
