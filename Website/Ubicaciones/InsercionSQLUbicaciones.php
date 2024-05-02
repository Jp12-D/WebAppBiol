<?php

if($_SERVER["REQUEST_METHOD"]=="POST"){



    $nombre = $_POST["nombreUbicacion"];
    
   

    try {

        require_once "DatabaseConnection.php";

        $query = "INSERT INTO dbo.Ubicacion (NombreUbicacion) VALUES (?);";
        
        $stmt = $pdo->prepare($query);

        $stmt->execute([ $nombre]);

        $pdo = null;
        $stmt = null;

        header("Location: UbicacionesHTML.php");
        echo '<script>window.location.reload(true);</script>';
        
        die();
        
    } catch (PDOException $e) {
        if($e->getCode() === '23000' && strpos($e->getMessage(), 'NombreUbicacion UNIQUE') !== FALSE){
            echo "No se pudo añadir esta ubicación. Ya hay una ubicación con ese nombre en nuestros registros. ";
        }
    }

}
