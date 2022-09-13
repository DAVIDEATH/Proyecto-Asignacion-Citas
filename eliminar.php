<?php include 'conexion.php';
 
if (!isset($_GET['id'])){
    exit();
}

$codigo =$_GET['id'];
$sentencia=$conn->prepare("DELETE FROM cita_medica WHERE id_cita=?");
$resultado = $sentencia->execute([$codigo]);

if($resultado=== TRUE) {
    header('location:eliminar_cita.php');
}else{
    echo "OCURRIO UN ERROR AL ELIMINAR SU CITA";
}
?>