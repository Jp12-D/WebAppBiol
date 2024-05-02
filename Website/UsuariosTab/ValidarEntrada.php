<?php
require_once 'DatabaseConnection.php';

// Iniciar la sesión
session_start();

// Si se han enviado las credenciales de administrador
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email']) && isset($_POST['password'])) {
    // Obtener el correo electrónico y la contraseña ingresados por el usuario
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        // Obtener la conexión a la base de datos
        $pdo = obtenerConexionBD();

        // Consultar la base de datos para verificar las credenciales de administrador
        $sql = "SELECT * FROM dbo.Usuarios WHERE eMail = :email AND Contraseña = :password AND Privilegio = 'admin'";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
        $adminUser = $stmt->fetch(PDO::FETCH_ASSOC);

        // Si las credenciales de administrador son válidas, redirigir al formulario de actualización
        if ($adminUser) {
            // Establecer la variable de sesión para indicar que las credenciales son válidas
            $_SESSION['credenciales_validadas'] = true;
            // Redirigir a la página deseada después de la validación exitosa
            header("Location: FormUsers.php");
            exit();
        } else {
            // Si las credenciales de administrador no son válidas, mostrar un mensaje de error
            echo "Credenciales de administrador incorrectas. No tienes permiso para editar usuarios.";
        }
    } catch (PDOException $e) {
        // Manejar cualquier error que ocurra durante el proceso de validación
        echo "Error: " . $e->getMessage();
    }
} else {
    // Mostrar el formulario para ingresar las credenciales
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificación de Credenciales</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Login/login.css">
</head>
<body>
    <div class="background-img">
        <div class="center-prompt">
            <div class="container">
                <div class="row center">
                    <div class="col-md-6 text-center mx-auto">
                        <div class="card">
                            <div class="card-header">
                                Verificación de Credenciales
                            </div>
                            <div class="card-body">
                                <form action="ValidarEntrada.php" method="post" id="login-form">
                                    <div class="form-group">
                                        <label for="email">Email:</label>
                                        <input type="email" class="form-control" id="email" name="email" required autocomplete="off"> 
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Contraseña:</label>
                                        <input type="password" class="form-control" id="password" name="password" required autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Verificar Credenciales</button>
                                    </div>
                                </form>
                                <div id="error-message" class="error-message mt-3"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<?php
}
?>
