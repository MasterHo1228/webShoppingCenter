<?php
/**
 * Created by IntelliJ IDEA.
 * User: MasterHo
 * Date: 2016/6/8
 * Time: 21:15
 */
session_start();
header("Content-type: text/html; charset=utf-8");
if (!empty($_SESSION['AdminID'])) {
    $AdminID = $_SESSION['AdminID'];
    require_once("../backend/dbconnUser.php");

    $queryCheck=mysqli_query($link,"SELECT ID FROM administrators WHERE Name='root' ;");
    while ($rsCheck=mysqli_fetch_array($queryCheck)){
        if ($AdminID==$rsCheck[0]){
            $isRoot=true;
        }
        elseif ($AdminID!=$rsCheck[0]){
            $isRoot=false;
            $urlEdit="editadmin.php?ID=".$_SESSION['AdminID']."";
            header('location:'.$urlEdit);
        }
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
<h2>管理员账号管理</h2>
    <table border="1">
    <tr>
        <th>ID</th>
        <th>用户名</th>
        <th>性别</th>
        <th>E-Mali</th>
        <th>操作</th>
    </tr>
    <?php
    if ($isRoot==true){
        $strsqlFind="SELECT ID,Name,Gender,Email FROM administrators ;";
        $queryFind = mysqli_query($link, $strsqlFind);
        while ($rs = mysqli_fetch_array($queryFind)) {
            $ID = $rs['ID'];
            $Name = $rs['Name'];
            $Gender = $rs['Gender'];
            $Email = $rs['Email'];
            echo "<tr>";
            echo "<td>" . $ID . "</td>";
            echo "<td>" . $Name . "</td>";
            echo "<td>" . $Gender . "</td>";
            echo "<td>" . $Email . "</td>";
            echo "<td>" ;
                echo "<a href='editadmin.php?ID=".$ID."' target='right'>编辑信息</a>";
                if ($rs['Name']!='root'){
                    echo "&nbsp;";
                    echo "<a href='#' onclick='confirmDel(".$ID.")'>删除账户</a>"."</td>";
                }
            echo "</tr>";
        }
    }
    mysqli_close($link);
}
else{
    echo "<script>alert('非法操作！');window.close();</script>";
}
?>
</table>
<script language="JavaScript">
    function confirmDel(ID) {
        if (confirm("确定要删除该管理员吗？")){
            location.href="../backend/deladmin.php?ID="+ID+"";
        }
    }
</script>