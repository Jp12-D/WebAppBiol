<?php
require_once 'DatabaseConnection.php';

// Verificar si se ha proporcionado un ID de usuario válido
if (isset($_GET['id']) && !empty($_GET['id'])) {
    // Obtener el ID de usuario desde la URL
    $idUsuario = $_GET['id'];

    // Verificar si se han enviado los datos del formulario de actualización
    if (isset($_POST['nombre']) && isset($_POST['apellidoPaterno']) && isset($_POST['apellidoMaterno']) && isset($_POST['eMail']) && isset($_POST['pwd']) && isset($_POST['privilegio'])) {
        // Obtener los datos del formulario
        $nombre = $_POST['nombre'];
        $apellidoPaterno = $_POST['apellidoPaterno'];
        $apellidoMaterno = $_POST['apellidoMaterno'];
        $emailUsuario = $_POST['eMail'];
        $password = $_POST['pwd'];
        $privilegio = $_POST['privilegio'];

        // Obtener la conexión a la base de datos
        $pdo = obtenerConexionBD();

         // Verificar si se proporcionó una nueva contraseña
    if (!empty($_POST['pwd'])) {
        // Si se proporcionó una nueva contraseña, actualízala en la base de datos
        $password = $_POST['pwd'];
    } else {
        // Si no se proporcionó una nueva contraseña, conserva la contraseña existente en la base de datos
        // Obtener la contraseña existente del usuario desde la base de datos
        $sqlPassword = "SELECT Contraseña FROM dbo.Usuarios WHERE IDUsuario = ?";
        $stmtPassword = $pdo->prepare($sqlPassword);
        $stmtPassword->execute([$idUsuario]);
        $existingPassword = $stmtPassword->fetchColumn();

        // Utilizar la contraseña existente
        $password = $existingPassword;
    }

        try {

            // Construir la consulta SQL para actualizar el usuario
            $query = "UPDATE dbo.Usuarios SET Nombre=?, Apellido_Paterno=?, Apellido_Materno=?, eMail=?, Contraseña=?, Privilegio=? WHERE IDUsuario=?";

            $stmt = $pdo->prepare($query);

            $stmt->execute([$nombre, $apellidoPaterno, $apellidoMaterno, $emailUsuario, $password, $privilegio, $idUsuario]);

            // Redirigir de vuelta a la página de usuarios después de actualizar
            header("Location: UsuariosHTML.php");
            exit();
        } catch (PDOException $e) {
            if($e->getCode() === '23000' && strpos($e->getMessage(), 'eMail UNIQUE') !== false){
                echo "No se pudo agregar este usuario. El email ingresado ya está en uso por otro usuario.";
            } elseif($e->getCode() === '23000' && strpos($e->getMessage(), 'Contraseña UNIQUE') !== false){
                echo "Contraseña inválida, favor de utilizar otra contraseña.";
            }else {
                echo "Error, someta la información del usuario de nuevo.";
            }
        }
    } else {
        // Obtener los datos del usuario a editar de la base de datos
        try {
            // Obtener la conexión a la base de datos
            $pdo = obtenerConexionBD();

            // Consultar la base de datos para obtener la información del usuario a editar
            $sql = "SELECT * FROM dbo.Usuarios WHERE IDUsuario = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$idUsuario]);
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            // Datos del usuario obtenidos, ahora prellenamos los campos del formulario con esta información
            $nombre = $usuario['Nombre'];
            $apellidoPaterno = $usuario['Apellido_Paterno'];
            $apellidoMaterno = $usuario['Apellido_Materno'];
            $emailUsuario = $usuario['eMail'];
         
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Write your comments here -->
    <title>Credenciales-Editar</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Se vincula el archivo de css para que de estilo-->
    <link rel="stylesheet" href="js.css">
    <link rel="stylesheet" href="FormUsers.css">
</head>

<body>
   
        <div class="center-prompt">
            <div class="container">
                <div class="row center">
                    <div class="col-md-6 text-center mx-auto">
                        <div class="card">
                            <div class="card-header">
                                Editar Usuario
                            </div>
                            <div class="card-body">
                                <form  method="post">

                                <input type="hidden" name="idUsuario" value="<?php echo $idUsuario; ?>">
                                    <div class="form-group">
                                        <label for="Nombre">Nombre:</label>
                                        <input type="text" class="form-control" id="Nombre" name="nombre" value="<?php echo $nombre; ?>" placeholder="Juan" required></input>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="Apellido Paterno">Apellido paterno:</label>
                                        <input type="text" class="form-control" id="ApellidoPaterno" name="apellidoPaterno" value="<?php echo $apellidoPaterno; ?>" placeholder="Del" required></input>
                                    </div>
                                   
                                    <div class="form-group">
                                        <label for="Apellido Materno">Apellido materno:</label>
                                        <input type="text" class="form-control" id="ApellidoMaterno" name="apellidoMaterno" value="<?php echo $apellidoMaterno; ?>" placeholder="Pueblo"></input>
                                    </div>
                                   
                                    <div class="form-group">
                                        <label for="eMail">eMail:</label>
                                        <input type="email" class="form-control" id="eMail" name="eMail"  value="<?php echo $emailUsuario; ?>" placeholder="juan.delpueblo@upr.edu" required></input>
                                    </div>
                            
                                    <div class="form-group">
                                        <label for="Privilegio">Password:</label>
                                        <input type="password" class="form-control" id="Password" name="pwd" maxlength="100"></input>
                                    </div>
                            
                                    <div class="form-group">
                                        <label for="Privilegio">Privilegio:</label>
                                        <label for="admin">Admin</label>
                                        <input type="radio" name="privilegio" id="admin" value="Admin" onclick="document.getElementById('usuario').checked = false;">
                                        
                                        <label for="usuario">Usuario</label>
                                        <input type="radio" name="privilegio" id="usuario" value="Usuario" onclick="document.getElementById('admin').checked = false;">
                                    </div>
                                   
                            
                                    <div>
                                   <button type="button" onclick="window.location.href = 'UsuariosHTML.php';">Volver</button>
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
    header("Location: UsuariosHTML.php");
    exit();
}
?>