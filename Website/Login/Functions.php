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
    $sql = "SELECT eMail, Contraseña FROM dbo.Usuarios WHERE eMail = :correo";

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":correo", $email, PDO::PARAM_STR);
        $stmt->execute();

        // Verificar si se encontró algún usuario con el correo proporcionado
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $email = $row["eMail"];
            $contraseñaAlmacenada = $row["Contraseña"];
           
            // Verificar la contraseña (sin hashear)
            if ($pwd === $contraseñaAlmacenada) {
                // La contraseña es correcta, iniciar sesión
                session_start();
                $_SESSION["loggedin"] = true;
                $_SESSION["eMail"] = $email;
                return true; //Inicio de sesion exitoso
            } else {
                // La contraseña proporcionada es incorrecta
                return false;
            }
        } else {
            // No se encontró ningún usuario con el correo proporcionado
            return false;
        }
    } catch (PDOException $e) {
        // Error al ejecutar la consulta SQL
        return false;
    }
}

//function emailExists($pdo, $email, $pwd) {
 //   $sql = "SELECT * FROM dbo.Usuarios WHERE eMail = ?;";
 //   $stmt = $pdo->prepare($sql);
  //  if (!$stmt) {
      
  //      return false;
   // }
   // $stmt->execute([$email]);
   // $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // Imprimir el resultado de la consulta para depurar

  //  if (!$result) {
    
   //     return false;
  //  }

  //  return $result;
//}
