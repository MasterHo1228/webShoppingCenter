<?php
/**
 * Created by IntelliJ IDEA.
 * User: Administrator
 * Date: 2016-05-05
 * Time: 10:26
 */
session_start();
header("Content-type: text/html; charset=utf-8");

if (!empty($_SESSION['uID'])){
    echo "<script>alert('亲，您已经登录了呦！！！');location.href='index.html';</script>";
}
else{
    if (!empty($_SESSION['wrongCount']) && $_SESSION['wrongCount']>=5){
        echo "<script>alert('抱歉，您登录错误的次数过多，请稍后再登录！')</script>";
    }
    else{
        if(!empty($_POST['username']) && !empty($_POST['password'])){
            require_once("dbconnUser.php");
            require_once ("chkemail.php");
            $usrName=mysqli_real_escape_string($link,$_POST['username']);
            $usrPW=mysqli_real_escape_string($link,$_POST['password']);

            if (check_email($usrName)){
                $strsql="SELECT uID,uEmail,uPassWord,uStatus FROM user WHERE uEmail='$usrName' AND uPassWord='$usrPW'";
            }
            else{
                $strsql="SELECT uID,uName,uPassWord,uStatus FROM user WHERE uName='$usrName' AND uPassWord='$usrPW'";
            }
            $query=mysqli_query($link,$strsql);
            if (mysqli_num_rows($query)==1){
                while ($rs=mysqli_fetch_array($query)){
                    if ($rs['uStatus']==1){
                        $_SESSION['uID']=$rs['uID'];
                        unset($_SESSION['wrongCount']);
                        echo "<script>alert('登录成功！');location.href='index.html';</script>";
                    }
                    elseif ($rs['uStatus']==0){
                        echo "<script>alert('抱歉，你的账号已被封禁！！');location.href='login.html';</script>";
                    }
                }
            }
            else{
                if (empty($_SESSION['wrongCount'])){
                    $_SESSION['wrongCount']=1;
                }
                else if (!empty($_SESSION['wrongCount'])){
                    $_SESSION['wrongCount'] +=1;
                }
                echo "<script>alert('用户名或密码错误！');location.href='login.html';</script>";
            }
            mysqli_close($link);
        }
        else{
            echo "<script>alert('请输入用户名或密码！！');location.href='login.html';</script>";
        }
    }
}
?>

