<?php

namespace Framework\Router;

class Route
{

    /**
     * @var string
     */
    private $name;

    private $callable;

    /**
     * @var array
     */
    private $parameters;

    public function __construct(string $name, $callable, array $parameters)
    {
        $this->name = $name;
        $this->callable = $callable;
        $this->parameters = $parameters;
    }

    /**
     * Retourne le nom de la Route
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return callable|string
     */
    public function getCallback()
    {
        return $this->callable;
    }

    /**
     * Retourne les paramètres de la Route
     *
     * @return string[]
     */
    public function getParameters(): array
    {
        return $this->parameters;
    }
}