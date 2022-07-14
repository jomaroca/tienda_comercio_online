<?php

include "administrador/global/config.php";
include "administrador/global/conexion.php";
include "carrito.php";
include "template/header.php";

?>

<?php if ($mensaje!="") { ?>
<div class="card-body">
    <div class="alert alert-success alert-dismissible fade show opacity-75" role="alert">
        <?php echo $mensaje; ?>
        <a href="listaCarrito.php" class="link-success"><strong>Ver carrito</strong></a>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
</div>
<?php } ?>

<?php

$sentencia=$pdo->prepare("SELECT * FROM productos");
$sentencia->execute();
$listaProductos=$sentencia->fetchall(PDO::FETCH_ASSOC);

?>

<?php foreach($listaProductos as $producto) { ?>
<div class="col-3">
    <div class="card">
        <img class="card-img-top" height="315px" data-bs-toggle="popover" data-bs-trigger="focus" 
            src="img/<?php echo $producto['Imagen']; ?>" title="<?php echo $producto['Descripcion']; ?>">
        <div class="card-body">
            <h5 class="card-title"><?php echo $producto['Nombre']; ?></h5>
            <h6 class="card-title"><?php echo $producto['Precio']; ?>€</h6>
            <form action="" method="post">
                <input type="hidden" name="id" id="id" value="<?php echo openssl_encrypt($producto['ID'], COD, KEY); ?>">
                <input type="hidden" name="nombre" id="nombre" value="<?php echo openssl_encrypt($producto['Nombre'], COD, KEY); ?>">
                <input type="hidden" name="precio" id="precio" value="<?php echo openssl_encrypt($producto['Precio'], COD, KEY); ?>">
                <input type="hidden" name="cantidad" id="cantidad" value="<?php echo openssl_encrypt(1, COD, KEY); ?>">
                <button class="btn btn-primary" name="btnAccion" value="Agregar" type="submit">Agregar al carrito</button>
            </form>
        </div>
    </div><br>
</div>
<?php } ?>

<script src="js/javaScript.js"></script>

<?php include "template/footer.php"; ?>