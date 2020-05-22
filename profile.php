<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/list.css">
    <title>Perfil</title>
</head>

<body>
    <h1>Perfil del usuario</h1>

    <div>
        <a href="loginusuario.php">Salir de la sesion</a>
    </div>
    <br><br>
    <div>
        <table>
            <thead>
                <tr>
                    <th>Cedula</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Edad</th>
                    <th>Correo Electrónico</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include_once dirname(__FILE__) . '/config/config.php';
                include_once dirname(__FILE__) . '/sql_queries/sqlqueries.php';
                if(isset($_GET['username'])){
                    $persona = getPersona_Usuario($_GET['username']);
                    if ($persona != null && $persona != false) { 
                        echo '<tr>';
                        echo '<td>' . $persona['Cedula'] . '</td>';
                        echo '<td>' . $persona['Nombre'] . '</td>';
                        echo '<td>' . $persona['Apellido'] . '</td>';
                        echo '<td>' . $persona['Edad'] . '</td>';
                        echo '<td>' . $persona['Correo_electronico'] . '</td>';
                        echo '</tr>';
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>