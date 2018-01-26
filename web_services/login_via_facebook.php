<?php

function login_via_facebook($params=array())
{
	global $outputjson, $gh, $db ;
	
	$user_id = $gh->read('user_id',0);
	$fb_id = $gh->read('fb_id');
	$username = $gh->read('username');
	$user_email = $gh->read('user_email');
	$added_on = date('Y-m-d H:i:s');

	$data = array(
		"fb_id" => $fb_id,
		"user_email" => $user_email,
		"username" => $username
		);

	$where = "fb_id='".$fb_id."'";

	$exist = $db->getRowCount("tbl_users", $where);
	if( $exist > 0)
	{
		$outputjson['success'] = '1';
		$outputjson['message'] = 'Facebook login success.';

	}
	else
	{

		$data["username"]	 = $username;
		$data["user_email"]	 = $user_email;
		// signed up user using facebook..
		$data['added_on'] = $added_on;

		
		$data = $gh->removeNull($data);

		$id = $db->insert('tbl_users', $data);
		if($id)
		{
			$outputjson['success'] = '1';
			$outputjson['message'] = 'Facebook signup success.';
		}
		else
		{
			$outputjson['success'] = '0';
			$outputjson['message'] = 'Facebook signup failed, please try again.';
		}
	}
	
	$outputjson['dictionary'] = array();

	$dt = $db->select("*","tbl_users",$where);

	if(count($dt) > 0)
	{
		$outputjson['dictionary'] = $dt[0];
	}
}
?>
