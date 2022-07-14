<?php

include "administrador/global/config.php";
include "administrador/global/conexion.php";
include "carrito.php";
include "template/header.php";

?>

<?php 

if($_POST){

    $idSession=session_id();
    $nombre=$_POST['nombre'];
    $direccion=$_POST['direccion'];
    $correo=$_POST['correo'];
    $total=0;

    foreach($_SESSION['carrito'] as $indice=>$producto){

        $total=$total+($producto['Precio']+$producto['Cantidad']);
    }
        $sentencia=$pdo->prepare("INSERT INTO `ventas` (`ID`, `ClaveTransaccion`, `Fecha`, `Nombre`, `Direccion`, `Correo`, `Total`) 
        VALUES (NULL, :ClaveTransaccion, NOW(), :Nombre, :Direccion, :Correo, :Total);");
        
        $sentencia->bindParam(":ClaveTransaccion", $idSession);
        $sentencia->bindParam(":Nombre", $nombre);
        $sentencia->bindParam(":Direccion", $direccion);
        $sentencia->bindParam(":Correo", $correo);
        $sentencia->bindParam(":Total", $total);

        $sentencia->execute();
        $idVentas=$pdo->lastInsertId();

        foreach($_SESSION['carrito'] as $indice=>$producto){
        
            $sentencia=$pdo->prepare("INSERT INTO `factura` (`ID`, `Id_venta`, `Id_producto`, `Precio`, `Cantidad`) 
            VALUES (NULL, :Id_venta, :Id_producto, :Precio, :Cantidad);");
            
            $sentencia->bindParam(":Id_venta", $idVentas);
            $sentencia->bindParam(":Id_producto", $producto['ID']);
            $sentencia->bindParam(":Precio", $producto['Precio']);
            $sentencia->bindParam(":Cantidad", $producto['Cantidad']);
    
            $sentencia->execute();
        }

    //echo "<h3>".$total."</h3>";
}

?>

<div class="jumbotron text-center"><br><br>
    <h1 class="display-4">¡Paso Final!</h1>
    <hr class="my-4">
    <p class="lead">Estas a punto de pagar con paypal la cantidad de:
        <h4><?php echo number_format($total, 2); ?>€</h4>
                    Paypal puede generar costes ajenos a este sitio web
        <div id="smart-button-container"><div style="text-align: center;"><div id="paypal-button-container"></div></div></div>
    </p>
</div>

<script src="https://www.paypal.com/sdk/js?client-id=sb&enable-funding=venmo&currency=EUR" data-sdk-integration-source="button-factory"></script>

<script>

function initPayPalButton() {
    paypal.Buttons({
    style: {
        shape: 'pill',
        color: 'black',
        layout: 'horizontal',
        label: 'paypal',
        tagline: true
    },

    createOrder: function(data, actions) {
        return actions.order.create({
        purchase_units: [{"amount":{"currency_code":"EUR","value":<?php echo $total; ?>}}]
        });
    },

    onApprove: function(data, actions) {
        return actions.order.capture().then(function(orderData) {
        
        // Full available details
        console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));

        // Show a success message within this page, e.g.
        const element = document.getElementById('paypal-button-container');
        element.innerHTML = '';
        element.innerHTML = '<h3>¡Gracias por tu pago!</h3>';

        // Or go to another URL:  actions.redirect('thank_you.html');
        
        });
    },

    onError: function(err) {
        console.log(err);
    }
    }).render('#paypal-button-container');
}
initPayPalButton();

</script>

<?php session_destroy(); ?>

<?php include "template/footer.php"; ?>