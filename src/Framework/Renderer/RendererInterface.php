<?php

namespace Framework\Renderer;

interface RendererInterface
{

    /**
     * Rajoute le chemin du fichier des vues
     *
     * @param string $namespace
     * @param string|null $path
     */
    public function addPath(string $namespace, ?string $path = null): void;

    /**
     * Permet de rendre une vue
     * Le chemin peut être précisé avec des namespaces rajoutés via addPath()
     * $this->render("view"), Une vie sans namespace
     * $this->render("@namespace/view"), une vue avec un namespace
     *
     * @param string $viewname , Le nom de la vue
     * @param array|null $params , Le paramètres à envoyer à la vue
     * @return string
     */
    public function render(string $viewname, ?array $params = []): string;

    /**
     * Permet de rajouter des variables globales aux vues
     *
     * @param string $key
     * @param $value
     */
    public function addGlobals(string $key, $value): void;
}