<?php	
	function delete_company($param=array())
	{
		global $outputjson, $gh, $db;
		$company_id			= $gh->read('company_id');

		if(empty($company_id))
		{
			$outputjson['success'] = 0;
	    	$outputjson['message'] = 'Select company';
	    	return false;
		}

	    $company_data = $db->delete('tbl_companies',array('company_id'=>$company_id));

			
	    if(count($company_data) > 0)
	    {	
	    	
	    	$outputjson['success'] = '1';
	    	$outputjson['message'] = 'Company delete Success';
	    }
	    else
	    {
	    	$outputjson['success'] = '0';
	    	$outputjson['message'] = 'Company delete faild !!!!';
	    }

		
	}
?>