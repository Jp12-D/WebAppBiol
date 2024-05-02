<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Write your comments here -->
    <title>Registrar Proveedor</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Se vincula el archivo de css para que de estilo-->
    <link rel="stylesheet" href="js.css">
    <link rel="stylesheet" href="FormUbicaciones.css">
</head>

<body>
   
        <div class="center-prompt">
            <div class="container">
                <div class="row center">
                    <div class="col-md-6 text-center mx-auto">
                        <div class="card">
                            <div class="card-header">
                                Registrar Ubicacion
                            </div>
                            <div class="card-body">
                                <form action="InsercionSQLUbicaciones.php" method="post">
                                    <div class="form-group">
                                        <label for="Nombre">Nombre:</label>
                                        <input type="text" class="form-control" id="Nombre" name="nombreUbicacion" placeholder="Salón XXX" required></input>
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
    </div>




    <script src="index.js"></script>
</body>

</html>