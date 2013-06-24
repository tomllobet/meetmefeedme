<?php session_start(); require_once('logincheck.php');

//print_r($_SESSION);

//echo "user_id: ".$user_id;

$error_model = $_GET['e'];

if($error_model){
	
	$display_error="display_error();";
}else{
	
	$display_error="";
}


if($error_model == 1){
	
	$error_model_message = 'You have already joined this table.';
}


require_once("facebook/facebook.php");

$config = array();
$config['appId'] = '245990175539249';
$config['secret'] = '8676515a31fa4a20fb4a020df6fc28f2';
$config['fileUpload'] = false; // optional

$facebook = new Facebook($config);

$params = array(
'scope' => 'email',
'redirect_uri' => 'http://meetmefeedme.com'
);

$loginUrl = $facebook->getLoginUrl($params);


require('connect.php');


// RESERVATION OBJECT

$s			=	"SELECT * FROM reservations ORDER BY res_id DESC";
$q			=	mysql_query($s) or die(mysql_error());

$numrows	=	mysql_num_rows($q);
$r			=	mysql_fetch_array($q);

$restaurant_name 		= $r['res_restaurant_name'];
$restaurant_website 	= $r['res_website'];
$restaurant_location 	= $r['res_location'];
$restaurant_image	 	= $r['res_image'];
$reservation_id			= $r['res_id'];
$corking_fee			= $r['res_corking_fee'];


/*   SET PRICE FIX, PARKING to yes or no. */

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


// ATTENDING LIST

$s_attend			=	"SELECT attending.attending_id, attending.res_id, attending.user_id, users.user_name, users.user_fb_id FROM attending, users WHERE (attending.res_id=".$reservation_id.") AND (attending.user_id=users.user_id) ORDER BY attending_id ASC";
$q_attend			=	mysql_query($s_attend) or die(mysql_error());

$numrows_attend	=	mysql_num_rows($q_attend);
//$r_attend		=	mysql_fetch_array($q_attend);


/*   CHECK TO SEE IF USER HAS ALREADY JOINED OR IF THE TBALE IS FULL */

$s_full			= 	"SELECT * FROM attending WHERE res_id=".$reservation_id;
$q_full			=	mysql_query($s_full) or die(mysql_error());

$numrows_full	=	mysql_num_rows($q_full);

if($numrows_full < 10){

	// TABLE IS NOT FULL (UNDER 10 SEATS TAKEN)
	
	$s_check		=	"SELECT * FROM attending WHERE (res_id=".$reservation_id.") AND (user_id=".$user_id.")";
	$q_check		=	mysql_query($s_check) or die(mysql_error());
	
	$numrows_check	=	mysql_num_rows($q_check);
	
	if($numrows_check < 1){
		
		// NOT YET ATTENDING, GIVE LINK TO JOIN TABLE
		$join_cancel = '<a href="join-table.php?res_id='.$reservation_id.'">Click here if you would like to join this table.</a>';
		
	}else{
		
		// ALREADY ATTENDING, GIVE OPTION TO CANCEL 
		$join_cancel = 'Welcome Back '.$_SESSION['user_name'].'<br /><a href="#" class="cancel">Click here if you want to cancel your seat.</a>';
		
	}


}else{
	
	$join_cancel = 'Welcome Back '.$_SESSION['user_name'].'<br />This table is full,  try next time.';
	
}




?>