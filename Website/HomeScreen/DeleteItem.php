<?php
require_once 'DatabaseConnection.php';

// Verificar si se ha proporcionado un ID de artículo válido en la URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    // Obtener el ID de artículo desde la URL
    $idArticulo = $_GET['id'];

    // Verificar si se han enviado las credenciales de administrador
    if (isset($_POST['email']) && isset($_POST['password'])) {
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

            // Si se encontró un usuario administrador con las credenciales proporcionadas, proceder con la eliminación del registro de inventario
            if ($adminUser) {
                // Construir la consulta SQL para eliminar el registro de inventario
                $sql = "DELETE FROM dbo.Inventario WHERE IDArticulo = :idItem";

                // Preparar la consulta
                $stmt = $pdo->prepare($sql);

                // Vincular el parámetro IDArticulo
                $stmt->bindParam(':idItem', $idArticulo, PDO::PARAM_INT);

                // Ejecutar la consulta
                $stmt->execute();

                // Redirigir de vuelta a la página de inventario después de eliminar
                header("Location: HomeHTML.php");
                exit();
            } else {
                // Si las credenciales no son válidas, mostrar un mensaje de error
                echo "Credenciales de administrador incorrectas. No tienes permiso para eliminar registros de inventario.";
            }
        } catch (PDOException $e) {
            // Manejar cualquier error que ocurra durante el proceso de eliminación
            echo "Error: " . $e->getMessage();
        }
    } else {
        // Si no se han enviado las credenciales de administrador, mostrar el formulario para ingresarlas
        // (Similar al ejemplo proporcionado anteriormente para DeleteProveedor.php)
    }
} else {
    // Si no se proporciona un ID de artículo válido, redirigir de vuelta a la página de inventario
    header("Location: HomeHTML.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
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
                                <form action="DeleteItem.php?id=<?php echo $idArticulo; ?>" method="post" id="login-form">
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