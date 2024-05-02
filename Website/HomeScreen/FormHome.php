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
    <title>Registrar Artículo</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Se vincula el archivo de css para que de estilo-->
    <link rel="stylesheet" href="FormInventario.css">
</head>

<body>
   
    <div class="center-prompt">
        <div class="container">
            <div class="row center">
                <div class="col-md-6 text-center mx-auto">
                    <div class="card">
                        <div class="card-header">
                            Registrar Artículo
                        </div>
                        <div class="card-body">
                            <form action="InsercionSQLHome.php" method="post" onsubmit="return validarFormulario()">
                                <div class="form-group">
                                    <label for="numSerie">Número de Serie:</label>
                                    <input type="text" class="form-control" id="numSerie" name="numSerie" placeholder="Juan" required>
                                </div>

                                <div class="form-group">
                                    <label for="fondos">Fondos:</label>
                                    <label for="upr">UPR</label>
                                    <input type="radio" name="fondos" id="upr" value="UPR">
                                    
                                    <label for="fed">FED</label>
                                    <input type="radio" name="fondos" id="fed" value="FED">
                                </div>
                                
                                <div class="form-group">
                                    <label for="etiqueta">Etiqueta:</label>
                                    <input type="text" class="form-control" id="etiqueta" name="etiqueta" placeholder="XXXXXXX" required>
                                </div>
                               
                                <div class="form-group">
                                    <label for="categoria">Categoría:</label>
                                    <label for="instrumento">Instrumento</label>
                                    <input type="radio" name="categoria" id="instrumento" value="Instrumento">
                                    
                                    <label for="mueble">Mueble</label>
                                    <input type="radio" name="categoria" id="mueble" value="Mueble">
                                    <label for="solucion">Solución</label>
                                    <input type="radio" name="categoria" id="solucion" value="Solucion">
                                </div>

                                <div class="form-group">
                                    <label for="fechaExp">Fecha de expiración (Si aplica):</label>
                                    <input type="date" class="form-control" id="fechaExp" name="fechaExp">
                                </div>
                               
                                <div class="form-group">
                                    <label for="nombreArticulo">Nombre del Artículo:</label>
                                    <input type="text" class="form-control" id="nombreArticulo" name="nombreArticulo" placeholder="XXX" required>
                                </div>
                        
                                <div class="form-group">
                                    <label for="marca">Marca:</label>
                                    <input type="text" class="form-control" id="marca" name="marca" maxlength="100">
                                </div>
                              
                                <div class="form-group">
                                    <label for="modelo">Modelo:</label>
                                    <input type="text" class="form-control" id="modelo" name="modelo" maxlength="100">
                                </div>

                                <div class="form-group">
                                    <label for="costo">Costo:</label>
                                    <input type="text" class="form-control" id="costo" name="costo" maxlength="12" required>
                                </div>

                                <div class="form-group">
                                    <label for="Proveedor">Proveedor:</label>
                                    <select id="proveedor" name="proveedor" >
                                    <?php
                                    include('proveedorDropDown.php')
                                    ?>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label for="ubicacion">Ubicación:</label>
                                    <select id="ubicacion" name="ubicacion" >
                                    <?php
                                    include('ubicacionDropDown.php')
                                    ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="registrador">Registrado por:</label>
                                    <select id="ubicacion" name="registrador" >
                                    <?php
                                    include('UsuarioDropDown.php')
                                    ?>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label for="descripcion">Descripción:</label>
                                    <input type="text" class="form-control" id="descripcion" name="descripcion" maxlength="100" autocomplete="off">
                                </div>
                        
                                <div>
                                    <button type="button" onclick="window.location.href = 'HomeHTML.php';">Volver</button>
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
<!--Scripts-->

<script>
    function validarFormulario() {
    // Verificar si se ha seleccionado una opción de Fondos
    var opcionFondosSeleccionada = document.querySelector('input[name="fondos"]:checked');
    if (!opcionFondosSeleccionada) {
        alert('Por favor, selecciona una opción de Fondos.');
        return false;
    }
    // Verificar si se ha seleccionado una opción de Categoría
    var categoriaSeleccionada = document.querySelector('input[name="categoria"]:checked');
    if (!categoriaSeleccionada) {
        alert('Por favor, selecciona una opción de Categoría.');
        return false;
    }
    // Verificar si se ha seleccionado la categoría "Solución"
    if (categoriaSeleccionada.value !== 'Solucion') {
        var fechaExpInput = document.getElementById('fechaExp');
        if (fechaExpInput.value !== "") {
            alert('No puedes ingresar una fecha de expiración si la categoría no es "Solución".');
            return false;
        }
    }
    return true; // Permitir enviar el formulario si todo está correcto
}

    

    // Llamar a la función cuando cambie la selección de categoría
    document.querySelectorAll('input[name="categoria"]').forEach(function(radioButton) {
        radioButton.addEventListener('change', habilitarFechaExpiracion);
    });

    // Llamar a la función al cargar la página para establecer el estado inicial del campo de fecha de expiración
    window.addEventListener('load', habilitarFechaExpiracion);
</script>

</body>

</html>
