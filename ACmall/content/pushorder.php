<?php
/**
 * Created by IntelliJ IDEA.
 * User: MasterHo
 * Date: 2016/6/8
 * Time: 23:11
 */
session_start();
header("Content-type: text/html; charset=utf-8");
if (!empty($_SESSION['sUID']) || !empty($_SESSION['AdminID']) && !empty($_GET['orderID'])) {
    $orderID=$_GET['orderID'];
    @$sUID=$_SESSION['sUID'];
    @$AdminID=$_SESSION['AdminID'];
    require_once ("../backend/dbconnOrders.php");
    if (!empty($sUID)){
        $strsqlVerify="SELECT orderID,gSalesSUID,orderStatus FROM vieworderbriefinfo WHERE orderID='$orderID' AND gSalesSUID=$sUID;";
    }
    elseif (!empty($AdminID)){
        $strsqlVerify="SELECT orderID,gSalesSUID,orderStatus FROM vieworderbriefinfo WHERE orderID='$orderID' GROUP BY orderID;";
    }
    $queryVerify=mysqli_query($link,$strsqlVerify);
    if (mysqli_num_rows($queryVerify)==0){
        if (mysqli_error($link)){
            echo mysqli_error($link);
        }
        echo "<script>alert('验证加载失败！')</script>";
    }
    elseif (mysqli_num_rows($queryVerify)==1){
        while ($rsVerify=mysqli_fetch_array($queryVerify)){
            $orderStatus=$rsVerify['orderStatus'];
        }
        if ($orderStatus==2 || $orderStatus==3){
            echo "<script>alert('该订单已发货！！');history.go(-1)</script>";
        }
        elseif ($orderStatus==0){
            echo "<script>alert('该订单已被取消！！');history.go(-1)</script>";
        }
        elseif ($orderStatus==1){
            $strsqlLoad="SELECT eID,eName FROM expresses ORDER BY eID ASC ;";
            $queryLoad=mysqli_query($link,$strsqlLoad);
        }
    }
?>
<style type="text/css">
    input,select,textarea{
        margin: 5px 0;
        height: 22px;
    }
    #btnPushOrder{
        width: 125px;
        height: 28px;
        margin: 8px;
    }
    .NotNull{
        color: red;
    }
</style>
<h1>填写订单发货信息</h1>
<form action="../backend/updorder.php" method="post" id="formEditGood">
    <label for="txtOrderID">订单号：</label><input type="text" name="POrderID" id="txtOrderID" value="<?php echo $orderID?>" readonly><br/>
    <span class="NotNull">*</span><label for="selPOrderE">发货快递：</label><select name="POrderE" id="selPOrderE">
        <?php
        while ($rs=mysqli_fetch_array($queryLoad)){
            $eID=$rs['eID'];
            $eName=$rs['eName'];
            echo "<option value='".$eID."'>".$eName."</option>";
        }
        ?>
    </select><br/>
    <span class="NotNull">*</span><label for="txtPOrderENum">快递运单号:</label><input type="text" name="POrderENum" id="txtPOrderENum" maxlength="20"><br/>
    <input type="submit" value="提交" id="btnPushOrder">
</form>
<?php
    mysqli_close($link);
}
?>