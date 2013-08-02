<?php session_start(); require_once('logincheck.php');

require('connect.php');

$res_id = mysql_real_escape_string($_POST['res_id']);	
	
$error=false;

if(!$res_id){
	$error=true;
}

if(!$user_id){
	$error=true;
}

if($error == true){
	echo "SERVER SIDE ERROR";
}else{
	require_once('connect.php');
	$s		=	"DELETE FROM attending WHERE (res_id='".$res_id."') AND (user_id='".$user_id."')";
	$q		=	mysql_query($s) or die(mysql_error());
	echo "TRUE";
}

	
?>