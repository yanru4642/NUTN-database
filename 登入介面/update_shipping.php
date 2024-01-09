<?php
session_start();
include 'config.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['selectedOrder'])) {
        $updated_ids = [];
        foreach ($_POST['selectedOrder'] as $orderId) {
            $sql = "UPDATE `order` SET O_State = '已出貨' WHERE O_ID = '" . $orderId . "'";
            if ($link->query($sql) === TRUE) {
                array_push($updated_ids, $orderId);
            }
        }
        if (count($updated_ids) > 0) {
            $_SESSION['message'] = "成功更新訂單ID: " . implode(", ", $updated_ids);
        }
    }
    header("Location: shipment_stock_up.php");
    exit;
}
$link->close();
?>