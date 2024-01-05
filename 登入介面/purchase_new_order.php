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
    <title>新增訂單</title>
  </head>
  <body class="min-vh-100 gradient-custom">
    <!-- header -->
    <script src="header.js"></script>
    <script> document.write(header);</script>

    <div class="container rounded bg-glass">
      <h1 class="my-5 pt-3">新增訂單</h1>

      <div class="row my-5">
        <div class="col-md-3 py-2">
          <select class="form-select" id="customerSelect">
            <option selected>選擇客戶</option>
            <option value="1">客戶1</option>
            <option value="2">客戶2</option>
            <option value="3">客戶3</option>
          </select>
        </div>
        <div class="col-md-3 py-2">
          <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addItemModal">新增商品</button>
        </div>
      </div>
      <div class="my-5">
        <div class="table-responsive">
          <table class="table table-striped table-hover table-bordered caption-top">
            <caption class="fs-3">商品清單</caption>
            <thead class="table-dark text-center">
              <tr>
                <th scope="col">機型</th>
                <th scope="col">供應商</th>
                <th scope="col">數量</th>
                <th scope="col">單位金額</th>
                <th scope="col">小計</th>
                <th scope="col">操作</th>
              </tr>
            </thead>
            <tbody class="font-monospace text-end">
              <tr>
                <td class="text-center">0001</td>
                <td class="text-center">random</td>
                <td>3</td>
                <td>1500</td>
                <td>4500</td>
                <td class="text-center"><button type="button" class="btn btn-danger btn-sm remove-btn" onclick="removeItem(this)">移除商品</button></td>
              </tr>
              <tr>
                <td class="text-center">0002</td>
                <td class="text-center">random</td>
                <td>2</td>
                <td>1000</td>
                <td>2000</td>
                <td class="text-center"><button type="button" class="btn btn-danger btn-sm remove-btn" onclick="removeItem(this)">移除商品</button></td>
              </tr>
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
              <div class="modal-body">
                  <!-- 在此加入商品與數量選擇 -->
                  <form>
                      <div class="mb-3">
                          <label for="productSelect" class="form-label">選擇商品</label>
                          <select class="form-select" id="productSelect">
                              <option value="1">商品1</option>
                              <option value="2">商品2</option>
                              <!-- 其他商品選項 -->
                          </select>
                      </div>
                      <div class="mb-3">
                          <label for="quantityInput" class="form-label">數量</label>
                          <input type="number" class="form-control" id="quantityInput" min="1" value="1">
                      </div>
                  </form>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                  <button type="button" class="btn btn-primary" id="addItemButton" onclick="addItem()">確認</button>
              </div>
          </div>
      </div>
    </div>
    <script>
      function addProduct() {
      }
      function removeItem(button) {
        // 找到要移除的商品行(tr)，並從DOM中刪除
        var row = button.parentNode.parentNode;
        row.parentNode.removeChild(row);
      }
      document.getElementById('cancelOrderBtn').addEventListener('click', function () {
            if (confirm('放棄修改?') == true) {
              window.location.href = 'purchase_index.php';
            }
        });
      document.getElementById('createOrderBtn').addEventListener('click', function () {
            alert('新增訂單成功！\n訂單編號：0001');
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