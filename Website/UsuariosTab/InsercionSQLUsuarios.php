<?php

if($_SERVER["REQUEST_METHOD"]=="POST"){



    $Nombre = $_POST["nombre"];
    $apellidoPaterno = $_POST["paterno"];
    $apellidoMaterno = $_POST["materno"];
    $eMail = $_POST["eMail"];
    $pwd = $_POST["pwd"];
    $privilegio = $_POST["privilegio"];
   

    try {

        require_once "DatabaseConnection.php";

        $query = "INSERT INTO dbo.Usuarios (Nombre, Apellido_Paterno, Apellido_Materno, eMail, Contraseña, Privilegio) 
         VALUES (?,?,?,?,?,?);";

        $stmt = $pdo->prepare($query);

        
        
        // Aquí está el cambio: Ejecutar la consulta utilizando execute() en lugar de asignarla a $stmt nuevamente.
        $stmt->execute([ $Nombre, $apellidoPaterno, $apellidoMaterno, $eMail, $pwd, $privilegio ]);

        $pdo = null;
        $stmt = null;

        header("Location: UsuariosHTML.php");
        echo '<script>window.location.reload(true);</script>';
        
        die();
        
    } catch (PDOException $e) {
        if($e->getCode() === '23000' && strpos($e->getMessage(), 'eMail UNIQUE') !== false){
            echo "No se pudo agregar este usuario. El email ingresado ya está en uso por otro usuario.";
        } elseif($e->getCode() === '23000' && strpos($e->getMessage(), 'Contraseña UNIQUE') !== false){
            echo "Contraseña inválida, favor de utilizar otra contraseña.";
        }else {
            echo "Error, someta la información del usuario de nuevo.";
        }
    }

}
