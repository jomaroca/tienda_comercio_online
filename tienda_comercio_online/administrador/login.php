<?php

session_start();
    if($_POST){
        if(($_POST['usuario']=="Administrador")&&($_POST['contrasena']=="negocio")){
            $_SESSION['usuario']="superAdmin";
            $_SESSION['administrador']="Administrador";
            header('Location: inicio.php');
        }
        $mensaje="El usuario o contraseña son incorrectos";
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Mi Sitio Web</title>
</head>
<body>
    <div class="container"><br><br><br>
        <div class="row">
            <div class="col-md-4">
                
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Login
                    </div>
                    <div class="card-body">

                    <?php if(isset($mensaje)) { ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $mensaje; ?>
                        </div>
                    <?php } $mensaje; ?>

                        <form action="" method="post">
                        <div class = "form-group">
                        <label for="validationDefault01">Usuario</label>
                        <input type="text" class="form-control" id="validationDefault01" name="usuario" aria-describedby="emailHelp" placeholder="Introduce usuario" required>
                        </div>
                        <div class="form-group">
                        <label for="validationDefault02">Contraseña</label>
                        <input type="password" class="form-control" id="validationDefault02" name="contrasena" placeholder="Introduce contraseña" required>
                        </div><br>
                        <button type="submit" class="btn btn-secondary rounded">Entrar</button>
                        </form>
                           
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</body>
</html>