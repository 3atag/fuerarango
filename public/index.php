
    <?php

    require_once '../vendor/autoload.php';

    require_once '../config/parameters.php';

    require_once '../views/templates/header.php';
    
    use Aura\Router\RouterContainer;

    $request = Laminas\Diactoros\ServerRequestFactory::fromGlobals(
        $_SERVER,
        $_GET,
        $_POST,
        $_COOKIE,
        $_FILES
    );

    $routerContainer = new RouterContainer();

    $map = $routerContainer->getMap();

    $map->get('index', '/fuerarango/', [
        'controller'=>'App\Controllers\InternacionController',
        'action'=>'viewAll'
    ]);

    $map->get('hola', '/fuerarango/paciente/add', [
        'controller'=>'App\Controllers\PacienteController',
        'action'=>'add'
    ]);

    $matcher = $routerContainer->getMatcher();

    $route = $matcher->match($request);

    if(!$route) {
        
        echo 'no route';

    } else {
        $handlerData = $route->handler;
        $controllerName = $handlerData['controller'];
        $actionName = $handlerData['action'];

        $controller = new $controllerName;
        $controller->$actionName();
       
    }
    

    
    require_once '../views/templates/footer.php'
    ?>
