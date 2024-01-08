<!doctype html>
<html lang="zh-Hant-TW">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel='stylesheet' href='css/bootstrap.css'>
    <!-- Custom CSS -->
    <style>
        .gradient-custom {
          background: rgb(38,70,126);
          background: linear-gradient(132deg, rgba(23,54,106,1) 0%, rgba(38,70,126,1) 35%, rgba(116,106,187,1) 72%, rgba(180,106,187,1) 100%);
        }
        .bg-glass {
          background-color: rgba(15, 20, 5, 0.7) !important;
          backdrop-filter: saturate(200%) blur(25px);
        }
    </style>
    <?php
    session_start();
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: welcome.php");
    exit;}
    ?>
    <title>Database Login</title>
  </head>
  <body>
  <form method="post" action="login.php">  
    <section class="vh-100 gradient-custom">
      <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-12 col-md-8 col-lg-6 col-xl-5">
            <div class="card bg-dark text-white bg-glass" style="border-radius: 1rem;">
              <div class="card-body px-5 text-center mb-md-5 mt-md-4">
                  <h1 class="fw-bold mb-2">啟勝電機行</h1>
                  <h5 class="text-white-50 mb-5">採購出貨管理系統</h5>
                  <div class="form-outline form-white mb-4">
                    <label class="form-label" for="formUser">Username</label>
                    <input type="text" name="username" id="formUser" class="form-control form-control-lg" />
                  </div>
                  <div class="form-outline form-white mb-5">
                    <label class="form-label" for="formPassword">Password</label>
                    <input type="password" name="password" id="formPassword" class="form-control form-control-lg" />
                  </div>
                  <input class="btn btn-outline-light btn-lg px-5" type="submit" value="登入" name="submit">
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    </form>
    <!-- Bootstrap JS -->
    <script src="js/bootstrap.bundle.js"></script>
  </body>
</html>