<?php	
	function delete_sample($param=array())
	{
		global $outputjson, $gh, $db;
		$sample_id			= $gh->read('sample_id');

		if(empty($sample_id))
		{
			$outputjson['success'] = 0;
	    	$outputjson['message'] = 'Select sample id';
	    	return false;
		}

	    $sample_data = $db->update('tbl_samples',array('is_deleted'=>"1"),array('sample_id'=>$sample_id));

			
	    if(count($sample_data) > 0)
	    {	
	    	
	    	$outputjson['success'] = '1';
	    	$outputjson['message'] = 'sample delete Success';
	    }
	    else
	    {
	    	$outputjson['success'] = '0';
	    	$outputjson['message'] = 'sample delete faild !!!!';
	    }

		
	}
?>