<?php
include('db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'];
    $pswd = $_POST['contraseña'];

    // Validar solo letras y números
    if (!preg_match('/^[a-zA-Z0-9]+$/', $usuario) || !preg_match('/^[a-zA-Z0-9]+$/', $pswd)) {
        // Si los datos no son válidos, redirigir de vuelta al formulario de registro
        header("location: register.html");
        exit();
    }

    $conexion = mysqli_connect("localhost", "root", "", "pruebainject");

    if (!$conexion) {
        die("Error de conexión: " . mysqli_connect_error());
    }

    // Verificar si el usuario ya existe en la base de datos
    $consulta = "SELECT * FROM usuarios WHERE nombre = '$usuario'";
    $resultado = mysqli_query($conexion, $consulta);

    if (mysqli_num_rows($resultado) > 0) {
        echo "<br>El usuario ya existe. Por favor, elige otro nombre de usuario.";
    } else {
        // Hash de la contraseña
        $hashed_pswd = password_hash($pswd, PASSWORD_DEFAULT);

        // Insertar el usuario en la base de datos
        if ($stmt = $conexion->prepare("INSERT INTO usuarios (nombre, pswd) VALUES (?, ?)")) {
            $stmt->bind_param("ss", $usuario, $hashed_pswd);
            $stmt->execute();
            $stmt->close();

            header("location: index.html");
            exit();
        } else {
            echo "Error al preparar la consulta: " . $conexion->error;
        }
    }

    mysqli_close($conexion);
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro trabajadores</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css">

 
<style>
    * {
	padding: 0;
	margin: 0;
	font-family: century gothic;
	text-align: center;
}

body{
	background-image: url('imgs/bg.jpg');
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center;
    
}
form {
	padding: 50px 20px;
	background-color: #381b1ba6;
	margin: calc(25% + 100px);
	margin-top: 70px;
	padding-top: 28px;
	margin-bottom: 30px
}

.title {
	text-align: center;
	padding: 25px;
	color: rgb(206, 203, 203)
}



input {
	width: calc(100% - 20px);
	padding: 9px;
	margin: auto;
	margin-top: 12px;
	font-size: 16px
}
p{
	margin: 20px;
}
.btn{
	width: 25%;
}



body{
	background-color: rgb(79, 27, 202);

	color:white;
	
}


header{
    width: 100%;
    color: #fff;
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    align-content: space-between;
    background-color: rgba(0, 0, 0,.3);
}


.link{
color: red;
}
</style>
    </style>
</head>
<body>
   <form action="register.php" method="post">
       <h1 class="title">Registro de Usuario</h1>
       <p style="color: #ffffff"><b>*Ingresa solo letras y numeros, no uses espacios.*</b></p>

       <p>Usuario <input type="text" placeholder="Ingrese su nombre" name="usuario" pattern="[a-zA-Z0-9]+" required></p>
       <p>Contraseña <input type="password" placeholder="Ingrese su contraseña" name="contraseña" pattern="[a-zA-Z0-9]+" required></p>
       <input type="submit" value="Registrar" class="btn">
       <input type="reset" class="btn" value="Limpiar">
       <p>Ya tienes cuenta? <a href="index.html" class="link">Login</a></p>
   </form> 
</body>
</html>
