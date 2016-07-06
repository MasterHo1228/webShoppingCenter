<?php
/**
 * Created by IntelliJ IDEA.
 * User: MasterHo
 * Date: 2016/5/31
 * Time: 17:48
 */
session_start();
if (!empty($_SESSION['sUID'])){
    echo "login";
}
elseif (!empty($_SESSION['AdminID'])){
    require_once ("dbconnUser.php");
    $aID=$_SESSION['AdminID'];

    $queryCheck=mysqli_query($link,"SELECT ID FROM administrators WHERE Name='root' ;");
    while ($rs=mysqli_fetch_array($queryCheck)){
        if ($aID==$rs[0]){
            echo "root";
        }
        elseif ($aID!=$rs[0]){
            echo "Adminlogin";
        }
    }
}
?>