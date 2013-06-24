<?php 
if(!$_SESSION['user_fb_id']){

	header('Location: http://meetmefeedme.com/index.php');
	
}else{

	require('connect.php');

	$user_object_s   = "SELECT user_id, user_fb_id FROM users WHERE user_fb_id=".$_SESSION['user_fb_id']."";
	$user_object_q   = mysql_query($user_object_s) or die(mysql_error());

	$user_object_numrows = mysql_num_rows($user_object_q);
	$user_object= mysql_fetch_array($user_object_q);

	$user_id   = $user_object['user_id'];
	
	//echo $user_object_s;
	
} ?>