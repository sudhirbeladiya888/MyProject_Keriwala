<?php	
	function update_test($param=array())
	{
		global $outputjson, $gh, $db;
    	$data = array();
    	$outputjson['success'] = '0';
		$data['added_on'] 		= date('Y-m-d H:i:s');
		$test_id				=	$gh->read('test_id');
		$data['test_name']		=	$test_name			=		$gh->read('test_name');
		$data['test_price']		=	$test_price			=		$gh->read('test_price');
		

		if(empty($test_name))
		{
			$outputjson['message'] = "Missing test name";
			return false;
		}
		if(empty($test_price))
		{
			$outputjson['message'] = "Missing test price";
			return false;
		}
	    $test_date	 = $db->update('tbl_tests',$data,array("test_id" => $test_id));
		if(count($test_date) > 0)
	    {	

	    	$data = $db->execute("SELECT * FROM tbl_tests WHERE test_id	='$test_id'");
	    	$outputjson['success'] = '1';
	    	$outputjson['data'] = $data[0];
	    	$outputjson['message'] = 'Test update Success';
	    }
	    else
	    {
	    	$outputjson['success'] = '0';
	    	$outputjson['data'] = [];
	    	$outputjson['message'] = 'Test update faild !!!!';
	    }

		
	}
?>