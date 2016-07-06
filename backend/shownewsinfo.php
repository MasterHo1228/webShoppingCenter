<?php
/**
 * Created by IntelliJ IDEA.
 * User: MasterHo
 * Date: 2016/6/13
 * Time: 22:14
 */
header("Content-type: text/xml");
require_once ("dbconnUser.php");

$queryFind=mysqli_query($link,"SELECT pnID,pnTitle FROM viewpubnews ORDER BY pnID DESC LIMIT 10;");

echo "<?xml version='1.0' encoding='UTF-8'?>";
echo "<NewsRoot>";

while ($rs=mysqli_fetch_array($queryFind)){
    echo "<news>";
        $pnID=$rs['pnID'];
        $pnTitle=$rs['pnTitle'];

        echo "<ID>".$pnID."</ID>";
        echo "<Title>".$pnTitle."</Title>";
    echo "</news>";
}
echo "</NewsRoot>";
mysqli_close($link);