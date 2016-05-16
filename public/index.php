<?php

require '../vendor/autoload.php';
require '../config.php';

// Setup custom Twig view
$twigView = new \Slim\Views\Twig();
// monolog
//$logger = new \Monolog\Logger("slim");
//$handler = new \Monolog\Handler\FirePHPHandler();
//$logger->pushProcessor(new \Monolog\Processor\MemoryPeakUsageProcessor(true));
//$logger->pushProcessor(new \Monolog\Processor\WebProcessor());
//$logger->pushHandler($handler);
$writer = new \Jiaojie\Slim\LogWriter\MonologWriter([
    "name" => "slim",
    "processors" => [
        new \Monolog\Processor\WebProcessor(),
    ],
    "handlers" => [
        new \Monolog\Handler\FirePHPHandler(),
        new \Monolog\Handler\StreamHandler("/tmp/slim." . date("Y-m-d") . ".log"),
    ],
        ]);

$app = new \Slim\Slim([
    'debug' => false,
    'view' => $twigView,
    'templates.path' => '../templates/',
    'log.enabled' => true,
    'log.writer' => $writer,
    'log.level' => \Slim\Log::DEBUG,
    // Cookies
    'cookies.encrypt' => true,
    'cookies.lifetime' => '20 minutes',
    'cookies.path' => '/',
    'cookies.domain' => "jiaojie.me",
    'cookies.secure' => true,
    'cookies.httponly' => false,
    // Encryption
    'cookies.secret_key' => 'CHANGE_ME',
    'cookies.cipher' => MCRYPT_RIJNDAEL_256,
    'cookies.cipher_mode' => MCRYPT_MODE_CBC,
        ]);



// Automatically load router files
$routers = glob('../routers/*.router.php');
foreach ($routers as $router) {
    require $router;
}

$app->hook("slim.after.dispatch", function() use($app) {
    \Kint::dump($app->flashData());

//    $app->log->warn([12]);
});

$app->run();
