<?php
/**
 * Created by IntelliJ IDEA.
 * User: MasterHo
 * Date: 2016/6/9
 * Time: 0:57
 */
session_start();
if (!empty($_SESSION['AdminID']) || !empty($_SESSION['sUID'])) {
    if (!empty($_POST['POrderID']) && !empty($_POST['POrderENum'])){
        require_once ("dbconnOrders.php");

        $POrderID=htmlentities((mysqli_real_escape_string($link,$_POST['POrderID'])),ENT_QUOTES,'UTF-8');
        $POrderE=htmlentities((mysqli_real_escape_string($link,$_POST['POrderE'])),ENT_QUOTES,'UTF-8');
        $POrderENum=htmlentities((mysqli_real_escape_string($link,$_POST['POrderENum'])),ENT_QUOTES,'UTF-8');

        if (!empty($POrderENum)){
            $queryUpd1=mysqli_query($link,"UPDATE orders SET ExpressID=$POrderE,ExpressNum=$POrderENum WHERE orderID='$POrderID' ;");
            $queryUpd2=mysqli_query($link,"UPDATE ordersdetail SET orderStatus='2' WHERE orderID='$POrderID' ;");
            if (empty(mysqli_error($link))){
                echo "<script>alert('更新快递信息成功！')</script>";
            }
            else{
                echo "<script>alert('更新快递信息失败！')</script>";
            }
        }
        mysqli_close($link);
    }
    else{
        echo "<script>alert('快递运单号不能为空！');history.back();</script>";
    }
}
else{
    echo "<script>alert('非法操作！！');window.close();</script>";
}
?>

