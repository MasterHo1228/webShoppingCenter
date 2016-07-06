<?php
/**
 * Created by IntelliJ IDEA.
 * User: MasterHo
 * Date: 2016/6/13
 * Time: 22:14
 */
session_start();
header("Content-type: text/xml");
require_once ("dbconnUser.php");

function hideStar($str) { //用户名、邮箱、手机账号中间字符串以*隐藏
    if (strpos($str, '@')) {
        $email_array = explode("@", $str);
        $prevfix = (strlen($email_array[0]) < 4) ? "" : substr($str, 0, 3); //邮箱前缀
        $count = 0;
        $str = preg_replace('/([\d\w+_-]{0,100})@/', '***@', $str, -1, $count);
        $rs = $prevfix . $str;
    } else {
        $pattern = '/(1[3458]{1}[0-9])[0-9]{4}([0-9]{4})/i';
        if (preg_match($pattern, $str)) {
            $rs = preg_replace($pattern, '$1****$2', $str); // substr_replace($name,'****',3,4);
        } else {
            $rs = substr($str, 0, 3) . "***" . substr($str, -1);
        }
    }
    return $rs;
}

if (!empty($_SESSION['uID'])){
    $uID=$_SESSION['uID'];
    $queryFind=mysqli_query($link,"SELECT uName,uGender,uDateOfBirth,uEmail,uAvater,uGrade FROM user WHERE uID=$uID ;");

    echo "<?xml version='1.0' encoding='UTF-8'?>";
    echo "<Users>";

    while ($rs=mysqli_fetch_array($queryFind)){
        echo "<user>";
        $uName=$rs['uName'];
        $uGender=$rs['uGender'];
        $uDateOfBirth=$rs['uDateOfBirth'];
        $uEmail=$rs['uEmail'];
        $uAvater=$rs['uAvater'];
        $uGrade=$rs['uGrade'];
            echo "<Name>".$uName."</Name>";
            echo "<Gender>".$uGender."</Gender>";
            echo "<DateOfBirth>".$uDateOfBirth."</DateOfBirth>";
            echo "<Email>".hideStar($uEmail)."</Email>";
            echo "<Avater>".$uAvater."</Avater>";
            echo "<Grade>".$uGrade."</Grade>";
        echo "</user>";
    }
    echo "</Users>";
    mysqli_close($link);
}
