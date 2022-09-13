<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/estilos_registrate.css">
    <title>Nueva EPS</title>
</head>

<body>
    <header>
        <img src="img/logoEPS.png">
        <h1>Gente cuidando gente</h1>

    </header>

    <nav>
        <a href="index.php">inicio</a>
    </nav>

    <menu>
        <form action="registrardb.php" method="POST">
            <h1>Solicita tu Usuario</h1>
            <h2>Ingresa los siguientes datos</h2>

            <div class="formularios">
                <label>Tipo de Documento:</label>
                <select class="select" name="select" required>

                    <?php
                    //conexion
                    $conn = mysqli_connect("localhost", "root", "", "login_def");
                    //consulta
                    $consulta = "SELECT id, documento FROM tipo_documento ";
                    $ejecutar = mysqli_query($conn, $consulta);

                    ?>
                    <!-- resultado -->
                    <?php foreach ($ejecutar as $opciones) : ?>

                        <option name="select" value="<?php echo $opciones['id'] ?>"><?php echo $opciones['documento'] ?></option>

                    <?php endforeach ?>

                </select><br>
                <label>Numero de Documento:</label>
                <input type="number" name="numero_documento" placeholder="sin puntos ni comas" required><br>

                <label>Nombres:</label>
                <input type="text" name="nombres" placeholder="Nombres" required><br>

                <label>Apellidos:</label>
                <input type="text" name="Apellidos" placeholder="Apellidos" required><br>


                <label>Celular o telefono:</label>
                <input type="number" name="celular" placeholder="telefono " minlength="10" maxlength="10"><br>

                <div class="articulo_importante">
                    <h2>IMPORTANTE:<h2>
                            <h3>Para garantizar el envío de su usuario y clave al correo electrónico digita:<h3>
                </div>

                <label>Correo:</label>
                <input type="email" name="email" placeholder="correo" max="200"><br>
                <label>Contraseña:</label>
                <input type="password" name="contraseña" placeholder="contraseña" required minlength="8" maxlength="50"><br>
            </div>

            <input class="enviar" type="submit" name="enviar" value="enviar">
        </form>
    </menu>


</body>

</html>