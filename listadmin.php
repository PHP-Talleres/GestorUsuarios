<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/list.css">
    <title>Lista de usuarios</title>
</head>

<body>
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
                        echo '<td>' . $fila['username'] . '</td>';
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