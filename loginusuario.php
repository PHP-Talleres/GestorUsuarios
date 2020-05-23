<?php
if (isset($_COOKIE['contadorLogin'])) {
    // Caduca en un año 
    setcookie('contadorLogin', $_COOKIE['contadorLogin'] + 1, time() + 60);
} else {
    // Caduca en un año 
    setcookie('contadorLogin', 1, time() + 60);
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/gestor.css">
    <title>Login de usuarios</title>
</head>

<body>
    <div>
        <a href="index.php">Regresar</a>
    </div>
    <?php
    if (isset($_COOKIE['contadorLogin'])) {
        echo '<br><br>';
        echo '<div><a href="salir.php?Contador=' . ($_COOKIE['contadorLogin']+1) . '">Salir</a></div>';
        echo '<br>';
    } else {
        echo '<br><br>';
        echo '<div><a href="salir.php?Contador=1' . '">Salir</a></div>';
        echo '<br>';
    }
    ?>
    <h1>Login de usuarios</h1>

    <br>
    <div class="form">
        <form action="loginusuario.php" method="post" autocomplete="off">
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
        if (isset($_POST["username"]) && isset($_POST["password"])) {
            $usuario = new Usuario;
            $usuario->username = $_POST["username"];
            $usuario->password = $_POST["password"];
            $respuesta = login($usuario);
            if ($respuesta != false) {
                if ($respuesta == "ADMIN") {
                    header('Location: listadmin.php');
                }
                if ($respuesta == "USER") {
                    header('Location: profile.php?username=' . $usuario->username);
                }
            }
        }
        ?>
    </div>

</body>

</html>