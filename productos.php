<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="style/productos.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Inicio</title>
  </head>
  <body>
       <div class="body container">
            <div class="row row-cols-1 row-cols-md-12 g-1">
                <div class="filtros container-sm col-3">
                    <div class="accordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                              <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                                Categorias
                              </button>
                            </h2>
                            <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
                              <div class="accordion-body">
                                <ul class="list-group">
                                  <li class="">
                                    <input class="form-check-input me-1" type="checkbox" value="" aria-label="...">
                                    Aerosoles
                                  </li>
                                  <li class="">
                                    <input class="form-check-input me-1" type="checkbox" value="" aria-label="...">
                                    Esmaltes y Látex
                                  </li>
                                  <li class="">
                                    <input class="form-check-input me-1" type="checkbox" value="" aria-label="...">
                                    Pinturas Especiales
                                  </li>
                                  <li class="">
                                    <input class="form-check-input me-1" type="checkbox" value="" aria-label="...">
                                    Impermeabilizantes
                                  </li>
                                </ul>
                              </div>
                            </div>
                       </div>
                    </div>
                    
                </div>
                <?php
                    $where = " where 1=1 ";
                    $nombre = mysqli_real_escape_string($con, $_REQUEST['nombre'] ?? '');
                    if (empty($nombre) == false) {
                        $where = "and nombre like '%" . $nombre . "%'";
                    }
                    $queryCuenta = "SELECT COUNT(*) as cuenta FROM productos  $where ;";
                    $resCuenta = mysqli_query($con, $queryCuenta);
                    $rowCuenta = mysqli_fetch_assoc($resCuenta);
                    $totalRegistros = $rowCuenta['cuenta'];

                    $elementosPorPagina = 6;

                    $totalPaginas = ceil($totalRegistros / $elementosPorPagina);

                    $paginaSel = $_REQUEST['pagina'] ?? false;

                    if ($paginaSel == false) {
                        $inicioLimite = 0;
                        $paginaSel = 1;
                    } else {
                        $inicioLimite = ($paginaSel - 1) * $elementosPorPagina;
                    }
                    $limite = " limit $inicioLimite,$elementosPorPagina ";
                    $query = "SELECT 
                                        p.id,
                                        p.nombre,
                                        p.precio,
                                        p.existencia,
                                        f.web_path
                                        FROM
                                        productos AS p
                                        INNER JOIN productos_files AS pf ON pf.producto_id=p.id
                                        INNER JOIN files AS f ON f.id=pf.file_id
                                        $where
                                        GROUP BY p.id
                                        $limite
                                        ";
                    $res = mysqli_query($con, $query);
                    while ($row = mysqli_fetch_assoc($res)) {
                ?>
                <div class="productos container col-9">
                    <div class="row row-cols-1 row-cols-md-3 g-1">
                          <div class="col">
                            <div class="card producto">
                                <img class="card-img-top img-thumbnail" src="<?php echo $row['web_path'] ?>"  alt="">
                                <div class="titulo_producto">
                                    <h4>
                                       <?php echo $row['nombre'] ?><?php echo $row['nombre'] ?>
                                    </h4>
                                </div>
                                <div class="stock_content">
                                    <p class="stock">
                                        <?php echo $row['existencia'] ?>
                                    </p>
                                </div>
                                <div class="price_action">
                                    <div class="oferta">
                                        <span class="price">$2400</span><span class="price_text">antes</span>
                                    </div>
                                     <div class="contado">
                                        <span class="price"><?php echo $row['precio'] ?></span><span class="price_text">CONTADO</span>
                                    </div>
                                    <a href="index.php?modulo=detalleproducto&id=<?php echo $row['id'] ?>" class="btn btn-success">Agregar al Carrito</a>
                                </div>
                            </div>
                          </div>
                    
                    <?php
                    }
                    ?>
                    </div>
                    <?php
                    if ($totalPaginas > 0) {
                    ?>
                    <nav aria-label="Page navigation">
                        <ul class="pagination">
                            <?php
                            if ($paginaSel != 1) {
                            ?>
                                <li class="page-item">
                                    <a class="page-link" href="index.php?modulo=productos&pagina=<?php echo ($paginaSel - 1); ?>" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                </li>
                            <?php
                            }
                            ?>

                            <?php
                            for ($i = 1; $i <= $totalPaginas; $i++) {
                            ?>
                                <li class="page-item <?php echo ($paginaSel == $i) ? " active " : " "; ?>">
                                    <a class="page-link" href="index.php?modulo=productos&pagina=<?php echo $i; ?>"><?php echo $i; ?></a>
                                </li>
                            <?php
                            }
                            ?>
                            <?php
                            if ($paginaSel != $totalPaginas) {
                            ?>
                                <li class="page-item">
                                    <a class="page-link" href="index.php?modulo=productos&pagina=<?php echo ($paginaSel + 1); ?>" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </li>
                            <?php
                            }
                            ?>
                        </ul>
                    </nav>
                    <?php
                    }
                    ?>
                        
                        
                        
                </div>
            </div>
        </div>
    
    
    
    
    
    

        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    </body>
</html>
=======
<div class="row mt-1">
    <?php
    $where = " where 1=1 ";
    $nombre = mysqli_real_escape_string($con, $_REQUEST['nombre'] ?? '');
    if (empty($nombre) == false) {
        $where = "and nombre like '%" . $nombre . "%'";
    }
    $queryCuenta = "SELECT COUNT(*) as cuenta FROM productos  $where ;";
    $resCuenta = mysqli_query($con, $queryCuenta);
    $rowCuenta = mysqli_fetch_assoc($resCuenta);
    $totalRegistros = $rowCuenta['cuenta'];

    $elementosPorPagina = 6;

    $totalPaginas = ceil($totalRegistros / $elementosPorPagina);

    $paginaSel = $_REQUEST['pagina'] ?? false;

    if ($paginaSel == false) {
        $inicioLimite = 0;
        $paginaSel = 1;
    } else {
        $inicioLimite = ($paginaSel - 1) * $elementosPorPagina;
    }
    $limite = " limit $inicioLimite,$elementosPorPagina ";
    $query = "SELECT 
                        p.id,
                        p.nombre,
                        p.precio,
                        p.existencia,
                        f.web_path
                        FROM
                        productos AS p
                        INNER JOIN productos_files AS pf ON pf.producto_id=p.id
                        INNER JOIN files AS f ON f.id=pf.file_id
                        $where
                        GROUP BY p.id
                        $limite
                        ";
    $res = mysqli_query($con, $query);
    while ($row = mysqli_fetch_assoc($res)) {
    ?>
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="card border-primary">
                <img class="card-img-top img-thumbnail" src="<?php echo $row['web_path'] ?>" alt="">
                <div class="card-body">
                    <h2 class="card-title"><strong><?php echo $row['nombre'] ?></strong></h2>
                    <p class="card-text"><strong>Precio:</strong><?php echo $row['precio'] ?></p>
                    <p class="card-text"><strong>Existencia:</strong><?php echo $row['existencia'] ?></p>
                    <a href="index.php?modulo=detalleproducto&id=<?php echo $row['id'] ?>" class="btn btn-primary">Ver</a>
                </div>
            </div>
        </div>
    <?php
    }
    ?>
</div>
<?php
if ($totalPaginas > 0) {
?>
    <nav aria-label="Page navigation">
        <ul class="pagination">
            <?php
            if ($paginaSel != 1) {
            ?>
                <li class="page-item">
                    <a class="page-link" href="index.php?modulo=productos&pagina=<?php echo ($paginaSel - 1); ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span>
                    </a>
                </li>
            <?php
            }
            ?>

            <?php
            for ($i = 1; $i <= $totalPaginas; $i++) {
            ?>
                <li class="page-item <?php echo ($paginaSel == $i) ? " active " : " "; ?>">
                    <a class="page-link" href="index.php?modulo=productos&pagina=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>
            <?php
            }
            ?>
            <?php
            if ($paginaSel != $totalPaginas) {
            ?>
                <li class="page-item">
                    <a class="page-link" href="index.php?modulo=productos&pagina=<?php echo ($paginaSel + 1); ?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Next</span>
                    </a>
                </li>
            <?php
            }
            ?>
        </ul>
    </nav>
<?php
}
?>
>>>>>>> 942a682617d1f7e8d2e66d79dee136e89e843967
