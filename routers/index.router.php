<?php

//// GET index route
$app->get('/', function () use ($app) {
    $oStuff = new models\Stuff();
    $hello = $oStuff->setStuff();
    $app->render('index.html', array('hello' => $hello));
});

$app->get('/hello/:user', function ($user) use ($app) {
    $app->render('index.html', array('hello' => "hello, $user"));
})->name("test");



$getRoute = function(\Slim\Route $route) use($app) {
    \Kint::dump($route);
    \Kint::dump($app->urlFor("test", ["user" => "world"]));
};

$app->get('/hello/:user/:word', $getRoute, function ($user, $word) use ($app) {
//    $app->halt(403, 'You shall not pass!');
    $a =b;
    $app->render('index.html', array('hello' => "hay, $word, $user"));
});

//$app->get("/", function () use ($app) {
////    $app->contentType("application/json");
//    return json_encode(["time" => date("Y-m-d H:i:s")]);
//});