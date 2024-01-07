<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['selectedPurchases'])) {
        $updated_ids = [];
        foreach ($_POST['selectedPurchases'] as $purchaseId) {
            $sql = "UPDATE purchase SET P_State = '已採購' WHERE P_ID = '" . $purchaseId . "'";
            if ($link->query($sql) === TRUE) {
                array_push($updated_ids, $purchaseId);
            }
        }
        if (count($updated_ids) > 0) {
            $_SESSION['message'] = "成功更新採購單ID: " . implode(", ", $updated_ids);
        }
    }
    header("Location: purchase_purchasing.php");
    exit;
}
$link->close();
?>
