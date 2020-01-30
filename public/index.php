
    <?php

    require_once '../vendor/autoload.php';

    require_once '../views/templates/header.php';

    use App\Controllers\{PacienteController, InternacionController};
    use Aura\Router\RouterContainer;

    require '../App/Controllers/PacienteController.php';
    require '../App/Controllers/InternacionController.php';

    $request = Laminas\Diactoros\ServerRequestFactory::fromGlobals(
        $_SERVER,
        $_GET,
        $_POST,
        $_COOKIE,
        $_FILES
    );

    $routerContainer = new RouterContainer();

    $map = $routerContainer->getMap();

    $map->get('index', '/fuerarango/', 'index.php');
    $map->get('hola', '/fuerarango/paciente/register', 'hola.php');

    $matcher = $routerContainer->getMatcher();

    $route = $matcher->match($request);

    if(!$route) {
        
        echo 'no route';

    } else {
        var_dump($route->handler);
    }
    

    if (isset($_GET['controller']) && class_exists($_GET['controller'])) {

        $nombre_controlador = $_GET['controller'];

        $controlador = new $nombre_controlador();

        // Si el metodo esta seteado y existe dentro del controlador
        if (isset($_GET['action']) && method_exists($controlador, $_GET['action'])) {

            // ejecuto el metodo
            $action = $_GET['action'];
            $controlador->$action();
        } elseif (!isset($_GET['action'])) {

            echo '';
        } else {

            echo 'El parametro action ingresado no es valido';
        }
    } elseif (!isset($_GET['controller'])) {

        echo '';
    } else {
        echo 'El parametro controller ingresado no es valido';
    }
    require_once '../views/templates/footer.php'
    ?>
