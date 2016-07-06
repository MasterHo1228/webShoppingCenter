<?php
/**
 * Created by IntelliJ IDEA.
 * User: MasterHo
 * Date: 2016/6/13
 * Time: 22:14
 */
header("Content-type: text/xml");

if (!empty($_GET['pnID'])){
    $pnID=$_GET['pnID'];
    require_once ("dbconnUser.php");
    $queryFind=mysqli_query($link,"SELECT pnTitle,sUName,pnContent,pnSendTime FROM viewpubnews WHERE pnID=$pnID;");

    echo "<?xml version='1.0' encoding='UTF-8'?>";
    echo "<NewsRoot>";
    while ($rs=mysqli_fetch_array($queryFind)){
        echo "<news>";
        $pnTitle=$rs['pnTitle'];
        $sUName=$rs['sUName'];
        $pnContent=html_entity_decode($rs['pnContent']);
        $pnSendTime=$rs['pnSendTime'];

        echo "<Title>".$pnTitle."</Title>";
        echo "<PubAuthor>".$sUName."</PubAuthor>";
        echo "<Content>".$pnContent."</Content>";
        echo "<SendTime>".$pnSendTime."</SendTime>";
        echo "</news>";
    }
    echo "</NewsRoot>";
    mysqli_close($link);
}

?>