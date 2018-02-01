<?php	
	function add_test_results($param=array())
	{
		global $outputjson, $gh, $db;
    	$data = array();
    	$outputjson['success'] = '0';
		$data['added_on'] 	= date('Y-m-d H:i:s');
		$data['price_record_id']	=	$price_record_id			=		$gh->read('price_record_id');
		$data['result']	=	$result		=		$gh->read('result');
		

		
		if(empty($result))
		{
			$outputjson['message'] = "Missing result";
			return false;
		}
		// if(empty($password))
		// {
		// 	$outputjson['message'] = "Missing password";
		// 	return false;
		// }
		
		
	    $update_data = $db->update('tbl_price_record',$data,"price_record_id=$price_record_id");
		if(count($update_data) > 0)
	    {	

	    	$data = $db->execute("SELECT * FROM tbl_price_record WHERE price_record_id='$price_record_id'");
	    	$outputjson['success'] = '1';
	    	$outputjson['data'] = $data[0];
	    	$outputjson['message'] = 'Record Success';
	    }
	    else
	    {
	    	$outputjson['success'] = '0';
	    	$outputjson['data'] = [];
	    	$outputjson['message'] = 'Record faild !!!!';
	    }

		
	}
?>