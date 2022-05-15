<?php include("cabecera.php"); ?>
<?php include("conexion.php"); ?>
<?php

$objConexion = new conexion();
$proyecto = $objConexion->consultar('SELECT * FROM `proyecto`');

?>
<div class="p-5 bg-light">
    <div class="container">
        <h1 class="display-3">Bienvenid@s</h1>
        <p class="lead">Este portafolio es de Nicolás Galaz</p>
        <hr class="my-2">
        <p>Más Información</p>
        <!-- <p class="lead">
            <a class="btn btn-primary btn-lg" href="Jumbo action link" role="button">Jumbo action name</a>
        </p> -->
    </div>
</div>

<div class="row row-cols-1 row-cols-md-3 g-4">
    <?php foreach ($proyecto as $proyecto) { ?>
        <div class="col">
            <div class="card">
                <img class="card-img-top" src="./img/<?php echo $proyecto['imagen']; ?>" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $proyecto['nombre']; ?></h5>
                    <p class="card-text"><?php echo $proyecto['descripcion']; ?></p>
                </div>
                <div class="card-footer">
                    <small class="text-muted"> Registro creado en el <?php echo $proyecto['fecha']; ?></small>
                </div>
            </div>
        </div>
    <?php } ?>
</div>
<?php include("pie.php"); ?>