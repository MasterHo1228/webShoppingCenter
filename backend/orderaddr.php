<?php
/**
 * Created by IntelliJ IDEA.
 * User: Administrator
 * Date: 2016/6/23
 * Time: 8:34
 */
session_start();
if (!empty($_SESSION['uID'])){
    if (!empty($_SESSION['tmpOrderID'])){//如果是刚下好订单立即付款的情况
        $orderID=$_SESSION['tmpOrderID'];
        require_once ("dbconnOrder.php");

        if (!empty($_POST['orderPerson']) && !empty($_POST['orderAddress']) && !empty($_POST['orderTel'])){
            $orderPerson=htmlentities((mysqli_real_escape_string($link,$_POST['orderPerson'])),ENT_QUOTES,'UTF-8');
            $orderAddr=htmlentities((mysqli_real_escape_string($link,$_POST['orderAddress'])),ENT_QUOTES,'UTF-8');
            $orderTel=htmlentities((mysqli_real_escape_string($link,$_POST['orderTel'])),ENT_QUOTES,'UTF-8');

            mysqli_query($link,"UPDATE orders SET orderPerson='$orderPerson',orderAddress='$orderAddr',orderTel='$orderTel',tmpOrder='0' WHERE orderID='$orderID' AND tmpOrder='1' ;");
            if (empty(mysqli_error($link))){
                unset($_SESSION['tmpOrderID']);
            }
            else{
                echo mysqli_error($link);
            }
        }
        else{
            echo "<script>alert('收货人联系信息请填写完整！');history.back();</script>";
        }
    }
}
?>