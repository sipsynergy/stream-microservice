<?php
// Routes

$app->get('/', function (\Slim\Http\Request $request, \Slim\Http\Response $response, $args) {

    $swagger = \Swagger\scan(__DIR__ . '/../src/App/Controller');

    return $response->withJson($swagger);

    // TODO: http://editor.swagger.io/#/
});

$app->get('/api/activities', 'App\Controller\ActivityController:fetchAllAction');
$app->patch('/api/activities', 'App\Controller\ActivityController:addActivityAction');
