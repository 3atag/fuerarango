
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

    /* PACIENTES */
    $map->get('indexPacientes', '/fuerarango/pacientes/index', [
        'controller' => 'App\Controllers\PacienteController',
        'action' => 'viewAll'
    ]);

    $map->get('addPaciente', '/fuerarango/pacientes/nuevo', [
        'controller' => 'App\Controllers\PacienteController',
        'action' => 'add'
    ]);

    $map->post('savePaciente', '/fuerarango/pacientes/save', [
        'controller' => 'App\Controllers\PacienteController',
        'action' => 'save'
    ]);

    /* PRACTICAS */
    $map->get('indexPracticas', '/fuerarango/practicas', [
        'controller' => 'App\Controllers\PracticaController',
        'action' => 'viewAll'
    ]);

    $map->get('addPractica', '/fuerarango/practicas/nueva', [
        'controller' => 'App\Controllers\PracticaController',
        'action' => 'add'
    ]);

    $map->post('savePractica', '/fuerarango/practicas/save', [
        'controller' => 'App\Controllers\PracticaController',
        'action' => 'save'
    ]);

    $map->get('editPractica', '/fuerarango/practicas/edit', [
        'controller' => 'App\Controllers\PracticaController',
        'action' => 'edit'
    ]);

    $map->get('offPractica', '/fuerarango/practicas/off', [
        'controller' => 'App\Controllers\PracticaController',
        'action' => 'off'
    ]);

    


    /* INTERNACION */
    $map->get('addInternacion', '/fuerarango/internaciones/nueva', [
        'controller' => 'App\Controllers\InternacionController',
        'action' => 'add'
    ]);

    $map->post('saveInternacion', '/fuerarango/internaciones/save', [
        'controller' => 'App\Controllers\InternacionController',
        'action' => 'save'
    ]);

    $map->get('index', '/fuerarango/', [
        'controller' => 'App\Controllers\InternacionController',
        'action' => 'viewAll'
    ]);

    $matcher = $routerContainer->getMatcher();

    $route = $matcher->match($request);

    if (!$route) {

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
