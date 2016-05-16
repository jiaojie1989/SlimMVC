<?php

//// GET index route
$app->get('/', function () use ($app) {
    $oStuff = new models\Stuff();
    $hello = $oStuff->setStuff();
    $app->render('index.html', array('hello' => $hello));
});

$app->get('/hello/:user', function ($user) use ($app) {
//    $app->render('index.html', array('hello' => "hello, $user"));
    $app->etag("{$user}_" . date("Ymd"), "weak");
    $app->flash("user", [rand()]);
    \RedBeanPHP\R::setup('mysql:host=172.16.7.27:3306;dbname=duizhang', 'jiaojie', '<Stp123>');
    $temp = \RedBeanPHP\R::find("pay_order", "sid = ?", [3822007107]);
    \Kint::dump($temp);
    $app->render('index.html', array('hello' => "hello, $user"));
})->name("test");



$getRoute = function(\Slim\Route $route) use($app) {
    \Kint::dump($route);
    \Kint::dump($app->urlFor("test", ["user" => "world"]));
    \Kint::dump($_SERVER);
};

$app->get('/hello/:user/:word', $getRoute, function ($user, $word) use ($app) {
//    $app->halt(403, 'You shall not pass!');
//    $app->expires('+1 week');
    $app->etag("1-{$user}-{$word}", "weak");
    $app->render('index.html', array('hello' => "hay, $word, $user"));
});

//$app->get("/", function () use ($app) {
////    $app->contentType("application/json");
//    return json_encode(["time" => date("Y-m-d H:i:s")]);
//});