<?php
// Verificar si se recibieron los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario 
    $nombre = htmlspecialchars($_POST['nombre']);
    $email = htmlspecialchars($_POST['email']);
    $contrasena = htmlspecialchars($_POST['contrasena']);
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $telefono = $_POST['telefono'];

    // Validar los datos
    if (empty($nombre) || empty($email) || empty($contrasena) || empty($fecha_nacimiento) || empty($telefono)) {
        echo "Por favor completa todos los campos obligatorios.";
        exit;
    }

    // Validar el nombre para evitar caracteres especiales
    if (!preg_match("/^[a-zA-Z ]*$/", $nombre)) {
        echo "El nombre solo puede contener letras y espacios.";
        exit;
    }

    // Validar el teléfono y que solo contenga números
    if (!preg_match("/^[0-9]+$/", $telefono)) {
        echo "El número de teléfono solo puede contener números.";
        exit;
    }

    // Conectar a la base de datos
    $servername = "localhost";
    $username = "root";
    $password = "!UMpub41*";
    $dbname = "mi_aplicacion_db";

    // Crear conexión utilizando consultas preparadas
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Error en la conexión a la base de datos: " . $conn->connect_error);
    }

    // consulta 
    $sql = "INSERT INTO usuarios (nombre, email, contrasena, fecha_nacimiento, telefono) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    //  ejecutar la consulta 
    $stmt->bind_param("sssss", $nombre, $email, $contrasena, $fecha_nacimiento, $telefono);

    if ($stmt->execute()) {
        echo "Registro exitoso. ¡Bienvenido, $nombre!";
    } else {
        echo "Error al registrar el usuario: " . $conn->error;
    }

    // Cerrar la conexión a la base de datos
    $stmt->close();
    $conn->close();
} else {
    // Redireccionar si se intenta acceder directamente 
    header("Location: formulario_registro.php");
    exit;
}
?>
