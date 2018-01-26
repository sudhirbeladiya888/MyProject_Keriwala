<?php	
/*
Order Status
1 = confirmed
2 = shipping
3 = delivered
*/
	function create_order($param=array())
	{
		global $outputjson, $gh, $db;
    	$data = array();
    	$data['user_id']				=	$user_id			= $gh->read('user_id');

  		$product_list					= $gh->read('product_list');//"1,2,3";
    	$option_list					= $gh->read('option_list');//"10,11,12";
    	
    	$product_qty_list				= $gh->read('product_qty_list');//"1,1,1";
    	$option_qty_list				= $gh->read('option_qty_list');//"1,2,1";
    	
    	$product_price_list				= $gh->read('product_price_list');//"100,120,140";
    	$option_price_list				= $gh->read('option_price_list');//"200,400,200";

    	
    	$data['town']					=	$town				= $gh->read('town');
    	$data['cap']					=	$cap				= $gh->read('cap');
    	$data['mesaage']				=	$mesaage			= $gh->read('mesaage');
		$data['full_name']				=	$full_name			= $gh->read('full_name');
    	$data['delevery_time']			=	$delevery_time		= $gh->read("delevery_time");
    	$data['delevery_date']			=	$delevery_date		= date('Y-m-d',strtotime($gh->read("delevery_date")));
		$data['shipping_address']		=	$shipping_address	= $gh->read('shipping_address');
		$data['order_status']			=	$order_status		= '1';  // Default confirmed order 1
    	$data['transaction_id']			=	$transaction_id		= $gh->read('transaction_id');
    	$data['order_date']				= date('Y-m-d H:i:s');

    	$product_array = [];
    	$option_array = [];
    	$product_list_arr = explode(",", $product_list);
    	$product_qty_list_arr = explode(",", $product_qty_list);
    	$product_price_list_arr = explode(",", $product_price_list);

    	$keys   = $product_list_arr;
		$product_result = array();

		foreach ($keys as $id => $key) {
		    $product_result[$key] = array(
		        'product_id' => $keys[$id],
		        'product_qty'  => $product_qty_list_arr[$id],
    			'product_price' => $product_price_list_arr[$id],
		    );
		}


    	$option_list_arr = explode(",", $option_list);
    	$option_qty_list_arr = explode(",", $option_qty_list);
    	$option_price_list_arr = explode(",", $option_price_list);


    	$keys_op   = $option_list_arr;
		$names  = $option_qty_list_arr;
		$emails = $option_price_list_arr;
		$option_result = array();

		foreach ($keys_op as $id => $key) {
		    $option_result[$key] = array(
		        'option_id' => $keys_op[$id],
		        'option_qty'  => $option_qty_list_arr[$id],
    			'option_price' => $option_price_list_arr[$id],
		    );
		}
    	 //print_r($option_result);


		// if(empty($user_id))
		// {
		// 	$outputjson['success'] = 0;
	 //    	$outputjson['message'] = 'Enter User id';
	 //    	return false;
		// }
		// if(empty($item_type))
		// {
		// 	$outputjson['success'] = 0;
	 //    	$outputjson['message'] = 'Enter Item type';
	 //    	return false;
		// }
		// if(empty($item_id))
		// {
		// 	$outputjson['success'] = 0;
	 //    	$outputjson['message'] = 'Enter Item id';
	 //    	return false;
		// }
		// if(empty($item_quantity))
		// {
		// 	$outputjson['success'] = 0;
	 //    	$outputjson['message'] = 'Enter Item Quantity';
	 //    	return false;
		// }
		// if(empty($item_price))
		// {
		// 	$outputjson['success'] = 0;
	 //    	$outputjson['message'] = 'Enter Item Price';
	 //    	return false;
		// }
		// if(empty($shipping_address))
		// {
		// 	$outputjson['success'] = 0;
	 //    	$outputjson['message'] = 'Enter Shipping address';
	 //    	return false;
		// }
		// if(empty($transaction_id))
		// {
		// 	$outputjson['success'] = 0;
	 //    	$outputjson['message'] = 'Enter Transaction id';
	 //    	return false;
		// }
		
		$order_id = $db->insert('tbl_orders',$data);
		if(count($order_id) > 0)
	    {	
	    	$data_ordr_detail_pro =  array();
	    	//$data_ordr_detail_pro['order_id'] = $order_id;
			foreach ($product_result as $value) {
	    		$data_ordr_detail_pro['item_type'] = 'product';
	    		$data_ordr_detail_pro['item_price'] = $value['product_price'];
	    		$data_ordr_detail_pro['item_id'] = $value['product_id'];
	    		$data_ordr_detail_pro['item_quantity'] = $value['product_qty'];
	    		$data_ordr_detail_pro['order_id'] = $order_id;
	    		$insert_product_order = $db->insert("tbl_order_details",$data_ordr_detail_pro);
	    	}

	    	$data_ordr_detail_opt =  array();
	    	//$data_ordr_detail_opt['order_id'] = $order_id;
			foreach ($option_result as $value) {
	    		$data_ordr_detail_opt['item_type'] = 'option';
	    		$data_ordr_detail_opt['item_price'] = $value['option_price'];
	    		$data_ordr_detail_opt['item_id'] = $value['option_id'];
	    		$data_ordr_detail_opt['item_quantity'] = $value['option_qty'];
	    		$data_ordr_detail_opt['order_id'] = $order_id;
	    		$insert_product_order = $db->insert("tbl_order_details",$data_ordr_detail_opt);
	    	}

		// $data = $db->execute("SELECT dtl.*,ordr.* FROM tbl_orders ordr
		// 							LEFT JOIN tbl_order_details dtl ON ordr.order_id=dtl.order_id
		// 							WHERE ordr.order_id = ".$order_id);
	    	$outputjson['success'] = '1';
	    	// $outputjson['data'] = $data[0];
	    	$outputjson['message'] = 'Orders placed Success';
	    }
	    else
	    {
	    	$outputjson['success'] = '0';
	    	$outputjson['data'] = [];
	    	$outputjson['message'] = 'Orders placed faild !!!!';
	    }

		
	}
?>