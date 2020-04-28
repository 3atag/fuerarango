
    <?php

    require_once '../vendor/autoload.php';

    /*----------- Laravel Eloquent Config ------------*/

    use Illuminate\Database\Capsule\Manager as Capsule;

    use Laminas\Diactoros\Response\RedirectResponse;

    $capsule = new Capsule;

    $capsule->addConnection([
        'driver'    => 'mysql',
        'host'      => 'localhost',
        'database'  => 'fuerarango',
        'username'  => 'root',
        'password'  => '',
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

    /* PACIENTES */
    $map->get('indexPacientes', '/fuerarango/pacientes', [
        'controller' => 'App\Controllers\PacienteController',
        'action' => 'getAllPacienteAction'
    ]);

    $map->get('addPaciente', '/fuerarango/pacientes/nuevo', [
        'controller' => 'App\Controllers\PacienteController',
        'action' => 'getAddPacienteAction'
    ]);

    $map->post('savePaciente', '/fuerarango/pacientes/save', [
        'controller' => 'App\Controllers\PacienteController',
        'action' => 'postSavePacienteAction'
    ]);

    $map->get('importPadron', '/fuerarango/pacientes/padron', [
        'controller' => 'App\Controllers\PacienteController',
        'action' => 'getImportPadronAction'
    ]);

    $map->post('procesarPadron', '/fuerarango/pacientes/procesarPadron', [
        'controller' => 'App\Controllers\PacienteController',
        'action' => 'postProcesarPadronAction'
    ]);

    /* PRACTICAS */
    $map->get('indexPracticas', '/fuerarango/practicas', [
        'controller' => 'App\Controllers\PracticaController',
        'action' => 'getAllPracticaAction'
    ]);

    $map->get('addPractica', '/fuerarango/practicas/nueva', [
        'controller' => 'App\Controllers\PracticaController',
        'action' => 'getAddPracticaAction'
    ]);

    $map->post('savePractica', '/fuerarango/practicas/save', [
        'controller' => 'App\Controllers\PracticaController',
        'action' => 'postSavePracticaAction'
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
        'action' => 'getAddInternacionAction'
    ]);

    $map->post('saveInternacion', '/fuerarango/internaciones/save', [
        'controller' => 'App\Controllers\InternacionController',
        'action' => 'postSaveInternacionAction'
    ]);
   
    $map->get('index', '/fuerarango/', [
        'controller' => 'App\Controllers\InternacionController',
        'action' => 'getAllInternacionAction'
    ]);

    $map->get('editInternacion', '/fuerarango/internaciones/edit/{id}', [        
        'controller' => 'App\Controllers\InternacionController',
        'action' => 'getEditInternacionAction'
    ]);

    $map->post('saveEditInternacion', '/fuerarango/internaciones/edit/saveEdit', [
        'controller' => 'App\Controllers\InternacionController',
        'action' => 'postSaveEditInternacionAction'
    ]);

     /* USUARIOS */
     $map->get('indexUsuarios', '/fuerarango/usuarios', [
        'controller' => 'App\Controllers\UsuarioController',
        'action' => 'getAllUsuarioAction'
    ]);

    $map->get('addUsuarios', '/fuerarango/usuarios/nuevo', [
        'controller' => 'App\Controllers\UsuarioController',
        'action' => 'getAddUsuarioAction'
    ]);

    $map->post('saveUsuarios', '/fuerarango/usuarios/save', [
        'controller' => 'App\Controllers\UsuarioController',
        'action' => 'postSaveUsuarioAction'
    ]);

    // $map->get('addPaciente', '/fuerarango/pacientes/nuevo', [
    //     'controller' => 'App\Controllers\PacienteController',
    //     'action' => 'getAddPacienteAction'
    // ]);

    // $map->post('savePaciente', '/fuerarango/pacientes/save', [
    //     'controller' => 'App\Controllers\PacienteController',
    //     'action' => 'postSavePacienteAction'
    // ]);

    // $map->get('importPadron', '/fuerarango/pacientes/padron', [
    //     'controller' => 'App\Controllers\PacienteController',
    //     'action' => 'getImportPadronAction'
    // ]);

    // $map->post('procesarPadron', '/fuerarango/pacientes/procesarPadron', [
    //     'controller' => 'App\Controllers\PacienteController',
    //     'action' => 'postProcesarPadronAction'
    // ]);

    /* LOGIN */
    $map->get('loginForm', '/fuerarango/login', [
        'controller' => 'App\Controllers\AuthController',
        'action' => 'getLogin'
    ]);

    $map->post('auth', '/fuerarango/auth', [
        'controller' => 'App\Controllers\AuthController',
        'action' => 'postLoginAction'
    ]);

    /************************** ****************************/

    
    $matcher = $routerContainer->getMatcher();

    $route = $matcher->match($request);

    if (!$route) {

       echo 'no route';

    } else {
        // Recorremos los atributos de la ruta (los valores que traemos por url)
        foreach ($route->attributes as $attribute => $value) {

            // Agregamos al request el atributo y su valor en cada iteracion, una vez por atributo
            $request = $request->withAttribute($attribute,$value);
            
        }

        $handlerData = $route->handler;
        $controllerName = $handlerData['controller'];
        $actionName = $handlerData['action'];

        $controller = new $controllerName;
        $response = $controller->$actionName($request);

        foreach ($response->getHeaders() as $name => $values) {

            foreach ($values as $value) {
                header(sprintf('%s: %s', $name, $value), false);
            }
        }

        http_response_code($response->getStatusCode());
        echo $response->getBody();

    }

    ?>
