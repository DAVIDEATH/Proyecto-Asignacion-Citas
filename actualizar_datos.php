<?php session_start();
$usuario = $_SESSION['nombres'];
if(!isset($usuario)) {
    header("location:index.php");
}else{
    
}
function eliminar_caracteres($eliminar_Caracteres)
{
    $res = preg_replace('/[0-9\@\.\;\" "]+/', '', $eliminar_Caracteres);
    return $res;
}

$conn = mysqli_connect("localhost", "root", "", "login_def");
//creamos variables
$_SESSION['nombre'];
$_SESSION['apellido'];
$_SESSION['numero_celular'];

if(isset($_POST['enviar'])){

    //creamos variabes
    $nombre_nuevo=$_POST['cambiar_nombres'];
    $apellidos_nuevos=$_POST['cambiar_apellidos'];
    $celular_nuevo=$_POST['cambiar_celular'];
    $numero_documento=$_SESSION['num_cedula'];
    //consulta
    $query= $conn->prepare("UPDATE registrate SET nombres=?, apellidos=?, celular=? WHERE numero_documento = $numero_documento");
    $resultado= $query->execute([$nombre_nuevo,$apellidos_nuevos,$celular_nuevo]);
}elseif(isset($_POST['enviar'], $resultado) ==true){
    echo "se han cambiado los datos";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=d, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/estilos_actualizar_datos.css">
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
        <?php echo "<h2>Actualizar Datos para el usuario: </h2>" .$_SESSION['nombres']; ?>
    </menu>

    <h2>puedes cambiar solo una o todas las que necesites</h2>
    <article>
        <h4><center>Si no se cambia el correo o contraseña cierra sesion para guardar cambios</center></h4>
    </article>
    <article>
        <form class="cambiar_datos_basicos" action="actualizar_datos.php" method="POST">
            <h3>cambiar datos personales</h3><br>
            <label>cambiar nombres</label><br>
            <input type="text" name="cambiar_nombres" value="<?php echo $_SESSION['nombre'];?>" required><br>
            <label>cambiar apellidos</label> <br>
            <input type="text" name="cambiar_apellidos" value="<?php echo $_SESSION['apellido'];?>" required><br>
            <label>cambiar Numero celular</label><br>
            <input type="number" name="cambiar_celular" value="<?php echo $_SESSION['numero_celular'];?>" required><br>
            <input id="cursor" type="submit" name="enviar" value="cambiar"><br>
        </form>

        <form class="cambiar_datos_privados" action="actualizar_datos.php" method="POST">
            <h3>cambiar datos privados</h3><br>
            <label>cambiar correo electronico</label><br>
            <input type="email" name="cambiar_email"  value=""><br>
            <p>Para cambiar contraseña digita estos datos</p>
            <label>digita tu contraseña anterior</label><br>
            <input type="password" name="anterior_contraseña" minlength="8" maxlength="50"><br>
            <label>digita tu contraseña nueva</label><br>
            <input type="password" name="nueva_contraseña" minlength="8" maxlength="50"><br>
            <input id="cursor" type="submit" name="enviar2" value="cambiar"> <br>
        </form>
    </article>

    <article>
    
    <?php
    if(isset($_POST['enviar'])){

        //creamos variabes
        $nombre_nuevo=$_POST['cambiar_nombres'];
        $apellidos_nuevos=$_POST['cambiar_apellidos'];
        $celular_nuevo=$_POST['cambiar_celular'];
        $numero_documento=$_SESSION['num_cedula'];  
        //consulta
        $query= $conn->prepare("UPDATE registrate SET nombres=?, apellidos=?, celular=? WHERE numero_documento = $numero_documento");
        $resultado= $query->execute([$nombre_nuevo,$apellidos_nuevos,$celular_nuevo]);
        echo "<b>se ha cambiado los datos</b>";
    }

    

    if(isset($_POST['enviar2'])){
    //creamos variables
    $cambiar_email=$_POST['cambiar_email'];
    $contraseña_anterior=$_POST['anterior_contraseña'];
    $nueva_contraseña=$_POST['nueva_contraseña'];
    $numero_documento=$_SESSION['num_cedula'];
    if(empty($cambiar_email) and empty($contraseña_anterior) and empty($nueva_contraseña)){
        echo "<b>digita los datos que quieres cambiar</b>";
    }else{

    };

    if(empty($cambiar_email)){

    }else{
        if($cambiar_email === $_SESSION['correo']){
            echo "<b> Tu ya tienes este correo si quieres cambia el correo</b>";
    }else{
        if(empty($contraseña_anterior and empty($nueva_contraseña) and !empty($cambiar_email))){
            $query2=$conn->prepare("UPDATE registrate SET correo=? WHERE numero_documento = $numero_documento");
            $result=$query2->execute([$cambiar_email]); 
            echo "<b>se ha cambiado el correo</b>";
        }
    }
    }
    
    if(!empty($nueva_contraseña and $contraseña_anterior)){
        //consulta
        $consulta2="SELECT contraseña FROM registrate WHERE numero_documento = $numero_documento";
        $resultado2=mysqli_query($conn,$consulta2);
        while ($row=$resultado2->fetch_assoc()){
            $row['contraseña'];
            $contraseña=$row['contraseña'];
        }
        if($contraseña_anterior === $contraseña){
            $query3=$conn->prepare("UPDATE registrate SET contraseña=? WHERE numero_documento = $numero_documento");
            $result3=$query3->execute([$nueva_contraseña]);
            echo "<b><center>se ha cambiado tu contraseña</center></b>";
        }else{
            echo "<b>Error al cambiar la contraseña, verifica los datos</b>";
        }

    }
    elseif(!empty($contraseña_anterior) and empty($nueva_contraseña)){
        echo "<b>escribe una contraseña nueva</b>";
    }
    elseif(empty($contraseña_anterior) and !empty($nueva_contraseña)){
        echo "<b>escribe tu contraseña anterior</b> ";
    }

    } 
    ?>
    </article>
    


</body>
</html>