<?php session_start();
$numero_documento=$_POST['numero_documento'];
$contraseña=$_POST['contraseña'];

//conectar a la baase de datos

$conn=mysqli_connect("localhost","root","","login_def");

$consulta= "SELECT * FROM registrate WHERE numero_documento='$numero_documento' and contraseña='$contraseña' ";
$resultado=mysqli_query($conn, $consulta);

$num_filas=mysqli_num_rows($resultado);

if($num_filas>0){
    $filas= mysqli_fetch_row($resultado);
    $_SESSION['nombres']=$filas[2]." ".$filas[3];
    $_SESSION['num_cedula']=$numero_documento;
    $_SESSION['nombre']=$filas[2];
    $_SESSION['apellido']=$filas[3];
    $_SESSION['correo']=$filas[5];
    $_SESSION['numero_celular']=$filas[4];
    
    header("location:home.php");
}
else {
    echo "<p class='bad'>Error al iniciar sesion verifica tus datos</p>";
}

mysqli_close($conn);

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/estilo_ingresar.css">
    <title>Ingresar</title>
</head>

<body>
    <header>

            <a href="/index.php">
            <img src="img/logoEPS.png">
            </a>
            <h1>gente cuidando gente</h1>

    </header>

    <nav>
        <a href="index.php">inicio</a>
    </nav>

    <menu>
        <img src="img/mini_logo.jpg">

        <form action="validar.php" method="post">
            <h1>inicia sesion</h1>
            <h2>ingresa tu documento y contraseña</h2>

            <label>Numero de documento:</label><br>
            <input type="text" name="numero_documento" placeholder="sin puntos ni comas" required><br>
            <label>contraseña:</label><br>
            <input type="password" name="contraseña" placeholder="contraseña" required><br>

            <input class="ingresar" type="submit" name="ingresar" value="ingresar">

            <h3>¿no tiene usuario?</h3>
            <a href="registrate.php">Solicita un nuevo usuario</a>
        </form>
    </menu>

</body>

</html>