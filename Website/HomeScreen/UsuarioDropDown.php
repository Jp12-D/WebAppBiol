<?php

$serverName = "DESKTOP-HG6LPR5\\SQLEXPRESS01";
$database = "BIOLdb";
$uid = "";
$pass = "";

try {
    $pdo = new PDO("sqlsrv:Server=$serverName;Database=$database", $uid, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM dbo.Usuarios";
    $stmt = $pdo->query($sql);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if($rows){
        foreach($rows as $row){
            echo "<option value='" . $row['IDUsuario'] . "'>" . $row['IDUsuario'] . " - " . $row['Nombre'] . " " . $row['Apellido_Paterno'] . "</option>";
        }
    } else{
        echo "<option value=''>No hay usuarios disponibles</option>";
    }
    
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$pdo = null;