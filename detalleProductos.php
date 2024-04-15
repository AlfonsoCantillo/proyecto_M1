<?php 
  require_once 'includes/conexion.php';
  require_once 'gestionProductos.php';
  
  session_start();  
  $item = 0;
  if (isset($_SESSION['item'])) {
    $item = $_SESSION['item'];
  }
  
  if (isset($_GET['producto'])) {
    $p = $_GET['producto'];
  }else $p = null;  
  $productos = consultarProductos($p);
  
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Tienda Con Estilo</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
  </head>
  <body>
      <!-- Navigation-->
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container px-4 px-lg-5">
          <a class="navbar-brand" href="index.php"><img src="img/logoTE.png" width="101px" height="70px"></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php">Inicio</a></li>
                <li class="nav-item"><a class="nav-link" href="#!">Nosotros</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Tienda</a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Productos</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="#!">Mas populares</a></li>
                        <li><a class="dropdown-item" href="#!">Nuevo Catálogo</a></li>
                    </ul>
                </li>
            </ul>
            <form class="d-flex" action="carro.php">
              <button class="btn btn-outline-dark" type="submit">
                  <i class="bi-cart-fill me-1"></i>                  
                  <span class="badge bg-dark text-white ms-1 rounded-pill" id="carro"><?php echo $item; ?></span>
              </button>
            </form>
          </div>
        </div>
      </nav>
      <!-- Header-->
      <header class="bg-primary py-1">
          <div class="container px-4 px-lg-5 my-5">
              <div class="text-center text-white">
                  <h1 class="display-4 fw-bolder">Tienda Con Estilo</h1>
                  <p class="lead fw-normal text-white-50 mb-0" style="font-size: 1.8rem;">
                    Diseño & Elegancia
                  </p>
              </div>
          </div>
      </header>
      
      <!-- Product section-->
      <section class="py-1">
        <?php 
          foreach ($productos as $item => $producto) {                
        ?>
          <div class="container px-2 px-lg-5 my-5">
            <div class="row gx-4 gx-lg-5 align-items-center">
                <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="img/productos/<?php echo $producto->imagen; ?>" alt="..." /></div>
                <div class="col-md-6">
                  <div class="small mb-1">SKU: <?php echo $producto->codigo; ?></div>
                  <h1 class="display-5 fw-bolder"><?php echo $producto->nombre; ?></h1>
                  <div class="fs-5 mb-2">
                    <span class="text-decoration-line-through">$45.00</span>
                    <span><?php echo '$ '.number_format($producto->precio,0); ?></span>
                  </div>
                  <p class="lead"><?php echo $producto->descripcion; ?></p>
                  <p class="lead">Cantidades disponibles: <?php echo $producto->existencias; ?></p>
                  <div class="d-flex">
                      <input class="form-control text-center me-3" id="cantidad" type="num" value="1" style="max-width: 5rem" />
                      <button class="btn btn-outline-dark flex-shrink-0" type="button" id="btnadd" onclick="agregarCarro('<?php echo $producto->codigo; ?>','<?php echo $producto->existencias; ?>')">
                          <i class="bi-cart-fill me-1"></i>
                          Agregar al carro
                      </button>
                  </div>
                </div>
            </div>
          </div>
        <?php } ?>
      </section>


      <!-- Footer-->
      <footer class="py-5 bg-dark">
          <div class="container"><p class="m-0 text-center text-white">Copyright &copy; tiendaestilo.com 2024</p></div>
      </footer>
      <!-- Bootstrap core JS-->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
      <!-- Core theme JS-->
      <script src="js/scripts.js"></script>
      <script src="js/gestionProductos.js"></script>
  </body>
</html>