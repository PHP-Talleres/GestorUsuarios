<?php
include_once dirname(__FILE__) . '/../model/persona.php';
function insert_into_Personas($persona)
{
    $sql_search = 'SELECT * FROM Personas WHERE Cedula = ';
    $sql_search .= $persona->cedula;
    $sql = 'INSERT INTO Personas (Nombre, Apellido, Correo_electronico, Edad, Cedula) VALUES (';
    $sql .= '\'' . $persona->nombre . '\'';
    $sql .= ', ';
    $sql .= '\'' . $persona->apellido . '\'';
    $sql .= ', ';
    $sql .= '\'' . $persona->correo_electronico . '\'';
    $sql .= ', ';
    $sql .= $persona->edad;
    $sql .= ', ';
    $sql .= $persona->cedula;
    $sql .= ')';
    $sql_update = 'UPDATE Personas SET ' ;
    $sql_update .= 'Nombre = ' .  '\'' . $persona->nombre . '\',';
    $sql_update .= 'Apellido = ' .  '\'' . $persona->apellido . '\',';
    $sql_update .= 'Correo_electronico = ' .  '\'' . $persona->correo_electronico . '\',';
    $sql_update .= 'Edad = ' .  '\'' . $persona->edad . '\' ';
    $sql_update .= 'WHERE Cedula = ' . $persona->cedula;
    // Crear conexión
    $con = mysqli_connect(HOST_DB, USUARIO_DB, USUARIO_PASS, DATABASE);
    // Verificar conexión
    if (mysqli_connect_errno()) {
        echo "<br><div class=\"result_query error_text\"> Error en la conexión: " . mysqli_connect_error() . "</div>";
    } else {
        //Query for search of Cedula
        if (mysqli_query($con, $sql_search)) {
            //If the search returns a number greater than 0 is that the Cedula is present 
            if (mysqli_affected_rows($con) > 0){
                //If the Cedula is present its an UPDATE
                if (mysqli_query($con, $sql_update)) {
                    echo "<br><div class=\"result_query success_text\">¡ACTUALIZADO!"  . "</div>";
                }
                else{
                    echo "<br><div class=\"result_query error_text\">Error en la actualización: " . mysqli_error($con)  . "</div>";
                }   
            } 
            else{
                if (mysqli_query($con, $sql)) {
                    echo "<br><div class=\"result_query success_text\">¡CREADO!"  . "</div>";
                } else {
                    echo "<br><div class=\"result_query error_text\">Error en la inserción: " . mysqli_error($con)  . "</div>";
                }
            }     
        }
    }
    mysqli_close($con);
}

function delete_into_Personas($cedula)
{
    $sql = 'DELETE FROM Personas WHERE Cedula = ' . $cedula;
    // Crear conexión
    $con = mysqli_connect(HOST_DB, USUARIO_DB, USUARIO_PASS, DATABASE);
    // Verificar conexión
    if (mysqli_connect_errno()) {
        echo "<br><div class=\"result_query error_text\"> Error en la conexión: " . mysqli_connect_error() . "</div>";
    } else {
        if (mysqli_query($con, $sql)) {
            if (mysqli_affected_rows($con) > 0)
                echo "<br><div class=\"result_query success_text\">¡EXITO!"  . "</div>";
            else
                echo "<br><div class=\"result_query error_text\"> No se ha borrado ningún registro" . "</div>";
        } else {
            echo "<br><div class=\"result_query error_text\">Error en la inserción: " . mysqli_error($con)  . "</div>";
        }
    }
    mysqli_close($con);
}

function list_Personas($parameter, $type){
    $sql = 'SELECT * FROM Personas';
    if($parameter == 'cedula'){
        $sql .= ' ORDER BY Cedula';
    }
    if ($parameter == 'nombre') {
        $sql .= ' ORDER BY Nombre';
    }
    if($type == 'ascending'){
        $sql .= ' ASC';
    }
    if ($type == 'descending') {
        $sql .= ' DESC';
    }
    // Crear conexión
    $con = mysqli_connect(HOST_DB, USUARIO_DB, USUARIO_PASS, DATABASE);
    // Verificar conexión
    if (mysqli_connect_errno()) {
        return null;
    }
    else{
        $resultado = mysqli_query($con, $sql);
        return $resultado;
    }
}
