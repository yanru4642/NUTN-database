<!doctype html>
<html lang="zh-Hant-TW">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Bootstrap CSS -->
  <link rel='stylesheet' href='../css/bootstrap.css'>

  <!-- Custom CSS -->
  <style>
    .gradient-custom {
      background: rgb(38, 70, 126);
      background: linear-gradient(132deg, rgba(23, 54, 106, 1) 0%, rgba(38, 70, 126, 1) 35%, rgb(95, 90, 128) 72%, rgb(133, 133, 133) 100%);
      background: rgb(126, 157, 215);
      background: linear-gradient(132deg, rgba(126, 157, 215, 1) 0%, rgba(55, 95, 168, 1) 34%, rgba(61, 43, 148, 1) 100%);
      background: rgb(155, 175, 217);
      background: linear-gradient(132deg, rgba(155, 175, 217, 1) 0%, rgba(111, 123, 247, 1) 37%, rgba(16, 55, 131, 1) 100%);
    }

    .bg-glass {
      background-color: rgba(220, 220, 220, 0.8) !important;
      backdrop-filter: saturate(200%) blur(25px);
    }
  </style>
  <title>換貨到貨</title>
</head>

<body class="min-vh-100 gradient-custom">
  <!-- header -->
  <script src="purchase_header.js"></script>
  <script> document.write(header);</script>

  <?php
  session_start();
  include_once 'config.php';
  if (isset($_SESSION['message'])) {
    echo "<div class='alert alert-success'>" . $_SESSION['message'] . "</div>";
    unset($_SESSION['message']);
  }
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['selectedExchange'])) {
      $updated_ids = [];
      foreach ($_POST['selectedExchange'] as $reorderId) {
        //update reorder
        $sql = "UPDATE reorder SET D_State = '已換貨' WHERE R_ID = '" . $reorderId . "'";
        $result = $link->query($sql);
        //update purchase order
        $sql = "SELECT `P_ID` FROM `reorder` WHERE R_ID = '" . $reorderId . "'";
        $result = $link->query($sql);
        if ($result) {
          $row = $result->fetch_assoc();
          $purchaseId = $row['P_ID'];
        }
        $sql = "UPDATE purchase SET P_State = '採購到貨' WHERE P_ID = '" . $purchaseId . "'";
        if ($link->query($sql) === TRUE) {
          array_push($updated_ids, $purchaseId);
        }
      }
      if (count($updated_ids) > 0) {
        $_SESSION['message'] = "換貨完成採購單: " . implode(", ", $updated_ids);
      }
    }
    header("Location: purchase_exchange_check.php");
    exit;
  }
  ?>

  <div class="container rounded bg-glass">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
      <h1 class="my-5 pt-3">換貨到貨</h1>
      <div class="row mb-5">
        <div class="table-responsive">
          <table class="table table-striped table-hover table-bordered caption-top">
            <caption class="fs-3">換貨單列表</caption>
            <thead class="table-dark text-center">
              <tr>
                <th scope="col">換貨單ID</th>
                <th scope="col">採購單ID</th>
                <th scope="col">數量</th>
                <th scope="col">商品無誤</th>
              </tr>
            </thead>
            <tbody class="font-monospace text-center">
              <?php
              $sql = "SELECT R_ID, P_ID, R_Quantity FROM reorder WHERE D_State = '未換貨' ";
              $result = $link->query($sql);
              if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                  echo "<tr>";
                  echo "<td>" . $row["R_ID"] . "</td>";
                  echo "<td>" . $row["P_ID"] . "</td>";
                  echo "<td>" . $row["R_Quantity"] . "</td>";
                  echo "<td><input class='form-check-input' type='checkbox' name='selectedExchange[]' value='" . $row["R_ID"] . "'></td>";
                  echo "</tr>";
                }
              } else {
                echo "0 results";
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
      <div class="row">
        <div class="col mb-3">
          <button type="button" class="btn btn-secondary" id="cancelBtn">回主頁</button>
          <button type="submit" class="btn btn-primary" id="confirmBtn">確認</button>
        </div>
      </div>
    </form>
  </div>

  <script>
    document.getElementById('cancelBtn').addEventListener('click', function () {
      if (confirm('放棄修改?') == true) {
        window.location.href = 'purchase_index.php';
      }
    });
  </script>
  <!-- header highlight -->
  <script>
    [].forEach.call(document.querySelectorAll('a'), function (elem) {
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