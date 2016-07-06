<?php
/**
 * Created by IntelliJ IDEA.
 * User: MasterHo
 * Date: 2016/6/13
 * Time: 22:14
 */
header("Content-type: text/xml");
require_once ("dbconnGoods.php");

$queryFind=mysqli_query($link,"SELECT gName FROM viewshowgoodsdetail ;");

echo "<?xml version='1.0' encoding='UTF-8'?>";
echo "<Goods>";
while ($rs=mysqli_fetch_array($queryFind)){
        $gName=$rs['gName'];
        echo "<name>".$gName."</name>";
}
echo "</Goods>";
mysqli_close($link);
?>