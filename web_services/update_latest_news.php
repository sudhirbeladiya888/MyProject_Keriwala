<?php	
	function update_latest_news($param=array())
	{
		global $outputjson, $gh, $db;
    	$data = array();
    	$outputjson['success'] = '0';
		
    	$news_id			=		$gh->read('news_id');
    	$data['news_image']			=	$news_image			=		$gh->read('news_image');
		$data['news_title']			=	$news_title			=		$gh->read('news_title');
		$data['news_discription']	=	$news_discription	=		$gh->read('news_discription');
		$data['news_author']		=	$news_author		=		$gh->read('news_author');

		if(empty($news_title))
		{
			$outputjson['message'] = "Missing Title";
			return false;
		}
		if(empty($news_discription))
		{
			$outputjson['message'] = "Missing Discription";
			return false;
		}
		if(empty($news_author))
		{
			$outputjson['message'] = "Missing Author";
			return false;
		}
		
		
	    $news_data = $db->update('tbl_latest_news',$data,array("news_id"=>$news_id));
		if(count($news_data) > 0)
	    {	

	    	$data = $db->execute("SELECT * FROM tbl_latest_news  WHERE news_id='$news_id'");
	    	$outputjson['success'] = '1';
	    	$outputjson['data'] = $data[0];
	    	$outputjson['message'] = 'News update Success';
	    }
	    else
	    {
	    	$outputjson['success'] = '0';
	    	$outputjson['data'] = [];
	    	$outputjson['message'] = 'News update faild !!!!';
	    }

		
	}
?>