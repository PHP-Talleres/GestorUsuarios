<?php
include_once dirname(__FILE__) . '/../model/persona.php';
include_once dirname(__FILE__) . '/../model/usuario.php';
include_once dirname(__FILE__) . '/../config/config.php';
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

function list_Usuarios()
{
    $sql = 'SELECT * FROM Usuarios';
    // Crear conexión
    $con = mysqli_connect(HOST_DB, USUARIO_DB, USUARIO_PASS, DATABASE);
    // Verificar conexión
    if (mysqli_connect_errno()) {
        return null;
    } else {
        $resultado = mysqli_query($con, $sql);
        return $resultado;
    }
}

function checkTables($nameTable){
    $sql = 'SHOW tables LIKE \'' . $nameTable . '\'';
    // Crear conexión
    $con = mysqli_connect(HOST_DB, USUARIO_DB, USUARIO_PASS, DATABASE);
    // Verificar conexión
    if (mysqli_connect_errno()) {
        echo "<br><div class=\"result_query error_text\"> Error en la conexión: " . mysqli_connect_error() . "</div>";
    } else {
        if (mysqli_query($con, $sql)) {
            if (mysqli_affected_rows($con) > 0){
                echo "<br><div class=\"result_query success_text\">Ya se creo la tabla " . $nameTable . "</div>";
                mysqli_close($con);
                return true;
            }
            else{
                echo "<br><div class=\"result_query error_text\"> No se ha creado la tabla " . $nameTable . "</div>";
                mysqli_close($con);
                return false;
            }    
        } else {
            echo "<br><div class=\"result_query error_text\"> Error en la verificación: " . mysqli_error($con)  . "</div>";
            mysqli_close($con);
            return false;
        }
    }
    mysqli_close($con);
    return false;
}

function createTablePersonas(){
    $sql_personas = 'CREATE TABLE personas (
        Nombre varchar(50) NOT NULL,
        Apellido varchar(50) NOT NULL,
        Correo_electronico varchar(100) NOT NULL,
        Edad int(3) NOT NULL,
        Cedula bigint(20) NOT NULL,
        PRIMARY KEY (Cedula)
    );';

    // Crear conexión
    $con = mysqli_connect(HOST_DB, USUARIO_DB, USUARIO_PASS, DATABASE);
    // Verificar conexión
    if (mysqli_connect_errno()) {
        echo "<br><div class=\"result_query error_text\"> Error en la conexión: " . mysqli_connect_error() . "</div>";
    } else {
        if (mysqli_query($con, $sql_personas)) {
            echo "<br><div class=\"result_query success_text\">Ya se creo la tabla Personas" . "</div>";
            mysqli_close($con);
            return true;
        } else {
            echo "<br><div class=\"result_query error_text\"> Error en la creación de la tabla Personas: " . mysqli_error($con)  . "</div>";
            mysqli_close($con);
            return false;
        }
    }
    mysqli_close($con);
}

function createTableUsuarios()
{
    $sql_personas = 'CREATE TABLE usuarios (
        Id int(11) NOT NULL,
        username varchar(100) NOT NULL UNIQUE,
        Rol char(7) NOT NULL,
        Cedula bigint(20) NOT NULL,
        Contrasenia varchar(100),
        PRIMARY KEY (Id, Cedula),
        FOREIGN KEY (Cedula) REFERENCES personas(Cedula)
    );';

    // Crear conexión
    $con = mysqli_connect(HOST_DB, USUARIO_DB, USUARIO_PASS, DATABASE);
    // Verificar conexión
    if (mysqli_connect_errno()) {
        echo "<br><div class=\"result_query error_text\"> Error en la conexión: " . mysqli_connect_error() . "</div>";
    } else {
        if (mysqli_query($con, $sql_personas)) {
            $sql_alter = ' ALTER TABLE usuarios
                            MODIFY Id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;';
            if(mysqli_query($con, $sql_alter)){
                echo "<br><div class=\"result_query success_text\">Ya se creo la tabla Usuarios" . "</div>";
                mysqli_close($con);
                return true;
            }else{
                echo "<br><div class=\"result_query error_text\"> Error en la alteración de la tabla Usuarios: " . mysqli_error($con)  . "</div>";
                mysqli_close($con);
                return false; 
            }   
        } else {
            echo "<br><div class=\"result_query error_text\"> Error en la creación de la tabla Usuarios: " . mysqli_error($con)  . "</div>";
            mysqli_close($con);
            return false;
        }
    }
    mysqli_close($con);
}

function insert_into_Usuarios($usuario)
{
    $user_type = 'USER';
    $sql_search = 'SELECT * FROM Usuarios';
    // Crear conexión
    $con = mysqli_connect(HOST_DB, USUARIO_DB, USUARIO_PASS, DATABASE);
    // Verificar conexión
    if (mysqli_connect_errno()) {
        echo "<br><div class=\"result_query error_text\"> Error en la conexión: " . mysqli_connect_error() . "</div>";
    } else {
        //Query for search of Cedula
        if (mysqli_query($con, $sql_search)) {
            if (mysqli_affected_rows($con) == 0) {
                $user_type = 'ADMIN';
            }
        }
    }
    mysqli_close($con);
    
    $sql = 'INSERT INTO Usuarios (username, Rol, Cedula, Contrasenia) VALUES (';
    $sql .= '\'' . $usuario->username . '\'';
    $sql .= ', ';
    $sql .= '\'' . $user_type . '\'';
    $sql .= ', ';
    $sql .= $usuario->cedula;
    $sql .= ', ';
    $sql .= '\'' . $usuario->password . '\'';
    $sql .= ')';
    
    $sql_search_cedula = 'SELECT * FROM Usuarios WHERE Cedula = ';
    $sql_search_cedula .= $usuario->cedula;

    $sql_search_username = 'SELECT * FROM Usuarios WHERE username = \'';
    $sql_search_username .= $usuario->username . '\'';

    // Crear conexión
    $con = mysqli_connect(HOST_DB, USUARIO_DB, USUARIO_PASS, DATABASE);
    // Verificar conexión
    if (mysqli_connect_errno()) {
        echo "<br><div class=\"result_query error_text\"> Error en la conexión: " . mysqli_connect_error() . "</div>";
    } else {
        if (mysqli_query($con, $sql_search_cedula)) {
            //Query for search of Cedula
            if (mysqli_affected_rows($con) == 0) {
                //If the search returns a number equals to 0 is that the Cedula is not present
                //Query for search of Username
                if (mysqli_query($con, $sql_search_username)) {
                    //If the search returns a number equals to 0 is that the Username is not present
                    if (mysqli_affected_rows($con) == 0) {
                        if (mysqli_query($con, $sql)) {
                            echo "<br><div class=\"result_query success_text\">¡CREADO!"  . "</div>";
                        } else {
                            echo "<br><div class=\"result_query error_text\">Error en la inserción: " . mysqli_error($con)  . "</div>";
                        }
                    }else{
                        echo "<br><div class=\"result_query error_text\">Nombre de usuario ya existe dentro de la base de datos" . "</div>";
                    }
                }else{
                    echo "<br><div class=\"result_query error_text\">Error en la Búsqueda del nombre: " . mysqli_error($con)  . "</div>"; 
                }
            } else {
                echo "<br><div class=\"result_query error_text\">Cédula ya existe dentro de la base de datos" . "</div>";
            }
        }else{
           echo "<br><div class=\"result_query error_text\">Error en la Búsqueda de la Cedula: " . mysqli_error($con)  . "</div>"; 
        }
    }
    mysqli_close($con);
}

function login($usuario)
{
    $sql = 'SELECT * FROM Usuarios WHERE Username = \'' . $usuario->username . '\'';
    // Crear conexión
    $con = mysqli_connect(HOST_DB, USUARIO_DB, USUARIO_PASS, DATABASE);
    // Verificar conexión
    if (mysqli_connect_errno()) {
        echo "<br><div class=\"result_query error_text\"> Error en la conexión: " . mysqli_connect_error() . "</div>";
    } else {
        if (mysqli_query($con, $sql)) {
            if (mysqli_affected_rows($con) > 0) {
                $resultado=mysqli_query($con, $sql);
                $fila = mysqli_fetch_array($resultado);
                if(password_verify($usuario->password, $fila['Contrasenia'])){
                    echo "<br><div class=\"result_query success_text\">Correcto Login de " . $usuario->username . "</div>";
                    mysqli_close($con);
                    return $fila['Rol'];
                }else{
                    echo "<br><div class=\"result_query error_text\"> Error en el login de: " . $usuario->username  . "</div>";
                    mysqli_close($con);
                    return false;
                }
            } else {
                mysqli_close($con);
                return false;
            }
        } else {
            echo "<br><div class=\"result_query error_text\"> Error en la verificación: " . mysqli_error($con)  . "</div>";
            mysqli_close($con);
            return false;
        }
    }
    mysqli_close($con);
    return false;
}

function getPersona_Usuario($username){
    $sql = 'SELECT * FROM Usuarios WHERE Username = \'' . $username . '\'';
    // Crear conexión
    $con = mysqli_connect(HOST_DB, USUARIO_DB, USUARIO_PASS, DATABASE);
    // Verificar conexión
    if (mysqli_connect_errno()) {
        echo "<br><div class=\"result_query error_text\"> Error en la conexión: " . mysqli_connect_error() . "</div>";
    } else {
        if (mysqli_query($con, $sql)) {
            if (mysqli_affected_rows($con) > 0) {
                $resultado = mysqli_query($con, $sql);
                $fila = mysqli_fetch_array($resultado);
                $cedula = $fila['Cedula'];
                $sql_personas = 'SELECT * FROM Personas WHERE Cedula = \'' . $cedula . '\'';
                if (mysqli_query($con, $sql_personas)) {
                    if (mysqli_affected_rows($con) > 0) {
                        $resultado = mysqli_query($con, $sql_personas);
                        $fila = mysqli_fetch_array($resultado);
                        mysqli_close($con);
                        return $fila;
                    }else{
                        echo "<br><div class=\"result_query error_text\"> No se ha encontrado la cédula del usuario en la tabla personas." . "</div>";
                        mysqli_close($con);
                        return false;
                    }
                }else{
                    echo "<br><div class=\"result_query error_text\"> Error en la cedula del usuario " . "</div>";
                    mysqli_close($con);
                    return false;
                }
            } else {
                mysqli_close($con);
                return false;
            }
        } else {
            echo "<br><div class=\"result_query error_text\"> Error en la verificación: " . mysqli_error($con)  . "</div>";
            mysqli_close($con);
            return false;
        }
    }
    mysqli_close($con);
    return false;
}
?>