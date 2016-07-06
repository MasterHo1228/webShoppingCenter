<?php
/**
 * Created by IntelliJ IDEA.
 * User: MasterHo
 * Date: 2016/6/9
 * Time: 0:57
 */
session_start();
if (!empty($_SESSION['sUID']) || !empty($_SESSION['AdminID']) && !empty($_SESSION['pnID'])) {
    @$sUID=$_SESSION['sUID'];

    if (!empty($_POST['ENewsTitle']) && !empty($_POST['ENewsMain'])){
        require_once ("dbconnUser.php");
        $pnID=$_SESSION['pnID'];
        $ENewsTitle=htmlentities((mysqli_real_escape_string($link,$_POST['ENewsTitle'])),ENT_QUOTES,'UTF-8');
        $ENewsMain=htmlentities((mysqli_real_escape_string($link,$_POST['ENewsMain'])),ENT_QUOTES,'UTF-8');

        if (!empty($ENewsTitle) && !empty($ENewsMain)){
            if (!empty($_SESSION['sUID'])){
                $queryUpd="UPDATE supubnews SET pnTitle='$ENewsTitle',pnContent='$ENewsMain' WHERE pnID=$pnID AND pnSendSUID=$sUID ;";
            }
            else{
                $queryUpd="UPDATE supubnews SET pnTitle='$ENewsTitle',pnContent='$ENewsMain' WHERE pnID=$pnID ;";
            }
        }
        if (mysqli_query($link,$queryUpd)){
            echo "<script>alert('公告更新成功！')</script>";
        }
        else{
            echo "<script>alert('公告更新失败！')</script>";
        }
        mysqli_close($link);
    }
    else{
        echo "<script>alert('标题和内容不能为空呦！！');history.back();</script>";
    }
}
else{
    echo "<script>alert('非法操作！！');window.close();</script>";
}
?>

