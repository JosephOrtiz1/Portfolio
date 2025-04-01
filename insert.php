<?php

//Conexion con la base de datos
$conexion = new mysqli("localhost", "Admin", "JqZl@.8092hjkl", 'yellowmenstorephp');

if ($conexion->connect_error) {
    die("Conexion fallida: " . $conexion->connect_error);
} else {
    echo "Conexión exitosa";
}

//Insert de Categorias
$nombre = "Kimonos";
$tipo = "Camisas";


$sql = "INSERT INTO categorias (nombre, tipo) VALUES (?, ?)";


$stmt = $conexion->prepare($sql);

if ($stmt === false) {
    die("Error en la preparación de la consulta: " . $conexion->error);
}

$stmt->bind_param("ss", $nombre, $tipo);


$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo "Nueva categoria registrada ....";
} else {
    echo "Error al registrar la categoria.";
}
$stmt->close();
$conexion->close();


?>
