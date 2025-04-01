<?php 
include("Conexion.php");

$sql = "SELECT id, nombre, tipo FROM CATEGORIAS";
$result = $conexion->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"] . " - Nombre: " . $row["nombre"] . " - Tipo: " . $row["tipo"] . "<br>";
    }
} else {
    echo "0 resultados"; 
}
?>
