<?php
require_once 'DBUsuarios.php';
require_once 'Functions.php';
$pdo = obtenerConexionBD();

if (isset($_POST["submit"])) {
    // Obtener los datos del formulario
    $email = $_POST["email"];
    $pwd = $_POST["password"];

    // Verificar si los campos están vacíos
    if (emptyInputLogin($email, $pwd)) {
        header("location: login.php?error=emptyinput");
        exit();
    }

    // Intentar iniciar sesión
    if (loginUser($pdo, $email, $pwd)) {
        header("location: ../HomeScreen/HomeHTML.php");
        exit();
    } else {
        // Si el inicio de sesión falla, redirigir a la página de inicio de sesión con un mensaje de error
        header("location: login.php?error=loginfailed");
        exit();
    }
} else {
    // Si el formulario de inicio de sesión no se envió correctamente, redirigir de nuevo a la página de inicio de sesión
    header("location: login.php");
    exit();
}
