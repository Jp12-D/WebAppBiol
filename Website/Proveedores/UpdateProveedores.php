<?php
require_once 'DatabaseConnection.php';

// Verificar si se ha proporcionado un ID de usuario válido
if (isset($_GET['id']) && !empty($_GET['id'])) {
    // Obtener el ID del proveedor desde la URL
    $idProveedor = $_GET['id'];

    // Verificar si se han enviado los datos del formulario de actualización
    if (isset($_POST['nombreProveedor']) && isset($_POST['telefono']) && isset($_POST['emailProveedor']) && isset($_POST['url']) && isset($_POST['notas'])) {
        
        // Obtener los datos del formulario

        $nombreP = $_POST['nombreProveedor'];
        $telefono = $_POST['telefono'];
        $email = $_POST['emailProveedor'];
        $URL = $_POST['url'];
        $notas = $_POST['notas'];
        

        // Obtener la conexión a la base de datos
        $pdo = obtenerConexionBD();

        try {

            // Construir la consulta SQL para actualizar la ubicacion
            $query = "UPDATE dbo.Proveedores SET NombreProveedor=?, Telefono=?,eMail=?, URL=?,Notas=? WHERE IDProveedor=?";

            $stmt = $pdo->prepare($query);

            $stmt->execute([$nombreP, $telefono, $email, $URL, $notas, $idProveedor]);

            // Redirigir de vuelta a la página de ubicaciones después de actualizar
            header("Location: ProveedoresHTML.php");
            exit();
        } catch (PDOException $e) {
            // Manejar cualquier error que ocurra durante el proceso de actualización
            echo "Error: " . $e->getMessage();
        }
    } else {
        
        try {
            // Obtener la conexión a la base de datos
            $pdo = obtenerConexionBD();

            // Consultar la base de datos para obtener la información del proveedor a editar
            $sql = "SELECT * FROM dbo.Proveedores WHERE IDProveedor = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$idProveedor]);
            $fetchProv = $stmt->fetch(PDO::FETCH_ASSOC);

            // Inicializar las variables con los datos de la ubicacion
           
            $nombreP = $fetchProv['NombreProveedor'];
            $telefono = $fetchProv['Telefono'];
            $email = $fetchProv['eMail'];
            $URL = $fetchProv['URL'];
            $notas = $fetchProv['Notas'];
           
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Credenciales-Editar</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="FormProveedores.css">
</head>

<body>
   
    <div class="center-prompt">
        <div class="container">
            <div class="row center">
                <div class="col-md-6 text-center mx-auto">
                    <div class="card">
                        <div class="card-header">
                            Editar Proveedor
                        </div>
                        <div class="card-body">
                            <form method="post">

                                <input type="hidden" name="idProveedor" value="<?php echo $idProveedor ?>">

                                <div class="form-group">
                                    <label for="Nombre">Nombre:</label>
                                    <input type="text" class="form-control" id="Nombre" name="nombreProveedor" value="<?php echo $nombreP; ?>" placeholder="Salón XXX" required>
                                </div>
                                    
                                <div class="form-group">
                                    <label for="telefono">Teléfono:</label>
                                    <input type="tel" class="form-control" id="notas" name="telefono" placeholder="123-456-7890" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}"  value="<?php echo $telefono; ?>">
                                </div>

                                <div class="form-group">
                                    <label for="email">eMail:</label>
                                    <input type="email" class="form-control" id="notas" name="emailProveedor" value="<?php echo $email; ?>">
                                </div>

                                <div class="form-group">
                                    <label for="url">URL:</label>
                                    <input type="text" class="form-control" id="notas" name="url" value="<?php echo $URL; ?>">
                                </div>

                                <div class="form-group">
                                    <label for="notas">Notas:</label>
                                    <input type="text" class="form-control" id="notas" name="notas" value="<?php echo $notas; ?>">
                                </div>                     
                            
                                <div>
                                    <button type="button" onclick="window.location.href = 'ProveedoresHTML.php';">Volver</button>
                                    <input type="submit">
                                    <input type="reset">
                                </div>
                            
                            </form>
                            <div id="error-message" class="error-message mt-3"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
            </div>

        </div>
    </div>
</body>

</html>
<?php
        } catch (PDOException $e) {
            // Manejar cualquier error que ocurra durante la obtención de los datos del usuario
            echo "Error: " . $e->getMessage();
        }
    }
} else {
    // Si no se proporciona un ID de usuario válido, redirigir de vuelta a la página de usuarios
    header("Location: ProveedoresHTML.php");
    exit();
}
?>