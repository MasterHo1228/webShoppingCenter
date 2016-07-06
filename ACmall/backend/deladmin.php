<?php
/**
 * Created by IntelliJ IDEA.
 * User: MasterHo
 * Date: 2016/6/9
 * Time: 9:42
 */
session_start();
if (!empty($_SESSION['AdminID']) && !empty($_GET['ID'])) {
    $AdminID = $_SESSION['AdminID'];
    require_once ("dbconnUser.php");
    $queryCheck=mysqli_query($link,"SELECT ID FROM administrators WHERE Name='root' ;");
    while ($rsCheck=mysqli_fetch_array($queryCheck)){
        if ($AdminID==$rsCheck[0]){
            $isRoot=true;
            $ID=$_GET['ID'];
            $strsqlDel="DELETE FROM administrators WHERE ID=$ID ;";

            if (mysqli_query($link,$strsqlDel)){
                echo "<script>alert('管理员删除成功！');location.href('../content/adminlist.php');</script>";
            }
            else{
                echo "<script>alert('未找到账号或账号已被删除！');location.href('../content/adminlist.php');</script>";
            }
        }
        elseif ($AdminID!=$rsCheck[0]){
            $isRoot=false;
            echo "<script>alert('抱歉，您的账号没有进行该操作的权限！！');window.close();</script>";
        }
    }
    mysqli_close($link);
}
else{
    echo "<script>alert('非法操作！！');window.close();</script>";
}
?>