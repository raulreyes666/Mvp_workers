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

// Consulta SQL para obtener los trabajadores
$sql = "SELECT nombre, cargo, salario FROM chambeadores";
$result = $conn->query($sql);

// Verificar si se encontraron resultados
if ($result->num_rows > 0) {
    // Crear la tabla HTML
    echo "<table class='table table-bordered'>
            <tr class='table-success'>
                <th>Nombre</th>
                <th>Cargo</th>
                <th>Salario</th>
            </tr>";

    // Mostrar los datos en la tabla
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["nombre"] . "</td>
                <td>" . $row["cargo"] . "</td>
                <td>" . $row["salario"] . "</td>
            </tr>";
    }

    echo "</table>";
} else {
    echo "<br><br>No se encontraron trabajadores.";
}

// Cerrar la conexión
$conn->close();
?>
