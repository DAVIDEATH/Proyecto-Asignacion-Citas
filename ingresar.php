<?php session_start();
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
            <a href="index.php">
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
            <input type="number" name="numero_documento" placeholder="sin puntos ni comas" required><br>
            <label>contraseña:</label><br>
            <input type="password" name="contraseña" placeholder="contraseña" required required minlength="8" maxlength="50"><br>

            <input class="ingresar" type="submit" name="ingresar" value="ingresar">

            <h3>¿no tiene usuario?</h3>
            <a href="registrate.php">Solicita un nuevo usuario</a>
        </form>
    </menu>

</body>

</html>