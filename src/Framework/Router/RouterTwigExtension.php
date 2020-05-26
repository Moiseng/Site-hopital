<?php

namespace Framework\Router;

use Framework\Router;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class RouterTwigExtension extends AbstractExtension
{

    /**
     * @var Router
     */
    private $router;

    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    public function getFunctions()
    {
        return [
          new TwigFunction("path", [$this, "pathFor"])
        ];
    }

    /**
     * Permet de générer une URL
     *
     * @param string $viewname , Le nom de la vue
     * @param array $params , Le paramètres de la vue ex " {id: param.id} "
     *
     * @return string
     */
    public function pathFor(string $viewname, array $params = []): string
    {
        return $this->router->generateUri($viewname, $params);
    }
}