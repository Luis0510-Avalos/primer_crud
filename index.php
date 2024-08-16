<?php include "conexion.php" ?>

<?php
session_start();

// Recibe información del usuario logueado
if (isset($_SESSION['usuario']) != "Luis") {
    header("location:login.php");
}



// Insertar información
if ($_POST) {
    $i = $_POST['id_trabajador'];
    $n = $_POST['nombre'];
    $e = $_POST['edad'];
    $d = $_POST['direccion'];
    $p = $_POST['puesto'];

    if ($i) {
        $stmt = $conexion->prepare('UPDATE trabajadores SET nombre = ?, edad = ?, direccion = ?, puesto = ? WHERE id = ?');
        $stmt->execute([$n, $e, $d, $p, $i]);
    } else {
        $stmt = $conexion->prepare('INSERT INTO trabajadores (nombre, edad, direccion, puesto) VALUES (?, ?, ?, ?)');
        $stmt->execute([$n, $e, $d, $p]);
    }
    header("location:index.php");
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


// Eliminar información
if (isset($_GET['borrar'])) {
    $idee = $_GET['borrar'];
    $sql = "DELETE FROM `trabajadores` WHERE `trabajadores`.`id` = " . $idee;
    $conexion->exec($sql);
    header("location:index.php");
}


// Consultar la información para mostrar en una tabla
$sql = "SELECT * FROM `trabajadores`";
$sentencia = $conexion->prepare($sql);
$sentencia->execute();
$resultado = $sentencia->fetchAll();



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
            <div class="col-md-5">
                <br>

                <!-- Modal para agregar información -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Agregar</button>

                <!-- Modal -->
                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel"><?php echo $nombre ? 'Actualizar' : 'Agregar'; ?></h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

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
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                        <input type="submit" class="btn btn-primary" value="<?php echo $nombre ? 'Actualizar' : 'Agregar'; ?>">
                                    </div>
                                    
                                </form>
                            </div>
                        </div>
                    </div>
                </div>




            </div>

            <div class="col-md-7">
                <br>
                <div class="table-responsive">
                    <table class="table table-primary text-center">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Edad</th>
                                <th>Dirección</th>
                                <th>Puesto en la empresa</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($resultado as $trabajador) { ?>
                                <tr>
                                    <td><?php echo $trabajador['id']; ?></td>
                                    <td><?php echo $trabajador['nombre']; ?></td>
                                    <td><?php echo $trabajador['edad']; ?></td>
                                    <td><?php echo $trabajador['direccion']; ?></td>
                                    <td><?php echo $trabajador['puesto']; ?></td>
                                    <td>
                                        <form action="update.php" method="GET">
                                            <input type="hidden" name="editar" value="<?php echo $trabajador['id']; ?>">
                                            <button type="submit" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Editar</button>
                                        </form>
                                        |
                                        <a href="?borrar=<?php echo $trabajador['id']; ?>" class="btn btn-danger">Eliminar</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

            </div>

        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>