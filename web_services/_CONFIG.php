<?php

	error_reporting(0);
	error_reporting(E_ALL);

	date_default_timezone_set('UTC');

	
	if($_SERVER['REQUEST_URI'] == "admin.cubicanalytical.com")
	{
	}
	else
	{
		define("db_host","localhost");
		define("db_user","root");
		define("db_pass","");
		define("db_name","cubicavd_db_cubic");
	
		define("DOMAIN","http://localhost/Cubic/");
		define("WEB_SERVICE_PATH","http://localhost/Cubic/web_services/");
	}



	define("UPLOAD","upload/");

	$path = "upload/";
	if(!is_dir($path)) mkdir($path, 0777, true);

	$path = "upload/thumb/";
	if(!is_dir($path)) mkdir($path, 0777, true);

	$path = "upload/large/";
	if(!is_dir($path)) mkdir($path, 0777, true);
?>