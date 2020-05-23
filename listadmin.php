<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/list.css">
    <link rel="stylesheet" type="text/css" href="css/profileadmin.css">
    <title>Lista de usuarios</title>
</head>

<body>
    <?php
    include_once dirname(__FILE__) . '/config/config.php';
    include_once dirname(__FILE__) . '/sql_queries/sqlqueries.php';
    if (isset($_POST['username'])) {
        deleteUsuario($_POST['username']);
    }
    ?>
    <h1>Listado de personas</h1>

    <div>
        <a href="loginusuario.php">Salir de la sesion</a>
    </div>
    <br><br>
    <div>
        <table>
            <thead>
                <tr>
                    <th>Nombre de usuario</th>
                    <th>Rol</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include_once dirname(__FILE__) . '/config/config.php';
                include_once dirname(__FILE__) . '/sql_queries/sqlqueries.php';
                $listPersonas = list_Usuarios();
                if ($listPersonas != null) {
                    while ($fila = mysqli_fetch_array($listPersonas)) {
                        echo '<tr>';
                        echo '<td><a href="profileadmin.php?username=' . $fila['username'] . '">' . $fila['username'] . '</a></td>';
                        echo '<td>' . $fila['Rol'] . '</td>';
                        echo '</tr>';
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>