<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    date_default_timezone_set('America/Puerto_Rico');

    $fechaAdquisicion = date("Y-m-d H:i:s");
    $serialNum = $_POST["numSerie"];
    $fondos = $_POST["fondos"];
    $etiqueta = $_POST["etiqueta"];
    $categoria = $_POST["categoria"];
    $fechaExp = $_POST["fechaExp"];
    $nombreArticulo = $_POST["nombreArticulo"];
    $marca = $_POST["marca"];
    $modelo = $_POST["modelo"];
    $costo = $_POST["costo"];
    $proveedor = $_POST["proveedor"];
    $ubicacion = $_POST["ubicacion"];
    $IDUsuario = $_POST["registrador"];
    $descripcion = $_POST["descripcion"];

    try {

        require_once "DatabaseConnection.php";

        // Verificar si la categoría es "Solución"
        if (strtolower($categoria) != "solucion") {
            // Si la categoría no es "Solución", establecer FechaExp como NULL
            $fechaExp = null;
        }

        $query = "INSERT INTO dbo.Inventario (FechaAdquisicion, SerialNum, Fondos, Etiqueta, Categoria, FechaExp,
         NombreArticulo, Marca ,Modelo , Costo, NombreProveedor, NombreUbicacion,IDUsuario, Descripcion) 
         VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?);";

        $stmt = $pdo->prepare($query);

        // Ejecutar la consulta utilizando execute() en lugar de asignarla a $stmt nuevamente.
        $stmt->execute([$fechaAdquisicion, $serialNum, $fondos, $etiqueta, $categoria, $fechaExp, $nombreArticulo,
            $marca, $modelo, $costo, $proveedor, $ubicacion, $IDUsuario, $descripcion]);

        $pdo = null;
        $stmt = null;

        header("Location: HomeHTML.php");
        echo '<script>window.location.reload(true);</script>';

        die();
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
                echo "No se pudo insertar el registro. La etiqueta y el número de serie ingresados ya están en uso.";
            } 
        } else {
            
            echo "Ocurrió un error al procesar su solicitud. Por favor, inténtelo de nuevo.";
        }
    }
} 
