<?php
$conexion= new mysqli ("%localhost", "Admin", "JqZl@.8092hjkl", 'yellowmenstorephp');

if($conexion->connect_error){
    die("Conexion fallida:" . $conexion->connect_error);

}else{
    echo "Conesxion exitosa";
}

?>
