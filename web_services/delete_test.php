<?php	
	function delete_test($param=array())
	{
		global $outputjson, $gh, $db;
		$test_id			= $gh->read('test_id');

		if(empty($test_id))
		{
			$outputjson['success'] = 0;
	    	$outputjson['message'] = 'Select test';
	    	return false;
		}

	    $test_data = $db->delete('tbl_tests',array('test_id'=>$test_id));

			
	    if(count($test_data) > 0)
	    {	
	    	
	    	$outputjson['success'] = '1';
	    	$outputjson['message'] = 'Test delete Success';
	    }
	    else
	    {
	    	$outputjson['success'] = '0';
	    	$outputjson['message'] = 'Test delete faild !!!!';
	    }

		
	}
?>