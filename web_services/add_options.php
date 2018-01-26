<?php	
	function add_options($param=array())
	{
		global $outputjson, $gh, $db;
    	$data = array();
		// $admin_id			= $gh->read('admin_id');
		// $data['user_id'] 				= $user_id					= $gh->read('user_id',0);
		$data['option_title']				=	$option_title			= $gh->read('option_title');
		$data['option_description']			=	$option_description			= $gh->read('option_description');
		$data['option_price']				=	$option_price	= $gh->read('option_price');
	    $data['added_on'] = date('Y-m-d H:i:s');

		if(empty($option_title))
		{
			$outputjson['success'] = 0;
	    	$outputjson['message'] = 'Enter Option Title';
	    	return false;
		}
		if(empty($option_description))
		{
			$outputjson['success'] = 0;
	    	$outputjson['message'] = 'Enter Option Description';
	    	return false;
		}
		if(empty($option_price))
		{
			$outputjson['success'] = 0;
	    	$outputjson['message'] = 'Enter Option Price';
	    	return false;
		}
		
		// if(empty($admin_id) && empty($user_id))
		// {
		// 	$outputjson['success'] = 0;
	 //    	$outputjson['message'] = 'Select User';
	 //    	return false;
		// }
		// if(empty($user_id))
		// {
		// 	$data['user_id'] =	$user_id;
		// }
		// else
		// {
		// 	$data['admin_id'] = $admin_id;
		// }

		
	    $option_id = $db->insert('tbl_options',$data);
		if(count($option_id) > 0)
	    {	

	    	$data = $db->execute("SELECT * FROM tbl_options WHERE option_id='$option_id'");
	    	$outputjson['success'] = '1';
	    	$outputjson['data'] = $data[0];
	    	$outputjson['message'] = 'Option addedd Success';
	    }
	    else
	    {
	    	$outputjson['success'] = '0';
	    	$outputjson['data'] = [];
	    	$outputjson['message'] = 'Option addedd faild !!!!';
	    }

		
	}
?>