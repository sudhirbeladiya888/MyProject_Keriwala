<?php
	error_reporting(E_ALL);
	ini_set('display_errors',1);
	//error_reporting(E_ERROR | E_WARNING | E_PARSE);

	date_default_timezone_set('UTC');

	$start_service=microtime(true);	

	header("Content-type: application/json; charset=utf-8");
		
	$gIGNORESESS = true;
	include("_CONFIG.php");
	include("_HELPER.php");
	require_once('_DB.php');

	$operation=$_REQUEST['op'];
			
	global $outputjson, $gh, $db, $DEBUG;

	$debug= isset($_REQUEST['debug']) && $_REQUEST['debug'] == '1';
	if($debug){
		$outputjson["query_info"] = array();
	}

	$db = new MysqliDB(db_host, db_user, db_pass, db_name);
	$gh = new HELPER();

	$DEBUG = $gh->read("debug") == "1";
	$LOG = true; // $gh->read("log") == "1";

	$headers = $gh->LogHeaders(); 
	if(isset($headers['User-Agent'])){
		$gh->Log($headers['User-Agent']);
	}
		
	try 
	{
		if(!isset($operation))
		{
			$outputjson['error'] = "Operation missing in request.";
		}
		
		else if(file_exists($operation.".php"))
		{
			include($operation.".php");
			if(is_callable($operation) ){
				//echo "<pre>"; // must be here for formatted output
				$params = $_REQUEST;
				$operation($params);
				if(isset($_REQUEST['user_id']) && !empty($_REQUEST['user_id']))
				{
					$user_id = $_REQUEST['user_id'];
					if(isset($_REQUEST['from']) && !empty($_REQUEST['from']) && $_REQUEST['from'] == 'web')
					{
						$user_id = base64_decode($user_id);
					}
					$db->update('gb_users',array('last_visited'=>date('Y-m-d H:i:s')),array('user_id'=>$user_id));
				}
				//echo "</pre>"; // must be here for formatted output
			}
			else {
				$outputjson['error'] = "Operation does not exists" ;
			}
		}		
		else
		{
			$outputjson['error'] = "file does not exist";
		}
	}
	catch (Exception $e) 
	{
	    echo 'Caught exception: ',  $e->getMessage(), "\n";
	}

	$temp_outputjson = ($outputjson);
	$temp_outputjson = stripslashes_deep($temp_outputjson);
	
	if($LOG == "1")
	{
		$output = "Request: ";
		$output .= print_r($_SERVER['QUERY_STRING'],true) . "\n";
		$output .= "Posted_Data:".print_r($_POST,true) . "\n";
		$output .= "Posted Data:".print_r(urldecode(file_get_contents('php://input')), true) . "\n";
		$output .= print_r($temp_outputjson, true) . "\n";	
		$output .= "FILES POSTDATA:".print_r($_FILES,true) . "\n";	
		$gh -> Log($output);
	}

	$stop_service=microtime(true);
	$time_diff = ($stop_service-$start_service).' seconds';

	if(count($outputjson) > 0)
		$temp_outputjson["service_time"] = $time_diff;

	echo json_encode($temp_outputjson, JSON_PRETTY_PRINT);

	function stripslashes_deep($value) {
		$value = is_array($value) ?	array_map('stripslashes_deep', $value) : stripslashes($value);
		return $value;
	}
?>