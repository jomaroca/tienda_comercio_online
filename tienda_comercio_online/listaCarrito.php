<?php

include "administrador/global/config.php";
include "carrito.php";
include "template/header.php";

?>
<div class="col-md-8">
    <div class="card card-header">
        <h3>Lista del carrito</h3>
    </div>
    <?php if (!empty($_SESSION['carrito'])) { ?>
    <table class="table table-bordered">
        <thead class="text-center">
            <tr>
                <th>Nombre</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Total</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody class="text-center">    
            <?php $total=0; ?>
            <?php foreach($_SESSION['carrito'] as $indice=>$producto) { ?>
            <tr>
                <td><?php echo $producto['Nombre'] ?></td>
                <td><?php echo $producto['Cantidad'] ?></td>
                <td><?php echo $producto['Precio'] ?></td>
                <td><?php echo number_format($producto['Precio']*$producto['Cantidad'], 2); ?></td>
                <td>           
                    <form action="" method="post">
                        <input type="hidden" name="id" id="id" value="<?php echo openssl_encrypt($producto['ID'], COD, KEY); ?>">
                        <div class="d-grid gap-1 d-md-flex justify-content-md-center">
                            <button type="submit" class="btn btn-danger" name="btnAccion" onclick="return confirm('¿Seguro que quieres eliminar?')" value="Eliminar">Eliminar</button>          
                        </div>
                    </form>
                </td>
            </tr>       
            <?php $total=$total+($producto['Precio']*$producto['Cantidad']); ?>
            <?php } ?>
            <tr>
                <td colspan="4"><h3>Total</h3></td>
                <td><h3><?php echo number_format($total,2); ?>€</h3></td>          
            </tr>
        </tbody>
    </table>
</div>
<div class="col-md-4">
<div class="card">
    <div class="card-header">
        <h3>Datos de envio</h3>
    </div>
    <div class="card-body">
        <form action="pagar.php" method="post">
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input id="nombre" required class="form-control" type="text" name="nombre" placeholder="Introduce nombre">
            </div>
            <div class="form-group">
                <label for="direccion">Dirección</label>
                <input id="direccion" required class="form-control" type="text" name="direccion" placeholder="Introduce dirección">
            </div>                 
            <div class="form-group">
                <label for="correo">Correo</label>
                <input id="correo" required class="form-control" type="email" name="correo" placeholder="Introduce correo">
            </div><br>
            <div class="d-grid gap-2 col-6 mx-auto">
                <button type="submit" class="btn btn-primary btn-lg" name="btnAccion" value="pagar">Pagar</button>
            </div>
        </form>
    </div>
</div>
</div>

<?php }else{ ?>
    <div class="alert alert-success opacity-75">
        No has seleccionado ningún producto...
    </div>
<?php } ?>

</div>

<?php include "template/footer.php"; ?>