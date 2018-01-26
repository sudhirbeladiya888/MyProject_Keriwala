<?php	
	function add_latest_news($param=array())
	{
		global $outputjson, $gh, $db;
    	$data = array();
    	$outputjson['success'] = '0';
		$data['added_on'] 	= date('Y-m-d H:i:s');
		
		$data['news_image']			=	$news_image			=		$gh->read('news_image');
		$data['news_title']			=	$news_title			=		$gh->read('news_title');
		$data['news_discription']	=	$news_discription	=		$gh->read('news_discription');
		$data['news_author']		=	$news_author		=		$gh->read('news_author');

		if(empty($news_image))
		{
			$outputjson['message'] = "Missing Image";
			return false;
		}
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
		
		
	    $news_id = $db->insert('tbl_latest_news',$data);
		if(count($news_id) > 0)
	    {	

	    	$data = $db->execute("SELECT * FROM tbl_latest_news  WHERE news_id='$news_id'");
	    	$outputjson['success'] = '1';
	    	$outputjson['data'] = $data[0];
	    	$outputjson['message'] = 'News addedd Success';
	    }
	    else
	    {
	    	$outputjson['success'] = '0';
	    	$outputjson['data'] = [];
	    	$outputjson['message'] = 'News addedd faild !!!!';
	    }

		
	}
?>