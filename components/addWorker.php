<?php
session_start();
error_reporting(0);

$varsesion = $_SESSION['usuario'];
if ($varsesion == null || $varsesion == '') {
    header("location: index.html");
    die();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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

    // Obtener los datos del formulario
    $nombre = $_POST['nombre'];
    $cargo = $_POST['cargo'];
    $salario = $_POST['salario'];

    // Validar que solo se ingresen letras en el nombre y cargo
    if (!preg_match("/^[a-zA-Z]+$/", $nombre) || !preg_match("/^[a-zA-Z]+$/", $cargo)) {
        echo "Error: El nombre y el cargo solo deben contener letras.";
        exit();
    }

    // Verificar si ya existe un registro con el mismo nombre y cargo
    $sql_check = "SELECT * FROM chambeadores WHERE nombre = '$nombre' AND cargo = '$cargo'";
    $result_check = $conn->query($sql_check);

    if ($result_check->num_rows > 0) {
        echo '<script type="text/javascript">';
        echo 'alert("El trabajador ya existe.");';
        echo 'window.location.href = "addWorker.php";';
        echo '</script>';
        exit();
    }

    // Preparar la consulta para evitar inyección SQL
    $stmt = $conn->prepare("INSERT INTO chambeadores (nombre, cargo, salario) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nombre, $cargo, $salario);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo "<script>alert('Registro insertado correctamente.')</script>";
    } else {
        echo "Error al insertar el registro: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar trabajador</title>
    <style>
        * {
            text-align: center;
            
        }
        form {
            padding: 50px 50px;
            
            margin: calc(25% + 100px);
            margin-top: 70px;
            padding-top: 28px;
            margin-bottom: 30px;
            background-color: rgb(125, 217, 173) ;
        }
        .data {
            width: calc(100% - 20px);
        }

        .urls{
            padding: 20px;
            color: blueviolet;

        }
    </style>
</head>
<body>
    <form  method="post" id="formTrabajador">
        <h1 class="title">Agregar trabajadores</h1>
        <p>Nombre <input type="text" class="data" placeholder="Ingrese el nombre" name="nombre" pattern="[a-zA-Z]+" required></p>
        <p>Cargo <input type="text" class="data" placeholder="Ingrese el cargo" name="cargo" pattern="[a-zA-Z]+" required></p>
        <p>Salario <input type="number" class="data" placeholder="Ingrese el salario" name="salario" required></p>
        <input type="submit" value="Agregar" class="btn">
        <input type="reset" value="Borrar" class="btn" >
    </form> 
    <a href="../home.php" class="urls">Volver al panel</a>

    <a href="../logout.php" class="urls">Logout</a>


    <script>
        function limpiarCampos() {
            document.getElementById("formTrabajador").reset();
        }
    </script>
</body>
</html>
