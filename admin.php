<?php
$conexion = new mysqli("localhost", "Admin", "JqZl@.8092hjkl", "yellowmenstorephp");
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $permitirAccion = false;
    $id_producto = isset($_POST['id']) ? intval($_POST['id']) : 0;
    if ($id_producto > 0) {
        $sqlCheck = "SELECT id_producto FROM producto WHERE id_producto = $id_producto";
        $resultCheck = $conexion->query($sqlCheck);
        $permitirAccion = $resultCheck->num_rows > 0;
    }

    if (isset($_POST['agregar'])) {
        $nombre = $_POST['nombre'];
        $precio = $_POST['precio'];
        $nombre_categoria = $_POST['categoria'];
        $imagen = addslashes(file_get_contents($_FILES['imagen']['tmp_name']));

        $stmtCat = $conexion->prepare("SELECT id_categoria FROM categorias WHERE nombre_categoria = ?");
        $stmtCat->bind_param("s", $nombre_categoria);
        $stmtCat->execute();
        $resultadoCat = $stmtCat->get_result();
        if ($resultadoCat->num_rows > 0) {
            $filaCat = $resultadoCat->fetch_assoc();
            $id_categoria = $filaCat['id_categoria'];

            $sql = "INSERT INTO producto (nombre_producto, precio_producto, id_categoria, imagen_producto) VALUES ('$nombre', '$precio', '$id_categoria', '$imagen')";
            if ($conexion->query($sql)) {
                $mensaje = "✅ Producto agregado correctamente.";
            } else {
                $mensaje = "❌ Error al agregar el producto.";
            }
        } else {
            $mensaje = "⚠️ Categoría no encontrada.";
        }
    }

    if (isset($_POST['editar']) && $permitirAccion) {
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $precio = $_POST['precio'];
        $nombre_categoria = $_POST['categoria'];
        $imagen = !empty($_FILES['imagen']['tmp_name']) ? addslashes(file_get_contents($_FILES['imagen']['tmp_name'])) : null;

        $stmtCat = $conexion->prepare("SELECT id_categoria FROM categorias WHERE nombre_categoria = ?");
        $stmtCat->bind_param("s", $nombre_categoria);
        $stmtCat->execute();
        $resultadoCat = $stmtCat->get_result();
        if ($resultadoCat->num_rows > 0) {
            $filaCat = $resultadoCat->fetch_assoc();
            $id_categoria = $filaCat['id_categoria'];

            $sql = "UPDATE producto SET nombre_producto='$nombre', precio_producto='$precio', id_categoria='$id_categoria'";
            if ($imagen !== null) {
                $sql .= ", imagen_producto='$imagen'";
            }
            $sql .= " WHERE id_producto=$id";

            if ($conexion->query($sql)) {
                $mensaje = "✅ Producto actualizado correctamente.";
            } else {
                $mensaje = "❌ Error al actualizar el producto.";
            }
        } else {
            $mensaje = "⚠️ Categoría no encontrada.";
        }
    }

    if (isset($_POST['eliminar']) && $permitirAccion) {
        $id = $_POST['id'];
        $sql = "DELETE FROM producto WHERE id_producto=$id";
        if ($conexion->query($sql)) {
            $mensaje = "✅ Producto eliminado correctamente.";
        } else {
            $mensaje = "❌ Error al eliminar el producto.";
        }
    }
}

$filtro = isset($_GET['filtro']) ? $_GET['filtro'] : '';
$query = "SELECT producto.*, categorias.nombre_categoria FROM producto JOIN categorias ON producto.id_categoria = categorias.id_categoria WHERE nombre_producto LIKE ?";
$stmt = $conexion->prepare($query);
$param = "%$filtro%";
$stmt->bind_param("s", $param);
$stmt->execute();
$resultado = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Admin - Yellow Men</title>
    <link rel="stylesheet" href="main.css">
    <style>
        body {
            margin: 0;
            font-family: sans-serif;
            background-color: var(--clr-main, #fff200);
            color: var(--clr-black, #000);
            display: flex;
            height: 100vh;
        }
        aside {
            width: 250px;
            background-color: var(--clr-main, #fff200);
            padding: 2rem;
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }
        aside h1 {
            font-size: 1.5rem;
        }
        aside a {
            background-color: var(--clr-black);
            color: var(--clr-main);
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            text-decoration: none;
            font-weight: bold;
            text-align: center;
        }
        .admin-panel {
            flex: 1;
            background-color: var(--clr-black);
            padding: 2rem;
            overflow-y: auto;
        }
        .formulario-y-lista {
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }
        .contenido-admin {
            display: flex;
            flex-direction: row;
            gap: 2rem;
            align-items: flex-start;
        }
        .formularios-container {
            width: 350px;
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }
        .buscador-form {
            width: 100%;
        }
        .buscador-form input[type="text"] {
            width: 100%;
            background-color: var(--clr-main);
            color: var(--clr-black);
        }
        .formulario-producto form,
        .buscador-form {
            background-color: var(--clr-black);
            border: 2px solid var(--clr-main);
            padding: 1.5rem;
            border-radius: 1rem;
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }
        input, button {
            padding: 0.8rem;
            font-size: 1rem;
            border: none;
            border-radius: 0.5rem;
        }
        input[type="text"],
        input[type="number"],
        input[type="file"] {
            background-color: var(--clr-main);
            color: var(--clr-black);
        }
        button {
            background-color: var(--clr-main);
            color: var(--clr-black);
            font-weight: bold;
            cursor: pointer;
        }
        .productos-listado {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }
        .producto {
            background-color: var(--clr-main);
            border-radius: 1.5rem;
            display: flex;
            gap: 1rem;
            padding: 1rem;
            align-items: center;
        }
        .producto img {
            width: 300px;
            height: 400px;
            object-fit: cover;
            border-radius: 1rem;
        }
        .producto form {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }
        .producto input,
        .producto button {
            padding: 0.5rem;
        }
        .mensaje {
            padding: 1rem;
            background-color: #fff;
            color: #000;
            border-left: 5px solid #000;
            font-weight: bold;
            border-radius: 0.5rem;
        }
    </style>
</head>
<body>
    <aside>
        <h1>Yellow Men Admin</h1>
        <a href="index.php">Volver a la tienda</a>
        <a href="categorias.php">Categorías</a>
    </aside>
    <div class="admin-panel">
        <div class="formulario-y-lista">
            <form class="buscador-form" method="GET">
                <input type="text" name="filtro" placeholder="Buscar producto por nombre..." value="<?php echo htmlspecialchars($filtro); ?>">
                <button type="submit">Buscar</button>
            </form>

            <?php if (!empty($mensaje)): ?>
                <div class="mensaje"><?php echo $mensaje; ?></div>
            <?php endif; ?>

            <div class="contenido-admin">
                <div class="formularios-container">
                    <div class="formulario-producto">
                        <form method="POST" enctype="multipart/form-data">
                            <input type="text" name="nombre" placeholder="Nombre del producto" required>
                            <input type="number" name="precio" placeholder="Precio del producto" required>
                            <input type="text" name="categoria" placeholder="Nombre de la categoría" required>
                            <input type="file" name="imagen" accept="image/*" required>
                            <button type="submit" name="agregar">Agregar Producto</button>
                        </form>
                    </div>
                </div>

                <div class="productos-listado">
                    <?php
                    while ($producto = $resultado->fetch_assoc()) {
                        echo '<div class="producto">';
                        echo '<img src="data:image/jpeg;base64,' . base64_encode($producto['imagen_producto']) . '"/>';
                        echo '<form method="POST" enctype="multipart/form-data">';
                        echo '<input type="hidden" name="id" value="' . $producto['id_producto'] . '">';
                        echo '<input type="text" name="nombre" value="' . $producto['nombre_producto'] . '">';
                        echo '<input type="text" name="precio" value="' . $producto['precio_producto'] . '">';
                        echo '<input type="text" name="categoria" value="' . $producto['nombre_categoria'] . '">';
                        echo '<input type="file" name="imagen">';
                        echo '<button type="submit" name="editar">Editar</button>';
                        echo '<button type="submit" name="eliminar" onclick="return confirm(\'¿Estás seguro?\')">Eliminar</button>';
                        echo '</form>';
                        echo '</div>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
