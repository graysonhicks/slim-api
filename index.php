<?php

require 'vender/autoload.php';

$app = new \Slim\App();

$app->get('/', function($req, $res, $params){
  return $res->write("Hello");
});

$app->get('/hello/{name}', function($req, $res, $params){
  return $res->write("Hello" . $params['name']);
});

$app->run();
