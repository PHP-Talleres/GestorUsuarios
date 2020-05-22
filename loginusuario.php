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

    <h1>Login de usuarios</h1>
    
    <br>
    <div class="form">
        <form action="gestor.php" method="post">
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

</body>

</html>