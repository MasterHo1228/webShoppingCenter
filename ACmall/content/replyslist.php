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
    require_once("../backend/dbconnGoods.php");
    if (!empty($SUID)) {
        $strsqlFind = "SELECT uName,gName,sUName,grType,grContent,grSendTime FROM viewshowgoodreplys WHERE gSalesSUID=$SUID;";
    } else if (!empty($AdminID)) {
        $strsqlFind = "SELECT uName,gName,sUName,grType,grContent,grSendTime FROM viewshowgoodreplys ;";
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
<h2>商品评价管理</h2>
    <table border="1">
    <tr>
        <th>用户名</th>
        <th>商品名</th>
        <th>商品店铺</th>
        <th>评价类型</th>
        <th>评价内容</th>
        <th>评价时间</th>
    </tr>
    <?php
    $queryFind = mysqli_query($link, $strsqlFind);
    while ($rs = mysqli_fetch_array($queryFind)) {
        $uName = $rs['uName'];
        $gName = $rs['gName'];
        $sUName = $rs['sUName'];
        $grType = $rs['grType'];
        $grContent = $rs['grContent'];
        $grSendTime = $rs['grSendTime'];
        echo "<tr>";
            echo "<td>" . $uName . "</td>";
            echo "<td>" . $gName . "</td>";
            echo "<td>" . $sUName . "</td>";
            if ($grType=='1'){
                echo "<td>" . "好评". "</td>";
            }
            elseif ($grType=='2'){
                echo "<td>" . "中评". "</td>";
            }
            elseif ($grType=='3'){
                echo "<td>" . "差评". "</td>";
            }
            echo "<td>" . $grContent . "</td>";
            echo "<td>" . $grSendTime . "</td>";
        echo "</tr>";
    }
    mysqli_close($link);
}
else{
    echo "<script>alert('非法操作！');window.close();</script>";
}
?>
</table>