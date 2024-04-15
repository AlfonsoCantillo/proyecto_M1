<?php 
  require_once 'includes/conexion.php';
  require_once 'gestionProductos.php';
  $productos = consultarProductos(null);
  session_start();
  $item = 0;
  if (isset($_SESSION['item'])) {
    $item = $_SESSION['item'];
  }
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
                <span class="badge bg-dark text-white ms-1 rounded-pill"><?php echo $item; ?></span>
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
      <!-- Section-->
      <section class="py-5">
        <div class="container px-4 px-lg-5 mt-2">
          <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            <?php 
              foreach ($productos as $item => $producto) {                
            ?>
              <div class="col mb-5">
                <div class="card h-100">
                  <!-- Product image-->
                  <img class="card-img-top" src="img/productos/<?php echo $producto->imagen;  ?>" alt="..." />
                  <!-- Product details-->
                  <div class="card-body p-4">
                    <div class="text-center">
                      <!-- Product name-->
                      <h5 class="fw-bolder"><?php echo $producto->nombre; ?></h5>
                      <div class="d-flex justify-content-center small text-warning mb-2">
                        <div class="bi-star-fill"></div>
                        <div class="bi-star-fill"></div>
                        <div class="bi-star-fill"></div>
                        <div class="bi-star-fill"></div>
                        <div class="bi-star-fill"></div>
                      </div>
                      <!-- Product price-->
                      <?php echo '$' .number_format($producto->precio); ?>
                    </div>
                  </div>
                  <!-- Product actions-->
                  <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                    <div class="text-center">
                      <a class="btn btn-outline-dark mt-auto" href="detalleProductos.php?producto=<?php echo base64_encode($producto->codigo); ?>">Ver producto</a>
                    </div>
                  </div>
                </div>
              </div>
            <?php } ?>              
          </div>
        </div>
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