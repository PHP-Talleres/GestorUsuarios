<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/gestor.css">
    <title>Gestor tabla personas</title>
</head>

<body>
    <div>
        <a href="index.php">Regresar</a>
    </div>

    <h1>Gestor para la tabla personas</h1>

    <h2>Listado de personas</h2>

    <div>
        <table>
            <tr>
                <td><a href="list.php?parameter=cedula&type=ascending">Ascendente por Cedula</a></td>
                <td><a href="list.php?parameter=cedula&type=descending">Descendente por Cedula</a></td>
                <td><a href="list.php?parameter=nombre&type=ascending">Ascendente por Nombre</a></td>
                <td><a href="list.php?parameter=nombre&type=descending">Descendente por Nombre</a></td>
            </tr>
        </table>
    </div>

    <h2>Crear y actualizar personas</h2>
    <br>
    <div class="form">
        <form action="gestor.php" method="post" autocomplete="off">
            <p>
                <label>Cedula</label>
                <input id='cedula' name='cedula' required type='number'>
            </p>
            <p>
                <label>Nombre</label>
                <input id='nombre' name='nombre' required type='text'>
            </p>
            <p>
                <label>Apellido</label>
                <input id='apellido' name='apellido' required type='text'>
            </p>
            <p>
                <label>Correo electrónico</label>
                <input id='email' name='email' required type='text'>
            </p>
            <p>
                <label>Edad</label>
                <input id='edad' name='edad' required type='number'>
            </p>
            <p>
                <input class='button' type='submit' value='Enviar'>
            </p>
        </form>
        <?php
        include_once dirname(__FILE__) . '/config/config.php';
        include_once dirname(__FILE__) . '/sql_queries/sqlqueries.php';
        include_once dirname(__FILE__) . '/utils/utils.php';
        if (isset($_POST["cedula"]) && isset($_POST["nombre"]) && isset($_POST["apellido"]) && isset($_POST["email"]) && isset($_POST["edad"])) {
            if (validarNombre($_POST["nombre"])) {
                if (validarApellido($_POST["apellido"])) {
                    if (validarEmail($_POST["email"])) {
                        if (validarCedula($_POST["cedula"])) {
                            if (validarEdad($_POST["edad"])) {
                                $persona = new Persona;
                                $persona->nombre = $_POST["nombre"];
                                $persona->apellido = $_POST["apellido"];
                                $persona->cedula = $_POST["cedula"];
                                $persona->correo_electronico = $_POST["email"];
                                $persona->edad = $_POST["edad"];
                                insert_into_Personas($persona);
                            } else {
                                echo "<br><div class=\"result_query error_text\">Error en la edad ingresada" . "</div>";
                            }
                        } else {
                            echo "<br><div class=\"result_query error_text\">Error en la cédula ingresada" . "</div>";
                        }
                    } else {
                        echo "<br><div class=\"result_query error_text\">Error en el email ingresado" . "</div>";
                    }
                } else {
                    echo "<br><div class=\"result_query error_text\">Error en el apellido ingresado" . "</div>";
                }
            } else {
                echo "<br><div class=\"result_query error_text\">Error en el nombre ingresado" . "</div>";
            }
        }
        ?>
    </div>
    <br><br>
    <h2>Eliminar personas</h2>
    <br>
    <div class="form">
        <form action="gestor.php" method="get">
            <p>
                <label>Cedula</label>
                <input id='cedula' name='cedula' required type='number'>
            </p>
            <p>
                <input class='button' type='submit' value='Eliminar'>
            </p>
        </form>
        <?php
        include_once dirname(__FILE__) . '/config/config.php';
        include_once dirname(__FILE__) . '/sql_queries/sqlqueries.php';
        if (isset($_GET["cedula"])) {
            delete_into_Personas($_GET["cedula"]);
        }
        ?>
    </div>


</body>

</html>