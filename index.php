<?php
    session_start();
    if (isset($_SESSION['visitas'])) {
        $_SESSION['visitas'] = $_SESSION['visitas'] + 1;
    } else {
        $_SESSION['visitas'] = 1;
    } 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <title>Index</title>
</head>

<body>
    <?php
        include_once dirname(__FILE__) . '/sql_queries/sqlqueries.php';
        if($_SESSION['visitas'] == 1){
            if (!checkTables("personas")) {
                createTablePersonas();
            }
            if (!checkTables("usuarios")) {
                createTableUsuarios();
            }
        }  
    ?>
    <h1>Index de funcionalidades</h1>
    <div>
        <table class="indexTable">
            <tbody>
                <tr>
                    <td>Gestor para la tabla personas</td>
                    <td><a href="gestor.php">Link</a></td>
                </tr>
                <tr>
                    <td>Gestor de archivos</td>
                    <td><a href="gestorarchivos.php">Link</a></td>
                </tr>
                <tr>
                    <td>Registro usuarios</td>
                    <td><a href="registrousuarios.php">Link</a></td>
                </tr>
                <tr>
                    <td>Login usuario</td>
                    <td><a href="loginusuario.php">Link</a></td>
                </tr>
            </tbody>
            </tr>
        </table>
    </div>

</body>

</html>