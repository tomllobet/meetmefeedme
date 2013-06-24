<?php session_start();

if($_SESSION['user_fb_id']){

	header('Location: http://meetmefeedme.com/table.php');
	
}else{

}

//print_r($_SESSION); exit;


require_once("facebook/facebook.php");

$config = array();
$config['appId'] = '245990175539249';
$config['secret'] = '8676515a31fa4a20fb4a020df6fc28f2';
$config['fileUpload'] = false; // optional

$facebook = new Facebook($config);

$params = array(
'scope' => 'email',
'redirect_uri' => 'http://meetmefeedme.com/index.php'
);

$loginUrl = $facebook->getLoginUrl($params);


$user = $facebook->getUser();

$params = array(
  'ok_session' => 'http://http://meetmefeedme.com/table.php',
  'no_user' => 'http://http://meetmefeedme.com/index.php',
  'no_session' => 'http://meetmefeedme.com/index.php',
);

$next_url = $facebook->getLoginStatusUrl($params);


//echo $next_url;
//echo $user;

$params_logout 	= array( 'next' => 'http://meetfeed.aranydesign.com' );

$logout_url 	= $facebook->getLogoutUrl($params_logout);


if($user != 0){

	

	//echo "USer is: ";
	 $user_profile		= $facebook->api('/me','GET');
	
	
	//print_r($user_profile);
	
	$user_fb_id		= $user_profile['id'];
	$user_name 		= $user_profile['name'];
	$user_email		= $user_profile['email'];
	
	
	//echo "USER FB ID: ".$user_fb_id;
	
	//echo "<br />";
	
	require('connect.php');
	
	$s_check		=	"SELECT * FROM users WHERE user_fb_id=".$user_fb_id." ORDER BY user_fb_id DESC LIMIT 1";
	
	
	$q_check		=	mysql_query($s_check) or die(mysql_error());
	
	$numrows_check	=	mysql_num_rows($q_check);

	$check 			= 	mysql_fetch_array($q_check);
	
	$_SESSION['user_id']	= $check['user_id'];
	
	if($numrows_check < 1){
		
		//echo "Person Added"; //exit;
		
		$s_add		=	"INSERT INTO users(user_id, user_fb_id, user_name, user_email) VALUES(NULL,".$user_fb_id.",  '".$user_name."', '".$user_email."')";
		
		$q_add		=	mysql_query($s_add) or die(mysql_error());
	
		if($q_add){
		
			$_SESSION['user_fb_id'] = $user_fb_id;
			$_SESSION['user_name'] = $user_name;
			$_SESSION['user_email'] = $user_email;
			
			header("Location: http://meetmefeedme.com/");
		
		}else{
			
			echo "Error adding user"; //exit;
			
		}
	
		
	}else{
		
		$_SESSION['user_fb_id'] = $user_fb_id;
		$_SESSION['user_name'] = $user_name;
		$_SESSION['user_email'] = $user_email;
		
		//echo "Person already in system: ".$user_email;
		header("Location: http://meetmefeedme.com/table.php");
	}
	
	
}else{

	//echo "Not logged in. "; //exit;

	//echo $next_url;
}



?>