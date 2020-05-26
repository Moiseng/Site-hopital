<?php

use App\Hopital\PublicModule;

require dirname(__DIR__) . "/vendor/autoload.php";

$modules = [
    PublicModule::class
];

$builder = new \DI\ContainerBuilder();
$builder->addDefinitions(dirname(__DIR__) . "/config/config.php");
foreach ($modules as $module) {
    if ($module::DEFINITIONS) {
        $builder->addDefinitions($module::DEFINITIONS);
    }
}
$container = $builder->build();

$app = new \Framework\App($container, $modules);

if (php_sapi_name() !== "cli") {
    $response =$app->run(\GuzzleHttp\Psr7\ServerRequest::fromGlobals());
    \Http\Response\send($response);
}