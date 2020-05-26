<?php

namespace Framework\Renderer;

class PHPRenderer implements RendererInterface
{

    const DEFAULT_NAMESPACE = "__MAIN";
    /**
     * Tableau des chemins
     * @var array
     */
    private $paths = [];

    /**
     * Tableau des variables globales
     * Variables accessible pour toutes les vues
     * @var array
     */
    private $globals = [];

    public function __construct(?string $defaultPath = null)
    {
        if (is_null($defaultPath)) {
            return null;
        }
        $this->addPath($defaultPath);
    }

    /**
     * Permet d'ajouter le chemin du fichier des vues
     * @param string $namespace
     * @param string $path
     */
    public function addPath(string $namespace, ?string $path = null): void
    {
        if (is_null($path)) {
            $this->paths[self::DEFAULT_NAMESPACE] = $namespace;
        } else {
            $this->paths[$namespace] = $path;
        }
    }

    /**
     * Permet de rendre une vue
     * Le chemin peut-être précisé avec des namespaces rajoutés via addPath()
     * $this->render("view"), Une vue sans namespace
     * $this->render("@blog/view"), une vue avec un namespace
     * @param string $viewName
     * @param array|null $params
     * @return string
     */
    public function render(string $viewName, ?array $params = []): string
    {
        if ($this->hasNamespace($viewName)) {
            $path = $this->replaceNamespace($viewName) . ".php";
        } else {
            $path = $this->paths[self::DEFAULT_NAMESPACE] . DIRECTORY_SEPARATOR . $viewName . ".php";
        }
        ob_start();
        $renderer = $this;
        extract($this->globals); // extrait les variables globales
        extract($params); // extrait les variables passé en parametre et les envoie à la vue
        require($path);
        return ob_get_clean();
    }

    private function hasNamespace(string $viewName): bool
    {
        if ($viewName[0] === "@") {
            return true;
        }
        return false;
    }

    private function getNamespace(string $viewName): string
    {
        return substr($viewName, 1, strpos($viewName, "/") -1);
    }

    private function replaceNamespace(string $viewName): string
    {
        $namespace = $this->getNamespace($viewName);
        return str_replace("@" . $namespace, $this->paths[$namespace], $viewName);
    }

    /**
     * Permet de rajouter des variables globales aux vues
     *
     * @param string $key
     * @param $value
     */
    public function addGlobals(string $key, $value): void
    {
        /* je sauvegarde la valeur pour la clé */
        $this->globals[$key] = $value;
    }
}