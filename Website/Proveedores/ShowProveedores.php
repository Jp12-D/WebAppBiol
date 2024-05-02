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
    $sql = "SELECT * FROM dbo.Proveedores";
    $stmt = $pdo->query($sql);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($rows) {
        foreach ($rows as $row) {
            echo "<tr>";
            echo "<td>" . $row['IDProveedor'] . "</td>";
            echo "<td>" . $row['NombreProveedor'] . "</td>";
            echo "<td>" . $row['Telefono'] . "</td>";
            echo "<td>" . $row['eMail'] . "</td>";
            echo "<td><a href='" . $row['URL'] . "'>" . $row['URL'] . "</a></td>";
            echo "<td>" . $row['Notas'] . "</td>";
            echo "<td><a href='ValidarEditProveedores.php?id=" . $row['IDProveedor'] . "' class='boton-editar mostrar-editar'>Editar</a></td>";
            echo "<td><a href=\"DeleteProveedor.php?nombre=" . urlencode($row['NombreProveedor']) . "\" onclick=\"return confirm('¿Estás seguro de que quieres eliminar este proveedor?');\" class='boton-borrar mostrar-borrar'>Eliminar</a></td>";
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