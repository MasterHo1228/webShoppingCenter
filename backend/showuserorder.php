<?php
/**
 * Created by IntelliJ IDEA.
 * User: Administrator
 * Date: 2016/6/16
 * Time: 8:25
 */
session_start();
header("Content-type: text/xml");
if (!empty($_SESSION['uID'])){
    $uID=$_SESSION['uID'];

    require_once ("dbconnOrder.php");
    if (!empty($_GET['orderID'])){//第二种情况是 在个人中心订单页内结算付款
        $orderID=$_GET['orderID'];
        $queryLoad1=mysqli_query($link,"SELECT uName,sUName,isPaid,PayBy,orderStatus,orderPerson,orderAddress,orderTel,eName,ExpressNum FROM vieworderdetail WHERE oUID=$uID AND orderID='$orderID' GROUP BY orderID;");
        $queryLoad2=mysqli_query($link,"SELECT orderContainGoodsID,gName,gPrice,GoodsCount,sumPrice FROM vieworderdetail WHERE oUID=$uID AND orderID='$orderID' ;");
    }
    echo "<?xml version='1.0' encoding='UTF-8'?>";
    echo "<Orders>";
    if (@$queryLoad1){
        $orderSumPrice=0;//初始化总价为0
        echo "<order>";
            echo "<orderID>".$orderID."</orderID>";
            $rs1=mysqli_fetch_array($queryLoad1);
            $usrName=$rs1['uName'];
            echo "<usrName>".$usrName."</usrName>";
            $StoreName=$rs1['sUName'];
            echo "<scoreName>".$StoreName."</scoreName>";
            $isPaid=$rs1['isPaid'];
            echo "<isPaid>".$isPaid."</isPaid>";
            $PayBy=$rs1['PayBy'];
            echo "<PayBy>".$PayBy."</PayBy>";
            $orderStatus=$rs1['orderStatus'];
            echo "<orderStatus>".$orderStatus."</orderStatus>";
            $orderPerson=$rs1['orderPerson'];
            echo "<orderPerson>".$orderPerson."</orderPerson>";
            $orderAddress=$rs1['orderAddress'];
            echo "<orderAddress>".$orderAddress."</orderAddress>";
            $orderTel=$rs1['orderTel'];
            echo "<orderTel>".$orderTel."</orderTel>";
            $ExpressName=$rs1['eName'];
            echo "<ExpressName>".$ExpressName."</ExpressName>";
            $ExpressNum=$rs1['ExpressNum'];
            echo "<ExpressNum>".$ExpressNum."</ExpressNum>";

            echo "<ContainGoods>";
            while ($rs2=mysqli_fetch_array($queryLoad2)){
                echo "<goods>";
                    $goodsID=$rs2['orderContainGoodsID'];
                    echo "<GoodsID>".$goodsID."</GoodsID>";
                    $gName=$rs2['gName'];
                    echo "<gName>".$gName."</gName>";
                    $gPrice=$rs2['gPrice'];
                    echo "<gPrice>".$gPrice."</gPrice>";
                    $GoodsCount=$rs2['GoodsCount'];
                    echo "<GoodsCount>".$GoodsCount."</GoodsCount>";
                    $sumPrice=$rs2['sumPrice'];
                    echo "<sumPrice>".$sumPrice."</sumPrice>";
                echo "</goods>";
                $orderSumPrice +=$sumPrice;
            }
            echo "</ContainGoods>";
            echo "<OrderSumPrice>".$orderSumPrice."</OrderSumPrice>";
        echo "</order>";
    }
    echo "</Orders>";
    mysqli_close($link);
}
else{
    echo "<script>alert('非法操作！');window.close();</script>";
}
?>