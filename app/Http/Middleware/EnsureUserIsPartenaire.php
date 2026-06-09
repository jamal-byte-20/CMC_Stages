<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsPartenaire
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
        if (!$user->relationLoaded('partenaire')) {
            $user->load('partenaire');
        }

        if (!$user->partenaire) {
            abort(403, 'You must have a Partenaire profile to access this resource.');
        }

        return $next($request);
    }
}
