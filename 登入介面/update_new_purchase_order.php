<?php
session_start();
include 'config.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['selectedOrder'])) {
        $updated_ids = [];
        foreach ($_POST['selectedOrder'] as $orderId) {
            $sql = "UPDATE `order` SET O_State = '未到貨' WHERE O_ID = '" . $orderId . "'";
            if ($link->query($sql) === TRUE) {
                array_push($updated_ids, $orderId);
            }

            $sql = "SELECT `O_Date, Model, O_Quantity, O_TotalAmountOfTheItem` FROM `addinorder, order` as O WHERE O_ID = '" . $orderId . "'";
            $result = $link->query($sql);
            if ($result) {
              $row = $result->fetch_assoc();
              $date = $row['O_Date'];
              $model = $row['Model'];
              $quantity = $row['O_Quantity'];
              $amount = $row['O_TotalAmountOfTheItem'];
            }
        }
        

        $sql = "SELECT COUNT(*) AS total_records FROM purchase";
        $result = $link->query($sql);
        if ($result) {
            $row = $result->fetch_assoc();
            $purchaseId = 'P' . str_pad($row['total_records'] + 1, 4, '0', STR_PAD_LEFT);
        }
        
        foreach ($updated_ids as $orderId) {
            $sql = "INSERT INTO addinorder (O_ID, P_ID) VALUES ('$orderId','$purchaseId')";
            $link->query($sql);
        }


        $sql = "INSERT INTO purchase (P_ID, P_PurchaseDate, P_ArrivalDate, P_State, E_ID, Model	,P_Quantity, P_TotalAmountOfTheItem) VALUES ('$orderId', '$date','未到貨','E0001', '$model','$quantity','$amount')";
        $link->query($sql);

        if (count($updated_ids) > 0) {
            $_SESSION['message'] = "成功生成採購單 " . implode(", ", $updated_ids);
        }
    }
    //header("Location: purchase_new_purchase_order.php");
    //exit;
}
$link->close();
?>