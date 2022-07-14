<?php

session_start();

$mensaje="";

if(isset($_POST['btnAccion'])){

    switch($_POST['btnAccion']){

        case 'Agregar':

            if(is_numeric(openssl_decrypt($_POST['id'], COD, KEY))){
                $id=openssl_decrypt($_POST['id'], COD, KEY);
                $mensaje.="Id: ".$id."<br>";
            }else{
                $mensaje.="Identificador no es correcto".$id."<br>";
            }

            if(is_string(openssl_decrypt($_POST['nombre'], COD, KEY))){
                $nombre=openssl_decrypt($_POST['nombre'], COD, KEY);
                $mensaje.="Nombre: ".$nombre."<br>";
            }else{
                $mensaje.="Nombre no es correcto".$nombre."<br>";
            }

            if(is_numeric(openssl_decrypt($_POST['precio'], COD, KEY))){
                $precio=openssl_decrypt($_POST['precio'], COD, KEY);
                $mensaje.="Precio: ".$precio."<br>";
            }else{
                $mensaje.="Precio no es correcto".$precio."<br>";
            }

            if(is_numeric(openssl_decrypt($_POST['cantidad'], COD, KEY))){
                $cantidad=openssl_decrypt($_POST['cantidad'], COD, KEY);
                $mensaje.="Cantidad: ".$cantidad."<br>";
            }else{
                $mensaje.="Cantidad no es correcta".$cantidad."<br>";
            }

        if(!isset($_SESSION['carrito'])){
            $producto=array(
                'ID'=>$id,
                'Nombre'=>$nombre,
                'Precio'=>$precio,
                'Cantidad'=>$cantidad
            );
            $_SESSION['carrito'][0]=$producto;
            $mensaje="Producto agregado al carrito";
        }else{
            $idAgregado=array_column($_SESSION['carrito'], "ID");

            if(in_array($id, $idAgregado)){
                echo "<script>alert('El producto ya ha sido agregado...')</script>";
                $mensaje="";
            }else{
            $numeroProductos=count($_SESSION['carrito']);
            $producto=array(
                'ID'=>$id,
                'Nombre'=>$nombre,
                'Precio'=>$precio,
                'Cantidad'=>$cantidad
            );
            $_SESSION['carrito'][$numeroProductos]=$producto;
            $mensaje="Producto agregado al carrito";
            }
        }
        //$mensaje=print_r($_SESSION, true);

        break;

        case 'Eliminar':

            if(is_numeric(openssl_decrypt($_POST['id'], COD, KEY))){
                $id=openssl_decrypt($_POST['id'], COD, KEY);

                foreach($_SESSION['carrito'] as $indice=>$producto) {
                    
                    if($producto['ID']==$id){
                    unset($_SESSION['carrito'][$indice]);
                    //echo "<script>alert('Producto eliminado')</script>";
                    }

                }

            }else{
                $mensaje.="Identificador no es correcto".$id."<br>";
            }

        break;

    }
}

?>