<?php
use Control\AbmProducto;
require_once __DIR__ . '../../../Control/AbmProducto.php';

$abmProducto = new AbmProducto;
$newProduct = $abmProducto->agregarNuevoProducto("Base",1,100);
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MercadoPago</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<script></script>
<?php include_once("../../Vista/Estructura/navbar.php") ?>

<body class=" justify-content-center bg-dark">
<div class="flex justify-content-center">
    <h3 class="text-center text-light "> <?php echo $newProduct?> </h3>
</div>

</body>
<?php include_once("../../Vista/Estructura/footer.php") ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</html>