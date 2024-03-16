<?php
// Verifica si se recibió una solicitud POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibe datos del formulario
    $nombre = $_POST["nombre"];
    $direccion = $_POST["direccion"];
    $telefono = $_POST["telefono"];
    $productos = $_POST["productos"];
    $metodo_pago = $_POST["metodo_pago"];

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

    // Consulta SQL para insertar el pedido en la base de datos
    $sql = "INSERT INTO pedidos (nombre, direccion, telefono, productos, metodo_pago) VALUES ('$nombre', '$direccion', '$telefono', '$productos', '$metodo_pago')";

    if ($conexion->query($sql) === TRUE) {
        // Redirecciona a una página de éxito si el registro fue exitoso
        header("Location: pedido_exitoso.html");
        exit;
    } else {
        // Si hubo un error en la consulta, muestra un mensaje de error
        echo "Error: " . $sql . "<br>" . $conexion->error;
    }

    // Cierra la conexión
    $conexion->close();
} else {
    // Si la solicitud no es POST, redirecciona a una página de error
    header("Location: pedido_error.html");
    exit;
}
?>

