<?php

namespace App\AdminApi;

use Illuminate\Routing\Router;

/**
 * Decorates Restful routes
 *
 * Class RouterDecorator
 * @package App\AdminApi
 */
class RouterDecorator
{
    /**
     * @var Router
     */
    protected $router;

    /**
     * RouterDecorator constructor.
     * @param Router $router
     */
    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    /**
     * @param $routes
     */
    public function decorate($routes)
    {
        foreach ($routes as $resource => $controller)
        {
            $this->router->get("/{$resource}", "{$controller}@get");
            $this->router->post("/{$resource}", "{$controller}@create");
            $this->router->get("/{$resource}/{id}", "{$controller}@detail");
            $this->router->delete("/{$resource}/{id}", "{$controller}@delete");
            $this->router->post("/{$resource}/{id}", "{$controller}@update");
        }
    }
}