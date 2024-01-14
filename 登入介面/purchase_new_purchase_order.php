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
  <title>訂單彙整</title>
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
    if (!empty($_POST['selectedOrder'])) {
      $updated_ids = [];
      foreach ($_POST['selectedOrder'] as $orderId) {
        $sql = "UPDATE `order` SET O_State = '未到貨' WHERE O_ID = '" . $orderId . "'";
        $result = $link->query($sql);


        $sql = "SELECT `Model`, `O_Quantity`, `O_TotalAmountOfTheItem` FROM `addinorder`WHERE O_ID = '" . $orderId . "'";
        $result = $link->query($sql);
        if ($result) {
          $row = $result->fetch_assoc();
          $model = $row['Model'];
          $quantity = $row['O_Quantity'];
          $amount = $row['O_TotalAmountOfTheItem'];
        }
        //date
        $date = date('Y-m-d');

        $sql = "SELECT COUNT(*) AS total_records FROM purchase";
        $result = $link->query($sql);
        if ($result) {
          $row = $result->fetch_assoc();
          $purchaseId = 'P' . str_pad($row['total_records'] + 1, 4, '0', STR_PAD_LEFT);
        }
        //E_ID
        $employeeID = isset($_SESSION['userID']) ? $_SESSION['userID'] : 'E0002';
        //採購單
        $sql = "INSERT INTO purchase (P_ID, P_PurchaseDate, P_ArrivalDate, P_State, E_ID, Model	,P_Quantity, P_TotalAmountOfTheItem) VALUES ('$purchaseId', '$date',' ','未採購','$employeeID', '$model','$quantity','$amount')";
        $link->query($sql);

        //
        $sql = "INSERT INTO consolidateorders (O_ID, P_ID) VALUES ('$orderId','$purchaseId')";
        $result = $link->query($sql);
        if ($result === TRUE) {
          array_push($updated_ids, $purchaseId);
        }


      }
      if (count($updated_ids) > 0) {
        $_SESSION['message'] = "成功生成採購單 " . implode(", ", $updated_ids);
      }
    }
    header("Location: purchase_new_purchase_order.php");
    exit;
  }



  $sql = "SELECT O_ID, O_Date, O_State, C_ID FROM `order` WHERE O_State = '新訂單'";
  $result = $link->query($sql);
  ?>

  <div class="container rounded bg-glass">
    <h1 class="my-5 pt-3">訂單彙整</h1>


    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
      <div class="row mb-5">
        <div class="table-responsive">
          <table class="table table-striped table-hover table-bordered caption-top">
            <caption class="fs-3">訂單列表</caption>
            <thead class="table-dark text-center">
              <tr>
                <th scope="col">訂單ID</th>
                <th scope="col">商品</th>
                <th scope="col">建立日期</th>
                <th scope="col">訂單總金額</th>
                <th scope="col">訂單狀態</th>
                <th scope="col">生成採購</th>

              </tr>
            </thead>
            <tbody class="font-monospace text-center">
              <?php
              include_once 'config.php';
              $sql = "SELECT
              `order`.O_ID,
              `order`.O_Date,
              `order`.O_State,
              `addinorder`.Model,
              `addinorder`.O_TotalAmountOfTheItem
              FROM
              `order`
              NATURAL JOIN addinorder
              WHERE
              `order`.O_State = '新訂單'";

              $result = $link->query($sql);

              if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                  echo "<tr>";
                  echo "<td>" . $row["O_ID"] . "</td>";
                  echo "<td class='text-end'>" . $row["Model"] . "</td>";
                  echo "<td>" . $row["O_Date"] . "</td>";
                  echo "<td class='text-end'>" . $row["O_TotalAmountOfTheItem"] . "</td>";
                  echo "<td>" . $row["O_State"] . "</td>";
                  echo "<td><input class='form-check-input' type='checkbox' name='selectedOrder[]' value='" . $row["O_ID"] . "'></td>";
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
          <button type="submit" class="btn btn-primary" id="confirmBtn">生成採購單</button>
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