<?php
/**
 * Created by IntelliJ IDEA.
 * User: Administrator
 * Date: 2016/6/22
 * Time: 10:18
 */
session_start();
if (!empty($_SESSION['uID']) && !empty($_SESSION['tmpOrderID']) && !empty($_GET['gID'])){
    $gID=$_GET['gID'];
    $orderID=$_SESSION['tmpOrderID'];

    require_once ("dbconnOrder.php");
    $queryDel=mysqli_query($link,"DELETE FROM ordersdetail WHERE orderContainGoodsID=$gID AND orderID='$orderID' ;");
    if (empty(mysqli_error($link))){
        echo "<script>alert('已删除');location.href='../cart.html';</script>";
    }
    else{
        echo "<script>alert('操作失败！');location.href='../cart.html';</script>";
    }
}
else{
    echo "<script>alert('非法操作！！');window.close();</script>";
}
?>