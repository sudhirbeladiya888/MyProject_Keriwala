<?php	
	function delete_product($param=array())
	{
		global $outputjson, $gh, $db;
		$product_id			= $gh->read('product_id');

		if(empty($product_id))
		{
			$outputjson['success'] = 0;
	    	$outputjson['message'] = 'Select Product id';
	    	return false;
		}

	    $Product_data = $db->delete('tbl_products',array('product_id'=>$product_id));

			
	    if(count($Product_data) > 0)
	    {	
	    	
	    	$outputjson['success'] = '1';
	    	$outputjson['message'] = 'Product delete Success';
	    }
	    else
	    {
	    	$outputjson['success'] = '0';
	    	$outputjson['message'] = 'Product delete faild !!!!';
	    }

		
	}
?>