<?php

namespace App\Hopital;

use App\Hopital\Actions\HopitalActions;
use DI\Container;
use Framework\Module;
use Framework\Renderer\RendererInterface;
use Framework\Router;

class PublicModule extends Module
{

    const DEFINITIONS = __DIR__ . "/config.php";

    public function __construct(Container $container)
    {
        $container->get(RendererInterface::class)->addPath("hopital", __DIR__ . "/views");
        $publicPrefix = $container->get("public.preflix");
        $router = $container->get(Router::class);
        $router->get($publicPrefix, HopitalActions::class, "hopital.index");
        $router->get($publicPrefix . "/about", HopitalActions::class, "hopital.about");
        $router->get($publicPrefix . "/contact", HopitalActions::class, "hopital.contact");
        $router->get($publicPrefix . "/error", HopitalActions::class, "hopital.error");
    }

}