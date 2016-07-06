<?php
session_start();

$action = $_GET['act'];
$code = trim($_POST['code']);
if($action=='char'){
	if($code==$_SESSION["charCode"]){
       echo '1';
		unset($_SESSION["charCode"]);
    }
}
?>
