<?php
if (isset($_COOKIE['contadorArchivos'])) {
    // Caduca en un año 
    setcookie('contadorArchivos', $_COOKIE['contadorArchivos'] + 1, time() + 60);
} else {
    // Caduca en un año 
    setcookie('contadorArchivos', 1, time() + 60);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/gestorarchivos.css">
    <title>Gestor Archivos</title>
</head>

<body>
    <div>
        <a href="index.php">Regresar</a>
    </div>
    
    <?php
        if (isset($_COOKIE['contadorArchivos'])) {
            echo '<br><br>';
            echo '<div><a href="salir.php?Contador=' . ($_COOKIE['contadorArchivos']+1) . '">Salir</a></div>';
            echo '<br>';
        }else{
            echo '<br><br>';
            echo '<div><a href="salir.php?Contador=1' . '">Salir</a></div>';
            echo '<br>';
        }
    ?>
    <h1>Gestor de archivos</h1>

    <div class="form">
        <form action="gestorarchivos.php" method="post" enctype="multipart/form-data">
            <label for="arch">Nombre</label>
            <input type="file" name="arch" id="arch"><br>
            <input type="submit" name="submit" value="Enviar">
        </form>
    </div>

    <?php
    $str_pagina = "";
    if (isset($_FILES["arch"])) {
        if ($_FILES["arch"]["error"] > 0) {
            echo "<br><div class=\"banner error_text\">Favor seleccione un archivo válido.</div>";
        } else {
            $str_pagina .= "<br><div class=\"paragraph\">Nombre: " . $_FILES["arch"]["name"] . "</div>";
            $str_pagina .= "<div class=\"paragraph\">Tipo: " . $_FILES["arch"]["type"] . "</div>";
            $str_pagina .= "<div class=\"paragraph\">Tamaño: " . ($_FILES["arch"]["size"] / 1024) . " kB</div>";
            $str_pagina .= "<div class=\"paragraph\">Guardado en: " . $_FILES["arch"]["tmp_name"] . "</div>";
            echo "<br><div class=\"banner success_text\">Se ha cargado un archivo válido.<br>";
            echo $str_pagina;
            if (!file_exists('subidos/')) {
                mkdir('subidos/', 0777, true);
            }
            move_uploaded_file($_FILES["arch"]["tmp_name"], "subidos/" . $_FILES["arch"]["name"]);
            echo "<div class=\"paragraph\">Guardado en: " . "subidos/" . $_FILES["arch"]["name"] . "</div>";
            echo "</div>";
        }
    } else {
        echo "<br><div class=\"banner error_text\">Favor cargar un archivo.</div>";
    }
    ?>

    <br><br>

    <div class="footer">
        <?php
        include_once dirname(__FILE__) . '/utils/utils.php';
        date_default_timezone_set('America/Bogota');
        echo SpanishDate((new DateTime())->getTimestamp());
        echo date('h:i:s A') . "</br>";
        echo "<br>";
        crear_imagen();
        echo "<img src=images/imagen.png?" . date("U") . ">";
        ?>
    </div>
</body>

</html>