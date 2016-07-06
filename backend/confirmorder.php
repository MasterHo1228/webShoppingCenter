<?php
/**
 * Created by IntelliJ IDEA.
 * User: MasterHo
 * Date: 2016/6/28
 * Time: 13:36
 */
session_start();
if (!empty($_SESSION['uID']) && !empty($_POST['orderID'])){
    $orderID=$_POST['orderID'];

    require_once ("dbconnOrder.php");
    mysqli_query($link,"UPDATE ordersdetail SET orderStatus='3' WHERE orderID='$orderID' AND isPaid='true' AND orderStatus='2' ;");
    if (empty(mysqli_error($link))){
        echo "ok";
    }
}
?>