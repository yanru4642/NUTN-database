<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['selectedGoodCheck'])) {
        $updated_ids = [];
        foreach ($_POST['selectedGoodCheck'] as $goodCheckId) {
            $sql = "UPDATE purchase SET P_State = '採購到貨' WHERE P_ID = '" . $goodCheckId . "'";
            if ($link->query($sql) === TRUE) {
                array_push($updated_ids, $goodCheckId);
            }
        }
        if (count($updated_ids) > 0) {
            $_SESSION['message'] = "成功更新採購單ID: " . implode(", ", $updated_ids);
        }
    }
    header("Location: purchase_goods_check.php");
    exit;
}
$link->close();
?>