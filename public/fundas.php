<?php
declare(strict_types=1);

require_once __DIR__ . '/../src/datos/conectar.php';
require_once __DIR__ . '/../src/modelos/Producto.php';
require_once __DIR__ . '/../src/utilidades/vistas.php';

// El JOIN devuelve la categoría como texto, con los mismos campos que tenía datos.json.
$consulta = 'SELECT f.id, f.nombreProducto, c.nombre AS categoria, f.precio, f.stock, f.modelo_compatible AS modeloCompatible
             FROM fundas f
             INNER JOIN categorias c ON c.id = f.categoria_id
             ORDER BY f.id';

$registros = conectar()->query($consulta)->fetchAll();
$productos = array_map(fn (array $registro) => Producto::desdeArreglo($registro), $registros);
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PhonecaSeSDS - Fundas</title>
        <link rel="stylesheet" href="assets/css/estilos.css">
    </head>
    <body>
        <header>
            <h1>Fundas</h1>
            <nav>
                <ul>
                    <li><a href="index.php">Inicio</a></li>
                    <li><a href="fundas.php" aria-current="page">Catálogo</a></li>
                    <li><a href="contacto.php">Contacto</a></li>
                </ul>
            </nav>
        </header>

        <main>
            <h2>Catálogo de Fundas</h2>
            <a href="subir-producto.php" class="boton-agregar">Agregar funda +</a>
            <section class="tarjetas-productos">
                <?php foreach ($productos as $producto): ?>
                <?php mostrarTarjetaProducto($producto, 3); ?>
            <?php endforeach; ?>
            </section>
        </main>

        <footer>
            <p>&copy; 2026 PhonecaSeSDS. Todos los derechos reservados.</p>
        </footer>

    </body>
</html>