<?php 
include("Conexion.php");


$id_categoria = 1;  
$nombre = "Nuevo Nombre";  
$tipo = "Nueva Categoria"; 

$sql = "UPDATE categoria SET nombre = ?, tipo = ? WHERE id = ?";

$stmt = $conexion->prepare($sql);

if ($stmt === false) {
    die("Error al preparar la consulta: " . $conexion->error);
}


$stmt->bind_param("ssi", $nombre, $tipo, $id_categoria);


$stmt->execute();


if ($stmt->affected_rows > 0) {
    echo "Categoría actualizada correctamente.";
} else {
    echo "No se actualizó ninguna categoría (¿El ID es correcto?).";
}


$stmt->close();
$conexion->close();
?>
