<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

// CONFIG

$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;

$config['db']['host']   = "localhost";
$config['db']['user']   = "user";
$config['db']['pass']   = "password";
$config['db']['dbname'] = "exampleapp";

require 'vendor/autoload.php';

// PASS CONFIG IN
$app = new \Slim\App(["settings" => $config]);

// SLIM CONTAINER FOR DEPENDENCIES
$container = $app->getContainer();

// adding monolog lib
$container['logger'] = function($c) {
    $logger = new \Monolog\Logger('my_logger');
    $file_handler = new \Monolog\Handler\StreamHandler("../logs/app.log");
    $logger->pushHandler($file_handler);
    return $logger;
};

// Use monolog wherever needed like this:
//    $this->logger->addInfo("Something interesting happened");

$app->get('/', function (Request $request, Response $response) {
    $response->getBody()->write("Hello");

    return $response;
});
$app->get('/hello/{name}', function (Request $request, Response $response) {
    $name = $request->getAttribute('name');
    $response->getBody()->write("Hello, $name");

    return $response;
});
$app->run();
