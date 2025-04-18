<!-- Conexion con la base de datos -->
 
<?php
$conexion = new mysqli("localhost", "Admin", "JqZl@.8092hjkl", "yellowmenstorephp");
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yellow Men</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="main.css">
</head>
<body>

    <div class="wrapper">
        <aside>
            <header>
                <h1 class="logo">Yellow Men Store</h1>
            </header>
            <nav>
              <ul class="menu">
                <li>
                    <button id="todos" class="boton-menu boton-categoria active"><i class="bi bi-hand-index-thumb-fill"></i> Todos los productos</button>
                </li>
                <li>
                    <button id="abrigos" class="boton-menu boton-categoria"><i class="bi bi-hand-index-thumb"></i> Abrigos</button>
                </li>
                <li>
                    <button id="camisetas" class="boton-menu boton-categoria"><i class="bi bi-hand-index-thumb"></i> Camisetas</button>
                </li>
                <li>
                    <button id="pantalones" class="boton-menu boton-categoria"><i class="bi bi-hand-index-thumb"></i> Pantalones</button>
                </li>
                <li>
                    <a class="boton-menu boton-carrito" href="./carrito.html">
                        <i class="bi bi-cart-fill"></i> Carrito <span id="numerito" class="numerito">0</span>
                    </a>
                </li>
            </ul>
            </nav>
            <footer>
             <p class="text-footer">© 2025 Joseph Ortiz </p>   
            </footer>

        </aside>
        <main>
            <h2 class="titulo-principal">Todos los productos</h2>
            <div class="contenedor-productos">
                <!-- Aca van las imagenes de los productos -->

                <div class="producto">
                <img class="producto-imagen" src="img\Camisa1.png" alt=""> 
                <div class="producto-detalles">
                  <h3 class="producto titulo">Abrigo 01</h3>  
                  <p class="producto-precio">₡19 990</p>
                  <button class="producto-agregar">Agregar</button>
                </div>
                </div>


                <div class="producto">
                    <img class="producto-imagen" src="img\Camisa4.png" alt=""> 
                    <div class="producto-detalles">
                      <h3 class="producto titulo">Abrigo 01</h3>  
                      <p class="producto-precio">₡19 990</p>
                      <button class="producto-agregar">Agregar</button>
                    </div>
                    </div>
                
            
                    <div class="producto">
                        <img class="producto-imagen" src="img\Camisa2.png" alt=""> 
                        <div class="producto-detalles">
                          <h3 class="producto titulo">Abrigo 01</h3>  
                          <p class="producto-precio">₡19 990</p>
                          <button class="producto-agregar">Agregar</button>
                        </div>
                        </div>

                        <div class="producto">
                            <img class="producto-imagen" src="img\Camisa3.png" alt=""> 
                            <div class="producto-detalles">
                              <h3 class="producto titulo">Abrigo 01</h3>  
                              <p class="producto-precio">₡19 990</p>
                              <button class="producto-agregar">Agregar</button>
                            </div>
                            </div>



                            <div class="producto">
                                <img class="producto-imagen" src="img\Camisa1.png" alt=""> 
                                <div class="producto-detalles">
                                  <h3 class="producto titulo">Abrigo 01</h3>  
                                  <p class="producto-precio">₡19 990</p>
                                  <button class="producto-agregar">Agregar</button>
                                </div>
                                </div>
                
                
                                <div class="producto">
                                    <img class="producto-imagen" src="img\Camisa4.png" alt=""> 
                                    <div class="producto-detalles">
                                      <h3 class="producto titulo">Abrigo 01</h3>  
                                      <p class="producto-precio">₡19 990</p>
                                      <button class="producto-agregar">Agregar</button>
                                    </div>
                                    </div>
                                
                            
                                    <div class="producto">
                                        <img class="producto-imagen" src="img\Camisa2.png" alt=""> 
                                        <div class="producto-detalles">
                                          <h3 class="producto titulo">Abrigo 01</h3>  
                                          <p class="producto-precio">₡19 990</p>
                                          <button class="producto-agregar">Agregar</button>
                                        </div>
                                        </div>
                
                                        <div class="producto">
                                            <img class="producto-imagen" src="img\Camisa3.png" alt=""> 
                                            <div class="producto-detalles">
                                              <h3 class="producto titulo">Abrigo 01</h3>  
                                              <p class="producto-precio">₡19 990</p>
                                              <button class="producto-agregar">Agregar</button>
                                            </div>
                                            </div>


                 </div>
        </main>

            </div>
        
    </div>
</body>
</html>