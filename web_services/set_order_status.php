<?php	
	function set_order_status($param=array())
	{
		global $outputjson, $gh, $db;
		$order_id			= $gh->read('order_id');
		$data['order_status']	=	$order_status		= $gh->read('order_status');

		if(empty($order_id))
		{
			$outputjson['success'] = 0;
	    	$outputjson['message'] = 'Select order id';
	    	return false;
		}

	    $order_status = $db->update('tbl_orders',$data,array('order_id'=>$order_id));

			
	    if(count($order_status) > 0)
	    {	
	    	$outputjson['success'] = '1';
	    	$outputjson['message'] = 'Order Update Success';
	    }
	    else
	    {
	    	$outputjson['success'] = '0';
	    	$outputjson['message'] = 'Order Update faild !!!!';
	    }

		
	}
?>