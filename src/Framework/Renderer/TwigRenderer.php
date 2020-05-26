<?php

namespace Framework\Renderer;

use Twig\Environment;

class TwigRenderer implements RendererInterface
{

    const DEFAULT_NAMESPACE_RENDERER = "__MAIN";

    /**
     * @var Environment
     */
    private $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * Rajoute le chemin du fichier des vues
     *
     * @param string|null $namespace
     * @param string|null $path
     */
    public function addPath(?string $namespace = null, ?string $path = null): void
    {
        if (is_null($path)) {
            $this->twig->getLoader()->addPath($namespace);
        } else {
            $this->twig->getLoader()->addPath($path, $namespace);
        }
    }

    /**
     * Permet de rendre une vue
     * Le chemin peut être précisé avec des namespaces rajoutés via addPath()
     * $this->render("view"), Une vie sans namespace
     * $this->render("@namespace/view"), une vue avec un namespace
     *
     * @param string $viewname , Le nom de la vue
     * @param array|null $params , Le paramètres à envoyer à la vue
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function render(string $viewname, ?array $params = []): string
    {
        return $this->twig->render($viewname . ".twig", $params);
    }

    /**
     * Permet de rajouter des variables globales aux vues
     *
     * @param string $key
     * @param $value
     */
    public function addGlobals(string $key, $value): void
    {
        $this->twig->addGlobal($key, $value);
    }
}