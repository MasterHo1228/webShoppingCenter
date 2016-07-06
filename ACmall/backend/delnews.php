<?php
/**
 * Created by IntelliJ IDEA.
 * User: MasterHo
 * Date: 2016/6/9
 * Time: 9:42
 */
session_start();
if (!empty($_SESSION['AdminID']) && !empty($_GET['pnID'])) {
    require_once ("dbconnUser.php");
    $pnID=$_GET['pnID'];
    $strsqlDel="DELETE FROM supubnews WHERE pnID=$pnID ;";

    if (mysqli_query($link,$strsqlDel)){
        echo "<script>alert('删除公告成功！');location.href('../content/newslist.php');</script>";
    }
    else{
        echo "<script>alert('未找到公告或公告已被删除！');location.href('../content/newslist.php');</script>";
    }
    mysqli_close($link);
}
else{
    echo "<script>alert('非法操作！！');window.close();</script>";
}
?>