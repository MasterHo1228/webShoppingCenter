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
        $strsqlFind = "SELECT gID,gName,gBrand,gModel,cName,gPrice,gNums,gSoldOutNum FROM viewshowgoodsdetail WHERE gSalesSUID=$SUID;";
    } else if (!empty($AdminID)) {
        $strsqlFind = "SELECT gID,gName,gBrand,gModel,cName,gPrice,gNums,gSoldOutNum FROM viewshowgoodsdetail ;";
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
<h2>商品管理</h2>
    <table border="1">
    <tr>
        <th>商品ID</th>
        <th>商品名</th>
        <th>品牌</th>
        <th>型号</th>
        <th>种类</th>
        <th>价格</th>
        <th>库存</th>
        <th>销量</th>
        <th>操作</th>
    </tr>
    <?php
    $queryFind = mysqli_query($link, $strsqlFind);
    while ($rs = mysqli_fetch_array($queryFind)) {
        $gID = $rs['gID'];
        $gName = $rs['gName'];
        $gBrand = $rs['gBrand'];
        $gModel = $rs['gModel'];
        $cName = $rs['cName'];
        $gPrice = $rs['gPrice'];
        $gNums = $rs['gNums'];
        $gSoldOutNum = $rs['gSoldOutNum'];
        echo "<tr>";
            echo "<td>" . $gID . "</td>";
            echo "<td>" . $gName . "</td>";
            echo "<td>" . $gBrand . "</td>";
            echo "<td>" . $gModel . "</td>";
            echo "<td>" . $cName . "</td>";
            echo "<td>" . $gPrice . "</td>";
            echo "<td>" . $gNums . "</td>";
            echo "<td>" . $gSoldOutNum . "</td>";
            echo "<td>" ."<a href='editgood.php?gID=".$gID."' target='right'>编辑</a>&nbsp;"."<a href='#' onclick='confirmDel(".$gID.")'>删除</a>"."</td>";
        echo "</tr>";
    }
    mysqli_close($link);
}
else{
    echo "<script>alert('非法操作！');window.close();</script>";
}
?>
</table>
<script language="JavaScript">
    function confirmDel(gID) {
        if (confirm("确定要删除商品吗？")){
            location.href="../backend/delgoods.php?gID="+gID+"";
        }
    }
</script>