<?php	
	function delete_option($param=array())
	{
		global $outputjson, $gh, $db;
		$option_id			= $gh->read('option_id');

		if(empty($option_id))
		{
			$outputjson['success'] = 0;
	    	$outputjson['message'] = 'Select option id';
	    	return false;
		}

	    $option_data = $db->delete('tbl_options',array('option_id'=>$option_id));

			
	    if(count($option_data) > 0)
	    {	
	    	
	    	$outputjson['success'] = '1';
	    	$outputjson['message'] = 'Option delete Success';
	    }
	    else
	    {
	    	$outputjson['success'] = '0';
	    	$outputjson['message'] = 'Option delete faild !!!!';
	    }

		
	}
?>