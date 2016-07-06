<?php
/**
 * Created by IntelliJ IDEA.
 * User: Administrator
 * Date: 2016/6/8
 * Time: 10:53
 */
$dbLink="127.0.0.1";
$dbUser="root";
$dbPassW="";
$dbName="dbShoppingGoods";

$link=mysqli_connect($dbLink,$dbUser,$dbPassW,$dbName);
if (mysqli_connect_errno($link)) {
    echo "连接失败: " . mysqli_connect_error();
}
mysqli_query($link,"set names 'utf8mb4';");

?>