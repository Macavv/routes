<?php

namespace Macavv\Routes\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Router;

class RoutesController
{
    protected $router;

    /**
     * RoutesController constructor.
     * @param Router $router
     */
    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $routes = $this->router->getRoutes();

        if (!is_null($request['method'])) {
            $routes = $routes->get(strtoupper($request['method']));
        } else {
            $routes = $routes->getRoutes();
        }

        if (!is_null($request['keyword'])) {
            $path = $request['keyword'];

            $routes = array_filter($routes, function ($route) use ($path) {
                return !is_bool(strpos($route->uri, $path));
            });
        }

        return view('routes::routes', compact('routes', 'request'));
    }
}