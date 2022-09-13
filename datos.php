<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/estilos_registrate.css">
    <title>Registrate Nueva EPS</title>
</head>
<body>
    <header>
        <img src="img/logoEPS.png">
        <h1>gente cuidando gente</h1>

    </header>  

    <nav>
    <a href="index.php">inicio</a>
    </nav>

    <menu>
        <form action="registrardb.php" method="POST">
            <h1>Solicita tu Usuario</h1>
            <h2>Ingresa los siguientes datos</h2>

            <div class="formularios">
                    <label>Seleciona tu Documento</label>
                    <select class="select" name="select" require>

                        <?php 
                            $conn=mysqli_connect("localhost","root","","login_def");

                            $consulta="SELECT * FROM tipo_documento";
                            $ejecutar=mysqli_query($conn,$consulta);

                        ?>

                        <?php foreach ($ejecutar as $opciones): ?>

                            <option value="<?php echo $opciones['documento']?>"><?php echo $opciones['documento']?></option>

                        <?php endforeach ?>
                        
                    </select><br>
                    <label>Numero de Documento:</label>
                    <input type="text" name="numero_documento" placeholder="sin puntos ni comas" require><br>

                    <label>Primer Nombre:</label>
                    <input type="text" name="primer_nombre" placeholder="primer nombre" require><br>
                    <label>Segundo Nombre:</label>
                    <input type="text" name="segundo_nombre" placeholder="segundo nombre"><br>

                    <label>Primer Apellido:</label>
                    <input type="text" name="primer_apellido" placeholder="primer apellido" require><br>
                    <label>Segundo Apellido:</label>
                    <input type="text" name="segundo_apellido" placeholder="segundo apellido"><br>

                    <label>Fecha de Nacimiento:</label>
                    <input type="date" name="fecha_nacimiento" require><br>

                    <label>Direccion:</label>
                    <input type="text" name="direccion" placeholder="direccion" require><br>

                    <label>Telefono Movil:</label>
                    <input type="tel" name="telefono_movil" placeholder="telefono movil"><br>
                    <label>Telefono Fijo:</label>
                    <input type="tel" name="telefono_fijo" placeholder="telefono fijo"><br>
                    <label>Telefono Oficina:</label>
                    <input type="tel" name="telefono_oficina" placeholder="telefono oficina"><br>

                    <div class="articulo_importante">
                        <h2>IMPORTANTE:<h2>
                        <h3>Para garantizar el envío de su usuario y clave al correo electrónico confirme:<h3>
                    </div>

                    <label>Correo:</label>
                    <input type="email" name="email" placeholder="correo"><br>
                    <label>Confirmar correo:</label>
                    <input type="email" name="confirmar_email" placeholder="confirmar correo"><br>
                    <label>Contraseña:</label>
                    <input type="password" name="contraseña" placeholder="contraseña"><br>
                    <label>Confirmar contraseña:</label>
                    <input type="password" name="confirmar_contraseña" placeholder="confirmar contraseña"><br>
            </div>

            <input class="enviar" type="submit" name="enviar" value="enviar"> 
        </form>
    </menu>

    <footer class="pie">
        <ul class="lineas_de_atencion">
            <h2 class="titulo-segundario">Lineas De Atencion</h2>
                    <b>En Bogota:</b><br>
                    - (60)1 307 7022<br>
                    <b>Linea Gratuita Nacional:</b><br>
                    - 01 8000 954400<br>
                    <b>Regimen Subsidiario:</b><br>
                    - 01 8000 952000<br>
        </ul>

        <ul class="Oficinas_Administrativas">
                <h2 class="titulo-segundario">Oficinas Administrativas</h2>
                <b>Dirección Nacional:</b><br>
                - Carrera 85K No. 46A-66<br>
                <b>Bogotá D.C.<br></b>
                <b>Teléfono administrativo:</b><br>
                - (60)1 419 3000<br>
        </ul>

        <ul class="redes_sociales">
            <h2 class="titulo-segundario">Redes Sociales</h2>
            <a href="https://www.youtube.com/user/SomosNuevaEps">Youtube</a>
            <a href="https://twitter.com/gcuidandogente">twitter</a>
            <a href="https://www.instagram.com/gentecuidandogente">instagram</a>
        </ul>

    </footer>
</body>
</html>