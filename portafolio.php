<?php include("cabecera.php"); ?>
<?php include("conexion.php"); ?>
<?php
if ($_POST) {
    // INSERTANDDO NOMBRE DE PROYECTO
    $nombre = $_POST['nombre'];
    // INSERTANDO IMAGEN
    $fecha = new DateTime();
    $imagen = $fecha->getTimestamp() . "_" . $_FILES['archivo']['name'];
    $imagen_temporal = $_FILES['archivo']['tmp_name'];
    $fecha2 = Date('Y-m-d');

    // GUARDANDO IMAGEN EN CARPETA
    move_uploaded_file($imagen_temporal, "img/" . $imagen);
    // INSERTANDO DESCRIPPCION
    $descripcion = $_POST['descripcion'];
    $objConexion = new conexion();
    $sql = "INSERT INTO `proyecto` (`id`, `nombre`, `imagen`, `descripcion`, `fecha`) VALUES (NULL, '$nombre', '$imagen', '$descripcion', '$fecha2');";
    $objConexion->ejecutar($sql);
    // REDIRECCIONAMIENTO, PARA QUE NO NECESITE ACTUALIZAR
    header("location:portafolio.php");
}
if ($_GET) {
    $id = $_GET['borrar'];
    $objConexion = new conexion();
    $imagen = $objConexion->consultar('SELECT imagen FROM `proyecto`WHERE id=' . $id);
    unlink("img/" . $imagen[0]['imagen']);
    $sql = "DELETE FROM proyecto WHERE `proyecto`.`id` =" . $id;
    $objConexion->ejecutar($sql);
    // REDIRECCIONAMIENTO
    header("location:portafolio.php");
}
$objConexion = new conexion();
$proyecto = $objConexion->consultar('SELECT * FROM `proyecto`');
// print_r($resultado);

?>
<br>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Datos del Proyecto
                </div>
                <div class="card-body">
                    <form action="portafolio.php" method="post" enctype="multipart/form-data">
                        Nombre del Proyecto: <input required class="form-control" type="text" name="nombre">
                        <br>
                        Imagen del Proyecto: <input required class="form-control" type="file" name="archivo">
                        <br>
                        Descripción:
                        <textarea required class="form-control" name="descripcion" rows="3"></textarea>
                        <br>
                        <input type="submit" class="btn btn-success" value="Enviar Proyecto">
                    </form>
                </div>
                <div class="card-footer text-muted">

                </div>
            </div>
        </div>
        <div class="col-md-6">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Imagen</th>
                        <th>Descripción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($proyecto as $proyecto) { ?>
                        <tr>
                            <td><?php echo $proyecto['id']; ?></td>
                            <td><?php echo $proyecto['nombre']; ?></td>
                            <td><img width="90" src="./img/<?php echo $proyecto['imagen']; ?>" alt=""></td>
                            <td><?php echo $proyecto['descripcion']; ?></td>
                            <td><a class="btn btn-danger" href='?borrar=<?php echo $proyecto['id'] ?>' role="button">Eliminar</a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

    </div>
</div>





<?php include("pie.php"); ?>