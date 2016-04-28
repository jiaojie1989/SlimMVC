<?php

//// GET index route
$app->get('/', function () use ($app) {
    $oStuff = new models\Stuff();
    $hello = $oStuff->setStuff();
    $app->render('index.html', array('hello' => $hello));
});

$app->get('/hello/:user', function ($user) use ($app) {
    $app->render('index.html', array('hello' => "hello, $user"));
});

$app->get('/hello/:user/:word', function ($user, $word) use ($app) {
    $a = a;
    $app->render('index.html', array('hello' => "hay, $word, $user"));
});

//$app->get("/", function () use ($app) {
////    $app->contentType("application/json");
//    return json_encode(["time" => date("Y-m-d H:i:s")]);
//});