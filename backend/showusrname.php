<?php
/**
 * Created by IntelliJ IDEA.
 * User: MasterHo
 * Date: 2016/6/28
 * Time: 22:13
 */
session_start();
if (!empty($_SESSION['uID'])){
    $uID=$_SESSION['uID'];
    require_once ("dbconnUser.php");

    $queryFind=mysqli_query($link,"SELECT uName FROM user WHERE uID=$uID ;");
    while ($rs=mysqli_fetch_array($queryFind)){
        @$usrName=$rs['uName'];
    }
    echo @$usrName;
    mysqli_close($link);
}
?>