<?php session_start();
// conexion
include 'conexion.php';
//sentencia

$sentencia = $conn->query("SELECT * FROM cita_medica WHERE cedula_usuario='$_SESSION[num_cedula]'");
$cita_medica = $sentencia->fetchALL(PDO::FETCH_OBJ);

$conn = mysqli_connect("localhost", "root", "", "login_def");

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/estilo_eliminar_cita.css">
    <title>tus citas medicas</title>
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
        <?php echo "<h1>Todas la citas del usuario: </h1>" .$_SESSION['nombres']; ?>
    </menu>

    <table class="tabla1">
        <tr class="color">
            <td id="color">codigo de cita</td>
            <td id="color">tipo de cita</td>
            <td id="color">punto de atencion</td>
            <td id="color">cedula de usuario</td>
            <td id="color">nombres</td>
            <td id="color">apellidos</td>
            <td id="color">numero de contacto</td>
            <td id="color">fecha de la cita</td>
            <td id="color">hora de la cita</td>
            <td id="color">nombre medico</td>
        </tr>

        <?php
            foreach($cita_medica as $datos){

                ?>
                    <tr>
                        <td><?php echo $datos->id_cita?></td>
                        <?php $tipo_citas= $datos->tipo_cita;
                            $consulta4="SELECT nombre, id_especialidad FROM especialidades WHERE $tipo_citas = id_especialidad";
                            $result=mysqli_query($conn,$consulta4);
                            if(mysqli_num_rows($result)>0){
                                $fila =$result->fetch_array(MYSQLI_ASSOC);
                                //agregamos a la sesion
                                $_POST['nombre_especialidad']=$fila['nombre'];
                            }else{
                                echo "no se encontro medico";
                            }
                        ?>
                        <td><?php echo $_POST['nombre_especialidad']?></td>
                        <?php $ips= $datos->punto_atencion;
                            $consulta3="SELECT nombre_ips, nit FROM ips WHERE $ips = nit";
                            $nit_ips=mysqli_query($conn,$consulta3);
                            if(mysqli_num_rows($nit_ips)>0){
                                $fila =$nit_ips->fetch_array(MYSQLI_ASSOC);
                                //agregamos a la sesion
                                $_POST['nombre_ips']=$fila['nombre_ips'];
                            }else{
                                echo "no se encontro medico";
                            }
                        ?>
                        <td><?php echo $_POST['nombre_ips']?></td>
                        <td><?php echo $datos->cedula_usuario?></td>
                        <?php $cedula_usuario=$datos->cedula_usuario;
                            $consulta7="SELECT nombres, apellidos FROM registrate WHERE numero_documento = '$cedula_usuario'";
                            $nombre_completo=mysqli_query($conn,$consulta7);
                            if (mysqli_num_rows($nombre_completo)>0) {
                                $fila=$nombre_completo->fetch_array(MYSQLI_ASSOC);
                                //agregamos a la variable
                                $_POST['nombres']=$fila['nombres'];
                                $_POST['apellidos']=$fila['apellidos'];
                            }
                        ?>
                        <td><?php echo $_POST['nombres']?></td>
                        <td><?php echo $_POST['apellidos']?></td>
                        <td><?php echo $datos->numero_celular?></td>
                        <td><?php echo $datos->fecha_cita?></td>
                        <?php $id_horas= $datos->id_hora_cita;
                            $consulta6="SELECT hora FROM horas WHERE $id_horas = id";
                            $horas=mysqli_query($conn,$consulta6);
                            if(mysqli_num_rows($horas)>0){
                                $fila =$horas->fetch_array(MYSQLI_ASSOC);
                                //agregamos a la sesion
                                $_POST['hora']=$fila['hora'];
                            }else{
                                echo "no se encontro medico";
                            }
                        ?>
                        <td><?php echo $_POST['hora']?></td>
                        <?php $documento_medico= $datos->documento_medico;
                            $consulta2="SELECT nombres, apellidos FROM medicos WHERE $documento_medico = cedula";
                            $nombre_medico=mysqli_query($conn,$consulta2);
                            if(mysqli_num_rows($nombre_medico)>0){
                                $fila =$nombre_medico->fetch_array(MYSQLI_ASSOC);
                                //agregamos a la sesion
                                $_POST['nombre_medico']=$fila['nombres'];
                                $_POST['apellido_medicos']=$fila['apellidos'];
                            }else{
                                echo "no se encontro medico";
                            }
                        ?>
                        <td><?php echo $_POST['nombre_medico']; echo " "; echo $_POST['apellido_medicos']?>
                    </tr>
                <?php
            }
        
        ?>
        
    </table>

</body>
</html>