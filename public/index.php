<?php

require "../vendor/autoload.php";

use App\Router;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;

$whoops = (new Run())
    ->pushHandler(new PrettyPageHandler())
    ->register();

$router =(new Router(dirname(__DIR__ ) . "/views"))
    ->get("/acceuil", "index", "home")
    ->get("/contact", "contact", "contact")
    ->get("/a-propos", "about", "about")
    ->run();

