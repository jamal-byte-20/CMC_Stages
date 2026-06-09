<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:cmc,partenaire'],
            'post' => ['required_if:role,cmc', 'nullable', 'string', 'max:255'],
            'phone' => ['required_if:role,partenaire', 'nullable', 'string', 'max:50'],
            'city' => ['nullable', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if ($request->role === 'cmc') {
            $user->userCmc()->create([
                'post' => $request->post ?? 'CMC',
            ]);
            // Refresh the user to load the relationship
            $user = $user->fresh();
        }

        if ($request->role === 'partenaire') {
            $user->partenaire()->create([
                'phone' => $request->phone ?? null,
                'address' => $request->address ?? null,
                'city' => $request->city ?? null,
            ]);
            // Refresh the user to load the relationship
            $user = $user->fresh();
        }

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
