<?php session_start(); require_once('logincheck.php'); 

require_once("facebook/facebook.php");

$config = array();
$config['appId'] = '245990175539249';
$config['secret'] = '8676515a31fa4a20fb4a020df6fc28f2';
$config['fileUpload'] = false; // optional

$facebook = new Facebook($config);

$params = array(
'scope' => 'email',
'redirect_uri' => 'http://meetfeed.aranydesign.com'
);

$loginUrl = $facebook->getLoginUrl($params);


require('connect.php');


	


$s			=	"SELECT * FROM reservations ORDER BY res_id DESC";
$q			=	mysql_query($s) or die(mysql_error());

$numrows	=	mysql_num_rows($q);
$r			=	mysql_fetch_array($q);

$res_id			 		= $r['res_id'];
$restaurant_name 		= $r['res_restaurant_name'];
$restaurant_website 	= $r['res_website'];
$restaurant_location 	= $r['res_location'];
$restaurant_image	 	= $r['res_image'];
$reservation_id			= $r['res_id'];
$corking_fee			= $r['res_corking_fee'];


/*   CHECK TO SEE IF USER HAS ALREADY JOINED OR IF THE TBALE IS FULL */

$s_full			= 	"SELECT * FROM attending WHERE res_id=".$reservation_id;
$q_full			=	mysql_query($s_full) or die(mysql_error());

$numrows_full	=	mysql_num_rows($q_full);

if($numrows_full < 10){

	/*  CHECK IF PERSON IS ATTENDING ALREADY   */
	
	$s_check		=	"SELECT * FROM attending WHERE (res_id=".$res_id.") AND (user_id=".$user_id.")";
	$q_check		=	mysql_query($s_check) or die(mysql_error());
	
	$numrows_check	=	mysql_num_rows($q_check);
	
	//echo $numrows_check; 
	
	if($numrows_check < 1){
		
		// NOT YET ATTENDING, DO NOTHING	
		//echo "TRUE";
	
	}else{
		
		// ALREADY ATTENDING, GO BACK TO table.php with error.	
		header('Location: http://meetmefeedme.com/table.php?e=1');
	
	}

}else{

	// Table is Full, GO BACK TO table.php 
	header('Location: http://meetmefeedme.com/table.php');	

}






if($r['res_price_fix'] == 1){

	$price_fix = "Yes";

}else{

	$price_fix = "No";
	
}

if($r['res_parking'] == 1){

	$parking = "Yes";

}else{

	$parking = "No";
	
}

$restaurant_image	 	= $r['res_image'];


$datelong			= $r['res_date_time'];

$longunformatted 	= new DateTime($datelong);  
$reservation_date	= $longunformatted->format("Y-m-d H:i"); 



$string		=	"SELECT * FROM appetizers WHERE res_id=".$reservation_id." ORDER BY appetizer_id ASC";
$query		=	mysql_query($string) or die(mysql_error());

$numrows	=	mysql_num_rows($query);
//$appetizer	=	mysql_fetch_array($query);

//print_r($appetizer);


$string_main	=	"SELECT * FROM main WHERE res_id=".$reservation_id." ORDER BY main_id ASC";
$query_main		=	mysql_query($string_main) or die(mysql_error());

$numrows	=	mysql_num_rows($query_main);


$string_dessert	=	"SELECT * FROM desserts WHERE res_id=".$reservation_id." ORDER BY dessert_id ASC";
$query_dessert	=	mysql_query($string_dessert) or die(mysql_error());

$numrows	=	mysql_num_rows($query_dessert);

 

?>