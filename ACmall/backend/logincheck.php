<?php
/**
 * Created by IntelliJ IDEA.
 * User: Administrator
 * Date: 2016-05-05
 * Time: 10:26
 */
session_start();
header("Content-type: text/html; charset=utf-8");

if (!empty($_SESSION['sUID']) || !empty($_SESSION['AdminID'])){
    echo "<script>alert('已登录！！！');location.href='manage_h4.html';</script>";
}
else{
    if (!empty($_SESSION['adWrongCount']) && $_SESSION['adWrongCount']>=3){
        echo "<script>alert('抱歉，您登录错误的次数过多，请稍后再登录！')</script>";
    }
    else{
        if(!empty($_POST['usrName']) && !empty($_POST['usrPW'])){
            require_once("dbconnUser.php");
            $usrName=mysqli_real_escape_string($link,$_POST['usrName']);
            $usrPW=mysqli_real_escape_string($link,$_POST['usrPW']);

            $queryFindSUser=mysqli_query($link,"SELECT sUID,sUName,sULoginName,sUPassWord FROM salesuser WHERE sULoginName='$usrName' AND sUPassWord='$usrPW'");
            if (mysqli_num_rows($queryFindSUser)==1){
                while ($rs=mysqli_fetch_array($queryFindSUser)){
                    $_SESSION['sUID']=$rs['sUID'];
                    $_SESSION['sUName']=$rs['sUName'];
                }
                $sUID=$_SESSION['sUID'];
                $queryLog1=mysqli_query($link,"INSERT INTO usrloginlog(sUID) VALUES ($sUID) ;");
                unset($_SESSION['adWrongCount']);
                echo "<script>alert('登录成功！');location.href='manage_h4.html';</script>";
            }
            else{
                $queryFindAdmin=mysqli_query($link,"SELECT ID,Name,PassWord FROM administrators WHERE Name='$usrName' AND PassWord='$usrPW'");
                if (mysqli_num_rows($queryFindAdmin)==1){
                    while ($rs=mysqli_fetch_array($queryFindAdmin)){
                        $_SESSION['AdminID']=$rs['ID'];
                        $_SESSION['AdminName']=$rs['Name'];
                    }
                    $AdminID=$_SESSION['AdminID'];
                    $queryLog2=mysqli_query($link,"INSERT INTO usrloginlog(sUID,AdminID) VALUES (999,$AdminID) ;");
                    unset($_SESSION['adWrongCount']);
                    echo "<script>alert('Welcome back!');location.href='manage_h4.html';</script>";
                }
                else{
                    if (empty($_SESSION['adWrongCount'])){
                        $_SESSION['adWrongCount']=1;
                    }
                    else if (!empty($_SESSION['adWrongCount'])){
                        $_SESSION['adWrongCount'] +=1;
                    }
                    echo "<script>alert('用户名或密码错误！')</script>";
                }
            }
            mysqli_close($link);
        }
    }
}
?>

