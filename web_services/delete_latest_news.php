<?php	
	function delete_latest_news($param=array())
	{
		global $outputjson, $gh, $db;
		$news_id			= $gh->read('news_id');

		if(empty($news_id))
		{
			$outputjson['success'] = 0;
	    	$outputjson['message'] = 'Select news';
	    	return false;
		}

	    $sample_data = $db->delete('tbl_latest_news',array('news_id'=>$news_id));

			
	    if(count($sample_data) > 0)
	    {	
	    	
	    	$outputjson['success'] = '1';
	    	$outputjson['message'] = 'News delete Success';
	    }
	    else
	    {
	    	$outputjson['success'] = '0';
	    	$outputjson['message'] = 'News delete faild !!!!';
	    }

		
	}
?>