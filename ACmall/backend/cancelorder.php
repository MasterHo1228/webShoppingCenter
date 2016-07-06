<?php
/**
 * Created by IntelliJ IDEA.
 * User: MasterHo
 * Date: 2016/6/9
 * Time: 9:42
 */
session_start();
if (!empty($_SESSION['sUID']) || !empty($_SESSION['AdminID']) && !empty($_GET['orderID'])) {
    require_once ("dbconnOrders.php");
    $orderID=$_GET['orderID'];
    @$SUID=$_SESSION['sUID'];
    @$AdminID=$_SESSION['AdminID'];

    mysqli_query($link,"UPDATE ordersdetail SET orderStatus='0' WHERE orderID='$orderID' AND orderStatus !='0';");

    if (empty(mysqli_error($link))){
        echo "<script>alert('订单取消成功！');location.href('../content/orderslist.php');</script>";
    }
    else{
        echo "<script>alert('操作失败，订单已被取消！！');location.href('../content/orderslist.php');</script>";
    }
    mysqli_close($link);
}
else{
    echo "<script>alert('非法操作！！');window.close();</script>";
}
?>