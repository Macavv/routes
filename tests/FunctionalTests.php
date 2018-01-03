<?php

namespace Macavv\Routes;

use Illuminate\Routing\Router;

class FunctionalTests extends TestCase
{
    public function test_routes()
    {
       $router = $this->createMock(Router::class);
       $routes = $router->getRoutes();
       echo var_dump($routes);
    }
}