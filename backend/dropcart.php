<?php
/**
 * Created by IntelliJ IDEA.
 * User: Administrator
 * Date: 2016/6/22
 * Time: 10:18
 */
session_start();
if (!empty($_SESSION['uID']) && !empty($_SESSION['tmpOrderID'])){
    $orderID=$_SESSION['tmpOrderID'];

    require_once ("dbconnOrder.php");
    $queryDel=mysqli_query($link,"DELETE FROM ordersdetail WHERE orderID='$orderID' ;");
    $queryClean=mysqli_query($link,"DELETE FROM orders WHERE orderID='$orderID' AND tmpOrder='1' ;");
    if (empty(mysqli_error($link))){
        unset($_SESSION['tmpOrderID']);
        echo "<script>alert('已清空！');location.href='../index.html';</script>";
    }
    else{
        echo "<script>alert('操作失败！');location.href='../cart.html';</script>";
    }
}
else{
    echo "<script>alert('非法操作！！');window.close();</script>";
}
?>