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

    if($rows){
        foreach($rows as $row){
            echo "<option value='" . $row['NombreProveedor'] . "'>" . $row['NombreProveedor'] . "</option>";
        }
    } else{
        echo "<option value=''>No hay ubicaciones disponibles</option>";
    }
    
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$pdo = null;