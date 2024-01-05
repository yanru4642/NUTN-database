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
    <?php
  echo "<a href='logout.php' style='font-size: 26px;'> 登出</a>";
  ?>
    <!-- Bootstrap JS -->
    <script src="../js/bootstrap.bundle.js"></script>
  </body>
</html>