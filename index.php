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
    $pathInfo = pathinfo($fileName);
    $extension = $pathInfo['extension'];

    $fileConverter = new \PNGify\FileConverter($_FILES['file']['tmp_name'], $extension);
    $config = require './config.php';
    $fileConverter->setMappings($config['extensions']);

    try {
        $image = $fileConverter->toImage();
    } catch(\PNGify\Exceptions\InvalidFileExtension $e) {
        $response = $response->withStatus(400);

        /** @var \Psr\Http\Message\StreamInterface $body */
        $body = $response->getBody();
        $body->write(json_encode(['error' => 'Invalid file extension']));
        $response = $response->withHeader('Content-Type', 'application/json');
        $response = $response->withHeader('Content-Disposition', 'inline; filename="' . $pathInfo['filename'] . '.png"');
        $response = $response->withBody($body);

        return $response;
    }

    $response = $response->withHeader('Content-Type', 'image/png');
    $body = $response->getBody();
    $body->write($image);
    $response = $response->withBody($body);
    return $response;

});

$app->get('/', function (Request $request, Response $response) {

    $body = $response->getBody();
    $body->write(file_get_contents('./static/templates/index.html'));

    $response = $response->withBody($body);

    return $response;

});

$app->run();
