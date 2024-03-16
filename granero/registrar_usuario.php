<?php
// Verifica si se recibió una solicitud POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibe datos del formulario
    $nombre = $_POST["nombre"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Conexión a la base de datos (ajusta los valores según tu configuración)
    $servidor = "localhost";
    $usuario_db = "root";
    $contraseña_db = "S3gur1d4d";
    $nombre_db = "granero";

    // Establece la conexión
    $conexion = new mysqli($servidor, $usuario_db, $contraseña_db, $nombre_db);

    // Verifica la conexión
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    // Hash de la contraseña (para almacenarla de forma segura en la base de datos)
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Consulta SQL para insertar el usuario en la base de datos
    $sql = "INSERT INTO usuarios (nombre, email, password) VALUES ('$nombre', '$email', '$hashed_password')";

    if ($conexion->query($sql) === TRUE) {
        // Redirecciona a una página de éxito si el registro fue exitoso
        header("Location: registro_exitoso.html");
        exit;
    } else {
        // Si hubo un error en la consulta, muestra un mensaje de error
        echo "Error: " . $sql . "<br>" . $conexion->error;
    }

    // Cierra la conexión
    $conexion->close();
} else {
    // Si la solicitud no es POST, redirecciona a una página de error
    header("Location: registro_error.html");
    exit;
}
?>

