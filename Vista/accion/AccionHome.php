<?php
$idProducto = $_GET['idProducto'];
$cantidad = $_GET['cantidad'];
function agregarCarrito($idProducto, $cantidad)
{
    session_start(); // Iniciar la sesión

    // Si no existe el carrito, lo inicializamos
    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = array(); // Carrito vacío
        $_SESSION['contador'] = 0; // Inicializamos el contador en 0
    }

    // Actualizamos el carrito
    if (isset($_SESSION['carrito'][$idProducto])) {
        // Si el producto ya está en el carrito, sumamos la cantidad nueva a la existente
        $_SESSION['carrito'][$idProducto] += $cantidad;
    } else {
        // Si el producto no está en el carrito, lo agregamos con la cantidad indicada
        $_SESSION['carrito'][$idProducto] = $cantidad;
        $_SESSION['contador']++; // Incrementamos el contador de productos distintos
    }
}


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
    <div class="d-flex ">

        <aside class="card bg-dark text-light shadow-lg mb-4" style="width: 400px;">
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
        </aside>

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
            <div class="container my-5">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="card shadow-sm">
                            <div class="card-body text-center">
                                <img class="" style="width: 200px;" src="https://www.farmacialeloir.com.ar/img/articulos/maybelline_colossal_big_shot_mascara_pestanas_waterproof.jpg" alt="">
                                <h1 class="card-title">Rimel</h1>
                                <p class="card-text">Producto: <strong><?php echo $preference->items[0]->title; ?></strong></p>
                                <p class="card-text">Precio: <strong>$<?php echo number_format($preference->items[0]->unit_price, 2); ?></strong></p>
                                <form action="ejecutar.php" method="post">
                                    <!-- Campos ocultos con los valores que deseas enviar -->
                                    <input type="hidden" name="nombre" value="Rimel">
                                    <input type="hidden" name="precio" value="20">
                                    <input type="hidden" name="cantidad" value="1">
                                    <input type="hidden" name="idProducto" value="1">
                                    <div class="d-flex justify-content-center my-5">
                                        <button type="submit" name="ejecutar " id="3" class="btn btn-primary btn-lg">
                                            <i class="fas fa-shopping-cart"></i> Agregar producto
                                        </button>
                                    </div>
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
                        <h1 class=" card-title">Sombra</h1>
                                <p class="card-text">Producto: <strong><?php echo $preference->items[0]->title; ?></strong></p>
                                <p class="card-text">Precio: <strong>$<?php echo number_format($preference->items[0]->unit_price, 2); ?></strong></p>
                                <form action="ejecutar.php" method="post">
                                    <!-- Campos ocultos con los valores que deseas enviar -->
                                    <input type="hidden" name="nombre" value="Rimel">
                                    <input type="hidden" name="precio" value="20">
                                    <input type="hidden" name="cantidad" value="1">
                                    <input type="hidden" name="idProducto" value="1">
                                    <div class="d-flex justify-content-center my-5">
                                        <button type="submit" name="ejecutar" id="3" class="btn btn-primary btn-lg" onclick="agregarCarrito()">
                                            <i class="fas fa-shopping-cart"></i> Agregar producto
                                        </button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </main>
    </div>
</body>
<?php include_once("./Vista/Estructura/footer.php") ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</html>