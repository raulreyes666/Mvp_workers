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
    <title>Document</title>
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

<form action="borrarTrabajador.php" method="post" id="formTrabajador">
        <h1 class="title">Eliminar trabajador</h1>
        <p>Nombre <input type="text" class="data" placeholder="Ingrese el nombre" name="nombre" pattern="[a-zA-Z]+" required></p>
        <p>Cargo <input type="text" class="data" placeholder="Ingrese el cargo" name="cargo" pattern="[a-zA-Z]+" required></p>
        <input type="submit" value="Eliminar" class="btn">
        <input type="reset" value="Limpiar" class="btn" >
    </form> 




<a href="../home.php" class="urls">Volver al panel</a>

<a href="../logout.php" class="urls">
        Logout
    </a>

</body>
</html>