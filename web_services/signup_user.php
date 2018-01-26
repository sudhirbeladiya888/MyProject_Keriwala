<?php	
	function signup_user($param=array())
	{
		global $outputjson, $gh, $db;
		$data = array();
		$data['user_email']		=	$user_email			= $gh->read('user_email');
		$data['username']	=	$username       = $gh->read("username");
		$data['full_name'] 	= $full_name   		= $gh->read("full_name",0);
		$data['user_password']	=	$user_password       = base64_encode($gh->read("user_password"));
		$data['added_on'] 	= date('Y-m-d H:i:s');

	    if(empty($username))
	    {
	    	$outputjson['success'] = 0;
	    	$outputjson['message'] = 'Enter UserName';
	    	return false;
	    }
	    if(empty($full_name))
	    {
	    	$outputjson['success'] = 0;
	    	$outputjson['message'] = 'Enter full_name';
	    	return false;
	    }
	    if(empty($user_email))
	    {
	    	$outputjson['success'] = 0;
	    	$outputjson['message'] = 'Enter email';
	    	return false;
	    }
		if(empty($user_password))
	    {
	    	$outputjson['success'] = 0;
	    	$outputjson['message'] = 'Enter password';
	    	return false;
	    }

	    $is_exist= $db->execute("SELECT * FROM tbl_users WHERE username='$username' OR user_email='$user_email'");
	    if(count($is_exist) > 0)
	    {
	    	$outputjson['success'] = 0;
	    	$outputjson['message'] = 'UserName or email exists';
	    	return false;
	    }
	    $user_id = $db->insert('tbl_users',$data);
	    if(count($user_id) > 0)
	    {
	    	$data =  $db->execute("SELECT * FROM tbl_users WHERE user_id='$user_id'");
	    	$outputjson['success'] = '1';
	    	$outputjson['data'] =$data[0];
	    	$outputjson['message'] = 'Signup  Success';
	    }
	    else
	    {
	    	$outputjson['success'] = '0';
	    	$outputjson['data'] = [];
	    	$outputjson['message'] = 'Signup Fail !!!!';
	    }

		
	}
?>