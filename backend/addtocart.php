<?php
/**
 * Created by IntelliJ IDEA.
 * User: Administrator
 * Date: 2016/6/15
 * Time: 8:17
 */
session_start();
date_default_timezone_set("Asia/Shanghai");
if (!empty($_SESSION['uID']) && !empty($_POST['gID'])){
    require_once ("dbconnOrder.php");
    $uID=$_SESSION['uID'];
    $gID=$_POST['gID'];
    $gCount=htmlentities((mysqli_real_escape_string($link,$_POST['gCount'])),ENT_QUOTES,'UTF-8');

    if (empty($_SESSION['tmpOrderID'])){//先检测后台有没有生成了订单号，没有的话就生成一个出来！
        if (is_numeric($gCount)){
            $tmpOrderID="AC".date("YmdHis",time()).rand(10000,99999);
            $_SESSION['tmpOrderID']=$tmpOrderID;
            mysqli_query($link,"INSERT INTO orders(orderID,oUID,tmpOrder) VALUES ('$tmpOrderID',$uID,'1');");
            mysqli_query($link,"INSERT INTO ordersdetail(orderID,orderContainGoodsID,GoodsCount,isPaid) VALUES ('$tmpOrderID','$gID','$gCount','false');");

            if (empty(mysqli_error($link))){
                echo "<script>alert('商品已成功添加到购物车！')</script>";
            }
            else{
                echo "<script>alert('操作失败！')</script>";
            }
        }
        else{
            echo "<script>alert('非法数据！')</script>";
        }
    }
    elseif (!empty($_SESSION['tmpOrderID'])){//已经有订单号的就直接添加进去
        if (is_numeric($gCount)){
            $tmpOrderID=$_SESSION['tmpOrderID'];
            $queryCheckCart=mysqli_query($link,"SELECT orderContainGoodsID FROM ordersdetail WHERE orderID='$tmpOrderID';");
            while ($rsCheck=mysqli_fetch_array($queryCheckCart)){
                $cgID=$rsCheck['orderContainGoodsID'];
                if ($cgID==$gID){
                    mysqli_query($link,"UPDATE ordersdetail SET GoodsCount=GoodsCount+$gCount WHERE orderID='$tmpOrderID' AND orderContainGoodsID='$gID' ;");
                    $findSameGoods=true;
                    break;
                }
                else{
                    $findSameGoods=false;
                }
            }
            if ($findSameGoods==false){
                mysqli_query($link,"INSERT INTO ordersdetail(orderID,orderContainGoodsID,GoodsCount,isPaid) VALUES ('$tmpOrderID','$gID','$gCount','false');");
            }
            if (empty(mysqli_error($link))){
                echo "<script>alert('商品已成功添加到购物车！')</script>";
            }
            else{
                echo "<script>alert('操作失败！')</script>";
            }
        }
        else{
            echo "<script>alert('非法数据！')</script>";
        }
    }
    mysqli_close($link);
}
else{
    echo "<script>alert('请先登录账号，才能购买呦！！')</script>";
}
?>