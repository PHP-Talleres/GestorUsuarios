<?php
if (isset($_COOKIE['contadorRegistroUsuarios'])) {
    // Caduca en un año 
    setcookie('contadorRegistroUsuarios', $_COOKIE['contadorRegistroUsuarios'] + 1, time() + 60);
} else {
    // Caduca en un año 
    setcookie('contadorRegistroUsuarios', 1, time() + 60);
}
?>
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

    <?php
    if (isset($_COOKIE['contadorRegistroUsuarios'])) {
        echo '<br><br>';
        echo '<div><a href="salir.php?Contador=' . ($_COOKIE['contadorRegistroUsuarios'] + 1) . '">Salir</a></div>';
        echo '<br>';
    } else {
        echo '<br><br>';
        echo '<div><a href="salir.php?Contador=1' . '">Salir</a></div>';
        echo '<br>';
    }
    ?>

    <h1>Registro de usuarios</h1>

    <h2>Registrar un nuevo usuario</h2>
    <br>
    <?php
    include_once dirname(__FILE__) . '/config/config.php';
    include_once dirname(__FILE__) . '/sql_queries/sqlqueries.php';
    include_once dirname(__FILE__) . '/utils/utils.php';
    if (isset($_POST["cedula"]) && isset($_POST["username"]) && isset($_POST["password"])) {
        $usuario = new Usuario;
        $usuario->username = $_POST["username"];
        $usuario->cedula = $_POST["cedula"];
        $usuario->password = password_hash($_POST["password"], PASSWORD_DEFAULT);
        if (!insert_into_Usuarios($usuario)) {
            $GLOBALS["cedula_registro"] = $_POST["cedula"];
            $GLOBALS["username_registro"] = $_POST["username"];
            $GLOBALS["password_registro"] = $_POST["password"];
            echo '<br><br>';
        }
    }
    ?>
    <div class="form">
        <form action="registrousuarios.php" method="post" autocomplete="off">
            <p>
                <label>Cedula</label>
                <?php
                if (isset($GLOBALS["cedula_registro"])) {
                    echo '<input id=\'cedula\' name=\'cedula\' required type=\'number\' value=\'' . $GLOBALS["cedula_registro"] . '\'>';
                } else {
                    echo '<input id=\'cedula\' name=\'cedula\' required type=\'number\'>';
                }
                ?>
            </p>
            <p>
                <label>Nombre de usuario</label>
                <?php
                if (isset($GLOBALS["username_registro"])) {
                    echo '<input id=\'username\' name=\'username\' required type=\'text\' value=\'' . $GLOBALS["username_registro"] . '\'>';
                } else {
                    echo '<input id=\'username\' name=\'username\' required type=\'text\'>';
                }
                ?>
            </p>
            <p>
                <label>Contraseña</label>
                <?php
                if (isset($GLOBALS["password_registro"])) {
                    echo '<input id=\'password\' name=\'password\' required type=\'password\' value=\'' . $GLOBALS["password_registro"] . '\'>';
                } else {
                    echo '<input id=\'password\' name=\'password\' required type=\'password\'>';
                }
                ?>
            </p>
            <p>
                <input class='button' type='submit' value='Enviar'>
            </p>
        </form>
    </div>

</body>

</html>