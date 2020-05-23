<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/salir.css">
    <title>Salir</title>
</head>

<body>
    <?php
    if (isset($_GET['Contador'])) {
        echo '<div class="result"> <h1>Contador de visitas a la pagina</h1>';
        echo '<h2>' . $_GET['Contador'] . '</h2>';
        echo '</div>';
    } else {
        echo '<div class="result"> <h1>No se ha indicado número de visitas </h1> </div>';
    }
    ?>

</body>

</html>