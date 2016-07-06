<?php
session_start();

$action = $_GET['act'];
$code = trim($_POST['code']);
if($action=='char'){
	if($code==$_SESSION["usrCharCode"]){
       echo '1';
		unset($_SESSION["usrCharCode"]);
    }
}
?>
