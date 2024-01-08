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
  <title>換貨</title>
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
      foreach ($_POST['selectedExchange'] as $purchaseId) {
        //新增換貨資料
        $sql = "SELECT `P_Quantity` FROM `purchase` WHERE P_ID = '" . $purchaseId . "'";
        $result = $link->query($sql);
        if ($result) {
          $row = $result->fetch_assoc();
          $reorderNum = $row['P_Quantity'];
        }
        // Count number of reorder records
        $sql = "SELECT COUNT(*) AS total_records FROM reorder";
        $result = $link->query($sql);
        if ($result) {
          $row = $result->fetch_assoc();
          $reorderId = 'R' . str_pad($row['total_records'] + 1, 4, '0', STR_PAD_LEFT);
        }
        $sql = "INSERT INTO reorder (R_ID, D_State, R_Quantity, P_ID) VALUES ('$reorderId', '未換貨','$reorderNum','$purchaseId')";
        $link->query($sql);

        //修改訂單為換貨中
        $sql = "UPDATE purchase SET P_State = '換貨中' WHERE P_ID = '" . $purchaseId . "'";
        if ($link->query($sql) === TRUE) {
          array_push($updated_ids, $purchaseId);
        }
      }
      if (count($updated_ids) > 0) {
        $_SESSION['message'] = "換貨中採購單: " . implode(", ", $updated_ids);
      }
    }
    header("Location: purchase_exchange.php");
    exit;
  }
  ?>

  <div class="container rounded bg-glass">
    <h1 class="my-5 pt-3">換貨</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
      <div class="row mb-5">
        <div class="table-responsive">
          <table class="table table-striped table-hover table-bordered caption-top">
            <caption class="fs-3">採購單列表</caption>
            <thead class="table-dark text-center">
              <tr>
                <th scope="col">採購單ID</th>
                <th scope="col">機型</th>
                <th scope="col">數量</th>
                <th scope="col">總金額</th>
                <th scope="col">採購日期</th>
                <th scope="col">商品有誤</th>
              </tr>
            </thead>
            <tbody class="font-monospace text-center">
              <?php
              $sql = "SELECT P_ID, Model, P_Quantity, P_TotalAmountOfTheItem, P_ArrivalDate FROM purchase WHERE P_State = '已採購'";
              $result = $link->query($sql);
              if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                  echo "<tr>";
                  echo "<td>" . $row["P_ID"] . "</td>";
                  echo "<td>" . $row["Model"] . "</td>";
                  echo "<td>" . $row["P_Quantity"] . "</td>";
                  echo "<td class='text-end'>" . $row["P_TotalAmountOfTheItem"] . "</td>";
                  echo "<td>" . $row["P_ArrivalDate"] . "</td>";
                  echo "<td><input class='form-check-input' type='checkbox' name='selectedExchange[]' value='" . $row["P_ID"] . "'></td>";
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
          <button type="submit" class="btn btn-primary" id="confirmBtn">換貨</button>
        </div>
      </div>
    </form>
  </div>


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