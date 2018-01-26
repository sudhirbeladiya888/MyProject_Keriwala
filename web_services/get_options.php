<?php	
	function get_options($param=array())
	{
		global $outputjson, $gh, $db;
    
		$option_id = $gh->read("option_id");

		$where = " '1:1' ";
		
		if(!empty($option_id))
		{
			$where .= " AND option_id = ".$option_id;
		}

	    $option_data= $db->execute("
	    	SELECT * FROM tbl_options WHERE ".$where
			);
	  
	    if(count($option_data) > 0)
	    {	
	    	$outputjson['data'] = $option_data;
	    	$outputjson['success'] = 1;
	    	$outputjson['message'] = count($option_data) .' options found';
	    }
	    else
	    {
	    	$outputjson['success'] = 0;
	    	$outputjson['message'] = 'options not found';
	    }

		
	}
?>