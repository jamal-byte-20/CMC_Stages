<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Route as RouteFacade;
use Illuminate\View\View;

class RouteListController extends Controller
{
    public function index(Request $request): View
    {
        $routes = collect(RouteFacade::getRoutes())->map(function (Route $route) {
            return [
                'methods' => implode(', ', $route->methods()),
                'uri' => $route->uri(),
                'name' => $route->getName(),
                'action' => $route->getActionName(),
                'middleware' => implode(', ', (array) $route->gatherMiddleware()),
                'domain' => $route->domain() ?? 'n/a',
            ];
        });

        return view('routes.index', [
            'routes' => $routes,
        ]);
    }
}
