<?php	
	function get_latest_news($param=array())
	{
		global $outputjson, $gh, $db;
    

		$where = " '1:1' ";
		
		
	    $news_data= $db->execute("
	    	SELECT * FROM tbl_latest_news WHERE ".$where
			);
	  
	    if(count($news_data) > 0)
	    {	
	    	$outputjson['data'] = $news_data;
	    	$outputjson['success'] = 1;
	    	$outputjson['message'] = count($news_data) .' news  found';
	    }
	    else
	    {
	    	$outputjson['success'] = 0;
	    	$outputjson['message']	=	'News not found';
	    }

		
	}
?>