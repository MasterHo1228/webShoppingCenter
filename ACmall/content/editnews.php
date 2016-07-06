<?php
/**
 * Created by IntelliJ IDEA.
 * User: MasterHo
 * Date: 2016/6/8
 * Time: 23:11
 */
session_start();
header("Content-type: text/html; charset=utf-8");
if (!empty($_SESSION['sUID']) || !empty($_SESSION['AdminID']) && !empty($_GET['pnID'])) {
    $pnID=$_GET['pnID'];
    $_SESSION['pnID']=$pnID;
    @$sUID=$_SESSION['sUID'];
    @$AdminID=$_SESSION['AdminID'];
    require_once ("../backend/dbconnUser.php");
    if (!empty($sUID)){
        $strsqlVerify="SELECT pnID,pnSendSUID FROM viewpubnews WHERE pnID=$pnID AND pnSendSUID=$sUID;";
    }
    elseif (!empty($AdminID)){
        $strsqlVerify="SELECT pnID FROM viewpubnews WHERE pnID=$pnID ;";
    }
    $queryVerify=mysqli_query($link,$strsqlVerify);
    if (mysqli_num_rows($queryVerify)==0){
        echo "<script>alert('验证加载失败！')</script>";
    }
    elseif (mysqli_num_rows($queryVerify)==1){
        $strsqlLoad="SELECT pnTitle,pnContent FROM viewpubnews WHERE pnID=$pnID";
        $queryLoad=mysqli_query($link,$strsqlLoad);
    }

?>
<script type="text/javascript" charset="utf-8" src="../js/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="../js/ueditor.all.min.js"> </script>
<style type="text/css">
    input,select,textarea{
        margin: 5px 0;
        height: 22px;
    }
    #btnEditNews{
        width: 125px;
        height: 28px;
        margin: 8px;
    }
    #txtENewsTitle{
        width: 380px;
    }
    #divNewsMain{
        margin-top: 15px;
    }
    .NotNull{
        color: red;
    }
</style>
<?php
    while ($rs=mysqli_fetch_array($queryLoad)){
        $EpnTitle=$rs['pnTitle'];
        $EpnContent=$rs['pnContent'];
    }
?>
<h1>编辑新闻内容</h1>
<form action="../backend/updnews.php" method="post" id="formEditNews">
    <span class="NotNull">*</span><label for="txtENewsTitle">公告标题：</label><input type="text" name="ENewsTitle" id="txtENewsTitle" value="<?php echo html_entity_decode($EpnTitle)?>"><br/>
    <span class="NotNull">*</span><label for="txtENewsMain">公告内容：</label>
    <div id="divNewsMain">
        <script id="txtENewsMain" name="ENewsMain" type="text/plain"><?php echo html_entity_decode($EpnContent)?></script>
    </div><br/>
    <input type="submit" value="提交" id="btnEditNews">
</form>
<?php
    mysqli_close($link);
}
?>
<script type="text/javascript">
    var editor = UE.getEditor('txtENewsMain');
</script>
