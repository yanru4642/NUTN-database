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
          <a class="navbar-brand " href="shipment_index.php">啟勝電機行</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
              <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                  <li class="nav-item">
                      <a class="nav-link" href="shipment_index.php">Home</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="shipment_stock_up.php">備貨</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="shipment_hipping.php ">出貨</a>
                  </li>
              </ul>
              <span class="navbar-text me-3">出貨系統</span>
              <a href="../login.php">
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
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel='stylesheet' href='../css/bootstrap.css'>
    
    <title>Database</title>
  </head>
  <body>
    <script src="header.js"></script>
    <script> document.write(header);</script>
    <h1>出貨首頁</h1>

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