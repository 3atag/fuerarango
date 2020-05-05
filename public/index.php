
    <?php

    require_once '../vendor/autoload.php';

    session_start();

    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
    $dotenv->load();
  
    /*----------- Laravel Eloquent Config ------------*/

    use Illuminate\Database\Capsule\Manager as Capsule;

    use Laminas\Diactoros\Response\RedirectResponse;

    $capsule = new Capsule;

    $capsule->addConnection([
        'driver'    => 'mysql',
        'host'      => getenv('DB_HOST'),
        'database'  => getenv('DB_NAME'),
        'username'  => getenv('DB_USER'),
        'password'  => getenv('DB_PASS'),
        'charset'   => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix'    => '',
    ]);

    // Make this Capsule instance available globally via static methods... (optional)
    $capsule->setAsGlobal();

    // Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
    $capsule->bootEloquent();


    /*----------- AURA ROUTER Config ------------*/

    use App\Controllers\PracticaController;
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

    /* AUTENTICACION */

    $map->get('index', '/', [
        'controller' => 'App\Controllers\AuthController',
        'action' => 'getLogin'
    ]);

    /* PACIENTES */
    $map->get('indexPacientes', '/pacientes', [
        'controller' => 'App\Controllers\PacienteController',
        'action' => 'getAllPacienteAction',
        'auth' => true
    ]);

    $map->get('addPaciente', '/pacientes/nuevo', [
        'controller' => 'App\Controllers\PacienteController',
        'action' => 'getAddPacienteAction'
    ]);

    $map->post('savePaciente', '/pacientes/save', [
        'controller' => 'App\Controllers\PacienteController',
        'action' => 'postSavePacienteAction'
    ]);

    $map->get('importPadron', '/pacientes/padron', [
        'controller' => 'App\Controllers\PacienteController',
        'action' => 'getImportPadronAction'
    ]);

    $map->post('procesarPadron', '/pacientes/procesarPadron', [
        'controller' => 'App\Controllers\PacienteController',
        'action' => 'postProcesarPadronAction'
    ]);

    /* PRACTICAS */
    $map->get('indexPracticas', '/practicas', [
        'controller' => 'App\Controllers\PracticaController',
        'action' => 'getAllPracticaAction'
    ]);

    $map->get('addPractica', '/practicas/nueva', [
        'controller' => 'App\Controllers\PracticaController',
        'action' => 'getAddPracticaAction'
    ]);

    $map->post('savePractica', '/practicas/save', [
        'controller' => 'App\Controllers\PracticaController',
        'action' => 'postSavePracticaAction'
    ]);

    $map->get('editPractica', '/practicas/edit', [
        'controller' => 'App\Controllers\PracticaController',
        'action' => 'edit'
    ]);

    $map->get('offPractica', '/practicas/off', [
        'controller' => 'App\Controllers\PracticaController',
        'action' => 'off'
    ]);

    /* INTERNACION */
    $map->get('addInternacion', '/internaciones/nueva', [
        'controller' => 'App\Controllers\InternacionController',
        'action' => 'getAddInternacionAction'
    ]);

    $map->post('saveInternacion', '/internaciones/save', [
        'controller' => 'App\Controllers\InternacionController',
        'action' => 'postSaveInternacionAction'
    ]);

    $map->get('indexInternaciones', '/internaciones', [
        'controller' => 'App\Controllers\InternacionController',
        'action' => 'getAllInternacionAction',
        'auth' => true
    ]);

    $map->get('editInternacion', '/internaciones/edit/{id}', [
        'controller' => 'App\Controllers\InternacionController',
        'action' => 'getEditInternacionAction'
    ]);

    $map->post('saveEditInternacion', '/internaciones/edit/saveEdit', [
        'controller' => 'App\Controllers\InternacionController',
        'action' => 'postSaveEditInternacionAction'
    ]);

    /* USUARIOS */
    $map->get('indexUsuarios', '/usuarios', [
        'controller' => 'App\Controllers\UsuarioController',
        'action' => 'getAllUsuarioAction'
    ]);

    $map->get('addUsuarios', '/usuarios/nuevo', [
        'controller' => 'App\Controllers\UsuarioController',
        'action' => 'getAddUsuarioAction'
    ]);

    $map->post('saveUsuarios', '/usuarios/save', [
        'controller' => 'App\Controllers\UsuarioController',
        'action' => 'postSaveUsuarioAction'
    ]);

    // $map->get('addPaciente', '/pacientes/nuevo', [
    //     'controller' => 'App\Controllers\PacienteController',
    //     'action' => 'getAddPacienteAction'
    // ]);

    // $map->post('savePaciente', '/pacientes/save', [
    //     'controller' => 'App\Controllers\PacienteController',
    //     'action' => 'postSavePacienteAction'
    // ]);

    // $map->get('importPadron', '/pacientes/padron', [
    //     'controller' => 'App\Controllers\PacienteController',
    //     'action' => 'getImportPadronAction'
    // ]);

    // $map->post('procesarPadron', '/pacientes/procesarPadron', [
    //     'controller' => 'App\Controllers\PacienteController',
    //     'action' => 'postProcesarPadronAction'
    // ]);

    /* LOGIN */

    $map->post('auth', '/auth', [
        'controller' => 'App\Controllers\AuthController',
        'action' => 'postLoginAction'
    ]);

    $map->get('logout', '/logout', [
        'controller' => 'App\Controllers\AuthController',
        'action' => 'getLogout'
    ]);

    /************************** ****************************/


    $matcher = $routerContainer->getMatcher();

    $route = $matcher->match($request);

    if (!$route) {

        echo 'La ruta ingresada no existe';
    } else {
        // Recorremos los atributos de la ruta (los valores que traemos por url)
        foreach ($route->attributes as $attribute => $value) {

            // Agregamos al request el atributo y su valor en cada iteracion, una vez por atributo
            $request = $request->withAttribute($attribute, $value);
        }

        $handlerData = $route->handler;
        $controllerName = $handlerData['controller'];
        $actionName = $handlerData['action'];

        $needsAuth = $handlerData['auth'] ?? false;

        $sessionUserId = $_SESSION['userId'] ?? null;

        if ($needsAuth && !$sessionUserId) {
            // Si requiere autenticacion y el user id NO ESTA definido

            $response = new RedirectResponse('/');
            // La respuesta redirige a login

        } else {
            // Si requiere autenticacion y el user id ESTA definido

            $controller = new $controllerName;
            $response = $controller->$actionName($request);
            // La respuesta se carga con el controlador y la accion
        }

        foreach ($response->getHeaders() as $name => $values) {

            foreach ($values as $value) {
                header(sprintf('%s: %s', $name, $value), false);
            }
        }

        http_response_code($response->getStatusCode());

        echo $response->getBody();
    }

    ?>
