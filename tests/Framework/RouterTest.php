<?php

namespace Tests\Framework;

use Framework\Router;
use GuzzleHttp\Psr7\ServerRequest;
use PHPUnit\Framework\TestCase;

class RouterTest extends TestCase
{

    /**
     * @var Router
     */
    private $router;

    public function setUp(): void
    {
        $this->router = new Router();
    }

    public function testGetMethod()
    {
        $request = new ServerRequest("GET", "/demo");
        $this->router->get("/demo", function () {
            return "hello";
        },"demo");
        $route = $this->router->match($request);
        $this->assertEquals("demo", $route->getName());
        $this->assertEquals("hello", call_user_func_array($route->getCallback(), [$request]));
    }
    
    public function testGetMethodIfUrlDoesNotExists()
    {
        $request = new ServerRequest("GET", "/demo");
        $this->router->get("/demozae", function () {
            return "salut";
        }, "demo");
        $route = $this->router->match($request);
        $this->assertNull($route);
    }

    public function testGenerateUri()
    {
        $this->router->get("/demo", function () {
           return "hello";
        }, "demo");
        $uri = $this->router->generateUri("demo");
        $this->assertEquals("/demo", $uri);
    }

    /* Test l'url avec des paramètres ( slug, id ) */
    public function testGetMethodWithParams()
    {
        $request = new ServerRequest("GET", "/demo/mon-slug-5");
        $this->router->get("/demo/{slug:[a-z0-9\-]+}-{id:\d+}", function () {
            return "hello";
        }, "demo");
        $route = $this->router->match($request);
        $this->assertEquals("demo", $route->getName());
        $this->assertEquals("hello", call_user_func_array($route->getCallback(), [$request]));
        $this->assertEquals(["slug" => "mon-slug", "id" => 5], $route->getParameters());
    }

}