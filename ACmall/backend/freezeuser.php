<?php
/**
 * Created by IntelliJ IDEA.
 * User: Administrator
 * Date: 2016/6/13
 * Time: 16:10
 */
session_start();
if (!empty($_SESSION['AdminID']) && !empty($_GET['uID'])) {
    require_once ("dbconnUser.php");
    $uID=$_GET['uID'];

    $strsqlFrz="UPDATE user SET uStatus='0' WHERE uID=$uID ;";
    if (mysqli_query($link,$strsqlFrz)){
        echo "<script>alert('用户已被封禁！');location.href('../content/userlist.php');</script>";
    }
    else{
        echo "<script>alert('操作失败！');location.href('../content/userlist.php');</script>";
    }
    mysqli_close($link);
}
else{
    echo "<script>alert('非法操作！！');window.close();</script>";
}
?>

