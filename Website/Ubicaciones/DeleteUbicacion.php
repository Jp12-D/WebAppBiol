<?php
require_once 'DatabaseConnection.php';

if(isset($_GET['nombre']) && !empty($_GET['nombre'])) {
    $nombreUbicacion = $_GET['nombre'];

    if(isset($_POST['email']) && isset($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        try {
            $pdo = obtenerConexionBD();

            $sql = "SELECT * FROM dbo.Usuarios WHERE eMail = :email AND Contraseña = :password AND Privilegio = 'admin'";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            $stmt->execute();
            $adminUser = $stmt->fetch(PDO::FETCH_ASSOC);

            if($adminUser) {
                $sql = "DELETE FROM dbo.Ubicacion WHERE NombreUbicacion = :nombreUbicacion";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':nombreUbicacion', $nombreUbicacion, PDO::PARAM_STR);
                $stmt->execute();

                header("Location: UbicacionesHTML.php");
                exit();
            } else {
                echo "Credenciales de administrador incorrectas. No tienes permiso para eliminar ubicaciones.";
            }
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
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
                                <form action="DeleteUbicacion.php?nombre=<?php echo $nombreUbicacion; ?>" method="post" id="login-form">
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
} else {
    header("Location: UbicacionesHTML.php");
    exit();
}
?>