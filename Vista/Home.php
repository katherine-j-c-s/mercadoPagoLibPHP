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
            <div class="container my-5">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="card shadow-sm">
                            <div class="card-body text-center">
                                <img class="" style="width: 200px;" src="https://dcdn.mitiendanube.com/stores/002/607/396/products/buscar-unete-a-love-isdincontacto-argentina-isdin-fotoproteccionisdinceuticstest-protector-solar-facialtodos-los-cuidadosmarcas-fotoprotector-isdin-gel-cream-dry-touch-color-spf-50-el-primer-gel-61-6a1737f1c12984efa017125090429060-1024-1024.webp" alt="base">
                                <h1 class="card-title">Base </h1>
                                <p class="card-text">Producto: <strong>Rimel Big Shot</strong></p>
                                <p class="card-text">Descripcion: <strong>Dummy description</strong></p>
                                
                                <p class="card-text">Precio: <strong>$100</strong></p>
                                <form action="./accion/AccionProducto.php" method="post">
                                    <!-- Campos ocultos con los valores que deseas enviar -->
                                    <input type="hidden" name="nombre" value="Rimel Big Shot">
                                    <input type="hidden" name="precio" value="100">
                                    <input type="hidden" name="cantidad" value="1">
                                    <button class="btn btn-primary btn-lg" type="submit" name="ejecutar">Agregar al carrito</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </main>
    </div>
    <?php include_once("./Estructura/footer.php") ?>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</html>