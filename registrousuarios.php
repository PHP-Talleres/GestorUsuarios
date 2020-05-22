<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/gestor.css">
    <title>Registro de usuarios</title>
</head>

<body>
    <div>
        <a href="index.php">Regresar</a>
    </div>

    <h1>Registro de usuarios</h1>

    <h2>Registrar un nuevo usuario</h2>
    <br>
    <div class="form">
        <form action="registrousuarios.php" method="post" autocomplete="off">
            <p>
                <label>Cedula</label>
                <input id='cedula' name='cedula' required type='number'>
            </p>
            <p>
                <label>Nombre de usuario</label>
                <input id='username' name='username' required type='text'>
            </p>
            <p>
                <label>Contraseña</label>
                <input id='password' name='password' required type='password'>
            </p>
            <p>
                <input class='button' type='submit' value='Enviar'>
            </p>
        </form>
        <?php
        include_once dirname(__FILE__) . '/config/config.php';
        include_once dirname(__FILE__) . '/sql_queries/sqlqueries.php';
        include_once dirname(__FILE__) . '/utils/utils.php';
        if (isset($_POST["cedula"]) && isset($_POST["username"]) && isset($_POST["password"])) {
            $usuario = new Usuario;
            $usuario->username = $_POST["username"];
            $usuario->cedula = $_POST["cedula"];
            $usuario->password = password_hash($_POST["password"], PASSWORD_DEFAULT);
            insert_into_Usuarios($usuario);
        }
        ?>
    </div>

</body>

</html>