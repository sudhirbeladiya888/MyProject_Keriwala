<?php	
	function get_company($param=array())
	{
		global $outputjson, $gh, $db;
    
		$company_id = $gh->read("company_id");

		$where = " '1:1' ";
		
		if(!empty($company_id))
		{
			$where .= " AND company_id = ".$company_id;
		}

	    $companies_data= $db->execute("
	    	SELECT * FROM tbl_companies WHERE ".$where
			);
	  
	    if(count($companies_data) > 0)
	    {	
	    	$outputjson['data'] = $companies_data;
	    	$outputjson['success'] = 1;
	    	$outputjson['message'] = count($companies_data) .' Companies  found';
	    }
	    else
	    {
	    	$outputjson['success'] = 0;
	    	$outputjson['message']	=	'Companies not found';
	    }

		
	}
?>