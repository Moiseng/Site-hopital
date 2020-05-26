<?php

namespace Framework;

use Framework\Middleware\CallableMiddleware;
use Framework\Router\Route;
use Mezzio\Router\FastRouteRouter;
use Mezzio\Router\Route as MezzioRoute;
use Psr\Http\Message\ServerRequestInterface;

class Router
{

    /**
     * @var FastRouteRouter
     */
    private $router;

    public function __construct()
    {
        $this->router = new FastRouteRouter();
    }

    public function get(string $uri, $callable, ?string $name = null)
    {
        $this->router->addRoute(new MezzioRoute($uri, new CallableMiddleware($callable), ["GET"], $name));
    }

    /**
     * Vérifie si une route correspond à la route demandée
     *
     * @param ServerRequestInterface $request
     * @return Route|null
     */
    public function match(ServerRequestInterface $request): ?Route
    {
        $result = $this->router->match($request);
        if ($result->isSuccess()) {
            return new Route(
                $result->getMatchedRouteName(),
                $result->getMatchedRoute()->getMiddleware()->getCallable(),
                $result->getMatchedParams());
        }
        return null;
    }

    /**
     * Génère une URL
     *
     * @param string $name
     * @param array $params
     * @return string|null
     */
    public function generateUri(string $name, array $params = []): ?string
    {
        return $this->router->generateUri($name, $params);
    }

}
