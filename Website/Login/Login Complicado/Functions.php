<?php
require_once "DBUsuarios.php";
 $pdo = obtenerConexionBD();
function emptyInputLogin($email, $pwd){
    $result;
    if(empty($email) || empty($pwd)){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;

}
function loginUser($pdo, $email, $pwd) {
   
    $sql = "SELECT IDUsuario, Nombre, eMail, Contraseña FROM dbo.Usuarios WHERE eMail = :correo";

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":correo", $email, PDO::PARAM_STR);
        $stmt->execute();

        // Verificar si se encontró algún usuario con el correo proporcionado
        if ($stmt->rowCount() == 1) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $IDUsuario = $row["IDUsuario"];
            $Nombre = $row["Nombre"];
            $email = $row["eMail"];
            $PwdHash = $row["Contraseña"];

            // Verificar la contraseña
            if (password_verify($pwd, $PwdHash)) {
                // La contraseña es correcta, iniciar sesión
                session_start();
                $_SESSION["loggedin"] = true;
                $_SESSION["IDUsuario"] = $IDUsuario;
                $_SESSION["Nombre"] = $Nombre;
                $_SESSION["eMail"] = $email;
               
                header("location: ../HomeScreen/HomeHTML.php");
                return true;
                exit();
            } else {
                // La contraseña proporcionada es incorrecta
                return "Contraseña incorrecta.";
            }
        } else {
            // No se encontró ningún usuario con el correo proporcionado
            return "No se encontró ningún usuario con el correo proporcionado.";
        }
    } catch (PDOException $e) {
        // Error al ejecutar la consulta SQL
        return "Error al iniciar sesión: " . $e->getMessage();
    }
}



function emailExists($pdo, $email, $pwd) {
    $sql = "SELECT * FROM dbo.Usuarios WHERE eMail = ?;";
    $stmt = $pdo->prepare($sql);
    if (!$stmt) {
        echo "Error en la preparación de la consulta.";
        return false;
    }
    $stmt->execute([$email]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // Imprimir el resultado de la consulta para depurar
    echo "Resultado de la consulta: ";
    var_dump($result);

    if (!$result) {
        echo "No se encontró ningún usuario con el correo electrónico proporcionado.";
        return false;
    }

    return $result;
}
