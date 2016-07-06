<?php
/**
 * Created by IntelliJ IDEA.
 * User: Administrator
 * Date: 2016/6/16
 * Time: 10:17
 */
session_start();
if (!empty($_SESSION['uID']) && !empty($_POST['PayBy'])){
    $uID=$_SESSION['uID'];
    $PayBy=$_POST['PayBy'];

    require_once ("dbconnOrder.php");
    if (!empty($_SESSION['tmpOrderID'])){//如果是刚下好订单立即付款的情况
        $orderID=$_SESSION['tmpOrderID'];
    }
    if (!empty($_POST['orderID'])){//第二种情况是 在个人中心订单页内结算付款
        $orderID=$_POST['orderID'];
    }

    $queryCheck=mysqli_query($link,"SELECT isPaid,orderStatus FROM ordersdetail WHERE orderID='$orderID' GROUP BY orderID;");
    while ($rs=mysqli_fetch_array($queryCheck)){//update之前验证下订单是否已付款
        $isPaid=$rs['isPaid'];
        $orderStatus=$rs['orderStatus'];
    }
    if (@$orderStatus=='0'){
        echo "<script>alert('抱歉，该订单已被取消！！')</script>";
    }
    elseif (@$orderStatus=='1'){
        if ($isPaid=='false'){
            $payOrder=mysqli_query($link,"UPDATE ordersdetail SET isPaid='true',PayBy='$PayBy' WHERE orderID='$orderID' AND isPaid='false';");
            if (mysqli_error($link)){
                echo "<script>alert('亲，您的刀钝了，剁手失败！请及时联系客服处理！')</script>";
            }
            else{
                echo "<script>alert('恭喜，剁手成功！您的订单审核成功后将在两个工作日内发货！');location.href='index.html';</script>";
                unset($_SESSION['tmpOrderID']);
            }
        }
        elseif ($isPaid=='true'){
            echo "<script>alert('亲，这个订单您已经付款了喔！')</script>";
        }
    }
}
else{
    echo "<script>alert('非法操作！');window.close();</script>";
}
?>