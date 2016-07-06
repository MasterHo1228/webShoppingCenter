<?php
/**
 * Created by IntelliJ IDEA.
 * User: MasterHo
 * Date: 2016/6/13
 * Time: 22:14
 */
header("Content-type: text/xml");
require_once ("dbconnGoods.php");

$queryFind=mysqli_query($link,"SELECT gID,gName,gPrice,gOriginPrice,gRankTop,gSoldOutNum,sUName,gPhoto FROM viewshowgoodsdetail ORDER BY gRankTop,gSoldOutNum DESC ;");

echo "<?xml version='1.0' encoding='UTF-8'?>";
echo "<Goods>";

while ($rs=mysqli_fetch_array($queryFind)){
    echo "<good>";
        $gID=$rs['gID'];
        $gName=$rs['gName'];
        $gPrice=$rs['gPrice'];
        $gOriginPrice=$rs['gOriginPrice'];
        $gRankTop=$rs['gRankTop'];
        $gSoldOutNum=$rs['gSoldOutNum'];
        $sUName=$rs['sUName'];
        $PhotoPos=$rs['gPhoto'];

        echo "<ID>".$gID."</ID>";
        echo "<Name>".$gName."</Name>";
        echo "<Price>".$gPrice."</Price>";
        echo "<OriginPrice>".$gOriginPrice."</OriginPrice>";
        echo "<isRandTop>".$gRankTop."</isRandTop>";
        echo "<SellNums>".$gSoldOutNum."</SellNums>";
        echo "<StoreName>".$sUName."</StoreName>";
        echo "<PhotoPos>".$PhotoPos."</PhotoPos>";
    echo "</good>";
}
echo "</Goods>";
mysqli_close($link);
?>