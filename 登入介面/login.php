<?php
// Include config file
$conn = require_once "config.php";

// Define variables and initialize with empty values
$username = $_POST["username"];
$password = $_POST["password"];
$password_hash = password_hash($password, PASSWORD_DEFAULT);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sql = "SELECT * FROM employee WHERE E_Name ='" . $username . "'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    if (mysqli_num_rows($result) == 1 && $password == $row["E_Phone"]) {
        session_start();
        $_SESSION["loggedin"] = true;
        $_SESSION["department"] = $row["E_Department"];
        $_SESSION["username"] = $row["E_Name"];
        $_SESSION["userID"] = $row["E_ID"];
        $userID = $_SESSION["userID"];
        $department = $_SESSION["department"];
        if ($department == "採購") {
            header('location:purchase_index.php');
            exit();
        } else if ($department == "出貨") {
            header('location:shipment_index.php');
            exit();
        }
    } else {
        function_alert("帳號或密碼錯誤");
    }
} else {
    function_alert("Something wrong");
}

mysqli_close($link);

function function_alert($message)
{

    echo "<script>alert('$message');
     window.location.href='welcome.php';
    </script>";
    return false;
}
?>