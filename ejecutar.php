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
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
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
            "id" => "1234",
            "title" => "Rimel Big Shot",
            "description" => "Dummy description",
            "quantity" => 2,
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

// // Accessing the preference ID correctly
// echo "Preference ID: " . $preference->id;

// // Create the preference client
// $preferenceClient = new PreferenceClient();

// // Create the item (The correct class and namespace must be used here)
// $item = new Item();
// $item->id = 1;
// $item->title = "producto1";
// $item->description = "descripcion";
// $item->quantity = 1;
// $item->unit_price = 800;
// $item->currency_id = 'ARS';

// // Create the preference and set back URLs
// $preference = new Preference();
// $preference->back_urls = [
//     "success" => "pagoExitoso.html",
//     "failure" => "pagoFallido.html",
//     "pending" => "pagoPendiente.html"
// ];
// $preference->items = [$item];

// Save the preference

?>
