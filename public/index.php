<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <p>hola</p>
    <?php

    use App\Controllers\{PacienteController, InternacionController};

    require '../App/Controllers/PacienteController.php';
    require '../App/Controllers/InternacionController.php';

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



    ?>
</body>

</html>