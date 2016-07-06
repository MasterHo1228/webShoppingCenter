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
    require_once("../backend/dbconnUser.php");
    if (!empty($SUID)) {
        $strsqlFind = "SELECT pnID,pnTitle,pnContent,sUName,pnSendTime FROM viewpubnews WHERE pnSendSUID=$SUID;";
    } else if (!empty($AdminID)) {
        $strsqlFind = "SELECT pnID,pnTitle,pnContent,sUName,pnSendTime FROM viewpubnews ;";
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
<h2>公告管理</h2>
    <table border="1">
    <tr>
        <th>公告标题</th>
        <th>公告内容</th>
        <th>作者</th>
        <th>发布时间</th>
        <th>操作</th>
    </tr>
    <?php
    $queryFind = mysqli_query($link, $strsqlFind);
    while ($rs = mysqli_fetch_array($queryFind)) {
        $pnID = $rs['pnID'];
        $pnTitle = $rs['pnTitle'];
        $pnContent = $rs['pnContent'];
        $sUName = $rs['sUName'];
        $pnSendTime = $rs['pnSendTime'];
        echo "<tr>";
            echo "<td>" . $pnTitle . "</td>";
            echo "<td>" . $pnContent . "</td>";
            echo "<td>" . $sUName . "</td>";
            echo "<td>" . $pnSendTime . "</td>";
            echo "<td>" ."<a href='editnews.php?pnID=".$pnID."' target='right'>编辑</a>&nbsp;"."<a href='#' onclick='confirmDel(".$pnID.")'>删除</a>"."</td>";
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
    function confirmDel(pnID) {
        if (confirm("确定要删除公告吗？")){
            location.href="../backend/delnews.php?pnID="+pnID+"";
        }
    }
</script>