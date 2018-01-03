<?php

namespace Macavv\Routes;

use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    private $routerMock;

    protected function getPackageProviders($app)
    {
        return [
            RoutesServiceProvider::class
        ];
    }

    public function setUp()
    {
        parent::setUp();
        $this->routerMock = \Mockery::mock("Illuminate\Routing\Router");
    }
}