<?php
session_start();

// Verificar si las credenciales han sido validadas
if (!isset($_SESSION['credenciales_validadas']) || $_SESSION['credenciales_validadas'] !== true) {
    // Si las credenciales no han sido validadas, redirigir al usuario al formulario de verificación de credenciales
    header("Location: ValidarEntrada.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Write your comments here -->
    <title>Forma Usuarios</title>
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
                                Registrar Usuario
                            </div>
                            <div class="card-body">
                                <form action="InsercionSQLUsuarios.php" method="post">
                                    <div class="form-group">
                                        <label for="Nombre">Nombre:</label>
                                        <input type="text" class="form-control" id="Nombre" name="nombre" placeholder="Juan" required></input>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="Apellido Paterno">Apellido paterno:</label>
                                        <input type="text" class="form-control" id="Apellido paterno" name="paterno" placeholder="Del" required></input>
                                    </div>
                                   
                                    <div class="form-group">
                                        <label for="Apellido Materno">Apellido materno:</label>
                                        <input type="text" class="form-control" id="Apellido materno" name="materno" placeholder="Pueblo"></input>
                                    </div>
                                   
                                    <div class="form-group">
                                        <label for="eMail">eMail:</label>
                                        <input type="email" class="form-control" id="eMail" name="eMail"
                                         placeholder="juan.delpueblo@upr.edu" required></input>
                                    </div>
                            
                                  
                                    <div class="form-group">
                                        <label for="Privilegio">Password:</label>
                                        <input type="password" class="form-control" id="Password" name="pwd" maxlength="100" required></input>
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