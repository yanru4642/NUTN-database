<?php

session_start();  //可以用的變數存在session裡
$username=$_SESSION["username"];
$department=$_SESSION["department"];
echo "<h1>你好 ".$username."</h1>";
echo "<h1>部門 ".$department."</h1>";
echo "<a href='logout.php'>登出</a>";
    
?>