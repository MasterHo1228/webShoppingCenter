<?php
/**
 * Created by IntelliJ IDEA.
 * User: MasterHo
 * Date: 2016/6/8
 * Time: 23:11
 */
session_start();
header("Content-type: text/html; charset=utf-8");
if (!empty($_SESSION['sUID']) || !empty($_SESSION['AdminID']) && !empty($_GET['gID'])) {
    $gID=$_GET['gID'];
    $_SESSION['gID']=$gID;
    @$sUID=$_SESSION['sUID'];
    @$AdminID=$_SESSION['AdminID'];
    require_once ("../backend/dbconnGoods.php");
    if (!empty($sUID)){
        $strsqlVerify="SELECT gID,gSalesSUID FROM viewshowgoodsdetail WHERE gID=$gID AND gSalesSUID=$sUID;";
    }
    elseif (!empty($AdminID)){
        $strsqlVerify="SELECT gID FROM viewshowgoodsdetail WHERE gID=$gID ;";
    }
    $queryVerify=mysqli_query($link,$strsqlVerify);
    if (mysqli_num_rows($queryVerify)==0){
        echo "<script>alert('验证加载失败！')</script>";
    }
    elseif (mysqli_num_rows($queryVerify)==1){
        $strsqlLoad="SELECT gName,gPrice,gVPrice,gOriginPrice,gBrand,gModel,gCateID,gNums,gDescription FROM viewshowgoodsdetail WHERE gID=$gID";
        $queryLoad=mysqli_query($link,$strsqlLoad);
        $queryLoadCate=mysqli_query($link,"SELECT cID,cName FROM goodscategory ;");
    }

?>
    <script type="text/javascript" charset="utf-8" src="../js/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="../js/ueditor.all.min.js"> </script>
<style type="text/css">
    input,select,textarea{
        margin: 5px 0;
        height: 22px;
    }
    .inputPrice{
        width: 70px;
        height: 25px;
    }
    #btnEditGood{
        width: 125px;
        height: 28px;
        margin: 8px;
    }
    #txtEGoodDesc{
        width: 380px;
        height: 100px;
    }
    #EGoodsMain{
        margin-bottom: 20px;
    }
    #divGoodsDesc{
        width: 860px;
        height: 450px;
    }
    #divBtnSubmit{
        margin-top: 105px;
    }
    .NotNull{
        color: red;
    }
</style>
<?php
    while ($rs=mysqli_fetch_array($queryLoad)){
        $EgName=$rs['gName'];
        $EgPrice=$rs['gPrice'];
        $EgVPrice=$rs['gVPrice'];
        $EgOriginPrice=$rs['gOriginPrice'];
        $EgBrand=$rs['gBrand'];
        $EgModel=$rs['gModel'];
        $EgCateID=$rs['gCateID'];
        $EgNums=$rs['gNums'];
        $EgDescription=$rs['gDescription'];
    }    
?>
<h1>编辑商品信息</h1>
<form action="../backend/updgood.php" enctype="multipart/form-data" method="post" id="formEditGood">
    <div id="EGoodsMain">
        <span class="NotNull">*</span><label for="txtEGoodName">商品名称：</label><input type="text" name="EGoodName" id="txtEGoodName" value="<?php echo $EgName?>" maxlength="50"><br/>
        <span class="NotNull">*</span><label for="txtEGoodPrice">商品价格：</label><input type="text" name="EGoodPrice" id="txtEGoodPrice" class="inputPrice" value="<?php echo $EgPrice?>" maxlength="12">
        <label for="txtEGoodVPrice">会员价：</label><input type="text" name="EGoodVPrice" id="txtEGoodVPrice" class="inputPrice" value="<?php echo $EgVPrice?>" maxlength="12">
        <label for="txtEGoodOPrice">原价：</label><input type="text" name="EGoodOPrice" id="txtEGoodOPrice" class="inputPrice" value="<?php echo $EgOriginPrice?>" maxlength="12"><br/>
        <label for="txtEGoodBrand">商品品牌：</label><input type="text" name="EGoodBrand" id="txtEGoodBrand" value="<?php echo $EgBrand?>" maxlength="25"><br/>
        <label for="txtEGoodModel">商品型号：</label><input type="text" name="EGoodModel" id="txtEGoodModel" value="<?php echo $EgModel?>" maxlength="20"><br/>
        <label for="selEGoodCate">商品类型：</label><select name="EGoodCate" id="selEGoodCate">
            <?php
            while ($rs=mysqli_fetch_array($queryLoadCate)){
                $cateID=$rs['cID'];
                $cateName=$rs['cName'];
                if ($cateID==$EgCateID){
                    echo "<option value='".$cateID."' selected>".$cateName."</option>";
                }
                else{
                    echo "<option value='".$cateID."'>".$cateName."</option>";
                }
            }
            ?>
        </select>
        <label for="selEGoodRank">是否为首推商品：</label><select name="EGoodRank" id="selEGoodRank">
            <option value="1">是</option>
            <option value="0" selected>否</option>
        </select><br/>
        <span class="NotNull">*</span><label for="txtEGoodCount">商品数量:</label><input type="text" name="EGoodCount" id="txtEGoodCount" value="<?php echo $EgNums?>" maxlength="10"><br/>
        <label for="fiEGoodPhoto">商品图片:</label><input type="file" name="EGoodPhoto" id="fiEGoodPhoto"><br/>
    </div>
    <div id="divGoodsDesc">
        <span class="NotNull">*</span><label for="txtEGoodDesc">商品描述：</label>
        <script id="txtEGoodDesc" name="EGoodDesc" type="text/plain"><?php echo html_entity_decode($EgDescription)?></script>
    </div>
    <div id="divBtnSubmit">
        <input type="submit" value="提交" id="btnEditGood">
    </div>
</form>
<?php
    mysqli_close($link);
}
?>
<script type="text/javascript">
    var editor = UE.getEditor('txtEGoodDesc');
</script>

