<?php
/**
 * Created by IntelliJ IDEA.
 * User: MasterHo
 * Date: 2016/6/11
 * Time: 10:23
 */
session_start();
header("Content-type: text/html; charset=utf-8");
if (!empty($_SESSION['sUID']) || !empty($_SESSION['AdminID'])) {
    @$SUID = $_SESSION['sUID'];
    @$AdminID = $_SESSION['AdminID'];

    require_once ("../backend/dbconnUser.php");
    if (!empty($AdminID)){
        $queryLoad=mysqli_query($link,"SELECT Name,Gender,Email FROM administrators WHERE ID=$AdminID ;");
        while ($rs=mysqli_fetch_array($queryLoad)){
            $Name = $rs['Name'];
            $Gender = $rs['Gender'];
            $Email = $rs['Email'];

            echo "<h1>管理员账号信息：</h1>";
            echo "<ul>";
                echo "<li>用户名：".$Name."</li>";
                if ($Gender=='Male'){
                    echo "<li>性别："."男"."</li>";
                }
                elseif ($Gender=='Female'){
                    echo "<li>性别："."女"."</li>";
                }
            echo "<li>E-Mail：".$Email."</li>";
            echo "</ul>";
        }
    }
    elseif (!empty($SUID)){
        $queryLoad=mysqli_query($link,"SELECT sUName,sUAddress,sUGrade FROM salesuser WHERE sUID=$SUID ;");
        while ($rs=mysqli_fetch_array($queryLoad)){
            $sUName = $rs['sUName'];
            $sUAddress = $rs['sUAddress'];
            $sUGrade = $rs['sUGrade'];

            echo "<h1>店铺信息：</h1>";
            echo "<ul>";
            echo "<li>店铺名：".$sUName."</li>";
            echo "<li>店铺地址：".$sUAddress."</li>";
            echo "<li>店铺等级：".$sUGrade."</li>";
            echo "</ul>";
        }
    }
    mysqli_close($link);
}
?>