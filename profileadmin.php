<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/list.css">
    <link rel="stylesheet" type="text/css" href="css/profileadmin.css">
    <title>Perfil</title>
</head>

<body>
    <h1>Perfil del usuario</h1>
    <h2>Vista de administrador</h2>
    <br>
    <div>
        <a href="listadmin.php">Volver a la lista de usuarios</a>
    </div>
    <?php
    include_once dirname(__FILE__) . '/config/config.php';
    include_once dirname(__FILE__) . '/sql_queries/sqlqueries.php';
    if (isset($_POST['rol'])) {
        updateUserRol($_GET['username'], $_POST['rol']);
    }
    if (isset($_POST['delete'])) {
        echo "This is delete that is selected " . $_GET['username'];
    }
    ?>
    <br><br>
    <?php
    $url = 'profileadmin.php?username=' . $_GET['username'];
    echo '<form action="' . $url . '" method="post">';
    ?>
    <div>
        <table>
            <thead>
                <tr>
                    <th>Cedula</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Edad</th>
                    <th>Correo Electrónico</th>
                    <th>Nombre de usuario</th>
                    <th>Rol</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include_once dirname(__FILE__) . '/config/config.php';
                include_once dirname(__FILE__) . '/sql_queries/sqlqueries.php';
                if (isset($_GET['username'])) {
                    $persona = getPersona_Usuario($_GET['username']);
                    if ($persona != null && $persona != false) {
                        echo '<tr>';
                        echo '<td>' . $persona['Cedula'] . '</td>';
                        echo '<td>' . $persona['Nombre'] . '</td>';
                        echo '<td>' . $persona['Apellido'] . '</td>';
                        echo '<td>' . $persona['Edad'] . '</td>';
                        echo '<td>' . $persona['Correo_electronico'] . '</td>';
                        $persona = getPersona_Usuario($_GET['username']);
                        if ($persona != null && $persona != false) {
                            $usuario = getPersonaUsuario($persona['Cedula']);
                            if ($usuario != null && $usuario != false) {
                                $GLOBALS["username"] = $usuario['username'];
                                echo '<td>' . $usuario['username'] . '</td>';
                                echo '<td>' . '<select name="rol" id="rol">';
                                if ($usuario['Rol'] == 'ADMIN') {
                                    echo '<option value="ADMIN" selected="selected">ADMIN</option>';
                                    echo '<option value="USER">USER</option>';
                                }
                                if ($usuario['Rol'] == 'USER') {
                                    echo '<option value="ADMIN">ADMIN</option>';
                                    echo '<option value="USER" selected="selected">USER</option>';
                                }
                                echo '</select></td></tr>';
                            }
                        }
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
    <br>
    <div>
        <input type="submit" value="Guardar">
    </div>
    <br>
    </form>
    
    <div>
        <form action="listadmin.php" method="post">
            <?php
            echo '<input type="hidden" name="username" value=' . $GLOBALS["username"] . '>';
            ?>
            <input type="submit" value="Eliminar">
        </form>
    </div>
</body>

</html>