<?php
/**
 * Created by IntelliJ IDEA.
 * User: MasterHo
 * Date: 2016/6/28
 * Time: 11:33
 */
session_start();
header("Content-type: text/xml");
if (!empty($_SESSION['uID']) && !empty($_GET['orderID'])) {
    $uID = $_SESSION['uID'];
    $orderID = $_GET['orderID'];

    require_once("dbconnOrder.php");
    $queryFindGoods = mysqli_query($link, "SELECT orderContainGoodsID FROM vieworderdetail WHERE oUID=$uID AND orderID='$orderID' GROUP BY orderID ;");
    if (mysqli_num_rows($queryFindGoods)>0){
        while ($rsGoods=mysqli_fetch_array($queryFindGoods)){
            $goodsID=$rsGoods[0];
        }

        mysqli_close($link);
        require_once ("dbconnGoods.php");

        $queryLoadGoods=mysqli_query($link,"SELECT gName,gPhoto FROM goods WHERE gID=$goodsID ;");

        echo "<?xml version='1.0' encoding='UTF-8'?>";
        echo "<Goods>";

        while ($rsLoad = mysqli_fetch_array($queryLoadGoods)) {
            echo "<good>";
            echo "<goodsID>" . $goodsID . "</goodsID>";
            $gName = $rsLoad['gName'];
            echo "<gName>" . $gName . "</gName>";
            $gPhoto = $rsLoad['gPhoto'];
            echo "<PhotoPos>" . $gPhoto . "</PhotoPos>";
            echo "</good>";
        }
        echo "</Goods>";
        mysqli_close($link);
    }
}
?>