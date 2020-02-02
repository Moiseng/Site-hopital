<?php

require "../vendor/autoload.php";

use App\Router;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;

$whoops = (new Run())
    ->pushHandler(new PrettyPageHandler())
    ->register();

$router =(new Router(dirname(__DIR__ ) . "/views"))
    ->get("/", "index", "home")
    ->run();

