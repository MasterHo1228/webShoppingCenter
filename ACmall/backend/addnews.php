<?php
/**
 * Created by IntelliJ IDEA.
 * User: MasterHo
 * Date: 2016/6/7
 * Time: 20:51
 */
session_start();
if (!empty($_SESSION['sUID']) || !empty($_SESSION['AdminID'])){
    if (empty($_SESSION['sUID']) && !empty($_SESSION['AdminID'])){
        $AuthorID=999;
    }
    else{
        $AuthorID=$_SESSION['sUID'];
    }
    if (!empty($_POST['NewNewsTitle']) && !empty($_POST['NewNewsMain'])){
        require_once ("dbconnUser.php");

        $NewNewsTitle=htmlentities((mysqli_real_escape_string($link,$_POST['NewNewsTitle'])),ENT_QUOTES,'UTF-8');
        $NewNewsMain=htmlentities((mysqli_real_escape_string($link,$_POST['NewNewsMain'])),ENT_QUOTES,'UTF-8');
        
        $queryAdd=mysqli_query($link,"INSERT INTO supubnews(pnSendSUID,pnTitle,pnContent) VALUES ($AuthorID,'$NewNewsTitle','$NewNewsMain');");
        if ($queryAdd){
            echo "<script>alert('发布成功!');location.href='../content/newslist.php';</script>";
        }
        else{
            echo "<script>alert('发布失败！')</script>";
        }
    }
    else{
        echo "<script>alert('请将必填项填写完整！');history.back();</script>";
    }
}
else{
    echo "<script>alert('非法操作！');window.close();</script>";
}
?>