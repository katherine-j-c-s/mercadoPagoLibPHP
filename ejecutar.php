<?php
use Modelo\Producto;
require_once __DIR__ . '/modelo/Producto.php';

if (isset($_POST['nombre']) && isset($_POST['precio']) && isset($_POST['cantidad'])) {
    $nombre = $_POST['nombre'];
    $precio = (float)$_POST['precio'];    // Convertir a tipo float para números decimales
    $cantidad = (int)$_POST['cantidad'];  // Convertir a tipo entero

    // Llamar a la función y pasarle los parámetros
    ejecutarFuncionPHP($nombre, $precio, $cantidad);
}

// Función a ejecutar
function ejecutarFuncionPHP($nombre, $precio, $cantidad) {
    $producto = new Producto();
    $producto->cargar($nombre, $precio, $cantidad);
    $producto->insertar();
}
