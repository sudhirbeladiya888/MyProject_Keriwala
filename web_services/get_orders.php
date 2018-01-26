<?php	
	function get_orders($param=array())
	{
		global $outputjson, $gh, $db;
    
		$order_id = $gh->read("order_id");
		$user_id = $gh->read("user_id");

		$where = " '1:1' ";
		
		if(!empty($order_id))
		{
			$where .= " AND ordr.order_id = ".$order_id;
		}
		if(!empty($user_id))
		{
			$where .= " AND usr.user_id = ".$user_id;
		}

	    $order_data= $db->execute("
	    	SELECT usr.username,usr.full_name,usr.user_email,ordr.* FROM tbl_orders ordr
			LEFT JOIN tbl_users usr ON ordr.user_id = usr.user_id
			WHERE ".$where
			);
	  
	    if(count($order_data) > 0)
	    {	

	    	// foreach ($order_data as $key => $value) {

	    	// 	if($value['item_type'] = 'product');
	    	// 	{
	    	// 		$product_data= $db->execute();
	    	// 	}
	    	// 	$order_data[$key]['product_ids_list'] = $product_ids_list;
	    	// 	foreach ($product_ids_list as $product_id_comm ) {
	    			
	    	// 		$order_data[$key]['product_id_comm'] = $product_id_comm;
	    	// 	}
	    	// }

	    	$outputjson['data'] = $order_data;
	    	$outputjson['success'] = 1;
	    	$outputjson['message'] = count($order_data) .' Orders found';
	    }
	    else
	    {
	    	$outputjson['success'] = 0;
	    	$outputjson['message'] = 'Orders not found';
	    }

		
	}
?>