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
    $queryFind=mysqli_query($link,"SELECT grID,gID,uName,grType,grContent,grSendTime FROM viewshowgoodreplys WHERE gID=$gID ORDER BY grID DESC ;");

    echo "<?xml version='1.0' encoding='UTF-8'?>";
    echo "<Replies>";

    while ($rs=mysqli_fetch_array($queryFind)){
        echo "<reply>";
        $grID=$rs['grID'];
        $gID=$rs['gID'];
        $uName=$rs['uName'];
        $grType=$rs['grType'];
        $grContent=html_entity_decode($rs['grContent']);
        $grSendTime=$rs['grSendTime'];

        echo "<ReplyID>".$grID."</ReplyID>";
        echo "<gID>".$gID."</gID>";
        echo "<UsrName>".$uName."</UsrName>";
        echo "<ReplyType>".$grType."</ReplyType>";
        echo "<Content>".$grContent."</Content>";
        echo "<SendTime>".$grSendTime."</SendTime>";
        echo "</reply>";
    }
    echo "</Replies>";
}

mysqli_close($link);
?>