<?php session_start();
    $conn = mysqli_connect("localhost", "root", "", "login_def");
$usuario = $_SESSION['nombres'];
if(!isset($usuario)) {
    header("location:index.php");
}else{
    
}
?>


<?php
    if(isset($_POST['buscar'])){
    //variables
    $tipo_cita=$_POST['select1'];
    $ips=$_POST['select2'];
    $cedula=$_SESSION['num_cedula'];
    $nombre=$_SESSION['nombre'];
    $apellido=$_SESSION['apellido'];
    $numero_contacto=$_POST['contacto2'];
    $fecha_actual=date("y-m-d");
    $fecha = date("Y-m-d", strtotime($fecha_actual. "+1 day"));
    $_SESSION['fecha']=$fecha;

    $consulta4="SELECT nombre_ips FROM ips WHERE $ips= nit";
    $nombre_ips=mysqli_query($conn,$consulta4);
    if(mysqli_num_rows($nombre_ips)>0){
        $fila = $nombre_ips->fetch_array(MYSQLI_ASSOC);
        //asignamos a la sesion 
        $_SESSION['nombre_ips']= $fila['nombre_ips'];
    }else{
        echo "no hay ips";
    }

    $consulta5="SELECT nombre FROM especialidades WHERE $tipo_cita = id_especialidad";
    $nombre_tipo_cita=mysqli_query($conn,$consulta5);
    if(mysqli_num_rows($nombre_tipo_cita)>0){
        $fila2 =$nombre_tipo_cita->fetch_array(MYSQLI_ASSOC);
        //asignamos a la sesion
        $_SESSION['nombre_tipo_cita']= $fila2['nombre'];
    }else{
        echo "no hay tipos de citas";
    }
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

    <article>
    <?php
    if(isset($_POST['enviar'])){
        //creamos variables
        $tipo_cita=$_POST['select01'];
        $ips=$_POST['select02'];
        $numero_documento=$_POST['numero_documento'];
        $nombres=$_POST['nombres'];
        $apellidos=$_POST['apellidos'];
        $contacto=$_POST['contacto2'];
        $medico=$_POST['select3'];
        $fecha_cita=$_POST['fecha_cita'];
        $hora_cita=$_POST['select4'];
        //consulta
        $consulta="SELECT * FROM cita_medica WHERE fecha_cita = '$fecha_cita' AND id_hora_cita = '$hora_cita' ";
        $resultado=mysqli_query($conn, $consulta);
        $num_filas=mysqli_num_rows($resultado);
        if($num_filas>0){
        ?>
        <h3>Lo sentimos ya existe una cita<br>porfavor selecciona otra hora o fecha</h3>
        <?php
        }else{
            $_SESSION['tipo_cita']=$tipo_cita;
            $_SESSION['ips']=$ips;
            $_SESSION['fecha_cita']=$fecha_cita;
            $_SESSION['hora_cita']=$hora_cita;
            $_SESSION['numero_contacto']=$_POST['contacto2'];
            $_SESSION['medico']=$_POST['select3'];
            header("location:cita_asignada.php");
        }
    }

?>
    </article>

    <form method="POST">

        <h1>Verifica o Digita los datos </h1>

        <label>Tipo de cita:</label>
        <select id="cursor" name="select01" readonly>

            <option name="select01" readonly value="<?php echo $tipo_cita ?>"><?php echo $_SESSION['nombre_tipo_cita'] ?></option>
                
        </select>

        <label> Punto de atencion IPS: </label>
        <select id="cursor" name="select02" readonly>
                <option name="select02" value="<?php echo $ips ?>"><?php echo $_SESSION['nombre_ips'] ?></option>
        </select>

        <label>Numero documento:</label>
        <input name="numero_documento" readonly type="tel" value="<?php echo $_SESSION['num_cedula'] ?>">

        <label>Nombres:</label>
        <input name="nombres" readonly type="text" value="<?php echo $_SESSION['nombre'] ?>">

        <label>Apellidos:</label>
        <input name="apellidos" readonly type="text" value="<?php echo $_SESSION['apellido'] ?>">

        <label>Numero de contacto:</label>
        <input name="contacto2" type="number" minlength="10" maxlength="10" required value="<?php echo $_POST['contacto2'] ?>">

        <label>selecciona medico:</label>
        <select id="cursor" name="select3" required> 
            <?php 
                //conexion base de datos
                $conn = mysqli_connect("localhost", "root", "", "login_def");
                //consulta
                $consulta2 ="SELECT cedula, nombres, apellidos FROM medicos WHERE nit_ips = $ips and fkid_especialidad=$tipo_cita and disponibilidad = 'si'";
                $ejecutar2 = mysqli_query($conn,$consulta2);
            ?>
            <!--resultado-->
            <?php foreach($ejecutar2 as $opciones3) :?>
                <option name="select3" value="<?php echo $opciones3['cedula']?>"><?php echo $opciones3['nombres']; echo " "; echo $opciones3 ['apellidos'] ?></option>
                <?php endforeach ?>
            

        </select>

        <label for="fecha_cita"> Fecha de cita </label>
        <input id="cursor" name="fecha_cita" type="date" required value="" min="<?php echo $_SESSION['fecha'];?>">
            <label>selecciona la hora</label>
            <select id="cursor" name="select4">
            <?php
            //consulta
            $sql="SELECT * FROM horas";
            $result=mysqli_query($conn, $sql);
            ?>
            <!--resultado-->
            <?php foreach($result as $opciones4):?>
                <option name="select4" value="<?php echo $opciones4['id'];?>"><?php echo $opciones4['hora'];?></option>
            <?php endforeach;?>
            </select>

        <div class="recomendacion">
            <h2>recuerda:</h2>
            <ul>
                <li>1.Tener a la mano el documento</li>
                <li>2.Llegar 20 minutos antes de la cita asignada</li>
                <li>3.Recuerda llevar el valor de la cita</li>
                <li>4.Recuerda llevar los resultados de los examenes realizados</li>
            </ul>
        </div><br>

        <input class="enviar" type="submit" name="enviar" value="enviar">
        
    </form>


    
</body>
</html>