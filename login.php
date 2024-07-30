
<?php
session_start();

if($_POST){

    if(($_POST['usuario']=="Luis") && ($_POST['contrasena']=="1234")){
        $_SESSION['usuario']="Luis";
        header("location:index.php");
    }else{
        echo "<script>alert('Usuario y/o contraseña incorrecta');</script>";
    }

}

?>

<!doctype html>
<html lang="en">
    <head>
        <title>LOGIN</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
    </head>

    <div class="container">
        <div class="row">

            <div class="col-md-4"></div>

            <div class="col-md-4">
                <br>

                <div class="card">
                    <div class="card-header">Iniciar sesión</div>
                    <div class="card-body">

                        <form action="login.php" method="POST">
                            <label for="usuario" class="form-label">Nombre del proyecto:</label>
                            <input type="text" name="usuario" class="form-control" id="usuario">
                            <br>
                            <label for="contrasena" class="form-label">Contraseña:</label>
                            <input type="text" name="contrasena" class="form-control" id="contrasena">
                            <br><br>
                            <input type="submit" class="btn btn-primary" value="Enviar">
                        </form>

                    </div>
                </div>
                
            </div>

            <div class="col-md-4"></div>

        </div>
        
    </div>
    

    <body>

    </body>
</html>
