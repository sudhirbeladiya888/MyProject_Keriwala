<?php	
	function add_tests($param=array())
	{
		global $outputjson, $gh, $db;
    	$data = array();
    	$outputjson['success'] = '0';
		$data['added_on'] 		= date('Y-m-d H:i:s');
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
		
	    $test_id	 = $db->insert('tbl_tests',$data);
		if(count($test_id	) > 0)
	    {	
			$data = $db->execute("SELECT * FROM tbl_tests WHERE test_id	='$test_id	'");
	    	$outputjson['success'] = '1';
	    	$outputjson['data'] = $data[0];
	    	$outputjson['message'] = 'Test addedd Success';
	    }
	    else
	    {
	    	$outputjson['success'] = '0';
	    	$outputjson['data'] = [];
	    	$outputjson['message'] = 'Test addedd faild !!!!';
	    }

		
	}
?>