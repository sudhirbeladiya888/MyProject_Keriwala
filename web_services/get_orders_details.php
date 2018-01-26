<?php	
	function get_orders_details($param=array())
	{
		global $outputjson, $gh, $db;
		
		$order_id = $gh->read("order_id");

		$where = " '1:1' ";
		
		if(!empty($order_id))
		{
			$where .= " AND ordr.order_id = ".$order_id;
		}
		

		$order_data= $db->execute("
			SELECT usr.username,usr.full_name,usr.user_email,ordr.*,dtl.* FROM tbl_orders ordr
			LEFT JOIN tbl_users usr ON ordr.user_id = usr.user_id
			LEFT JOIN tbl_order_details dtl ON ordr.order_id = dtl.order_id
			WHERE ".$where
			);
		
		if(count($order_data) > 0)
		{	
			foreach ($order_data as $key =>  $value) {
				
				if($value['item_type'] == 'product')
				{
					$order_data[$key]['products']= "";
					$get_product_data= $db->select("*","tbl_products","product_id=".$value['item_id']);
					if(!empty($get_product_data))
					{
						$order_data[$key]['products']= $get_product_data[0]['product_photo'];
					}
				}
				if($value['item_type'] == 'option')
				{
					$order_data[$key]['options']= "";
					$get_options_data= $db->select("*","tbl_options","option_id=".$value['item_id']);
					if(!empty($get_options_data))
					{
						$order_data[$key]['options']= $get_options_data[0]['option_title'];
					}
				}
				
			}

			$outputjson['data'] = $order_data;
			$outputjson['success'] = 1;
			$outputjson['message'] = count($order_data) .' Orders Item found';
		}
		else
		{
			$outputjson['success'] = 0;
			$outputjson['message'] = 'Orders Item not found';
		}

		
	}
	?>