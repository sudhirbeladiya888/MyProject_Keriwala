<?php	
	function get_tests($param=array())
	{
		global $outputjson, $gh, $db;
    
		$test_id = $gh->read("test_id");
		$company_id = $gh->read("company_id");

		$where = " '1:1' ";
		
		if(!empty($test_id))
		{
			$where .= " AND t1.test_id = ".$test_id;
		}

		$sql = "
	    	SELECT t1.*,(select test_name from tbl_tests t2 where t1.parent_test_id=t2.test_id) as parent_test
	    	FROM `tbl_tests` t1
			WHERE ".$where;
			// echo $sql;
	    $test_data= $db->execute($sql);
	  	
	  	if(!empty($company_id))
	  	{
		  	foreach ($test_data as $key => $value) {
		  		$get_price = $db->execute("SELECT * FROM tbl_price_record WHERE company_id=".$company_id." AND test_id=".$value['test_id']." ORDER BY price_record_id DESC LIMIT 0,1");
		  		if(!empty($get_price))
		  		{
		  			$test_data[$key]['test_price'] = $get_price[0]['test_price'];
		  		}
		  	}
	  	}

	    if(count($test_data) > 0)
	    {	
	    	$outputjson['data'] = $test_data;
	    	$outputjson['success'] = 1;
	    	$outputjson['message'] = count($test_data) .' Tests  found';
	    }
	    else
	    {
	    	$outputjson['data'] = [];
	    	$outputjson['success'] = 0;
	    	$outputjson['message']	=	'Tests not found';
	    }

		
	}
?>