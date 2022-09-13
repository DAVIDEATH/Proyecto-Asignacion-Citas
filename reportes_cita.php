<?php
//ingresamos toda la pagina a una variable con el codigo de abajo
ob_start();
?>

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

<html lang="eS">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/estilo_reportes.css">
    <title>Cita Asignada</title>
</head>
<body>
<?php

$hora_cita=$_SESSION['hora_cita'];
$fecha_cita=$_SESSION['fecha_cita'];
$medico=$_SESSION['medico'];
$tipo_cita=$_SESSION['tipo_cita'];
$ips=$_SESSION['ips'];
$documento_usuario=$_SESSION['num_cedula'];
$numero_contacto=$_SESSION['numero_contacto'];


$last_id=mysqli_insert_id($conn);
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

<div style="    border: 1px solid black;
    width: 720px;
    height: 900px;
    border-radius: 15px;
    padding: 10px;
    background-color: #EDEDED;
    margin:10px auto ;
    font-size: 25px;" class="text_inf_cita">
    <h1 style="font-size: 40px; text-align: center;">Datos de la cita</h1>
    <p style="font-size: 27px;">Tu cita es de: <b><?php echo $_POST['especialidad']?></b> en la ips: <b><?php  echo $_POST['nombre_ips']?></b> con el medico: <b><?php echo $_POST['nombre_completo_medico']?></b> la cita esta asignada para el usuario: <b><?php echo $_POST['nombre_completo_usuario']?></b> con el numero de documento: <b><?php echo $documento_usuario?></b>.<br><br> recuerda tu cita es el dia: <b><?php echo $fecha_cita?></b> a la hora: <b><?php echo$_POST['hora'] ?></b> el codigo de tu cita es: <b><?php echo $_SESSION['id_cita']?></p></b><br> 
    <img style="margin-left: 250px;" src="http://<?php echo $_SERVER['HTTP_HOST'];?>/login_def-copia/img/mini_logo.jpg" height="200"><br>
    
    <div class="recomendacion">
            <h2 style="font-size: 40px; text-align: center;">Recuerda:</h2>
            <ul>
                <li style="font-size: 25px ;">1.Tener a la mano el documento</li>
                <li style="font-size: 25px ;">2.Llegar 20 minutos antes de la cita asignada</li>
                <li style="font-size: 25px ;">3.Recuerda llevar el valor de la cita</li>
                <li style="font-size: 25px ;">4.Recuerda llevar los resultados de los examenes realizados</li>
            </ul>
        </div>
</div>
</body>
</html>
<?php 
    //integramos la pagina a una variable
    $html=ob_get_clean();
    //se ha guardado toda la pagina en una variable $html

    //requerimos la libreria de dompdf
    require_once "libreria_pdf/autoload.inc.php";
    use Dompdf\Dompdf;
    $dompdf= new Dompdf();
    //mostrar imgaenes al pdf
    $options=$dompdf->getOptions();
    $options->set(array('isRemoteEnabled'=> true));
    $dompdf->setOptions($options);

    $dompdf->loadHtml($html);
    $dompdf->setPaper('letter');
    
    $dompdf->render();

    $dompdf->stream("Cita_Asignada.pdf", array("Attachment"=> true));
?>
