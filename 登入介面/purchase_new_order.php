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
</head>

<body class="min-vh-100 gradient-custom">
  <!-- header -->
  <script src="purchase_header.js"></script>
  <script>document.write(header);</script>

  <?php
  session_start();
  include_once 'config.php';
  if (isset($_SESSION['message'])) {
    echo "<div class='alert alert-success'>" . $_SESSION['message'] . "</div>";
    unset($_SESSION['message']);
  }
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //E_ID
    $employeeID = isset($_SESSION['userID']) ? $_SESSION['userID'] : 'E0001';
    // Count number of reorder records
    $sql = "SELECT COUNT(*) AS total_records FROM `order`";
    $result = $link->query($sql);
    if ($result) {
      $row = $result->fetch_assoc();
      //O_ID
      $orderId = 'O' . str_pad($row['total_records'] + 1, 4, '0', STR_PAD_LEFT);
    }
    //date
    $currentDate = date('Y-m-d');
    //C_ID
    $sql = "SELECT `C_ID` FROM `customer` WHERE `C_Name` = '" . $_POST['customer'] . "'";
    $result = $link->query($sql);
    if ($result) {
      $row = $result->fetch_assoc();
      $customerID = $row['C_ID'];

    }

    //new order 
    $sql = "INSERT INTO `order`(`O_ID`, `O_Date`, `E_ID`, `O_State`, `C_ID`) VALUES ('$orderId', '$currentDate','$employeeID','新訂單','$customerID')";
    $result = $link->query($sql);
    if ($result) {
      $_SESSION['message'] = "新增訂單成功，訂單ID: " . $orderId;
    }

    //add in order
    if (isset($_POST["model"]) && isset($_POST["quantity"]) && isset($_POST["subtotal"])) {
      $arrayLength = count($_POST["model"]);
      for ($i = 0; $i < $arrayLength; $i++) {
        $model = $_POST["model"][$i];
        $quantity = $_POST["quantity"][$i];
        $subtotal = $_POST["subtotal"][$i];
        $sql = "INSERT INTO `addinorder`(`O_ID`, `Model`, `O_Quantity`, `O_TotalAmountOfTheItem`) VALUES ('$orderId','$model','" . $quantity . "','" . $subtotal . "')";
        $result = $link->query($sql);
        if (!$result) {
          die('插入資料失敗: ' . mysqli_error($link));
        }
      }
    } else {
      echo "error when adding order";
    }

    header("Location: purchase_new_order.php");
    exit();
  }
  ?>


  <div class="container rounded bg-glass">
    <h1 class="my-5 pt-3">新增訂單</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
      <div class="row my-5">
        <div class="col-md-3 py-2">
          <select name="customer" class="form-select" id="customerSelect">
            <option disabled selected>選擇客戶</option>
            <?php
            include_once 'config.php';
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
            <tbody class="font-monospace text-center" id="orderTable">
              <!-- js自動生成 -->
            </tbody>
          </table>
        </div>
      </div>
      <div class="row">
        <div class="col mb-3">
          <button type="button" class="btn btn-secondary" id="cancelBtn">回主頁</button>
          <button type="submit" class="btn btn-primary" id="createOrderBtn">新增訂單</button>
        </div>
      </div>
    </form>
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
                $sql = "SELECT `Model`, `Shipping_Price` FROM air_conditioning";
                $result = $link->query($sql);
                $modelShippingPriceMap = array();
                if ($result->num_rows > 0) {
                  // 輸出每一行數據
                  while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row["Model"] . "'>" . $row["Model"] . "</option>";
                    $modelShippingPriceMap[$row["Model"]] = $row["Shipping_Price"];
                  }
                } else {
                  echo "<option disabled>無商品資料</option>";
                }

                $modelShippingPriceJson = json_encode($modelShippingPriceMap);
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
            <button type="button" class="btn btn-primary" id="addItemButton" onclick="addItem()"
              data-bs-dismiss="modal">確認</button>
          </div>
        </form>

        <script>
          function addItem() {
            // 獲取選擇的商品和數量
            var selectedProduct = document.getElementById("productSelect1").value;
            var quantity = document.getElementById("quantityInput").value;
            var modelShippingPriceMap = <?php echo $modelShippingPriceJson; ?>;
            var unitPrice = modelShippingPriceMap[selectedProduct];
            var subtotal = unitPrice * quantity;

            // 建立一個新的表格行
            var newRow = document.getElementById("orderTable").insertRow();

            // 在新行中插入單元格並填入資料
            var cell1 = newRow.insertCell(0);
            var cell2 = newRow.insertCell(1);
            var cell3 = newRow.insertCell(2);
            var cell4 = newRow.insertCell(3);
            var cell5 = newRow.insertCell(4);
            var input1 = document.createElement("input");
            input1.type = "text";
            input1.name = "model[]";
            input1.value = selectedProduct;
            input1.readOnly = true;
            cell1.appendChild(input1);

            var input2 = document.createElement("input");
            input2.type = "text";
            input2.name = "quantity[]";
            input2.value = quantity;
            input2.readOnly = true;
            cell2.appendChild(input2);

            var input3 = document.createElement("input");
            input3.type = "text";
            input3.name = "unitPrice[]";
            input3.value = unitPrice;
            input3.readOnly = true;
            cell3.appendChild(input3);

            var input4 = document.createElement("input");
            input4.type = "text";
            input4.name = "subtotal[]";
            input4.value = subtotal;
            input4.readOnly = true;
            cell4.appendChild(input4);

            var removeButton = document.createElement("button");
            removeButton.className = "btn btn-danger";
            removeButton.textContent = "移除";
            removeButton.onclick = function () {
              removeRow(newRow);
            };
            cell5.appendChild(removeButton);
          }
          function removeRow(row) {
            row.remove();
          }
        </script>
      </div>
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