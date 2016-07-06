<?php
/**
 * Created by IntelliJ IDEA.
 * User: MasterHo
 * Date: 2016/6/9
 * Time: 0:57
 */
session_start();
if (!empty($_SESSION['AdminID']) && !empty($_SESSION['EaID'])) {
    if (!empty($_POST['EaName'])){
        require_once ("dbconnUser.php");

        $EaID=$_SESSION['EaID'];
        $EaName=htmlentities((mysqli_real_escape_string($link,$_POST['EaName'])),ENT_QUOTES,'UTF-8');
        $EaPW=htmlentities((mysqli_real_escape_string($link,$_POST['EaPW'])),ENT_QUOTES,'UTF-8');
        $EaGender=htmlentities((mysqli_real_escape_string($link,$_POST['EaGender'])),ENT_QUOTES,'UTF-8');
        $EaEmail=htmlentities((mysqli_real_escape_string($link,$_POST['EaEmail'])),ENT_QUOTES,'UTF-8');

        if (empty($EaPW)){
            $queryUpd="UPDATE administrators SET Name='$EaName',Gender='$EaGender',Email='$EaEmail' WHERE ID=$EaID ;";
        }
        elseif (!empty($EaPW)){
            $queryUpd="UPDATE administrators SET Name='$EaName',Password='$EaPW',Gender='$EaGender',Email='$EaEmail' WHERE ID=$EaID ;";
        }
        if (mysqli_query($link,$queryUpd)){
            echo "<script>alert('管理员信息更新成功！')</script>";
        }
        else{
            echo "<script>alert('管理员信息更新失败！')</script>";
        }
        mysqli_close($link);
    }
    else{
        echo "<script>alert('Name不能为空！')</script>";
    }
}
else{
    echo "<script>alert('非法操作！！');window.close();</script>";
}
?>

