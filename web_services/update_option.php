<?php	
	function update_option($param=array())
	{
		global $outputjson, $gh, $db;
    	$data = array();
		$option_id			= $gh->read('option_id');
		$data['option_title']				=	$option_title			= $gh->read('option_title');
		$data['option_description']			=	$option_description			= $gh->read('option_description');
		$data['option_price']				=	$option_price	= $gh->read('option_price');
	    //$data['registered_on'] = date('Y-m-d H:i:s');

		if(empty($option_id))
		{
			$outputjson['success'] = 0;
			$outputjson['message'] = 'Select Option Id';
			return false;
		}
		if(empty($option_title))
		{
			$outputjson['success'] = 0;
			$outputjson['message'] = 'Enter Option Title';
			return false;
		}
		if(empty($option_description))
		{
			$outputjson['success'] = 0;
			$outputjson['message'] = 'Select Option Description';
			return false;
		}
		if(empty($option_price))
		{
			$outputjson['success'] = 0;
			$outputjson['message'] = 'Enter Option Price';
			return false;
		}
		


		
	  	
	    $options_data = $db->update('tbl_options',$data,array('option_id'=>$option_id));

			
	    if(count($options_data) > 0)
	    {	
	    	$data = $db->execute("SELECT * FROM tbl_options WHERE option_id='$option_id'");
			$outputjson['data_field'] = $data[0];
			$outputjson['success'] = '1';
	    	$outputjson['message'] = 'option update Success';
	    }
	    else
	    {
	    	$outputjson['success'] = '0';
	    	$outputjson['data'] = [];
	    	$outputjson['message'] = 'option update faild !!!!';
	    }

		
	}
?>