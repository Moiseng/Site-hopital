<?php

namespace Tests\Framework\Renderer;

use Framework\Renderer\TwigRenderer;
use PHPUnit\Framework\TestCase;
use PHPUnit\TextUI\Configuration\Loader;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class TwigRendererTest extends TestCase
{

    /**
     * @var TwigRenderer
     */
    private $renderer;

    public function setUp(): void
    {
        $loader = new FilesystemLoader();
        $twig = new Environment($loader);
        $this->renderer = new TwigRenderer($twig);
    }

    /* Test avec un namespace */
    public function testRendererTheRightNamespace()
    {
        $this->renderer->addPath("blog", __DIR__ . "/views");
        $content = $this->renderer->render("@blog/demo");
        $this->assertEquals("salut les gens", $content);
    }

    public function testRendererWithDefaultNamespace()
    {
        $this->renderer->addPath(__DIR__ . "/views");
        $content = $this->renderer->render("demo");
        $this->assertEquals("salut les gens", $content);
    }

    public function testRendererWithParams()
    {
        $this->renderer->addPath(__DIR__ . "/views");
        $content = $this->renderer->render("demo2", ["name" => "marc"]);
        $this->assertEquals("Salut marc", $content);
    }

    public function testGlobalParameters()
    {
        $this->renderer->addPath(__DIR__ . "/views");
        $this->renderer->addGlobals("name", "Marc");
        $content = $this->renderer->render("demo2");
        $this->assertEquals("Salut Marc", $content);
    }

}