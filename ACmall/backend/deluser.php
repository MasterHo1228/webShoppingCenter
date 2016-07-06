<?php
/**
 * Created by IntelliJ IDEA.
 * User: MasterHo
 * Date: 2016/6/9
 * Time: 9:42
 */
session_start();
if (!empty($_SESSION['AdminID']) && !empty($_GET['uID'])) {
    require_once ("dbconnUser.php");
    $uID=$_GET['uID'];
    $strsqlDel="DELETE FROM user WHERE uID=$uID ;";

    if (mysqli_query($link,$strsqlDel)){
        echo "<script>alert('删除用户成功！');location.href('../content/userlist.php');</script>";
    }
    else{
        echo "<script>alert('删除用户失败！');location.href('../content/userlist.php');</script>";
    }
    mysqli_close($link);
}
else{
    echo "<script>alert('非法操作！！');window.close();</script>";
}
?>