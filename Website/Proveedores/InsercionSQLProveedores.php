<?php

if($_SERVER["REQUEST_METHOD"]=="POST"){

    $Nombre = $_POST["Nombre"];
    $telefono = $_POST["telefono"];
    $email = $_POST["eMail"];
    $url = $_POST["url"];
    $Notas = $_POST["notas"];

    try {

        require_once "DatabaseConnection.php";

        $query = "INSERT INTO dbo.Proveedores (NombreProveedor, Telefono, eMail, URL, Notas) 
         VALUES (?,?,?,?,?);";

        $stmt = $pdo->prepare($query);

        
        
        
        $stmt->execute([$Nombre, $telefono, $email, $url, $Notas]);

        $pdo = null;
        $stmt = null;

        header("Location: ProveedoresHTML.php");
        echo '<script>window.location.reload(true);</script>';
        
        die();
        
    } catch (PDOException $e) {
        die("Query failed: " .$e->getMessage());
    }

}
else{
    
}