<?php


include('db.php');

$usuario = $_POST['usuario'];
$pswd = $_POST['contraseña']; // Contraseña en texto plano

session_start();
$_SESSION['usuario'] = $usuario;

$conexion = mysqli_connect("localhost", "root", "", "pruebainject");

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Preparar la consulta SQL para obtener el hash de la contraseña del usuario
$consulta = "SELECT pswd FROM usuarios WHERE nombre='$usuario'";
$resultado = mysqli_query($conexion, $consulta);

if ($resultado) {
    $fila = mysqli_fetch_assoc($resultado);
    $hashed_pswd = $fila['pswd'];

    // Verificar la contraseña ingresada con el hash almacenado
    if (password_verify($pswd, $hashed_pswd)) {
        header("location: home.php");
        exit;
    }
}

header("location: index.html");
exit;
?>