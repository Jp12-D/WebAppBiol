<?php
require_once 'DatabaseConnection.php';

// Verificar si se ha proporcionado un ID de usuario válido
if (isset($_GET['id']) && !empty($_GET['id'])) {
    
    // Obtener el ID del artículo desde la URL
    $idArticulo = $_GET['id'];

    // Verificar si se han enviado los datos del formulario de actualización del inventario
    if (isset($_POST['serialNum']) && isset($_POST['fondos']) && isset($_POST['etiqueta']) && isset($_POST['categoria']) && isset($_POST['fechaExp'])
    && isset($_POST['nombreArticulo']) && isset($_POST['marca']) && isset($_POST['modelo']) && isset($_POST['costo']) 
    && isset($_POST['ubicacion'])&& isset($_POST['registrador']) && isset($_POST['descripcion'])) {
        
        // Obtener los datos del formulario
        $serialNum = $_POST['serialNum'];
        $fondos = $_POST['fondos'];
        $etiqueta = $_POST['etiqueta'];
        $categoria = $_POST['categoria'];
        $fechaExpiracion = !empty($_POST['fechaExp']) ? $_POST['fechaExp'] : null;
        $nombreArticulo = $_POST['nombreArticulo'];
        $marca = $_POST['marca'];
        $modelo = $_POST['modelo'];
        $costo = $_POST['costo'];
        $proveedor = $_POST['proveedor'];
        $ubicacion = $_POST['ubicacion'];
        $registrado = $_POST['registrador'];
        $descripcion = $_POST['descripcion'];
        
        // Obtener la conexión a la base de datos
        $pdo = obtenerConexionBD();

        try {

            // Construir la consulta SQL para actualizar el artículo
            $query = "UPDATE dbo.Inventario SET SerialNum=?, Fondos=?, Etiqueta=?, Categoria=?, FechaExp=?, NombreArticulo=?, 
            Marca=?, Modelo=?, Costo=?, NombreProveedor=?, NombreUbicacion=?, IDUsuario=?, Descripcion=? WHERE IDArticulo=?";

            $stmt = $pdo->prepare($query);

            $stmt->execute([$serialNum, $fondos, $etiqueta, $categoria, $fechaExpiracion, 
            $nombreArticulo, $marca, $modelo, $costo, $proveedor, $ubicacion, $registrado, $descripcion, $idArticulo]);

            // Redirigir de vuelta a la página de Home después de actualizar
            header("Location: HomeHTML.php");
            exit();
        } catch (PDOException $e) {
            if ($e->getCode() === '23000') {
                if (strpos($e->getMessage(), 'Etiqueta UNIQUE') !== false && strpos($e->getMessage(), 'SerialNum UNIQUE') === false) {
                    // Etiqueta repetida
                    echo "La etiqueta sometida ya está siendo utilizada por otro artículo. Favor de intentarlo de nuevo";
                } elseif (strpos($e->getMessage(), 'SerialNum UNIQUE') !== false && strpos($e->getMessage(), 'Etiqueta UNIQUE') === false) {
                    // Número de serie repetido
                    echo "El número de serie sometido ya está siendo utilizado por otro articulo. Favor de intentarlo de nuevo.";
                } elseif (strpos($e->getMessage(), 'Etiqueta UNIQUE') !== false && strpos($e->getMessage(), 'SerialNum UNIQUE') !== false) {
                    // Etiqueta y número de serie repetidos
                    echo "No se pudo actualizar el registro. La etiqueta y el número de serie ingresados ya están en uso.";
                } 
            } else {
                
                echo "Ocurrió un error al procesar su solicitud. Por favor, inténtelo de nuevo más tarde.";
            }
        }
    } else {
        
        try {
            // Obtener la conexión a la base de datos
            $pdo = obtenerConexionBD();

            // Consultar la base de datos para obtener la información del artículo a editar
            $sql = "SELECT * FROM dbo.Inventario WHERE IDArticulo = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$idArticulo]);
            $fetchInv = $stmt->fetch(PDO::FETCH_ASSOC);

            // Inicializar las variables con los datos del artículo
            $serialNum = $fetchInv['SerialNum'];
            $fondos = $fetchInv['Fondos'];
            $etiqueta = $fetchInv['Etiqueta'];
            $categoria = $fetchInv['Categoria'];
            $fechaExpiracion = $fetchInv['FechaExp'];
            $nombreArticulo = $fetchInv['NombreArticulo'];
            $marca = $fetchInv['Marca'];
            $modelo = $fetchInv['Modelo'];
            $costo = $fetchInv['Costo'];
            $proveedor = $fetchInv['NombreProveedor'];
            $ubicacion = $fetchInv['NombreUbicacion'];
            $registrado = $fetchInv['IDUsuario'];
            $descripcion = $fetchInv['Descripcion'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Credenciales-Editar</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="FormInventario.css">
</head>
<body>
    <div class="center-prompt">
        <div class="container">
            <div class="row center">
                <div class="col-md-6 text-center mx-auto">
                    <div class="card">
                        <div class="card-header">
                            Editar Artículo
                        </div>

                        <?php echo $fechaExpiracion; ?>
                        <div class="card-body">
                            <form method="post" onsubmit="return validarFormulario()">
                                <input type="hidden" name="idArticulo" value="<?php echo $idArticulo ?>">
                                <div class="form-group">
                                    <label for="SerialNum">Número de Serie:</label>
                                    <input type="text" class="form-control" id="Nombre" name="serialNum" value="<?php echo $serialNum; ?>" placeholder=required>
                                </div>
                                <div class="form-group">
                                    <label for="Fondos">Fondos:</label>
                                    <label for="upr">UPR</label>
                                    <input type="radio" name="fondos" id="upr" value="UPR" <?php if ($fondos==='UPR' ) echo 'checked' ; ?>>
                                    <label for="fed">FED</label>
                                    <input type="radio" name="fondos" id="fed" value="FED" <?php if ($fondos==='FED' ) echo 'checked' ; ?>>
                                </div>
                                <div class="form-group">
                                    <label for="etiqueta">Etiqueta:</label>
                                    <input type="text" class="form-control" id="notas" name="etiqueta" value="<?php echo $etiqueta; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="categoria">Categoría:</label>
                                    <label for="instrumento">Instrumento</label>
                                    <input type="radio" name="categoria" id="instrumento" value="instrumento" <?php if ($categoria==='instrumento' ) echo 'checked' ; ?>>
                                    <label for="mueble">Mueble</label>
                                    <input type="radio" name="categoria" id="mueble" value="mueble" <?php if ($categoria==='mueble' ) echo 'checked' ; ?>>
                                    <label for="solucion">Solución</label>
                                    <input type="radio" name="categoria" id="solucion" value="solucion" <?php if ($categoria==='solucion' ) echo 'checked' ; ?>>
                                </div>
                                <div class="form-group">
                                    <label for="fechaExp">Fecha de expiración: (<?php echo $fechaExpiracion; ?>) PONER LA FECHA DEL PARÉNTESIS EN EL CAMPO:</label>
                                    <input type="date" class="form-control" id="fechaExp" name="fechaExp" value="<?php echo $fechaExpiracion; ?>"></input>
                                </div>
                                <div class="form-group">
                                    <label for="nombreArticulo">Nombre del Articulo:</label>
                                    <input type="text" class="form-control" id="nombreArticulo" name="nombreArticulo" value="<?php echo $nombreArticulo; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="marca">Marca</label>
                                    <input type="text" class="form-control" id="marca" name="marca" value="<?php echo $marca; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="modelo">Modelo</label>
                                    <input type="text" class="form-control" id="modelo" name="modelo" value="<?php echo $modelo; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="costo">Costo</label>
                                    <input type="text" class="form-control" id="costo" name="costo" maxlength="12" value="<?php echo $costo; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="proveedor">Proveedor:</label>
                                    <select id="proveedor" name="proveedor">
                                        <?php
                                            // Obtener el nombre del proveedor
                                            $proveedorNombre = $fetchInv['NombreProveedor'];

                                            // Mostrar las opciones del dropdown de proveedores
                                            include('proveedorDropDown.php');

                                            // Preseleccionar la opción correspondiente al proveedor
                                            echo "<script>document.getElementById('proveedor').value = '$proveedorNombre';</script>";
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="ubicacion">Ubicación:</label>
                                    <select id="ubicacion" name="ubicacion">
                                        <?php
                                            // Obtener el nombre de la ubicación
                                            $ubicacionNombre = $fetchInv['NombreUbicacion'];

                                            // Mostrar las opciones del dropdown de ubicaciones
                                            include('ubicacionDropDown.php');

                                            // Preseleccionar la opción correspondiente a la ubicación
                                            echo "<script>document.getElementById('ubicacion').value = '$ubicacionNombre';</script>";
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="registrador">Registrado por:</label>
                                    <select id="registrador" name="registrador">
                                        <?php
                                            // Obtener el ID del usuario registrado por
                                            $registradorID = $fetchInv['IDUsuario'];

                                            // Mostrar las opciones del dropdown de usuarios
                                            include('UsuarioDropDown.php');

                                            // Preseleccionar la opción correspondiente al usuario registrado por
                                            echo "<script>document.getElementById('registrador').value = '$registradorID';</script>";
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="descripcion">Descripcion</label>
                                    <input type="text" class="form-control" id="notas" name="descripcion" value="<?php echo $descripcion; ?>">
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
            // Habilitar el campo de fecha de expiración si está deshabilitado
            var fechaExpInput = document.getElementById('fechaExp');
            if (fechaExpInput.disabled) {
                fechaExpInput.disabled = false;
            }
            return true; // Permitir enviar el formulario si todo está correcto
        }
    </script>
    <script>
        function habilitarFechaExpiracion() {
            var categoriaSeleccionada = document.querySelector('input[name="categoria"]:checked').value;
            var fechaExpiracionInput = document.getElementById('fechaExp');
            if (categoriaSeleccionada === 'solucion') {
                fechaExpiracionInput.disabled = false; // Habilitar el campo de fecha de expiración
                fechaExpiracionInput.style.opacity = 1; // Restaurar la opacidad
            } else {
                fechaExpiracionInput.disabled = true; // Deshabilitar el campo de fecha de expiración
                fechaExpiracionInput.style.opacity = 0.5; // Reducir la opacidad para indicar que está deshabilitado
            }
        }
        // Llamar a la función cuando cambie la selección de categoría
        document.querySelectorAll('input[name="categoria"]').forEach(function (radioButton) {
            radioButton.addEventListener('change', habilitarFechaExpiracion);
        });
        // Llamar a la función al cargar la página para establecer el estado inicial del campo de fecha de expiración
        window.addEventListener('load', habilitarFechaExpiracion);
    </script>
</body>
</html>
<?php
        } catch (PDOException $e) {
            // Manejar cualquier error que ocurra durante la obtención de los datos del usuario
            echo "Error: " . $e->getMessage();
        }
    }
} else {
    // Si no se proporciona un ID de artículo válido, redirigir de vuelta a la página de Inventario
    header("Location: HomeHTML.php");
    exit();
}
?>
