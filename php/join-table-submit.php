<?php session_start(); require_once('logincheck.php');

//$_SESSION['user_id'] = "1";

$res_id 		= $_POST['res_id'];
$appetizer_id 	= $_POST['appetizer'];
$main_id		= $_POST['main'];
$dessert_id 	= $_POST['dessert'];
//$user_id 		= $_SESSION['user_id'];

$error=false;

if(!$res_id){
	$error=true;
}
if(!$appetizer_id){
	$error=true;
}
if(!$main_id){
	$error=true;
}
if(!$dessert_id){
	$error=true;
}
if(!$user_id){
	$error=true;
}

if($error == true){
	echo "SERVER SIDE ERROR";
}else{
	
	
	
	require_once('connect.php');
	
	$s_check		=	"SELECT * FROM attending WHERE (res_id=".$res_id.") AND (user_id=".$user_id.")";
	
	
	
	$q_check		=	mysql_query($s_check) or die(mysql_error());
	
	$numrows_check	=	mysql_num_rows($q_check);
	
	//echo $numrows_check; 
	
	if($numrows_check < 1){
		
		$s			=	"INSERT INTO attending(attending_id, res_id, user_id, attending_appetizer, attending_main, attending_dessert) VALUES(NULL, ".$res_id.", ".$user_id.", ".$appetizer_id.", ".$main_id.", ".$dessert_id.")";
		$q			=	mysql_query($s) or die(mysql_error());
		
		//$r			=	mysql_fetch_array($q);
		
		echo "TRUE";
	
	}else{
	
		echo "AlREADY";
	
	}
}



/*
echo "appetizer".$appetizer_id;
echo " main: ".$main_id;
echo " dessert:".$dessert_id;
*/
?>