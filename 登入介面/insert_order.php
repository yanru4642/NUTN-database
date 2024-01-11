<?php
include 'config.php'; // DB連接

// 接收前端傳送的JSON數據
$jsonData = file_get_contents("php://input");

// 檢查 JSON 數據是否成功讀取
if ($jsonData === false) {
    die('Error reading JSON data.');
}
echo 'Received JSON data: ' . $jsonData;

// 解碼 JSON 字串
$data = json_decode($jsonData, true);

// 檢查 JSON 解碼的錯誤
if (json_last_error() !== JSON_ERROR_NONE) {
    die('Error decoding JSON: ' . json_last_error_msg());
}

// 檢查 $data 是否為陣列
if (!is_array($data)) {
    die('Invalid JSON data format.');
}

foreach ($data as $item) {
    // 提取每一列的數據
    $orderCode = $item['orderCode'];
    $model = $item['model'];
    $quantity = $item['quantity'];
    $totalAmount = intval($item['totalAmount']);

    // 插入資料到 addinorder 表格
    $sql = "INSERT INTO addinorder (O_ID, Model, O_Quantity, O_TotalAmountOfTheItem) 
            VALUES ('$orderCode', '$model', '$quantity', '$totalAmount')";

    if ($link->query($sql) !== TRUE) {
        die("Error: " . $sql . "<br>" . $link->error);
    }
}

// 關閉資料庫連接
$link->close();

echo 'success'; // 告知前端插入成功
?>
