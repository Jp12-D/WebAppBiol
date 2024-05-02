<?php
   
if(isset($_POST["submit"])){
    
    $email = $_POST["email"];
    $pwd = $_POST["password"];

    require_once 'DBUsuarios.php';
    require_once 'Functions.php';
    $pdo = obtenerConexionBD();

    if(emptyInputLogin($email, $pwd) !== false){
        header("location: login.php?error=emptyinput");
        exit();
    }

    loginUser($pdo, $email, $pwd);

}
else{
  
    header("location: login.php");
    
    exit();
}