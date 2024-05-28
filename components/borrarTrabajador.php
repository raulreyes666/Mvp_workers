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
if (isset($_POST['nombre']) && isset($_POST['cargo'])) {
    $nombre = $_POST['nombre'];
    $cargo = $_POST['cargo'];

    // Validar los datos recibidos si es necesario

    // Consulta SQL para verificar si el trabajador existe
    $sql_check = "SELECT * FROM chambeadores WHERE nombre = '$nombre' AND cargo = '$cargo'";
    $result_check = $conn->query($sql_check);

    if ($result_check->num_rows > 0) {
        // El trabajador existe, proceder con la eliminación
        $sql_delete = "DELETE FROM chambeadores WHERE nombre = '$nombre' AND cargo = '$cargo'";

        // Ejecutar la consulta para eliminar el trabajador
        if ($conn->query($sql_delete) === TRUE) {
            // Éxito al borrar el trabajador
            echo '<script type="text/javascript">';
            echo 'alert("El trabajador fue eliminado.");';
            echo 'window.location.href = "deleteWorker.php";';
            echo '</script>';
            exit();
        } else {
            // Error al ejecutar la consulta de eliminación
            echo '<script type="text/javascript">';
            echo 'alert("Error al eliminar el trabajador.");';
            echo 'window.location.href = "deleteWorker.php";';
            echo '</script>';
            exit();
        }
    } else {
        // El trabajador no existe en la base de datos
        echo '<script type="text/javascript">';
        echo 'alert("El trabajador no existe en la base de datos.");';
        echo 'window.location.href = "deleteWorker.php";';
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
