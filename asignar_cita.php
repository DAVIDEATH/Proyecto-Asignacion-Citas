<?php session_start();
require_once "conexion.php";
$usuario = $_SESSION['nombres'];
if(!isset($usuario)) {
    header("location:index.php");
}else{
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=d, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/estiloz_asignar_cita.css">
    <title>Asignacion de citas</title>
</head> 
<body>
    <header>
        <img src="img/logoEPS.png">
        <h1>Gente cuidando gente</h1>

    </header>

    <nav>
        <a href="home.php">volver</a>
    </nav>

    <menu>
        <?php echo "<h2>Asignar cita para el usuario: </h2>" .$_SESSION['nombres']; ?>
    </menu>

    <form  action="datos_medico.php" method="POST">
        <h1>Verifica o Digita los datos </h1>

        <label>Tipo de cita:</label>
        <select id="cursor" name="select1">
            <?php 
                //conexion
                $conn = mysqli_connect("localhost", "root", "", "login_def");
                //consulta
                $consulta ="SELECT id_especialidad, nombre FROM especialidades";
                $ejecutar =mysqli_query($conn,$consulta);
            ?>
                <!-- resultado -->
                <?php foreach($ejecutar as $opciones1) : ?>
                    <option name="select1" value="<?php echo $opciones1['id_especialidad'] ?>"><?php echo $opciones1['nombre'] ?></option>
                <?php endforeach ?>
                
        </select>

        <label> Punto de atencion IPS: </label>
        <select id="cursor" name="select2">
            <?php
                //conexion base de datos
                $conn = mysqli_connect("localhost", "root", "", "login_def");
                //consulta
                $consulta ="SELECT nit, nombre_ips FROM ips";
                $ejecutar = mysqli_query($conn, $consulta);
            ?>
                <!--resultado-->
            <?php foreach($ejecutar as $opciones2) : ?>
                <option name="select2" value="<?php echo $opciones2['nit'] ?>"><?php echo $opciones2['nombre_ips'] ?></option>
            <?php endforeach ?>
        </select>
        
        <label>Cedula:</label>
        <input readonly type="tel" value="<?php echo $_SESSION['num_cedula'] ?>">

        <label>Nombres:</label>
        <input readonly type="text" value="<?php echo $_SESSION['nombre'] ?>">

        <label>Apellidos:</label>
        <input readonly type="text" value="<?php echo $_SESSION['apellido'] ?>">

        <label>Numero de contacto:</label>
        <input name="contacto2" type="number" minlength="10" maxlength="10" required value="<?php echo $_SESSION['numero_celular']?>">
        <input id="cursor" name="buscar" type="submit" value="Buscar">
    </form>


</body>
</html>
