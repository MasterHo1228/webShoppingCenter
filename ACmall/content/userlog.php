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

    $queryCheck=mysqli_query($link,"SELECT ID FROM administrators WHERE ID=$AdminID ;");
    if (mysqli_num_rows($queryCheck)>0) {
        $isAdmin = true;
    }
    else{
        echo "<script>alert('抱歉，您没有权限进行此操作！')</script>";
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
<h2>商城店铺账号登录记录</h2>
    <table border="1">
    <tr>
        <th>ID</th>
        <th>用户名</th>
        <th>登录时间</th>
    </tr>
    <?php
    if ($isAdmin==true){
        $queryLoad = mysqli_query($link,"SELECT sUID,sUName,LoginTime FROM viewuserslogs WHERE sUID NOT IN ('999');");
        while ($rs = mysqli_fetch_array($queryLoad)) {
            $sUID = $rs['sUID'];
            $sUName = $rs['sUName'];
            $LoginTime = $rs['LoginTime'];
            echo "<tr>";
                echo "<td>" . $sUID . "</td>";
                echo "<td>" . $sUName . "</td>";
                echo "<td>" . $LoginTime . "</td>";
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
