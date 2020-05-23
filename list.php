<?php
if (isset($_COOKIE['contadorList'])) {
    // Caduca en un año 
    setcookie('contadorList', $_COOKIE['contadorList'] + 1, time() + 60);
} else {
    // Caduca en un año 
    setcookie('contadorList', 1, time() + 60);
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/list.css">
    <title>Lista de personas</title>
</head>

<body>
    <h1>Listado de personas</h1>

    <div>
        <a href="gestor.php">Regresar al gestor</a>
    </div>
    <?php
    if (isset($_COOKIE['contadorList'])) {
        echo '<br><br>';
        echo '<div><a href="salir.php?Contador=' . ($_COOKIE['contadorList']+1) . '">Salir</a></div>';
        echo '<br>';
    }else{
        echo '<div><a href="salir.php?Contador=1' . '">Salir</a></div>';
        echo '<br><br>';
    }
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
                </tr>
            </thead>
            <tbody>
                <?php
                include_once dirname(__FILE__) . '/config/config.php';
                include_once dirname(__FILE__) . '/sql_queries/sqlqueries.php';
                if (isset($_GET["parameter"]) && isset($_GET["type"])) {
                    $listPersonas = list_Personas($_GET["parameter"], $_GET["type"]);
                    if ($listPersonas != null) {
                        while ($fila = mysqli_fetch_array($listPersonas)) {
                            echo '<tr>';
                            echo '<td>' . $fila['Cedula'] . '</td>';
                            echo '<td>' . $fila['Nombre'] . '</td>';
                            echo '<td>' . $fila['Apellido'] . '</td>';
                            echo '<td>' . $fila['Edad'] . '</td>';
                            echo '<td>' . $fila['Correo_electronico'] . '</td>';
                            echo '</tr>';
                        }
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>