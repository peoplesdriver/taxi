<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;


/*стартуем сессию*/
session_start();



use Aptoma\Twig\Extension\MarkdownExtension;
use Aptoma\Twig\Extension\MarkdownEngine;
use Aptoma\Twig\TokenParser\MarkdownTokenParser;
use Cartalyst\Sentinel\Native\Facades\Sentinel;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;

/*Старт приложения*/
require_once __DIR__  . '/vendor/autoload.php';




spl_autoload_register(function ($class) {
    if (file_exists(__DIR__ .'/models/' . $class . '.php')) {
        include __DIR__ .'/models/' . $class . '.php';
    } elseif (file_exists(__DIR__ .'/middleware/' . $class . '.php')) {
        include __DIR__ .'/middleware/' . $class . '.php';
    } elseif (file_exists(__DIR__ .'/controllers/' . $class . '.php')) {
        include __DIR__ .'/controllers/' . $class . '.php';
    } elseif (file_exists(__DIR__ .'/helpers/' . $class . '.php')) {
        include __DIR__ .'/helpers/' . $class . '.php';
    }
});

$config = Config::getInstance();


if (!empty($_COOKIE['city'])) {
    $capsule = new Capsule;
    $capsule->addConnection($config->confs['aba19']['db']);
    $capsule->setEventDispatcher(new Dispatcher(new Container));
    $capsule->setAsGlobal();
    $capsule->bootEloquent();
}

// Create app
$configuration = [
    'settings' => [
        'displayErrorDetails' => true,
    ],
];
$c = new \Slim\Container($configuration);
$app = new \Slim\App($c);


// Get container
$container = $app->getContainer();
$container['errorHandler'] = function ($c) {
    return function ($request, $response, $exception) use ($c) {
//        ddd($exception);
        return $c['response']->withStatus(500)
            ->withHeader('Content-Type', 'text/html')
            ->write($exception->getMessage());
    };
};

// Add Sentinel
if (file_exists('config.php')) {
    $container['sentinel'] = function ($container) {
        $sentinel = (new \Cartalyst\Sentinel\Native\Facades\Sentinel())->getSentinel();
        return $sentinel;
    };

//    $app->add( new Registred($container) );
}

// Register component on container
$container['view'] = function ($container) {
    $view = new \Slim\Views\Twig(__DIR__.'/views');
    
    $view->addExtension(new \Slim\Views\TwigExtension(
        $container['router'],
        $container['request']->getUri()
    ));

    $twig = $view->getEnvironment();

    $twig->addGlobal("session", $_SESSION);
    
    return $view;
};

// Флэш сообщения
$container['flash'] = function () {
    return new \Slim\Flash\Messages();
};

$page = isset($_GET['page']) ? $_GET['page'] : 1;
Illuminate\Pagination\Paginator::currentPageResolver(function() use ($page) 
{ 
    return $page; 
});

$container['redis'] = function() use($config) {
        $redis = new Redis();
        $redis->cmd('AUTH', $config->confs['aba19']['redis']['pass'])->get();
        return $redis;
    };





require_once 'routes/public.php';
require_once 'routes/api.php';
require_once 'routes/admin.php';


$app->run();




