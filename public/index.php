<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <?php

    use App\Controllers\UsuarioController;
    
    require '../App/Controllers/UsuarioController.php';

    $controlador = new UsuarioController();
    $controlador->mostrarTodosUsuarios();
    $controlador->crearUsuario();



    ?>
</body>

</html>