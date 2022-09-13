<?php session_start(); 
$usuario = $_SESSION['nombres'];
if(!isset($usuario)) {
    header("location:index.php");
}else{
    
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/estilos_home.css">
    <title>home</title>
</head>
<body>
    <header>
        <img src="img/logoEPS.png">
        <h1>Gente cuidando gente</h1>

    </header>
    <div class="todo_menu">
    <nav>
        <a href="cerrar_sesion.php">cerrar sesion</a>
    </nav>

    <div class="bienvenido">    
        <?php echo "<h2>bienvenido:<br></h2> ".$_SESSION['nombres']; ?>
    </div>

    <menu>
        <h1>Elija la Opcion Deseada</h1>
        <div class="opciones">
            <a class="asignar_cita" href="asignar_cita.php">Asignar Cita</a>

            <a class="cita" href="citas.php">Todas tus Citas</a>

        </div>

        <div class="todos_datos">
            <a class="editar_cita" href="eliminar_cita.php">Cancelar Citas</a>

            <a class="acdatos" href="actualizar_datos.php">Actualizar Datos</a>
        </div>
        
    </menu>
</div>
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
                <a href="enviar_pqr.php">envia un PQR</a>
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