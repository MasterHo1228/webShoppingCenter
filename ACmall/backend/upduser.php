<?php
/**
 * Created by IntelliJ IDEA.
 * User: MasterHo
 * Date: 2016/6/9
 * Time: 0:57
 */
session_start();
if (!empty($_SESSION['AdminID']) && !empty($_SESSION['EuID'])) {
    if (!empty($_POST['EuName'])){
        require_once ("dbconnUser.php");

        $uID=$_SESSION['EuID'];
        $EuName=htmlentities((mysqli_real_escape_string($link,$_POST['EuName'])),ENT_QUOTES,'UTF-8');
        $EuPW=htmlentities((mysqli_real_escape_string($link,$_POST['EuPW'])),ENT_QUOTES,'UTF-8');
        $EuGender=htmlentities((mysqli_real_escape_string($link,$_POST['EuGender'])),ENT_QUOTES,'UTF-8');
        $EuDateOfBirth=htmlentities((mysqli_real_escape_string($link,$_POST['EuDateOfBirth'])),ENT_QUOTES,'UTF-8');
        $EuEmail=htmlentities((mysqli_real_escape_string($link,$_POST['EuEmail'])),ENT_QUOTES,'UTF-8');
        $EuStatus=htmlentities((mysqli_real_escape_string($link,$_POST['EuStatus'])),ENT_QUOTES,'UTF-8');

        if (empty($EuPW)){
            $queryUpd="UPDATE user SET uName='$EuName',uGender='$EuGender',uDateOfBirth='$EuDateOfBirth',uEmail='$EuEmail',uStatus='$EuStatus' WHERE uID=$uID ;";
        }
        elseif (!empty($EuPW)){
            $queryUpd="UPDATE user SET uName='$EuName',uPassWord='$EuPW',uGender='$EuGender',uDateOfBirth='$EuDateOfBirth',uEmail='$EuEmail',uStatus='$EuStatus' WHERE uID=$uID ;";
        }
        if (mysqli_query($link,$queryUpd)){
            echo "<script>alert('用户信息更新成功！')</script>";
        }
        else{
            echo "<script>alert('用户信息更新失败！')</script>";
        }
        mysqli_close($link);
    }
    else{
        echo "<script>alert('请将必填项填写完整！');history.back();</script>";
    }
}
else{
    echo "<script>alert('非法操作！！');window.close();</script>";
}
?>

