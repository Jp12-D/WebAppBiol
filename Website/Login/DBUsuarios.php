<?php


$serverName = "DESKTOP-HG6LPR5\\SQLEXPRESS01";
$database = "BIOLdb";
$uid = "";
$pass = "";

try {
    $pdo = new PDO("sqlsrv:Server=$serverName;Database=$database", $uid, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
    

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$pdo = null;

function obtenerConexionBD() {
    $serverName = "DESKTOP-HG6LPR5\\SQLEXPRESS01";
    $database = "BIOLdb";
    $uid = ""; 
    $pass = ""; 

    try {
        $pdo = new PDO("sqlsrv:Server=$serverName;Database=$database", $uid, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo; // Devuelve el objeto PDO
    } catch (PDOException $e) {
        echo "Error de conexión: " . $e->getMessage();
        exit(); // Finaliza el script en caso de error de conexión
    }
}

