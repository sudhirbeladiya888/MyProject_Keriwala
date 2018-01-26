<?php	
	function update_company($param=array())
	{
		global $outputjson, $gh, $db;
    	$data = array();
    	$outputjson['success'] = '0';
    	$company_id			=	$gh->read('company_id');
		$data['added_on'] 	= 	date('Y-m-d H:i:s');
		$data['name']		=	$name			=		$gh->read('name');
		$data['address']	=	$address		=		$gh->read('address');
		$data['contact_no']	=	$contact_no		=		$gh->read('contact_no');
		$data['email']		=	$email			=		$gh->read('email');
		$data['contact_person']		=	$contact_person			=		$gh->read('contact_person');
		$data['password']		=	$password			=		base64_encode($gh->read('password'));


		if(empty($name))
		{
			$outputjson['message'] = "Missing name";
			return false;
		}
		if(empty($address))
		{
			$outputjson['message'] = "Missing address";
			return false;
		}
		if(empty($contact_no))
		{
			$outputjson['message'] = "Missing contact_no";
			return false;
		}
		if(empty($email))
		{
			$outputjson['message'] = "Missing email";
			return false;
		}
		if(empty($contact_person))
		{
			$outputjson['message'] = "Missing contact_person";
			return false;
		}
		if(empty($password))
		{
			$outputjson['message'] = "Missing password";
			return false;
		}
		
		
	    $company_data = $db->update('tbl_companies',$data,array("company_id"=>$company_id));
		if(count($company_id) > 0)
	    {	

	    	$data = $db->execute("SELECT * FROM tbl_companies WHERE company_id='$company_id'");
	    	$outputjson['success'] = '1';
	    	$outputjson['data'] = $data[0];
	    	$outputjson['message'] = 'Comapny update Success';
	    }
	    else
	    {
	    	$outputjson['success'] = '0';
	    	$outputjson['data'] = [];
	    	$outputjson['message'] = 'Comapny update faild !!!!';
	    }

		
	}
?>