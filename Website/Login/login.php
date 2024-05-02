<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Write your comments here -->
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Se vincula el archivo de css para que de estilo-->
   
    <link rel="stylesheet" href="login.css">

</head>

<body>
    <div class="background-img">
        <div class="center-prompt">
            <div class="container">
                <div class="row center">
                    <div class="col-md-6 text-center mx-auto">
                        <div class="card">
                            <div class="card-header">
                                Iniciar Sesión
                            </div>   
                            <div class="card-body">
                                <form action="InicioSesion.php" method="post" id="login-form">
                                    <div class="form-group">
                                        <label for="username">eMail:</label>
                                        <input type="text" class="form-control" id="username" name="email" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Contraseña:</label>
                                        <input type="password" class="form-control" id="password" name="password">
                                    </div>
                                    <button type="submit" name="submit" class="btn btn-primary">Iniciar Sesión</button>
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