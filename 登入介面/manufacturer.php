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
    <title>建立廠商資料</title>
</head>

<body class="min-vh-100 gradient-custom">
    <!-- header -->
    <script src="header.js"></script>
    <script>
        document.write(header);
    </script>
    <div class="container rounded bg-glass">
        <h1 class="my-5 pt-3">建立廠商資料</h1>
        <div class="row mb-5">
            <div class="table-responsive">
                <?php
                $conn = require_once "config.php";

                $sql = "SELECT * FROM manufacturer";
                $result = mysqli_query($conn, $sql);
                echo "<table border='1'>";
                echo "<tr><th>廠商ID</th><th>廠商名稱</th><th>廠商地址</th><th>廠商電話</th></tr>";

                for ($i = 0; $i < mysqli_num_rows($result); $i++) {
                    $row = mysqli_fetch_row($result);

                    // 列出資料
                    echo "<tr>";
                    echo "<td>" . $row[0] . "</td>";
                    echo "<td>" . $row[1] . "</td>";
                    echo "<td>" . $row[2] . "</td>";
                    echo "<td>" . $row[3] . "</td>";
                    echo "</tr>";
                }

                echo "</table>";

                if (isset($_POST['add_user_btn'])) {
                    $M_ID = $_POST['M_ID'];
                    $M_Name = $_POST['M_Name'];
                    $M_Address = $_POST['M_Address'];
                    $M_Phone = $_POST['M_Phone'];
                    $sql = "INSERT INTO `manufacturer` VALUES('$M_ID','$M_Name','$M_Address','$M_Phone')";
                    $result = mysqli_query($conn, $sql);
                    header('Location: manufacturer.php');
                }
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col mb-3">
                <form method="post" action="" class="mx-auto"> <!-- 使用 Bootstrap 的 mx-auto 將 form 置中 -->
                廠商ID<input type="text" placeholder="請輸入廠商ID" name="M_ID">
                    廠商名稱<input type="text" placeholder="請輸入廠商名稱" name="M_Name">
                    廠商地址<input type="text" placeholder="請輸入廠商地址" name="M_Address">
                    廠商電話<input type="text" placeholder="請輸入廠商電話" name="M_Phone">
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
