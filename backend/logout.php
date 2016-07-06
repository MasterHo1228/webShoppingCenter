<?php
/**
 * Created by IntelliJ IDEA.
 * User: MasterHo
 * Date: 2016/5/6
 * Time: 19:02
 */
session_start();
header("Content-type: text/html; charset=utf-8");
if (!empty($_SESSION['uID'])){
    $uID=$_SESSION['uID'];
    require_once ("dbconnOrder.php");
    $queryDropCart=mysqli_query($link,"DELETE FROM orders WHERE oUID='$uID' AND tmpOrder='1' ;");
    if (!empty(mysqli_error($link))){
        echo mysqli_error($link);
    }
    session_destroy();
    echo "<script>alert('已登出~~');location.href='../index.html';</script>";
}
else{
    echo "<script>alert('亲，你现在还没登录网站呦~~');history.go(-1);</script>";
}
?>