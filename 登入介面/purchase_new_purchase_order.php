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
    <title>訂單彙整</title>
  </head>
  <body class="min-vh-100 gradient-custom">
    <!-- header -->
    <script src="purchase_header.js"></script>
    <script> document.write(header);</script>

    <div class="container rounded bg-glass">
      <h1 class="my-5 pt-3">訂單彙整</h1>
      <div class="row mb-5">
        <div class="table-responsive">
          <table class="table table-striped table-hover table-bordered caption-top">
            <caption class="fs-3">訂單列表</caption>
            <thead class="table-dark text-center">
              <tr>
                <th scope="col">訂單ID</th>
                <th scope="col">客戶名</th>
                <th scope="col">建立日期</th>
                <th scope="col">訂單總金額</th>
                <th scope="col">訂單狀態</th>
              </tr>
            </thead>
            <tbody class="font-monospace text-center">
              <tr>
                <td>0001</td>
                <td>客戶1</td>
                <td>2023-12-24 10:45:00</td>
                <td class="text-end">8000</td>
                <td>未到貨</td>
              </tr>
              <tr>
                <td>0002</td>
                <td>客戶2</td>
                <td>2023-12-24 12:30:00</td>
                <td class="text-end">55000</td>
                <td>未到貨</td>
              </tr>
              <tr>
                <td>0003</td>
                <td>客戶3</td>
                <td>2023-12-24 15:40:30</td>
                <td class="text-end">12500</td>
                <td>未到貨</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="row">
        <div class="col mb-3">
          <button type="button" class="btn btn-secondary" id="cancelBtn">回主頁</button>
          <button type="button" class="btn btn-primary" id="confirmBtn">生成採購單</button>
        </div>
      </div>

      
    </div>

    <script>
      document.getElementById('cancelBtn').addEventListener('click', function () {
            if (confirm('放棄修改?') == true) {
              window.location.href = 'purchase_index.php';
            }
        });
      document.getElementById('confirmBtn').addEventListener('click', function () {
            alert('成功！');
        });
    </script>
    <!-- header highlight -->
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