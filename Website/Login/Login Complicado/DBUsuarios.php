<?php
session_start();
// Obtener los datos del usuario de las variables de sesión
$IDUsuario = $_SESSION["IDUsuario"];
$Nombre = $_SESSION["Nombre"];
$email = $_SESSION["eMail"];

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

    if ($rows) {
        foreach ($rows as $row) {
            echo "<tr>";
            echo "<td>" . $row['IDUsuario'] . "</td>";
            echo "<td>" . $row['Nombre'] . "</td>";
            echo "<td>" . $row['Apellido_Paterno'] . "</td>";
            echo "<td>" . $row['Apellido_Materno'] . "</td>";
            echo "<td>" . $row['eMail'] . "</td>";
            echo "<td>" . $row['Privilegio'] . "</td>";
            echo "</tr>";
        }
    } else {
        echo "0 resultados";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$pdo = null;

function obtenerConexionBD() {
    $serverName = "DESKTOP-HG6LPR5\\SQLEXPRESS01";
    $database = "BIOLdb";
    $uid = ""; // Tu nombre de usuario de la base de datos
    $pass = ""; // Tu contraseña de la base de datos

    try {
        $pdo = new PDO("sqlsrv:Server=$serverName;Database=$database", $uid, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo; // Devuelve el objeto PDO
    } catch (PDOException $e) {
        echo "Error de conexión: " . $e->getMessage();
        exit(); // Finaliza el script en caso de error de conexión
    }
}

