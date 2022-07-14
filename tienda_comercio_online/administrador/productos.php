<?php

include "template/header.php";
include "global/config.php";
include "global/conexion.php";

?>

<?php

$id=(isset($_POST['id']))?$_POST['id']:"";
$nombre=(isset($_POST['nombre']))?$_POST['nombre']:"";
$precio=(isset($_POST['precio']))?$_POST['precio']:"";
$descripcion=(isset($_POST['descripcion']))?$_POST['descripcion']:"";
$imagen=(isset($_FILES['imagen']['name']))?$_FILES['imagen']['name']:"";
$accion=(isset($_POST['accion']))?$_POST['accion']:"";

switch($accion){

    case 'crear':

        $sentencia=$pdo->prepare("INSERT INTO productos (ID, Nombre, Precio, Descripcion, Imagen)
        VALUES (NULL, :Nombre, :Precio, :Descripcion, :Imagen);");
        
        $sentencia->bindParam(":Nombre", $nombre);
        $sentencia->bindParam(":Precio", $precio);
        $sentencia->bindParam(":Descripcion", $descripcion);

        $fecha= NEW DateTime();
        $nombreArchivo=($imagen!="")?$fecha->getTimestamp()."_".$_FILES["imagen"]["name"]:"imagen.jpg";
        $tmpImagen=$_FILES["imagen"]["tmp_name"];

        if($tmpImagen!=""){
            move_uploaded_file($tmpImagen,"../img/".$nombreArchivo);
        }

        $sentencia->bindParam(":Imagen", $nombreArchivo);

        $sentencia->execute();

        header('Location: productos.php');

    break;

    case 'editar':

        $sentencia=$pdo->prepare("UPDATE productos SET Nombre=:Nombre, Precio=:Precio, Descripcion=:Descripcion WHERE ID=:ID");
        $sentencia->bindParam(":Nombre", $nombre);
        $sentencia->bindParam(":Precio", $precio);
        $sentencia->bindParam(":Descripcion", $descripcion);
        $sentencia->bindParam(":ID", $id);
        $sentencia->execute();

        if($imagen!=""){

            $fecha= NEW DateTime();
            $nombreArchivo=($imagen!="")?$fecha->getTimestamp()."_".$_FILES["imagen"]["name"]:"imagen.jpg";
            $tmpImagen=$_FILES["imagen"]["tmp_name"];
            move_uploaded_file($tmpImagen,"../img/".$nombreArchivo);

            $sentencia=$pdo->prepare("SELECT Imagen FROM productos WHERE ID=:ID");
            $sentencia->bindParam(":ID", $id);
            $sentencia->execute();
            $producto=$sentencia->fetch(PDO::FETCH_LAZY);

        if(isset($producto["Imagen"]) && ($producto["Imagen"]!="imagen.jpg")){

            if(file_exists("../img/".$producto["Imagen"])){
                unlink("../img/".$producto["Imagen"]);
            }
        }

            $sentencia=$pdo->prepare("UPDATE productos SET Imagen=:Imagen WHERE ID=:ID");
            $sentencia->bindParam(":Imagen", $$nombreArchivo);
            $sentencia->bindParam(":ID", $id);
            
        }

        header('Location: productos.php');

    break;

    case 'eliminar':

        $sentencia=$pdo->prepare("SELECT Imagen FROM productos WHERE ID=:ID");
        $sentencia->bindParam(":ID", $id);
        $sentencia->execute();
        $producto=$sentencia->fetch(PDO::FETCH_LAZY);

        if(isset($producto["Imagen"]) && ($producto["Imagen"]!="imagen.jpg")){

            if(file_exists("../img/".$producto["Imagen"])){
                unlink("../img/".$producto["Imagen"]);
            }
        }
 
        $sentencia=$pdo->prepare("DELETE FROM productos WHERE ID=:ID");
        $sentencia->bindParam(":ID", $id);
        $sentencia->execute();

        header('Location: productos.php');
    
        break;

    case 'seleccionar':

        $sentencia=$pdo->prepare("SELECT * FROM productos WHERE ID=:ID");
        $sentencia->bindParam(":ID", $id);
        $sentencia->execute();
        $producto=$sentencia->fetch(PDO::FETCH_LAZY);

        $nombre=$producto['Nombre'];
        $precio=$producto['Precio'];
        $descripcion=$producto['Descripcion'];
        $imagen=$producto['Imagen'];
   
        break;

    case 'cancelar':

        header('Location: productos.php');

        break;

}

        $sentencia=$pdo->prepare("SELECT * FROM productos");
        $sentencia->execute();
        $listaProductos=$sentencia->fetchall(PDO::FETCH_ASSOC);

?>

<div class="col-md-4">
<div class="card">
    <div class="card-header">
        Formulario de productos
    </div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
            <label for="id">ID</label>
            <input type="number" required readonly class="form-control" id="id" name="id" value="<?php echo $id; ?>" placeholder="Identificador">
            </div>
            <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" required class="form-control" id="nombre" name="nombre" value="<?php echo $nombre; ?>" placeholder="Nombre">
            </div>
            <div class="form-group">
            <label for="precio">Precio</label>
            <input type="number" step="any" required class="form-control" id="precio" name="precio" value="<?php echo $precio; ?>" placeholder="Precio">
            </div>
            <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea type="text" rows="1" cols="" required class="form-control" id="descripcion" name="descripcion" value="" placeholder="Descripción"><?php echo $descripcion; ?></textarea>
            </div>
            <div class="form-group">
            <label for="imagen">Imagen</label><br>

            <?php if($imagen!="") { ?>
                <img src="../img/<?php echo $imagen; ?>" class="img-thumbnail rounded" width="45px" height="55px" alt="Imagen">
            <?php } ?>
            
            <input type="file" class="form-control" id="imagen" name="imagen" placeholder="Imagen">
            </div><br>
            <div class="d-grid gap-1 d-md-flex justify-content-md-center">
                <button type="submit" name="accion" value="crear" <?php echo ($accion=="seleccionar")?"disabled":""; ?> class="btn btn-success rounded">Agregar</button>
                <button type="submit" name="accion" value="editar" <?php echo ($accion!="seleccionar")?"disabled":""; ?> class="btn btn-warning rounded">Editar</button>
                <button type="submit" name="accion" value="eliminar" <?php echo ($accion!="seleccionar")?"disabled":""; ?>  onclick="return confirm('¿Seguro que quieres eliminar?')" class="btn btn-danger rounded">Borrar</button>
                <button type="submit" name="accion" value="cancelar" <?php echo ($accion!="seleccionar")?"disabled":""; ?> class="btn btn-secondary rounded">Cancelar</button>
            </div>
        </form>
    </div>
</div>
</div>
<div class="col-md-8">
    <div class="card card-header">
        Lista de productos
    </div>
    <table class="table table-bordered" id="tabla">
        <thead>
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Descripción</th>
                <th>Imagen</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($listaProductos as $producto) { ?>
            <tr>
                <td><?php echo $producto['ID']; ?></td>
                <td><?php echo $producto['Nombre']; ?></td>
                <td><?php echo $producto['Precio']; ?></td>
                <td><textarea rows="" cols="25"><?php echo $producto['Descripcion']; ?></textarea></td>
                <td><img src="../img/<?php echo $producto['Imagen']; ?>" class="img-thumbnail rounded" width="45px" height="55px" alt="Imagen"></td>
                <td>
                    <form action="" method="post">
                        <input type="hidden" name="id" id="id" value="<?php echo $producto['ID']; ?>">
                        <div class="d-grid gap-1 d-md-flex justify-content-md-center">
                            <button class="btn btn-primary rounded" name="accion" value="seleccionar" type="submit">Aceptar</button>
                        </div>
                    </form>  
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<script src="js/javaScript.js"></script>

<?php include "template/footer.php"; ?>