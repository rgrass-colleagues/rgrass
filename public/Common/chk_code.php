<?php
session_start();

$action = $_GET['act'];
$code = trim($_POST['code']);
if($action=='math'){
	if($code==$_SESSION["confirm_code"]){
       echo '1';
    }
}
?>
