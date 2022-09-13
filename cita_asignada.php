<?php

use function PHPSTORM_META\map;

 session_start();
include_once "conexion.php";
    $conn = mysqli_connect("localhost", "root", "", "login_def");
$usuario = $_SESSION['nombres'];
if(!isset($usuario)) {
    header("location:index.php");
}else{
    
}
?>

<?php 
    $hora_cita=$_SESSION['hora_cita'];
    $fecha_cita=$_SESSION['fecha_cita'];
    $medico=$_SESSION['medico'];
    $tipo_cita=$_SESSION['tipo_cita'];
    $ips=$_SESSION['ips'];
    $documento_usuario=$_SESSION['num_cedula'];
    $numero_contacto=$_SESSION['numero_contacto'];
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/estilo_cita_Asignada.css">
    <title>Cita asignada</title>
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
    <?php echo "<h2>Cita asignada para el usuario: </h2>" .$_SESSION['nombres']; ?>
    
</menu>

<article>
    <?php
        $fecha = date("Y-m-d");
        //consulta
        $consulta="SELECT * FROM cita_medica WHERE fecha_cita = '$fecha_cita' AND id_hora_cita = '$hora_cita' ";
        $resultado=mysqli_query($conn, $consulta);
        $num_filas=mysqli_num_rows($resultado);
        if($num_filas>0){

        }else{
            
            $sql="INSERT INTO cita_medica (tipo_cita,punto_atencion,cedula_usuario,numero_celular,fecha_cita,id_hora_cita,documento_medico) VALUES('$tipo_cita','$ips','$documento_usuario','$numero_contacto','$fecha_cita','$hora_cita','$medico')";
            $result=mysqli_query($conn, $sql);
        ?>

        <h3>Tu cita fue asignada<br>Verifica los datos</h3>
        
    <?php
        }
    ?>
</article>

<article>
    <?php 
    $last_id=mysqli_insert_id($conn);
    $_SESSION['id_cita']=$last_id;
    //consulta
    $sql2="SELECT nombre FROM especialidades WHERE id_especialidad = '$tipo_cita'";
    $resultado2=mysqli_query($conn, $sql2);
    if(mysqli_num_rows($resultado2)>0){
        $fila =$resultado2->fetch_array(MYSQLI_ASSOC);
        //agregamos a variables
        $_POST['especialidad']=$fila['nombre'];
    }else{
        echo "no se encontro la especialidad";
    }

    $sql3="SELECT nombre_ips FROM ips WHERE nit='$ips'";
    $resultado3=mysqli_query($conn, $sql3);
    if(mysqli_num_rows($resultado3)>0){
        $fila3 =$resultado3->fetch_array(MYSQLI_ASSOC);
        //agregamos a la variable
        $_POST['nombre_ips']=$fila3['nombre_ips'];
    }else{
        echo "no se encontro IPS";
    }

    $sql4="SELECT nombres, apellidos FROM medicos WHERE cedula='$medico'";
    $resultado4=mysqli_query($conn, $sql4);
    if(mysqli_num_rows($resultado4)>0){
        $fila4 =$resultado4->fetch_array(MYSQLI_ASSOC);
        //agregamos a la variable
        $_POST['nombre_medico']=$fila4['nombres'];
        $_POST['apellido_medico']=$fila4['apellidos'];
        $_POST['nombre_completo_medico']=$fila4['nombres'].' '.$fila4['apellidos'];
    }

    $sql5="SELECT nombres, apellidos FROM registrate WHERE numero_documento = '$documento_usuario'";
    $resultado5=mysqli_query($conn, $sql5);
    if(mysqli_num_rows($resultado5)>0){
        $fila5 =$resultado5->fetch_array(MYSQLI_ASSOC);
        //agregamos a variables;
        $_POST['nombre_completo_usuario']=$fila5['nombres'].' '.$fila5['apellidos'];
    }

    $sql6="SELECT hora FROM horas WHERE id ='$hora_cita'";
    $resultado6=mysqli_query($conn, $sql6);
    if(mysqli_num_rows($resultado6)>0){
        $fila6 =$resultado6->fetch_array(MYSQLI_ASSOC);
        //creamos variables
        $_POST['hora']=$fila6['hora'];
    }
    ?>

<div class="text_inf_cita">
    <p><h2>Datos de la cita</h2>
    Tu cita es de: <b><?php echo $_POST['especialidad']?></b> en la ips: <b><?php  echo $_POST['nombre_ips']?></b> con el medico: <b><?php echo $_POST['nombre_completo_medico']?></b> la cita esta asignada para el usuario: <b><?php echo $_POST['nombre_completo_usuario']?></b> con el numero de documento: <b><?php echo $documento_usuario?></b>.<br><br> recuerda tu cita es el dia: <b><?php echo $fecha_cita?></b> a la hora: <b><?php echo$_POST['hora'] ?></b> el codigo de tu cita es: <b><?php echo $last_id?></b><br><br> </p>
    <img src="img/EVA.png"><br>
    <a class="gen_pdf" href="reportes_cita.php">Genera un pdf</a><br><br>
    <a href="home.php">Volver</a>

    <div class="recomendacion">
            <h2>recuerda:</h2>
            <ul>
                <li>1.Tener a la mano el documento</li>
                <li>2.Llegar 20 minutos antes de la cita asignada</li>
                <li>3.Recuerda llevar el valor de la cita</li>
                <li>4.Recuerda llevar los resultados de los examenes realizados</li>
            </ul>
        </div>
</div>

</article>


</body>
</html>