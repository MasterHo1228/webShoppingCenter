<?php
/**
 * Created by IntelliJ IDEA.
 * User: MasterHo
 * Date: 2016/6/28
 * Time: 11:33
 */
session_start();
header("Content-type: text/xml");
if (!empty($_SESSION['uID'])) {
    $uID = $_SESSION['uID'];
    require_once("dbconnOrder.php");
    $queryFind = mysqli_query($link, "SELECT orderID,sUName,isPaid,orderStatus FROM vieworderbriefinfo WHERE oUID=$uID AND tmpOrder='0';");

    echo "<?xml version='1.0' encoding='UTF-8'?>";
    echo "<Orders>";

    while ($rs = mysqli_fetch_array($queryFind)) {
        echo "<order>";
        $orderID = $rs['orderID'];
        echo "<orderID>" . $orderID . "</orderID>";
        $StoreName = $rs['sUName'];
        echo "<StoreName>" . $StoreName . "</StoreName>";
        $isPaid = $rs['isPaid'];
        echo "<isPaid>" . $isPaid . "</isPaid>";
        $orderStatus = $rs['orderStatus'];
        echo "<orderStatus>" . $orderStatus . "</orderStatus>";
        echo "</order>";
    }
    echo "</Orders>";
    mysqli_close($link);
}
?>