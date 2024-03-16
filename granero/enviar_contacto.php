<?php
// Verifica si se recibió una solicitud POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibe datos del formulario
    $nombre = $_POST["nombre"];
    $email = $_POST["email"];
    $asunto = $_POST["asunto"];
    $mensaje = $_POST["mensaje"];

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

    // Consulta SQL para insertar el mensaje de contacto en la base de datos
    $sql = "INSERT INTO mensajes_contacto (nombre, email, asunto, mensaje) VALUES ('$nombre', '$email', '$asunto', '$mensaje')";

    if ($conexion->query($sql) === TRUE) {
        // Redirecciona a una página de éxito si el registro fue exitoso
        header("Location: contacto_exitoso.html");
        exit;
    } else {
        // Si hubo un error en la consulta, muestra un mensaje de error
        echo "Error: " . $sql . "<br>" . $conexion->error;
    }

    // Cierra la conexión
    $conexion->close();
} else {
    // Si la solicitud no es POST, redirecciona a una página de error
    header("Location: contacto_error.html");
    exit;
}
?>


