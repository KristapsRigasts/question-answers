<?php

use App\Controllers\QuestionAnswerController;
use App\Redirect;
use App\Repositories\QuestionAndAnswer\PDOQuestionAndAnswerRepository;
use App\Repositories\QuestionAndAnswer\QuestionAndAnswerRepository;
use App\Repositories\User\PDOUserRepository;
use App\Repositories\User\UserRepository;
use App\View;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require_once 'vendor/autoload.php';

session_start();

$builder = new DI\ContainerBuilder();

/* In ContainerBuilder you can declare which Repository must be used when calling on Interface (
in case different data storages will be used or needs to be changed to different data storage) */
$builder->addDefinitions([
    QuestionAndAnswerRepository::class => DI\create(PDOQuestionAndAnswerRepository::class),
UserRepository::class => DI\create(PDOUserRepository::class)

]);

$container = $builder->build();
/* declaring routs and methods */
$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {

    $r->addRoute('GET', '/', [QuestionAnswerController::class, 'index']);
    $r->addRoute('POST', '/register', [QuestionAnswerController::class, 'register']);

    $r->addRoute('GET', '/question', [QuestionAnswerController::class, 'show']);
    $r->addRoute('POST', '/question', [QuestionAnswerController::class, 'answer']);

    $r->addRoute('GET', '/result', [QuestionAnswerController::class, 'result']);

});

$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:

        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];

        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];

        $controller = $handler[0];
        $method = $handler[1];

        /** @var View $response */
        $response = ($container->get($controller))->$method($vars);

        $twig = new Environment(new FilesystemLoader('app/Views'));
        $twig->addGlobal('session', $_SESSION);

        if($response instanceof View) {
            echo $twig->render($response->getPath() . '.html', $response->getVariables());
        }

        if ($response instanceof Redirect)
        {
            header('Location: ' . $response->getLocation());
            exit;
        }
        break;
}

if (isset($_SESSION['errors'])) {
    unset($_SESSION['errors']);
}

if (isset($_SESSION['inputs'])) {
    unset($_SESSION['inputs']);
}