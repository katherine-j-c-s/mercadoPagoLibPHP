<?php
require __DIR__ . '/../vendor/autoload.php';

use MercadoPago\MercadoPagoConfig;
use MercadoPago\Client\Preference\PreferenceClient;
use Modelo\Producto;

// Set your Mercado Pago access token
MercadoPagoConfig::setAccessToken('APP_USR-7761833317985447-101016-b5cc845c75840ded45ca4068ed53067e-1141992907');

// Initialize the preference client
$client = new PreferenceClient();

function agregarProducto($nombre, $precio, $cantidad, $idProducto)
{
    $producto = new Producto();
    $producto->cargar($nombre, $precio, $idProducto, $cantidad);
    $producto->insertar();
}

// Create the preference
$preference = $client->create([
    "back_urls" => array(
        "success" => "http://test.com/success",
        "failure" => "http://test.com/failure",
        "pending" => "http://test.com/pending"
    ),
    "items" => array(
        array(
            "id" => "123",
            "title" => "Rimel Big Shot",
            "description" => "Dummy description",
            "quantity" => 1,
            "currency_id" => "BRL",
            "unit_price" => 100
        ),
        array(
            "id" => "1234",
            "title" => "Base ",
            "description" => "Dummy description",
            "quantity" => 1,
            "currency_id" => "BRL",
            "unit_price" => 100
        ),
        array(
            "id" => "12345",
            "title" => "Sombra",
            "description" => "Dummy description",
            "quantity" => 1,
            "currency_id" => "BRL",
            "unit_price" => 100
        )
    ),
    "payer" => array(
        "name" => "Test",
        "surname" => "User",
        "email" => "your_test_email@example.com",
    ),
    "operation_type" => "regular_payment",
    "payment_methods" => array(
        "default_payment_method_id" => "master",
        "excluded_payment_types" => array(
            array(
                "id" => "visa"
            )
        ),
        "excluded_payment_methods" => array(
            array(
                "id" => ""
            )
        ),
        "installments" => 5,
        "default_installments" => 1
    )
]);



// use Modelo\Producto;

// require_once __DIR__ . '/modelo/Producto.php';
// $idProducto = $_GET['idProducto'];
// $cantidad = $_GET['cantidad'];
// $carrito = [] ;
    
// session_start(); // Iniciar la sesión

// // Verifica si la sesión de carrito existe, si no, inicialízala
// if (!isset($_SESSION['cart'])) {
//     $_SESSION['cart'] = [];
// }

// // Agrega un producto al carrito si se envían datos
// if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nombre']) && isset($_POST['precio'])) {
//     $nombre = $_POST['nombre'];
//     $precio = floatval($_POST['precio']);
    
//     // Busca si el producto ya está en el carrito
//     $productoEncontrado = false;
//     foreach ($_SESSION['cart'] as &$item) {
//         if ($item['nombre'] === $nombre) {
//             $item['cantidad'] += 1; // Incrementa la cantidad
//             $item['precio'] = $precio * $item['cantidad']; // Actualiza el precio total del producto
//             $productoEncontrado = true;
//             break;
//         }
//     }

//     // Si el producto no está en el carrito, lo añade
//     if (!$productoEncontrado) {
//         $_SESSION['cart'][] = [
//             'nombre' => $nombre,
//             'precio' => $precio,
//             'cantidad' => 1 // Inicializa la cantidad
//         ];
//     }
// }

// // Sumar el total y contar productos
// $total = 0;
// foreach ($_SESSION['cart'] as $item) {
//     $total += $item['precio'];
// }

// // Devuelve el carrito actualizado
// $carrito=  $_SESSION['cart'];



// if (isset($_POST['nombre']) && isset($_POST['precio']) && isset($_POST['cantidad'])) {
//     $nombre = $_POST['nombre'];
//     $precio = (float)$_POST['precio'];    // Convertir a tipo float para números decimales
//     $cantidad = (int)$_POST['cantidad'];  // Convertir a tipo entero

//     // Llamar a la función y pasarle los parámetros
//     ejecutarFuncionPHP($nombre, $precio, $cantidad);
// }

// // Función a ejecutar
// function ejecutarFuncionPHP($nombre, $precio, $cantidad)
// {
//     $producto = new Producto();
//     $producto->cargar($nombre, $precio, $cantidad);
//     $producto->insertar();
// }


?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MercadoPago</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<script src="https://sdk.mercadopago.com/js/v2"></script>
<?php include_once("./Vista/Estructura/navbar.php") ?>

<body class=" justify-content-center bg-dark">
<div class="flex justify-content-center">
<aside class="card bg-dark text-light shadow-lg mb-4" style="width: 400px;">
    <div class="card-header text-center">
        <h1>Carrito</h1>
    </div>
    <div class="card-body">
        <p class="mb-0">Tienes <?php echo count($cartItems); ?> producto(s) en el carrito</p>
        <hr>
        <?php
        foreach ($cartItems as $item) {
            echo "<p><strong>Producto:</strong> " . htmlspecialchars($item['nombre']) . "</p>";
            echo "<p><strong>Precio Total:</strong> $" . number_format($item['precio'], 2) . "</p>";
            echo "<p><strong>Cantidad:</strong> " . $item['cantidad'] . "</p>";
        }
        ?>
        <hr>
        <h4><strong>Total a pagar:</strong> <?php echo number_format($total, 2); ?></h4>
        <div class="btnPagar my-5"></div>
    </div>
</aside>
</div>

</body>
<?php include_once("./Vista/Estructura/footer.php") ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</html>