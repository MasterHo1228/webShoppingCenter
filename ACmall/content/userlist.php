<?php
/**
 * Created by IntelliJ IDEA.
 * User: MasterHo
 * Date: 2016/6/9
 * Time: 21:42
 */
session_start();
header("Content-type: text/html; charset=utf-8");
if (!empty($_SESSION['AdminID'])) {
$AdminID = $_SESSION['AdminID'];
require_once("../backend/dbconnUser.php");
    $strsqlFind = "SELECT uID,uName,uGender,uEmail,uGrade,uRegTime,uStatus FROM user ;";
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
<h2>商城会员管理</h2>
<table border="1">
    <tr>
        <th>用户名</th>
        <th>性别</th>
        <th>E-Mail</th>
        <th>会员等级</th>
        <th>注册时间</th>
        <th>账号状态</th>
        <th>操作</th>
    </tr>
    <?php
    $queryFind = mysqli_query($link, $strsqlFind);
    while ($rs = mysqli_fetch_array($queryFind)) {
        $uID = $rs['uID'];
        $uName = $rs['uName'];
        $uGender = $rs['uGender'];
        $uEmail = $rs['uEmail'];
        $uGrade = $rs['uGrade'];
        $uRegTime = $rs['uRegTime'];
        $uStatus = $rs['uStatus'];
        echo "<tr>";
        echo "<td>" . $uName . "</td>";
        echo "<td>" . $uGender . "</td>";
        echo "<td>" . $uEmail . "</td>";
        echo "<td>" . $uGrade . "</td>";
        echo "<td>" . $uRegTime . "</td>";
        if ($uStatus==1){
            echo "<td>" . "正常" . "</td>";
        }
        elseif ($uStatus==0){
            echo "<td>" . "冻结" . "</td>";
        }
        echo "<td>";
            echo "<a href='edituser.php?uID=".$uID."' target='right'>编辑</a>&nbsp;";
            if ($uStatus==1){
                echo "<a href='#' onclick='freezeUser(".$uID.")'>封禁</a>&nbsp;";
            }
            elseif ($uStatus==0){
                echo "<a href='#' onclick='UnFrzUser(".$uID.")'>解封</a>&nbsp;";
            }
            echo "<a href='#' onclick='confirmDel(".$uID.")'>删除</a>";
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
<script language="JavaScript">
    function confirmDel(uID) {
        if (confirm("确定要删除用户吗？")){
            location.href="../backend/deluser.php?uID="+uID+"";
        }
    }
    function freezeUser(uID) {
        if (confirm("确定要封禁该用户吗？")){
            location.href="../backend/freezeuser.php?uID="+uID+"";
        }
    }
    function UnFrzUser(uID) {
        if (confirm("确定要解封该用户吗？")){
            location.href="../backend/unfrzuser.php?uID="+uID+"";
        }
    }

</script>