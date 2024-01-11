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
  <title>新增訂單</title>

  <?php
  include 'config.php'; // DB連接
  
  function generateUniqueOrderCode($link)
  {
    $prefix = "O_";
    $maxAttempts = 10;

    for ($i = 0; $i < $maxAttempts; $i++) {
      $randomNumber = sprintf("%04d", mt_rand(1, 9999));
      $orderCode = $prefix . $randomNumber;

      // 檢查生成的編碼是否已存在於資料庫中
      $checkQuery = "SELECT * FROM `order` WHERE O_ID = '$orderCode'";
      $checkResult = $link->query($checkQuery);

      if ($checkResult->num_rows === 0) {
        return $orderCode; // 找到唯一的編碼
      }
    }

    // 如果達到最大嘗試次數，您可能希望適當處理此情況
    die("無法生成唯一的編碼");
  }

  // 生成唯一的訂單編號
  $uniqueOrderCode = generateUniqueOrderCode($link);
  ?>
  <script>
    var uniqueOrderCode = <?php echo json_encode($uniqueOrderCode); ?>;
  </script>




</head>

<body class="min-vh-100 gradient-custom">
  <!-- header -->
  <script src="purchase_header.js"></script>
  <script>document.write(header);</script>


  <div class="container rounded bg-glass">
    <h1 class="my-5 pt-3">新增訂單</h1>

    <div class="row my-5">
      <div class="col-md-3 py-2">
        <select class="form-select" id="customerSelect">
          <option disabled selected>選擇客戶</option>
          <?php
          include 'config.php'; // DB連接
          
          // 從客戶表格中選取客戶名稱
          $sql = "SELECT C_Name FROM customer";
          $result = $link->query($sql);

          if ($result->num_rows > 0) {
            // 輸出每一行數據
            while ($row = $result->fetch_assoc()) {
              echo "<option value='" . $row["C_Name"] . "'>" . $row["C_Name"] . "</option>";
            }
          } else {
            echo "<option disabled>無客戶資料</option>";
          }
          $link->close();
          ?>
        </select>
      </div>
      <div class="col-md-3 py-2">
        <button type="button" class="btn btn-success" data-bs-toggle="modal"
          data-bs-target="#addItemModal">新增商品</button>
      </div>
    </div>
    <div class="my-5">
      <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered caption-top">
          <caption class="fs-3">商品清單</caption>
          <thead class="table-dark text-center">
            <tr>
              <th scope="col">機型</th>
              <th scope="col">數量</th>
              <th scope="col">單位金額</th>
              <th scope="col">小計</th>
              <th scope="col">操作</th>
            </tr>
          </thead>
          <tbody class="font-monospace text-end" id="orderTable">



          </tbody>
        </table>
      </div>
    </div>
    <div class="row">
      <div class="col mb-3">
        <button type="button" class="btn btn-secondary" id="cancelOrderBtn">回主頁</button>
        <button type="button" class="btn btn-primary" id="createOrderBtn">新增訂單</button>
      </div>
    </div>


  </div>
  <!-- 新增商品 Modal -->
  <div class="modal fade" id="addItemModal" tabindex="-1" aria-labelledby="addItemModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addItemModalLabel">新增商品</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="insert_order.php" method="post">
          <div class="modal-body">
            <!-- 在此加入商品與數量選擇 -->

            <div class="mb-3">
              <label for="productSelect1" class="form-label">選擇商品</label>
              <select class="form-select" id="productSelect1" name="Model">
                <option disabled selected>選擇商品</option>
                <?php
                include 'config.php'; // DB連接
                
                // 從 air_conditioning 表格中選取 Model
                $sql = "SELECT `Model` FROM air_conditioning";
                $result = $link->query($sql);
                if ($result->num_rows > 0) {
                  // 輸出每一行數據
                  while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row["Model"] . "'>" . $row["Model"] . "</option>";
                  }
                } else {
                  echo "<option disabled>無商品資料</option>";
                }
                $link->close();

                ?>

              </select>
            </div>


            <div class="mb-3">
              <label for="quantityInput" class="form-label">數量</label>
              <input type="number" class="form-control" id="quantityInput" name="O_Quantity" min="1" value="1">
            </div>




          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
            <button type="button" class="btn btn-primary" id="addItemButton" onclick="addItem()">確認</button>
          </div>
        </form>
        <script>
          function addItem() {
            // 獲取選擇的商品和數量
            var selectedProduct = document.getElementById("productSelect1").value;
            var quantity = document.getElementById("quantityInput").value;

            // 建立一個新的表格行
            var newRow = document.getElementById("orderTable").insertRow();

            // 在新行中插入單元格並填入資料
            var cell1 = newRow.insertCell(0);
            var cell2 = newRow.insertCell(1);
            var cell3 = newRow.insertCell(2);

            cell1.innerHTML = selectedProduct;
            cell2.innerHTML = quantity;
            cell3.innerHTML = '<button class="btn btn-danger" onclick="removeRow(this)">移除</button>';
          }
        </script>
      </div>
    </div>
  </div>



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