<?php	
	function get_users($param=array())
	{
		global $outputjson, $gh, $db;
    
		
		

	    $user_data= $db->execute("
	    	SELECT * from tbl_admin"
			);
	  
	    if(count($user_data) > 0)
	    {	

	    	$outputjson['data'] = $user_data;
	    	$outputjson['success'] = 1;
	    	$outputjson['message'] = count($user_data) .' Users found';
	    }
	    else
	    {
	    	$outputjson['success'] = 0;
	    	$outputjson['message'] = 'Users not found';
	    }

		
	}
?>