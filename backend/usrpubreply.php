<?php
/**
 * Created by IntelliJ IDEA.
 * User: MasterHo
 * Date: 2016/6/28
 * Time: 21:39
 */
session_start();
if (!empty($_SESSION['uID']) && !empty($_POST['gID']) && !empty($_POST['replyMain'])){
    require_once ("dbconnGoods.php");
    $uID=$_SESSION['uID'];
    $gID=$_POST['gID'];
    $replyType=mysqli_real_escape_string($link,$_POST['replyType']);
    $replyMain=htmlentities((mysqli_real_escape_string($link,$_POST['replyMain'])),ENT_QUOTES,'UTF-8');

    mysqli_query($link,"INSERT INTO goodsreply(gID,grSendUID,grType,grContent) VALUES ('$gID','$uID','$replyType','$replyMain') ;");
    if (empty(mysqli_error($link))){
        echo "ok";
    }
}
?>