<?php

namespace App;
use AltoRouter;

final class Router
{

    /**
     * @var string
     */
    private $viewPath;

    /**
     * @var AltoRouter
     */
    private $router;

    public function __construct(string $viewPath)
    {
        $this->viewPath = $viewPath;
        $this->router = new AltoRouter();
    }

    /**
     * Permet de générer une URL en GET
     *
     * @param string $url
     * @param string $view
     * @param string|null $viewName
     * @return Router
     * @throws \Exception
     */
    public function get(string $url, string $view, ?string $viewName = null): self
    {
        $this->router->map("GET", $url, $view, $viewName);
        return $this;
    }

    /**
     * Permet de générer une URL en POST
     *
     * @param string $url
     * @param string $view
     * @param string|null $viewName
     * @return Router
     * @throws \Exception
     */
    public function post(string $url, string $view, ?string $viewName = null): self
    {
        $this->router->map("POST", $url, $view, $viewName);
        return $this;
    }

    /**
     * Permet de générer une URL a la fois en GET et en POST
     *
     * @param string $url
     * @param string $view
     * @param string $viewName
     * @return Router
     * @throws \Exception
     */
    public function postAndGet(string $url, string $view, string $viewName): self
    {
        $this->router->map("POST|GET", $url, $view, $viewName);
        return $this;
    }

    /**
     * Génère une URL
     *
     * @param string $name
     * @param array $params
     * @return mixed
     * @throws \Exception
     */
    public function url(string $name, array $params = [])
    {
        return $this->router->generate($name, $params);
    }

    /**
     * Exécute les routes
     *
     * @return Router
     */
    public function run(): self
    {
        /* vérifie si la route envoyer éxiste */
        $match =$this->router->match();
        $view = $match["target"]; // récupere la vue a envoyer
        $params = $match["params"];
        $router = $this;
        if ($view === null) {
            $view = "error/e404";
            require $this->viewPath . DIRECTORY_SEPARATOR . $view . ".php";
            exit();
        }
        ob_start();
        require $this->viewPath . DIRECTORY_SEPARATOR . $view . ".php";
        $content = ob_get_clean();
        if ($view !== null) {
            require $this->viewPath . DIRECTORY_SEPARATOR . "layouts/default". ".php";
        }
        return $this;
    }

}
