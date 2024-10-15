<?php
require __DIR__ . '/vendor/autoload.php';

use MercadoPago\MercadoPagoConfig;
use MercadoPago\Client\Preference\PreferenceClient;
use Modelo\Producto;

// Set your Mercado Pago access token
MercadoPagoConfig::setAccessToken('APP_USR-7761833317985447-101016-b5cc845c75840ded45ca4068ed53067e-1141992907');

// Initialize the preference client
$client = new PreferenceClient();

function agregarProducto($nombre, $precio, $cantidad, $idProducto) {
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
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <img class="" style="width: 200px;" src="https://www.farmacialeloir.com.ar/img/articulos/maybelline_colossal_big_shot_mascara_pestanas_waterproof.jpg" alt="">
                        <h1 class="card-title">Rimel</h1>
                        <p class="card-text">Producto: <strong><?php echo $preference->items[0]->title; ?></strong></p>
                        <p class="card-text">Precio: <strong>$<?php echo number_format($preference->items[0]->unit_price, 2); ?></strong></p>
                        <button type="$_GET" id="3" class="btn" onclick=""> Agregar producto</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <img class="" style="width: 200px;" src="https://dcdn.mitiendanube.com/stores/002/607/396/products/buscar-unete-a-love-isdincontacto-argentina-isdin-fotoproteccionisdinceuticstest-protector-solar-facialtodos-los-cuidadosmarcas-fotoprotector-isdin-gel-cream-dry-touch-color-spf-50-el-primer-gel-61-6a1737f1c12984efa017125090429060-1024-1024.webp" alt="base">
                        <h1 class="card-title">Base </h1>
                        <p class="card-text">Producto: <strong><?php echo $preference->items[0]->title; ?></strong></p>
                        <p class="card-text">Precio: <strong>$<?php echo number_format($preference->items[0]->unit_price, 2); ?></strong></p>
                        <form action="ejecutar.php" method="post">
                            <!-- Campos ocultos con los valores que deseas enviar -->
                            <input type="hidden" name="nombre" value="Rimel">
                            <input type="hidden" name="precio" value="20">
                            <input type="hidden" name="cantidad" value="1">
                            <input type="hidden" name="idProducto" value="1">
                            <button type="submit" name="ejecutar">Hacer clic para ejecutar PHP</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <img class="" style="width: 200px;" src="https://http2.mlstatic.com/D_NQ_NP_2X_852965-MLA45241732068_032021-F.webp"" alt="">
                        <h1 class="card-title">Sombra</h1>
                        <p class="card-text">Producto: <strong><?php echo $preference->items[0]->title; ?></strong></p>
                        <p class="card-text">Precio: <strong>$<?php echo number_format($preference->items[0]->unit_price, 2); ?></strong></p>
                        <button type="$_GET" id="3" class="btn" onclick="agregarProducto('Rimel',100,1,1)"> Agregar producto</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="btnPagar justify-content-center algin-item-center"></div>

</body>
<?php include_once("./Vista/Estructura/footer.php") ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</html>