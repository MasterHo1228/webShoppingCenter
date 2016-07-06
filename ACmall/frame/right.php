<?php
/**
 * Created by IntelliJ IDEA.
 * User: Administrator
 * Date: 2016/6/8
 * Time: 9:28
 */
session_start();
header("Content-type: text/html; charset=utf-8");
if (!empty($_SESSION['sUID'])){
    echo "<h3 style='text-align: center'>欢迎登录！</h3><br/>";
    echo "<h5 style='text-align: center'>".$_SESSION['sUName']."</h5>";
}
elseif (!empty($_SESSION['AdminID'])){
    echo "<h3 style='text-align: center'>Welcome back!</h3><br/>";
    echo "<h5 style='text-align: center'>".$_SESSION['AdminName']."</h5>";
}
?>

