<!doctype html>
<html lang="zh-Hant-TW">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel='stylesheet' href='../css/bootstrap.css'>
    
    <title>Database</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">
          <a class="navbar-brand " href="purchase_index.php">啟勝電機行</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
              <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                  <li class="nav-item">
                      <a class="nav-link" href="purchase_index.php">Home</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="purchase_new_order.php">新增訂單</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="purchase_new_purchase_order.php">訂單彙整</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="purchase_purchasing.php">採購</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="purchase_goods_check.php">盤點確認</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="purchase_exchange.php">換貨</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="purchase_exchange_check.php">換貨到貨</a>
                  </li>
              </ul>
              <span class="navbar-text me-3">採購系統</span>
              <a href="logout.php" class="btn btn-secondary">登出</a>
              </a>
          </div>
      </div>
  </nav>
    <!-- Bootstrap JS -->
    <script src="../js/bootstrap.bundle.js"></script>
  </body>
</html>
<!doctype html>
<html lang="zh-Hant-TW">
  <head>
  <?php 
session_start(); 
$_SESSION = array(); 
session_destroy(); 

?>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel='stylesheet' href='../css/bootstrap.css'>
    
    <!-- Custom CSS -->
    <style>
      .gradient-custom {
        background: #26467e;
        background: linear-gradient(132deg, rgba(23,54,106,1) 0%, rgba(38,70,126,1) 35%, rgba(116,106,187,1) 72%, rgba(180,106,187,1) 100%);
      }
      .bg-glass {
        background-color: rgba(220, 220, 220, 0.8) !important;
        backdrop-filter: saturate(200%) blur(25px);
      }
      .card-rounded{
        border-radius: 1.3rem;
      }
    </style>
    <title>Database</title>
  </head>
  <body class="min-vh-100 gradient-custom">
    <script src="header.js"></script>
    <script>document.write(header);</script>
    <div class="container my-5 p-4 bg-glass rounded">
      <div class="row g-3 g-md-5">
        <div class="col-lg-3">
          <div class="card h-100 card-rounded">
            <div class="card-header fs-2 fw-bold">未彙整訂單: 7</div>
            <div class="card-body font-monospace">
              <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam congue erat sit ametLorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam congue erat sit amet felis pellentesque interdum.</p>
            </div>
            <div class="card-footer">
              <a href="purchase_new_order.php" class="btn btn-primary mx-1">新增訂單</a>
              <a href="purchase_new_purchase_order.php" class="btn btn-primary mx-1">訂單彙整</a>
            </div>
          </div>
        </div>
        <div class="col-lg-3">
          <div class="card h-100 card-rounded">
            <div class="card-header fs-2 fw-bold">未採購: 8</div>
            <div class="card-body font-monospace">
              <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam congue erat sit ametLorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam congue erat sit amet felis pellentesque interdum.</p>
            </div>
            <div class="card-footer">
              <a href="purchase_purchasing.php" class="btn btn-primary mx-1">採購</a>
            </div>
          </div>
        </div>
        <div class="col-lg-3">
          <div class="card h-100 card-rounded">
            <div class="card-header fs-2 fw-bold">採購未到貨: 15</div>
            <div class="card-body font-monospace">
              <p class="card-text">Praesent volutpat volutpat felis sit amet pretium. In accumsan diam a ligula accumsan pulvinar. Nulla ut erat eget elit faucibus eleifend sed vel tellus. Duis non pretium orci.</p>
            </div>
            <div class="card-footer">
              <a href="goods_check.html" class="btn btn-primary mx-1">盤點</a>
              <a href="purchase_exchange.php" class="btn btn-primary mx-1">換貨</a>
            </div>
          </div>
        </div>
        <div class="col-lg-3">
          <div class="card h-100 card-rounded">
            <div class="card-header fs-2 fw-bold">換貨未到貨: 2</div>
            <div class="card-body font-monospace">
              <p class="card-text">Nam ipsum elit, vehicula imperdiet tempus vel, porttitor vestibulum justo. Donec vitae egestas arcu, sed sollicitudin velit. Aenean blandit elementum justo sed fermentum.</p>
              <p class="card-text"></p>
            </div>
            <div class="card-footer">
              <a href="purchase_exchange_check.php" class="btn btn-primary mx-1">換貨到貨</a>
             
            </div>
          </div>
        </div>
      </div>
      
    </div>
  

    <script>
      [].forEach.call(document.querySelectorAll('a'), function(elem) {
        if (elem.pathname === window.location.pathname)
          elem.classList.add('active')
        else
          elem.classList.remove('active')
      })
    </script>
    <!-- Bootstrap JS -->
    <script src="../js/bootstrap.bundle.js"></script>
  </body>
</html>