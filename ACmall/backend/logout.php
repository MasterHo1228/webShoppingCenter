<?php
/**
 * Created by IntelliJ IDEA.
 * User: MasterHo
 * Date: 2016/6/7
 * Time: 17:27
 */
session_start();
if (!empty($_SESSION['sUID'])){
    session_destroy();
    echo "<script>alert('已登出~~');window.top.location.href='../login.html';</script>";
}
elseif (!empty($_SESSION['AdminID'])){
    session_destroy();
    echo "<script>alert('Goodbye!');window.top.location.href='../login.html';</script>";
}
else{
    echo "<script>alert('亲，你现在还没登录网站呦~~');history.go(-1);</script>";
}
?>

