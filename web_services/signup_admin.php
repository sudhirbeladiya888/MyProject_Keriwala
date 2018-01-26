<?php	
	function signup_admin($param=array())
	{
		global $outputjson, $gh, $db;
    	$data = array();
		$data['email']		=	$email			= $gh->read('email');
	    $data['username']	=	$username       = $gh->read("username");
	    $data['password']	=	$password       = base64_encode($gh->read("password"));
	    // $data['device_token'] = $device_token   	= $gh->read("device_token",0);
	    // $data['registered_on'] = date('Y-m-d H:i:s');

	    if(empty($username))
	    {
	    	$outputjson['success'] = 0;
	    	$outputjson['message'] = 'Enter UserName';
	    	return false;
	    }
	    if(empty($email))
	    {
	    	$outputjson['success'] = 0;
	    	$outputjson['message'] = 'Enter email';
	    	return false;
	    }

	    if(empty($password))
	    {
	    	$outputjson['success'] = 0;
	    	$outputjson['message'] = 'Enter password';
	    	return false;
	    }

	    $is_exist= $db->execute("SELECT * FROM tbl_admin WHERE username='$username' OR email='$email'");
	    if(count($is_exist) > 0)
	    {
	    	$outputjson['success'] = 0;
	    	$outputjson['message'] = 'UserName or email exists';
	    	return false;
	    }
	    $admin_id = $db->insert('tbl_admin',$data);
	    if(count($admin_id) > 0)
	    {
	    	$data =  $db->execute("SELECT * FROM tbl_admin WHERE admin_id='$admin_id'");
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