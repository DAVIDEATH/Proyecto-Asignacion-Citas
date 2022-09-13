<?php session_start();

//conectar a la baase de datos

$conn = mysqli_connect("localhost", "root", "", "login_def");

//variables
$tipo_documento =$_POST['select'];
$numero_documento = $_POST['numero_documento'];
$nombres = $_POST['nombres'];
$apellidos = $_POST['Apellidos'];
$celular = $_POST['celular'];
$correo = $_POST['email'];
$contraseña = $_POST['contraseña'];

//consulta
$consulta ="INSERT INTO registrate (id_documento, numero_documento, nombres, apellidos, celular, correo, contraseña, confirmar_contraseña) VALUES ('$tipo_documento', '$numero_documento', '$nombres', '$apellidos', '$celular', '$correo', '$contraseña', '$contraseña');";

$result=mysqli_query($conn, $consulta);

mysqli_close($conn);
$_SESSION['nombre']=$nombres;
$_SESSION['numero_celular']=$celular;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="css/estilo_registrardb.css">
    <title>Usuario registrado</title>
</head>
<body>
    <header>

    <a href="/index.php">
    <img src="img/logoEPS.png">
    </a>
    <h1>gente cuidando gente</h1>

    </header>

    <nav>
    <h1>¡Se ha registrado correctamente!</h1>
    </nav>

    <menu>
    <h1>¡Bienvenido a la Nueva EPS!</h1>
    <div class="datos">
        <h2>Su usuario es: <?php echo $numero_documento ?></h2>
        <h2>Recuerde siempre su contraseña</h2>
    </div>
    <h2>para asigar citas inicia sesion con el boton <b>INGRESAR</b></h2>

    <img class="eva" src="img/EVA.png">

    <a class="boton_regreso" href="ingresar.php">INGRESAR</a>

    </menu>
</body>
</html>
