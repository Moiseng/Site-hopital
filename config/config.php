<?php

use Framework\Renderer\RendererInterface;
use Framework\Renderer\TwigRendererFactory;
use Framework\Router\RouterTwigExtension;

return [
    \Framework\Router::class => \DI\create(),
    "views.path" => dirname(__DIR__) . DIRECTORY_SEPARATOR,
    "twig.extensions" => [
      \DI\get(RouterTwigExtension::class)
    ],
    RendererInterface::class => \DI\factory(TwigRendererFactory::class),
];