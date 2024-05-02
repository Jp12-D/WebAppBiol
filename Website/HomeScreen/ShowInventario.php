<style>
    /* Estilos para el enlace "Borrar" */
    .boton-borrar {
        display: none;
        padding: 8px 16px;
        background-color: #950000;
        color: #fff; /* Color del texto */
        text-decoration: none; /* Eliminar subrayado */
        border: none; /* Eliminar borde */
        border-radius: 4px; /* Agregar bordes redondeados */
        cursor: pointer; /* Cambiar cursor al pasar el ratón */

    }

    /* Estilos al pasar el ratón sobre el botón */
    .boton-borrar:hover {
        background-color: #810000; /* Cambiar color de fondo al pasar el ratón */
    }

    .boton-borrar:active {
    background-color: #6e0000;

}
        /* Estilos para el enlace "Editar" */
        .boton-editar {
        display: none;
        padding: 8px 16px;
        background-color:#b3b000;
        color: #fff; 
        text-decoration: none; 
        border: none; 
        border-radius: 4px; 
        cursor: pointer; 

    }

    /* Estilos al pasar el ratón sobre el botón */
    .boton-editar:hover {
        background-color: #817200; /* Cambiar color de fondo al pasar el ratón */
    }

    .boton-editar:active {
    background-color: #686e00;

}
</style>

<?php

$serverName = "DESKTOP-HG6LPR5\\SQLEXPRESS01";
$database = "BIOLdb";
$uid = "";
$pass = "";

try {
    $pdo = new PDO("sqlsrv:Server=$serverName;Database=$database", $uid, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM dbo.Inventario";
    $stmt = $pdo->query($sql);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($rows) {
      foreach ($rows as $row) {
        
       // Verificar si hay una fecha de expiración válida
       if (!empty($row['FechaExp']) && $row['FechaExp'] != '1900-01-01') {
        $fechaActual = strtotime(date("Y-m-d"));
        $fechaExpiracion = strtotime($row['FechaExp']);
        $diferenciaDias = round(($fechaExpiracion - $fechaActual) / (60 * 60 * 24));

        // Si faltan 30 días o menos para la fecha de expiración, aplicar estilo rojo
        if ($diferenciaDias <= 30) {
            $estiloFila = 'style="background-color: #ffcccc;"';
        } else {
            $estiloFila = '';
        }
    } else {
        // Si no hay fecha de expiración, no aplicar estilo
        $estiloFila = '';
    }
        
    
        echo "<tr $estiloFila>";
        echo "<td>" . $row['IDArticulo'] . "</td>";
        echo "<td>" . $row['FechaAdquisicion'] . "</td>";
        echo "<td>" . $row['SerialNum'] . "</td>";
        echo "<td>" . $row['Fondos'] . "</td>";
        echo "<td>" . $row['Etiqueta'] . "</td>";
        echo "<td>" . $row['Categoria'] . "</td>";
        echo "<td>" . $row['NombreProveedor'] . "</td>";
        echo "<td>" . $row['FechaExp'] . "</td>";
        echo "<td>" . $row['NombreArticulo'] . "</td>";
        echo "<td>" . $row['Modelo'] . "</td>";
        echo "<td>" . $row['Marca'] . "</td>";
        echo "<td>$" . $row['Costo'] . "</td>";
        echo "<td>" . $row['NombreUbicacion'] . "</td>";
        echo "<td>" . $row['IDUsuario'] . "</td>";
        echo "<td>" . $row['Descripcion'] . "</td>";
        echo "<td><a href='ValidarEditHome.php?id=" . $row['IDArticulo'] . "' class='boton-editar mostrar-editar'>Editar</a></td>";
        echo "<td><a href='DeleteItem.php?id=" . urlencode($row['IDArticulo']) . "' onclick='return confirm(\"¿Está seguro de que desea borrar este elemento del inventario?\")' class='boton-borrar mostrar-borrar'>Borrar</a></td>";
        echo "</tr>";
    }
    } else {
        echo "0 resultados";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$pdo = null;
?>

<script>
document.addEventListener('DOMContentLoaded', function() {
  var filas = document.querySelectorAll('tbody tr');
  filas.forEach(function(fila) {
    fila.addEventListener('click', function() {
      var enlaceBorrar = this.querySelector('.mostrar-borrar');
      var enlaceEditar = this.querySelector('.mostrar-editar');
      if (enlaceBorrar.style.display === 'inline-block') {
        enlaceBorrar.style.display = 'none';
      } else {
        enlaceBorrar.style.display = 'inline-block';
      }
      if (enlaceEditar.style.display === 'inline-block') {
        enlaceEditar.style.display = 'none';
      } else {
        enlaceEditar.style.display = 'inline-block';
      }
    });
  });
});
</script>