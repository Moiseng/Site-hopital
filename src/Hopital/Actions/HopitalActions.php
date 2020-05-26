<?php

namespace App\Hopital\Actions;

use Framework\Renderer\RendererInterface;
use Framework\Router;
use Psr\Http\Message\ServerRequestInterface;

class HopitalActions
{

    /**
     * @var RendererInterface
     */
    private $renderer;

    /**
     * @var Router
     */
    private $router;

    public function __construct(RendererInterface $renderer, Router $router)
    {
        $this->renderer = $renderer;
        $this->router = $router;
    }


    public function __invoke(ServerRequestInterface $request)
    {
        if (substr((string)$request->getUri(), -7) === "hopital") {
            return $this->index();
        } elseif (substr((string)$request->getUri(), -7) === "contact" ) {
            return $this->contact();
        } elseif (substr((string)$request->getUri(), -5) === "error") {
            return $this->notRouteFound();
        } else {
            return $this->about();
        }
    }

    public function index(): string
    {
        return $this->renderer->render("@hopital/index");
    }

    public function about(): string
    {
        return $this->renderer->render("@hopital/about");
    }

    public function contact(): string
    {
        return $this->renderer->render("@hopital/contact");
    }

    public function notRouteFound()
    {
        return $this->renderer->render("@hopital/error/e404");
    }
}