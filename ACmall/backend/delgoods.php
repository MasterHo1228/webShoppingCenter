<?php
/**
 * Created by IntelliJ IDEA.
 * User: MasterHo
 * Date: 2016/6/9
 * Time: 9:42
 */
session_start();
if (!empty($_SESSION['sUID']) || !empty($_SESSION['AdminID']) && !empty($_GET['gID'])) {
    require_once ("dbconnGoods.php");
    $gID=$_GET['gID'];
    @$SUID=$_SESSION['sUID'];
    @$AdminID=$_SESSION['AdminID'];
    if (!empty($SUID)){
        $strsqlDel="DELETE FROM goods WHERE gID=$gID AND gSalesSUID=$SUID ;";
    }
    elseif (!empty($AdminID)){
        $strsqlDel="DELETE FROM goods WHERE gID=$gID ;";
    }

    if (mysqli_query($link,$strsqlDel)){
        echo "<script>alert('删除商品成功！');location.href('../content/goodslist.php');</script>";
    }
    else{
        echo "<script>alert('未找到商品或商品已被删除！');location.href('../content/goodslist.php');</script>";
    }
    mysqli_close($link);
}
else{
    echo "<script>alert('非法操作！！');window.close();</script>";
}
?>