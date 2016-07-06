<?php
header("Content-type: text/html; charset=utf-8");
require_once ("dbconnUser.php");
require_once ("chkemail.php");

if (!empty($_POST['username']) && !empty($_POST['password'])) {
    if ($_POST['password'] == $_POST['password1']) {
        if (!empty($_POST['email'])){
            $email=htmlentities((mysqli_real_escape_string($link, $_POST['email'])),ENT_QUOTES,'UTF-8');
            if (check_email($email)){
                $username=htmlentities((mysqli_real_escape_string($link, $_POST['username'])),ENT_QUOTES,'UTF-8');
                $password=htmlentities((mysqli_real_escape_string($link, $_POST['password'])),ENT_QUOTES,'UTF-8');
                $sex=htmlentities((mysqli_real_escape_string($link, $_POST['sex'])),ENT_QUOTES,'UTF-8');
                $dateofbirth=htmlentities((mysqli_real_escape_string($link, $_POST['dateofbirth'])),ENT_QUOTES,'UTF-8');

                $queryReg=mysqli_query($link,"insert into user(uName,uPassWord,uGender,uDateOfBirth,uEmail) VALUES ('$username','$password','$sex','$dateofbirth','$email');");
                if (empty(mysqli_error($link))) {
                    echo "<script>alert('注册成功！');location.href='../login.html';</script>";
                } else {
                    echo "<script>alert('注册失败！');location.href='../register.html';</script>";
                }
                mysqli_close($link);
            }
            else{
                echo "<script>alert('邮箱格式错误！');location.href='../register.html';</script>";
            }
        }
        else{
            $username=htmlentities((mysqli_real_escape_string($link, $_POST['username'])),ENT_QUOTES,'UTF-8');
            $password=htmlentities((mysqli_real_escape_string($link, $_POST['password'])),ENT_QUOTES,'UTF-8');
            $sex=htmlentities((mysqli_real_escape_string($link, $_POST['sex'])),ENT_QUOTES,'UTF-8');
            $dateofbirth=htmlentities((mysqli_real_escape_string($link, $_POST['dateofbirth'])),ENT_QUOTES,'UTF-8');

            $queryReg=mysqli_query($link,"insert into user(uName,uPassWord,uGender) VALUES ('$username','$password','$sex');");
            if (empty(mysqli_error($link))) {
                echo "<script>alert('注册成功！');location.href='../login.html';</script>";
            } else {
                echo "<script>alert('注册失败！');location.href='../register.html';</script>";
            }
            mysqli_close($link);
        }
    }
    else {
        echo "<script>alert('密码输入不一致！！');location.href='../register.html';</script>";
    }

}
else {
    echo "<script>alert('请输入用户名或密码！');location.href='../register.html';</script>";
}
?>