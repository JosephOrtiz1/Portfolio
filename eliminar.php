<?php
include("Conexion.php");

$id_categoria = 1;


$sql = "DELETE FROM CATEGORIAS WHERE id = ?";


$stmt = $conexion->prepare($sql);


if ($stmt === false) {
    die("Error en la preparación de la consulta: " . $conexion->error);
}

$stmt->bind_param("i", $id_categoria);  // 'i' indica que el parámetro es un entero


$stmt->execute();


if ($stmt->affected_rows > 0) {
    echo "Registro eliminado correctamente.";
} else {
    echo "Error eliminando registro o el ID no existe.";
}

$stmt->close();
$conexion->close();
?>
