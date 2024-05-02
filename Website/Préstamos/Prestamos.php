<?php

$serverName = "DESKTOP-HG6LPR5\SQLEXPRESS01";
$database = "BIOLdb";
$uid = "";
$pass = "";

$connection = [
    "Database" => $database,
    "Uid" => $uid,
    "PWD" => $pass,
];

$conn = sqlsrv_connect($serverName, $connection);
if(!$conn) {
    die(print_r(sqlsrv_errors(), true));
} 

$sql = "SELECT * FROM dbo.Usuarios";
$result = sqlsrv_query($conn, $sql);

if ($result !== false) {
    // Output data of each row
    while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
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

sqlsrv_free_stmt($result);
sqlsrv_close($conn);
?>

