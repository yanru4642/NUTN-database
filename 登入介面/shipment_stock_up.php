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
        background: rgb(38,70,126);
        background: linear-gradient(132deg, rgba(23,54,106,1) 0%, rgba(38,70,126,1) 35%, rgb(95, 90, 128) 72%, rgb(133, 133, 133) 100%);
        background: rgb(126,157,215);
        background: linear-gradient(132deg, rgba(126,157,215,1) 0%, rgba(55,95,168,1) 34%, rgba(61,43,148,1) 100%);
        background: rgb(155,175,217);
        background: linear-gradient(132deg, rgba(155,175,217,1) 0%, rgba(111,123,247,1) 37%, rgba(16,55,131,1) 100%);
      }
      .bg-glass {
        background-color: rgba(220, 220, 220, 0.8) !important;
        backdrop-filter: saturate(200%) blur(25px);
      }
    </style>
    <title>備貨</title>
  </head>
  <body class="min-vh-100 gradient-custom">
    <!-- header -->
    <script src="shipment_header.js"></script>
    <script> document.write(header);</script>

    <div class="container rounded bg-glass">
        <h1 class="my-5 pt-3">備貨</h1>
        
        <?php
          session_start(); 
          include_once 'config.php';

          if(isset($_SESSION['message'])) {
              echo "<div class='alert alert-success'>" . $_SESSION['message'] . "</div>";
              unset($_SESSION['message']);
          }

          $sql = "SELECT O_ID, C_ID, O_Date FROM `order`  WHERE O_State = '已到貨'";
          $result = $link->query($sql);
          
          
        ?>


        <form method="post" action="update_stock.php">
            <div class="row mb-5">
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-bordered caption-top">
                        <caption class="fs-3">訂單列表</caption>
                        <thead class="table-dark text-center">
                            <tr>
                            <th scope="col">訂單ID</th>
                            <th scope="col">客戶ID</th>
                            <th scope="col">建立日期</th>
                            <th scope="col">訂單總金額</th>
                            <th scope="col">備貨完成</th>
                            </tr>
                        </thead>
                        <tbody class="font-monospace text-center">
                          <?php

                  if ($result->num_rows > 0) {
                      while($row = $result->fetch_assoc()) {  
                          echo "<tr>";
                          echo "<td>" . $row["O_ID"]. "</td>";
                          echo "<td>" . $row["C_ID"]. "</td>";
                          echo "<td>" . $row["O_Date"]. "</td>";

                          $ID=$row["O_ID"];
                          
                          $sql1 = "SELECT O_TotalAmountOfTheItem FROM `addinorder`  WHERE O_ID ='$ID' ";
                          $result1 = $link->query($sql1);
                          if ($result1->num_rows > 0) {
                            while($row1 = $result1->fetch_assoc()) {  
                          echo "<td class='text-end'>" . $row1["O_TotalAmountOfTheItem"]. "</td>";}}
                          echo "<td><input class='form-check-input' type='checkbox' name='selectedOrder[]' value='" . $ID . "'></td>";
                          echo "</tr>";
                      }
                  } else {
                      echo "0 results";
                  }
                  $link->close();
                ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col mb-3">
                    <button type="button" class="btn btn-secondary" id="cancelBtn">回主頁</button>
                    <button type="submit" class="btn btn-primary" id="confirmBtn">確認已備貨</button>
                </div>
            </div>
        </form> 
    </div>

    <script>
      document.getElementById('cancelBtn').addEventListener('click', function () {
            if (confirm('放棄修改?') == true) {
              window.location.href = 'shipment_index.php';
            }
        });

    

    </script>
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