<?php
/**
 * Created by IntelliJ IDEA.
 * User: MasterHo
 * Date: 2016/6/8
 * Time: 21:15
 */
session_start();
header("Content-type: text/html; charset=utf-8");
if (!empty($_SESSION['sUID']) || !empty($_SESSION['AdminID'])) {
    @$SUID = $_SESSION['sUID'];
    @$AdminID = $_SESSION['AdminID'];
    require_once("../backend/dbconnOrders.php");
    if (!empty($SUID)) {
        $strsqlFind = "SELECT orderID,uName,sUName,tmpOrder,isPaid,PayBy,orderStatus,orderPerson,orderAddress,orderTel,eName,ExpressNum FROM vieworderbriefinfo WHERE gSalesSUID=$SUID;";
    } else if (!empty($AdminID)) {
        $strsqlFind = "SELECT orderID,uName,sUName,tmpOrder,isPaid,PayBy,orderStatus,orderPerson,orderAddress,orderTel,eName,ExpressNum FROM vieworderbriefinfo GROUP BY orderID;";
    }
    ?>
<style type="text/css">
    h2{
        text-align: center;
    }
    table{
        margin: 25px auto;
        text-align: center;
    }
</style>
<h2>订单管理</h2>
    <table border="1">
    <tr>
        <th>订单号</th>
        <th>用户名</th>
        <th>店铺名</th>
        <th>是否为临时订单</th>
        <th>是否已付款</th>
        <th>付款方式</th>
        <th>订单状态</th>
        <th>收货人</th>
        <th>收货地址</th>
        <th>联系电话</th>
        <th>发货快递</th>
        <th>快递运单号</th>
        <th>操作</th>
    </tr>
    <?php
    $queryFind = mysqli_query($link, $strsqlFind);
    while (@$rs = mysqli_fetch_array($queryFind)) {
        $orderID = $rs['orderID'];
        $uName = $rs['uName'];
        $sUName = $rs['sUName'];
        $tmpOrder = $rs['tmpOrder'];
        $isPaid = $rs['isPaid'];
        $PayBy = $rs['PayBy'];
        $orderPerson = $rs['orderPerson'];
        $orderAddress = $rs['orderAddress'];
        $orderTel = $rs['orderTel'];
        $orderStatus = $rs['orderStatus'];
        $eName = $rs['eName'];
        $ExpressNum = $rs['ExpressNum'];
        echo "<tr>";
            echo "<td>" . $orderID . "</td>";
            echo "<td>" . $uName . "</td>";
            echo "<td>" . $sUName . "</td>";
            switch ($tmpOrder){
                case '1':
                    echo "<td>" . "是" . "</td>";
                    break;
                case '0':
                    echo "<td>" . "否" . "</td>";
                    break;
            }
            switch ($isPaid){
                case 'true':
                    echo "<td>" . "已付款" . "</td>";
                    break;
                case 'false':
                    echo "<td>" . "未付款" . "</td>";
                    break;
            }

            switch ($PayBy){
                case 'ALIPAY':
                case 'alipay':
                    echo "<td>" . "支付宝" . "</td>";
                    break;
                case 'WECHAT':
                case 'wechat':
                    echo "<td>" . "微信" . "</td>";
                    break;
                default:
                    echo "<td>" . "未付款" . "</td>";
            }
            switch ($orderStatus){
                case 0:
                    echo "<td>" ."已取消". "</td>";
                    break;
                case 1:
                    echo "<td>" ."未发货". "</td>";
                    break;
                case 2:
                    echo "<td>" ."已发货". "</td>";
                    break;
                case 3:
                    echo "<td>" ."已收货". "</td>";
                    break;
            }
        
            echo "<td>" . $orderPerson . "</td>";
            echo "<td>" . $orderAddress . "</td>";
            echo "<td>" . $orderTel . "</td>";
            echo "<td>" . $eName . "</td>";
            echo "<td>" . $ExpressNum . "</td>";
            echo "<td>";
                if ($orderStatus==1) {
                    echo "<a href='pushorder.php?orderID=" . $orderID . "' target='right'>订单发货</a>&nbsp;";
                    echo "<a href='../backend/confirmdelorder.php?orderID=".$orderID."'>取消订单</a>";
                }
            echo "</td>";
        echo "</tr>";
    }
    mysqli_close($link);
}
else{
    echo "<script>alert('非法操作！');window.close();</script>";
}
?>
</table>