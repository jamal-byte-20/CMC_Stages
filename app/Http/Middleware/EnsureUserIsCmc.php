<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsCmc
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        if (!$user) {
            abort(401, 'Unauthorized');
        }

        // Ensure the relationship is loaded
        if (!$user->relationLoaded('userCmc')) {
            $user->load('userCmc');
        }

        if (!$user->userCmc) {
            abort(403, 'You must have a CMC profile to access this resource.');
        }

        return $next($request);
    }
}
