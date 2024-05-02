<?php
require_once 'DatabaseConnection.php';

// Verificar si se ha proporcionado un ID de usuario válido
if (isset($_GET['id']) && !empty($_GET['id'])) {
    // Obtener el ID de usuario desde la URL
    $idUbicacion = $_GET['id'];

    // Verificar si se han enviado los datos del formulario de actualización
    if (isset($_POST['nombreUbicacion']) && isset($_POST['notas'])){
        
        // Obtener los datos del formulario
        $nombreUbicacion = $_POST['nombreUbicacion'];
        $notas = $_POST['notas'];
        

        // Obtener la conexión a la base de datos
        $pdo = obtenerConexionBD();

        try {

            // Construir la consulta SQL para actualizar la ubicacion
            $query = "UPDATE dbo.Ubicacion SET NombreUbicacion=?, Notas=? WHERE IDUbicacion=?";

            $stmt = $pdo->prepare($query);

            $stmt->execute([$nombreUbicacion, $notas, $idUbicacion]);

            // Redirigir de vuelta a la página de ubicaciones después de actualizar
            header("Location: UbicacionesHTML.php");
            exit();
        } catch (PDOException $e) {
            if($e->getCode() === '23000' && strpos($e->getMessage(), 'NombreUbicacion UNIQUE') !== FALSE){
                echo "No se pudo actualizar esta ubicación. Ya hay una ubicación con ese nombre en nuestros registros. ";
            }
        }
    } else {
        
        try {
            // Obtener la conexión a la base de datos
            $pdo = obtenerConexionBD();

            // Consultar la base de datos para obtener la información de la ubicacion a editar
            $sql = "SELECT * FROM dbo.Ubicacion WHERE IDUbicacion = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$idUbicacion]);
            $ubicacion = $stmt->fetch(PDO::FETCH_ASSOC);

            // Inicializar las variables con los datos de la ubicacion
            $nombreUbicacion = $ubicacion['NombreUbicacion'];
            $notas = $ubicacion['Notas'];
           
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Credenciales-Editar</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="FormUbicaciones.css">
</head>

<body>
   
    <div class="center-prompt">
        <div class="container">
            <div class="row center">
                <div class="col-md-6 text-center mx-auto">
                    <div class="card">
                        <div class="card-header">
                            Editar Ubicacion
                        </div>
                        <div class="card-body">
                            <form  method="post">

                                <input type="hidden" name="idUbicacion" value="<?php echo $idUbicacion; ?>">
                                <div class="form-group">
                                    <label for="Nombre">Ubicacion:</label>
                                    <input type="text" class="form-control" id="Nombre" name="nombreUbicacion" value="<?php echo $nombreUbicacion; ?>" placeholder="Salón XXX" required>
                                </div>
                                    
                                <div class="form-group">
                                    <label for="ApellidoPaterno">Notas:</label>
                                    <input type="text" class="form-control" id="notas" name="notas" value="<?php echo $notas; ?>">
                                </div>                     
                            
                                <div>
                                    <button type="button" onclick="window.location.href = 'UbicacionesHTML.php';">Volver</button>
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
    header("Location: UbicacionesHTML.php");
    exit();
}
?>