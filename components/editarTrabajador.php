<?php 
session_start();
error_reporting(0);

$varsesion = $_SESSION['usuario'];
if($varsesion == null || $varsesion== ''){
    header("location: index.html");
    die();
}

// Establecer la conexión a la base de datos
$servername = "localhost";
$username = "root"; // Reemplaza con tu usuario de MySQL
$password = ""; // Reemplaza con tu contraseña de MySQL
$dbname = "pruebainject";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Verificar que se recibieron los datos esperados
if (isset($_POST['nombre']) && isset($_POST['cargo']) && isset($_POST['nuevo_nombre']) && isset($_POST['nuevo_cargo']) && isset($_POST['nuevo_salario'])) {
    $nombre = $_POST['nombre'];
    $cargo = $_POST['cargo'];
    $nuevo_nombre = $_POST['nuevo_nombre'];
    $nuevo_cargo = $_POST['nuevo_cargo'];
    $nuevo_salario = $_POST['nuevo_salario'];

    // Validar los datos recibidos si es necesario

    // Consulta SQL para actualizar el trabajador
    $sql_update = "UPDATE chambeadores SET nombre = '$nuevo_nombre', cargo = '$nuevo_cargo', salario = '$nuevo_salario' WHERE nombre = '$nombre' AND cargo = '$cargo'";

    // Ejecutar la consulta
    if ($conn->query($sql_update) === TRUE) {
        // Éxito al editar el trabajador
        echo '<script type="text/javascript">';
        echo 'alert("El trabajador fue editado correctamente.");';
        echo 'window.location.href = "editWorker.php";';
        echo '</script>';
        exit();
    } else {
        // Error al ejecutar la consulta de actualización
        echo '<script type="text/javascript">';
        echo 'alert("Error al editar el trabajador.");';
        echo 'window.location.href = "editWorker.php";';
        echo '</script>';
        exit();
    }
} else {
    // Datos incompletos o no recibidos
    echo "<script>alert('Datos incompletos')</script>";
}

// Cerrar la conexión
$conn->close();
?>
