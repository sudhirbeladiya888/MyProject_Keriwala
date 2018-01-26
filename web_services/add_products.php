<?php	
	function add_products($param=array())
	{
		global $outputjson, $gh, $db;
    	$data = array();
		$data['product_size']			=	$product_size			= $gh->read('product_size');
		$data['admin_id']				=	$admin_id			= $gh->read('admin_id');
		$data['user_id'] 				= 	$user_id					= $gh->read('user_id',0);
		$data['product_price']			=	$product_price			= $gh->read('product_price');
		$data['product_photo']			=	$product_photo			= $gh->read('product_photo');
		$data['product_description']	=	$product_description	= $gh->read('product_description');
	    $data['added_on'] = date('Y-m-d H:i:s');

	    if(empty($admin_id))
		{
			$outputjson['success'] = 0;
	    	$outputjson['message'] = 'Select admin';
	    	return false;
		}
		if(empty($product_size))
		{
			$outputjson['success'] = 0;
	    	$outputjson['message'] = 'Select Product Size';
	    	return false;
		}
		if(empty($product_price))
		{
			$outputjson['success'] = 0;
	    	$outputjson['message'] = 'Enter Product Price';
	    	return false;
		}
		if(empty($product_photo))
		{
			$outputjson['success'] = 0;
	    	$outputjson['message'] = 'Select Product Photo';
	    	return false;
		}
		if(empty($product_description))
		{
			$outputjson['success'] = 0;
	    	$outputjson['message'] = 'Enter Product Description';
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

		
	    $product_id = $db->insert('tbl_products',$data);
		if(count($product_id) > 0)
	    {	

	    	$data = $db->execute("SELECT * FROM tbl_products WHERE product_id='$product_id'");
	    	$outputjson['success'] = '1';
	    	$outputjson['data'] = $data[0];
	    	$outputjson['message'] = 'Product addedd Success';
	    }
	    else
	    {
	    	$outputjson['success'] = '0';
	    	$outputjson['data'] = [];
	    	$outputjson['message'] = 'Product addedd faild !!!!';
	    }

		
	}
?>