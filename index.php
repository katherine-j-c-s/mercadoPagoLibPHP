<?php
require __DIR__ . '/vendor/autoload.php';

use MercadoPago\MercadoPagoConfig;
use MercadoPago\Client\Preference\PreferenceClient;

// Set your Mercado Pago access token
MercadoPagoConfig::setAccessToken('APP_USR-7761833317985447-101016-b5cc845c75840ded45ca4068ed53067e-1141992907');

// Initialize the preference client
$client = new PreferenceClient();

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
            "title" => "Dummy Title",
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

// Accessing the preference ID correctly
echo "Preference ID: " . $preference->id;

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
</head>
    <script src="https://sdk.mercadopago.com/js/v2"></script>
<body>
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
    <div class="btnPagar"></div>
</body>
</html>
