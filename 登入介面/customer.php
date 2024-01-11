<!DOCTYPE html>
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

        form {
        display: flex;
        flex-direction: column;
        max-width: 300px; /* 設定最大寬度，根據實際需要調整 */
        margin: auto; /* 將 form 置中 */
    }

    form input {
        margin-bottom: 10px;
        padding: 5px;
    }

    form button {
        padding: 5px;
        font-weight: bold; /* 加粗文字 */
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px; /* 設定表格與上方元素的距離，根據實際需要調整 */
    }

    th, td {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
        font-weight: bold; /* 加粗文字 */
    }

    th {
        background-color: #f2f2f2;
    }
    </style>
    <title>建立客戶資料</title>
</head>

<body class="min-vh-100 gradient-custom">
    <!-- header -->
    <script src="header.js"></script>
    <script>
        document.write(header);
    </script>
    <div class="container rounded bg-glass">
        <h1 class="my-5 pt-3">建立客戶資料</h1>
        <div class="row mb-5">
            <div class="table-responsive">
                <?php
                $conn = require_once "config.php";

                $sql = "SELECT * FROM customer";
                $result = mysqli_query($conn, $sql);
                echo "<table border='1'>";
                echo "<tr><th>客戶ID</th><th>客戶名稱</th><th>客戶統編</th><th>客戶地址</th><th>客戶電話</th></tr>";

                for ($i = 0; $i < mysqli_num_rows($result); $i++) {
                    $row = mysqli_fetch_row($result);

                    // 列出資料
                    echo "<tr>";
                    echo "<td>" . $row[0] . "</td>";
                    echo "<td>" . $row[1] . "</td>";
                    echo "<td>" . $row[2] . "</td>";
                    echo "<td>" . $row[3] . "</td>";
                    echo "<td>" . $row[4] . "</td>";
                    echo "</tr>";
                }

                echo "</table>";

                if (isset($_POST['add_user_btn'])) {
                    $C_ID = $_POST['C_ID'];
                    $C_Name = $_POST['C_Name'];
                    $C_GUI = $_POST['C_GUI'];
                    $C_Address = $_POST['C_Address'];
                    $C_Phone = $_POST['C_Phone'];
                    $sql = "INSERT INTO `customer` VALUES('$C_ID','$C_Name','$C_GUI','$C_Address','$C_Phone')";
                    $result = mysqli_query($conn, $sql);
                    header('Location: customer.php');
                }
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col mb-3">
                <form method="post" action="" class="mx-auto"> <!-- 使用 Bootstrap 的 mx-auto 將 form 置中 -->
                    客戶ID<input type="text" placeholder="請輸入客戶ID" name="C_ID">
                    客戶名稱<input type="text" placeholder="請輸入客戶名稱" name="C_Name">
                    客戶統編<input type="text" placeholder="請輸入客戶統編" name="C_GUI">
                    客戶地址<input type="text" placeholder="請輸入客戶地址" name="C_Address">
                    客戶電話<input type="text" placeholder="請輸入客戶電話" name="C_Phone">
                    <button name="add_user_btn">新增客戶資料</button>
                </form>
            </div>
        </div>
        <div class="row">
        <div class="col mb-3">
          <button type="button" class="btn btn-secondary" id="cancelBtn">回主頁</button>
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
