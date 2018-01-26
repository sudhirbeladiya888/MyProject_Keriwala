<?php	
	function get_products($param=array())
	{
		global $outputjson, $gh, $db;
    
		$user_id = $gh->read("user_id");
		$product_id = $gh->read("product_id");

		$where = " '1:1' ";
		if(!empty($user_id))
		{
			$where .= " AND pro.user_id = ".$user_id;
		}
		if(!empty($product_id))
		{
			$where .= " AND pro.product_id = ".$product_id;
		}

	    $product_data= $db->execute("
	    	SELECT pro.*,(admn.username) as admin_username ,usr.username,usr.user_email FROM tbl_products pro
			LEFT JOIN tbl_users usr ON pro.user_id = usr.user_id
			LEFT JOIN tbl_admin admn ON admn.admin_id = pro.admin_id
			 WHERE ".$where
			);
	  
	    if(count($product_data) > 0)
	    {	
	    	$outputjson['data'] = $product_data;
	    	$outputjson['success'] = 1;
	    	$outputjson['message'] = count($product_data) .' Products found';
	    }
	    else
	    {
	    	$outputjson['success'] = 0;
	    	$outputjson['message'] = 'Products not found';
	    }

		
	}
?>