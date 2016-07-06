<?php
/**
 * Created by IntelliJ IDEA.
 * User: MasterHo
 * Date: 2016/6/13
 * Time: 22:14
 */
header("Content-type: text/xml");

if (!empty($_GET['gID'])){
    $gID=$_GET['gID'];
    require_once ("dbconnGoods.php");
    $queryFind=mysqli_query($link,"SELECT gName,gPrice,gOriginPrice,gBrand,gModel,cName,gNums,gSoldOutNum,sUName,gPhoto,gDescription FROM viewshowgoodsdetail WHERE gID=$gID ;");

    echo "<?xml version='1.0' encoding='UTF-8'?>";
    echo "<Goods>";

    while ($rs=mysqli_fetch_array($queryFind)){
        echo "<good>";
        $gName=$rs['gName'];
        $gPrice=$rs['gPrice'];
        $gOriginPrice=$rs['gOriginPrice'];
        $gBrand=$rs['gBrand'];
        $gModel=$rs['gModel'];
        $cName=$rs['cName'];
        $gNums=$rs['gNums'];
        $gSoldOutNum=$rs['gSoldOutNum'];
        $sUName=$rs['sUName'];
        $PhotoPos=$rs['gPhoto'];
        $gDescription=html_entity_decode($rs['gDescription']);

        echo "<ID>".$gID."</ID>";
        echo "<Name>".$gName."</Name>";
        echo "<Price>".$gPrice."</Price>";
        echo "<OriginPrice>".$gOriginPrice."</OriginPrice>";
        echo "<Brand>".$gBrand."</Brand>";
        echo "<Model>".$gModel."</Model>";
        echo "<Category>".$cName."</Category>";
        echo "<Nums>".$gNums."</Nums>";
        echo "<SellNums>".$gSoldOutNum."</SellNums>";
        echo "<StoreName>".$sUName."</StoreName>";
        echo "<PhotoPos>".$PhotoPos."</PhotoPos>";
        echo "<Description>".$gDescription."</Description>";
        echo "</good>";
    }
    echo "</Goods>";
    mysqli_close($link);
}

?>