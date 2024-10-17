<?php
require __DIR__ . '../../../vendor/autoload.php';

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
            "quantity" => 1,
            "currency_id" => "BRL",
            "unit_price" => 100
        )
    ),
    "payer" => array(
        "name" => "Test",
        "surname" => "contreras",
        "email" => "kathijcs@gmail.com",
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

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MercadoPago</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<script src="https://sdk.mercadopago.com/js/v2"></script>
<?php include_once("./Estructura/navbar.php") ?>

<body class=" justify-content-center bg-dark">
    <div class="d-flex ">

        <main style="width:100%">
            <!-- <div class="container my-5 "  >
        <h1>Rimel </h1>
        <p>Producto: <?php echo $preference->items[0]->title; ?></p>
        <p>Precio: <?php echo $preference->items[0]->unit_price; ?></p>
    </div> -->

            <script>
                const mp = new MercadoPago('APP_USR-816d265f-41d6-4824-a1c3-b009b866b5da', {
                    locale: 'es-AR'
                });
                mp.checkout({
                    preference: {
                        id: '<?php echo $preference->id; ?>'
                    },
                    render: {
                        container: '.btnPagar',
                        label: 'Pagar',
                    }
                });
            </script>
            
            <div class="container text-light my-5">
                <div class="card-header text-center">
                    <h1>Carrito</h1>
                </div>
                <div class="card-body">
                    <p class="mb-0">Tienes <?php echo count($preference->items); ?> producto(s) en el carrito</p>
                    <hr>
                    <?php
                    $total = 0;
                    foreach ($preference->items as $item) {
                        $total += $item->unit_price; // Sumar cada precio al total
                        echo "<p><strong>Producto:</strong> " . $item->title . "</p>";
                        echo "<p><strong>Precio:</strong> $" . number_format($item->unit_price, 2) . "</p>";
                    }
                    ?>
                    <hr>
                    <h4><strong>Total a pagar:</strong><?php echo number_format($total, 2); ?></h4>
                    <div class="btnPagar my-5"></div>
                </div>
            </div>

        </main>
    </div>
    <?php include_once("./Estructura/footer.php") ?>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</html>