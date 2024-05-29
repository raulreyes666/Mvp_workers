<?php 
session_start();
error_reporting(0);

$varsesion = $_SESSION['usuario'];
if($varsesion == null || $varsesion== ''){
    header("location: index.html");
    die();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mostrar Trabajadores</title>
    <!-- Agrega el enlace al archivo CSS de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        *{
            text-align: center;
        }
        .urls{
            padding: 20px;
            color: blueviolet;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="title">Mostrar trabajadores registrados</h1>
        <a href="../home.php" class="urls">Volver al panel</a>
        <?php include('mostrar_trabajadores.php'); ?>
    </div>

    <!-- Agrega el script de Bootstrap (opcional, solo si lo necesitas para funcionalidades específicas de Bootstrap) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
