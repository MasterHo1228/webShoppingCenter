<?php
/**
 * Created by IntelliJ IDEA.
 * User: Administrator
 * Date: 2016/6/29
 * Time: 8:55
 */
if (!empty($_GET['orderID'])){
    $orderID=$_GET['orderID'];
    $cLink="cancelorder.php?orderID=$orderID";
    echo "<script>
            if(confirm('确定要取消该订单吗？')){
                location.href='".$cLink."';
            }
            else{
                history.back();
            }
         </script>";
}
?>