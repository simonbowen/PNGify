<?php

require "./vendor/autoload.php";

use Slim\App;
use Slim\Container;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

$container = new Container();
$app = new App($container);

$app->post('/', function(Request $request, Response $response) {

    $fileName = $_FILES['file']['name'];
    $extension = pathinfo($fileName)['extension'];

    $fileConverter = new \Thummer\FileConverter($_FILES['file']['tmp_name'], $extension);
    $image = $fileConverter->toImage();

    $response = $response->withHeader('Content-Type', 'image/png');
    $body = $response->getBody();
    $body->write($image);
    $response = $response->withBody($body);

    return $response;

});

$app->run();
