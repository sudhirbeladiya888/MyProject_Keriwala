<?php	
	function login_user($param=array())
	{
		global $outputjson, $gh, $db;
    

	    $username       	= $gh->read("username");
	    $user_password      = base64_encode($gh->read("user_password"));
	    
		if(empty($username))
	    {
	    	$outputjson['success'] = 0;
	    	$outputjson['message'] = 'Enter UserName or Email';
	    	return false;
	    }

	    if(empty($user_password))
	    {
	    	$outputjson['success'] = 0;
	    	$outputjson['message'] = 'Enter password';
	    	return false;
	    }

	    $user_data= $db->execute("SELECT * FROM tbl_users WHERE (user_email='$username' OR username = '$username') AND user_password='$user_password'");
	    if(count($user_data) > 0)
	    {	
	  //   	session_start();
	  //   	$_SESSION['login_user_id']	=	$user_data[0]['user_id'];
	  //   	$_SESSION['user']	=	$user_data[0]['username'];
			// $_SESSION['full_name']	=	$user_data[0]['full_name'];
			// $_SESSION['user_email']	=	$user_data[0]['user_email'];
	    	$outputjson['data'] = $user_data[0];
	    	$outputjson['success'] = 1;
	    	$outputjson['message'] = 'Login Success';
	    }
	    else
	    {
	    	$outputjson['success'] = 0;
	    	$outputjson['message'] = 'username or password are  not match !!!!';
	    }

		
	}
?>