<?php

$servername = "localhost"; 
$username = "root"; 
$password = "!UMpub41*"; 
$dbname = "mi_aplicacion_db"; 

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}

// consulta
$sql = "SELECT telefono, nombre, email, fecha_nacimiento FROM usuarios";
$result = $conn->query($sql);

// Verificacion si se obtuvieron resultados
if ($result->num_rows > 0) {
    // Mostrar los datos en una tabla HTML
    echo "<h2>Datos de Usuarios:</h2>";
    echo "<table border='1'>";
    echo "<tr><th>Telefono</th><th>Nombre</th><th>Email</th><th>Fecha de Nacimiento</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["telefono"] . "</td>";
        echo "<td>" . $row["nombre"] . "</td>";
        echo "<td>" . $row["email"] . "</td>";
        echo "<td>" . $row["fecha_nacimiento"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No se encontraron usuarios en la base de datos.";
}

// Cerrar la conexión
$conn->close();
?>
