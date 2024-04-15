<?php 
  require_once 'includes/conexion.php';
  require_once 'gestionProductos.php';
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
            <form class="d-flex">
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
      
      <!-- Page content-->
      <section class="py-1">
        <div class="container px-2 px-lg-5 my-2">
          <div class="row">            
            <div class="col-lg-9 pe-5">
              <div class="row">
                <div class="col-12 mb-3">
                  <h5>Carro de compras</h3>
                </div>
              </div>
              <?php 
                if (isset($_SESSION['carrito'])) {                  
                  $arr1 = array();                  
                  $dat = explode('|',$_SESSION['carrito']);

                  foreach ($dat as $value) {                    
                    $x = json_decode($value);
                    $arr1[] = [$x->codigo,$x->cantidad];                                  
                  }

                  //Unificar
                  $long= count($arr1);
                  //print_r($arr1);
                  for ($i=0; $i < $long ; $i++) { 
                    $cod = $arr1[$i][0];                    
                    $sw  = 0;
                    for ($j=0; $j < $long ; $j++) { 
                      if ($i != $j) {
                        if ($arr1[$j][0] == $cod) {
                          $arr1[$i][1] += $arr1[$j][1];
                          $arr1[$j][0] = null;
                          $arr1[$j][1] = 0;                     
                          $k[]  = $j;
                        }
                      }
                    }
                  }
                  if (isset($k)) {
                    foreach ($k as $key => $value) {
                      unset($arr1[$value]);
                    }
                  }
                }              
              ?>

              <?php 
              $total = 0;
              foreach ($arr1 as $key => $value) {                
                $cantidad = $value[1];
                $p = base64_encode($value[0]);                                                     
                $productos = consultarProductos($p);
                
                foreach ($productos as $item => $producto) {
                  $total += $cantidad * $producto->precio;
              ?>
              <div class="row">
                <div class="col-2">
                  <img class="card-img-top" src="img/productos/<?php echo $producto->imagen;  ?>" alt="..." />
                </div>
                <div class="col-6">
                  <p class="fw-normal mb-0" style="font-size:16px;">
                    <?php echo $producto->nombre; ?>
                  </p>
                  <p class="fw-normal mb-1" style="font-size:14px;">
                    Código <?php echo $producto->codigo; ?>
                  </p>                  
                </div>
                <div class="col-2">
                  <input class="form-control text-center me-3" id="cantidad1" type="num" value="<?php echo $cantidad; ?>" style="max-width: 5rem" />
                </div>
                <div class="col-2">
                  <p class="fw-normal mb-0 float-end" style="font-size:16px;">
                    <?php echo '$ '.number_format($producto->precio,0); ?>
                  </p>
                </div>
              </div>
              <hr>
              <?php }}?>
              <div class="row">
                <div class="col-10">
                  <p class="fw-normal mb-0 float-end" style="font-size:16px;">
                    Total Productos:
                  </p>
                </div>
                <div class="col-2">
                  <div class="float-end">
                    <?php echo '$ '.number_format($total,0); ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 ps-2">
              <div class="row">
                <div class="col-12 mb-3">
                  <h5>Resumen de tu compra</h3>
                </div>                
              </div>
              <div class="row">
                <div class="col-6">
                  <p class="fw-normal " style="font-size:16px;">
                    Subtotal: 
                  </p>
                </div> 
                <div class="col-6">
                  <p class="fw-normal float-end" style="font-size:16px;">
                    <?php 
                      $subtotal= $total-($total*0.19);
                      echo '$ '.number_format($subtotal,2);
                    ?>
                  </p>
                </div>                
              </div>
              <div class="row">
                <div class="col-6">
                  <p class="fw-normal" style="font-size:16px;">
                    Impuestos: 
                  </p>
                </div> 
                <div class="col-6">
                  <p class="fw-normal float-end" style="font-size:16px;">
                    <?php 
                      $iva= ($total*0.19);
                      echo '$ '.number_format($iva,2);
                    ?>
                  </p>
                </div>                
              </div>
              <hr>
              <div class="row">
                <div class="col-6">
                  <p class="fw-normal fw-bold" style="font-size:16px;">
                    Total a Pagar: 
                  </p>
                </div> 
                <div class="col-6">
                  <p class="fw-normal float-end fw-bold" style="font-size:16px;">
                    <?php                       
                      echo '$ '.number_format($total,2);
                    ?>
                  </p>
                </div>                
              </div>
              <div class="row">
                <div class="col-12">
                  <button class="btn btn-outline-dark flex-shrink-0" type="button" id="btnaprobar">
                      <i class="bi-cart-fill me-1"></i>
                      Aprobar Compra
                  </button>
                </div>
              </div>
            </div>
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