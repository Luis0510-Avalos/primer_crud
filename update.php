<?php include "conexion.php" ?>

<?php
session_start();

// Recibe información del usuario logueado
if (isset($_SESSION['usuario']) != "Luis") {
    header("location:login.php");
}


$ide = "";
$nombre = "";
$edad = "";
$direccion = "";
$puesto = "";


// Mostrar datos de la actualización
if (isset($_GET['editar'])) {
    $ide = $_GET['editar'];
    $sqli = "SELECT * FROM `trabajadores` WHERE `trabajadores`.`id` = " . $ide;
    $op = $conexion->prepare($sqli);
    $op->execute();
    $chamba = $op->fetchAll();

    foreach ($chamba as $dato) {
        $ide = $dato['id'];
        $nombre = $dato['nombre'];
        $edad = $dato['edad'];
        $direccion = $dato['direccion'];
        $puesto = $dato['puesto'];
    }
}


?>

<!doctype html>
<html lang="en">

<head>
    <title>PÁGINA PRINCIPAL</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4">

            </div>

            <div class="col-md-4">

                <form action="index.php" method="POST">

                    <input type="hidden" name="id_trabajador" value="<?php echo (isset($ide)) ? $ide : " "; ?>">
                    <label for="nombre" class="form-label">Nombre:</label>
                    <input type="text" name="nombre" class="form-control" id="nombre" value="<?php echo (isset($nombre)) ? $nombre : ""; ?>">
                    <br>
                    <label for="edad" class="form-label">Edad:</label>
                    <input type="text" name="edad" class="form-control" id="edad" value="<?php echo (isset($edad)) ? $edad : ""; ?>">
                    <br>
                    <label for="direccion" class="form-label">Dirección:</label>
                    <input type="text" name="direccion" class="form-control" id="direccion" value="<?php echo (isset($direccion)) ? $direccion : ""; ?>">
                    <br>
                    <label for="puesto" class="form-label">Puesto en la empresa:</label>
                    <input type="text" name="puesto" class="form-control" id="puesto" value="<?php echo (isset($puesto)) ? $puesto : ""; ?>">
                    <br>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button> 
                        <input type="submit" class="btn btn-primary" value="<?php echo $nombre ? 'Actualizar' : 'Agregar'; ?>">

                </form>

            </div>

        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>