<?php	
	function get_samples($param=array())
	{
		global $outputjson, $gh, $db;
    
		$sample_id = $gh->read("sample_id");
		$company_id = $gh->read("company_id");
		$payment_type = $gh->read("payment_type");

		$where = " '1:1' AND IFNULL(is_deleted,0) = '0' ";
		
		if(!empty($sample_id))
		{
			$where .= " AND sample_id = ".$sample_id;
		}
		if(!empty($company_id))
		{
			$where .= " AND company_id= ".$company_id;
		}
		if(!empty($payment_type))
		{
			$where .= " AND company_id= ".$payment_type;
		}
		
		$qry = "
	    	SELECT smp.*,cmp.name as company_name
	    	, DATE_FORMAT( sample_received_on,  '%d-%m-%Y' ) AS sample_received_on
	    	, DATE_FORMAT( certificate_date,  '%d-%m-%Y' ) AS certificate_date
	    	FROM tbl_samples smp 
			LEFT JOIN tbl_companies cmp ON smp.company_id=cmp.company_id
			WHERE ".$where;
	    $option_data= $db->execute($qry);
	   
	   foreach ($option_data as $key => $value) {
	    $test_data= $db->execute("SELECT GROUP_CONCAT( test_name ) as test_name_list
			FROM tbl_tests
			WHERE test_id IN (".$value['test_id'].")");
	    	$option_data[$key]['test_name_list'] = $test_data[0]['test_name_list'];

	    	$sample_price_data= $db->execute("SELECT rec.*,te.test_name 
			FROM tbl_price_record rec
			left join tbl_tests te on rec.test_id=te.test_id
			WHERE sample_id = ".$value['sample_id']."");
	    	$option_data[$key]['test_price_list'] = $sample_price_data;

	   }

	    if(count($option_data) > 0)
	    {	
	    	$outputjson['data'] = $option_data;
	    	$outputjson['success'] = 1;
	    	$outputjson['query'] = $qry;
	    	$outputjson['message'] = count($option_data) .' Samples  found';
	    }
	    else
	    {
	    	$outputjson['data'] = [];
	    	$outputjson['success'] = 0;
	    	$outputjson['message']	=	'Samples not found';
	    }

		
	}
?>