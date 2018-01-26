<?php
	//error_reporting(0);
	//error_reporting(E_ERROR | E_WARNING | E_PARSE);

	// require_once '_SimpleImage.php';
	// require_once("phpmailer/class.phpmailer.php");

	global $DEBUG, $db, $mail;

	class HELPER
	{
		/* Function for create log file and check error */
		function Log($msg) {
			if(is_array($msg)) $msg = print_r($msg, true);

			// Display logged message on screen for debugging.
			$this->debug($msg);

			$path = "upload/_log/";
			if(!is_dir($path))	mkdir($path, 0777, true); 

			// \n must be enclosed with doubel quotes.. using single quote will print it as string not line break.
			$msg = PHP_EOL.date('Y-m-d H:i:s').": ".$msg.PHP_EOL;
			//$msg .= str_repeat("-", 5);

			file_put_contents($path.date('Y_m_d_H').".txt", $msg ,  FILE_APPEND | LOCK_EX);

			// FILE_APPEND => flag to append the content to the end of the file
			// LOCK_EX => flag to prevent anyone else writing to the file at the same time (Available since PHP 5.1)
		}

		function debug($obj, $force_display = false) {
			global $DEBUG;
			$force_display = isset($_REQUEST['debug']); // && $_REQUEST['debug'] == '1';
			if($DEBUG == 1 || $force_display){
				echo '<pre>';
				print_r($obj);
				echo '</pre>';
			}
		}

		function print_str($str) {
			// Order of replacement
			$order   = array("\r\n", "\n", "\r");
			$replace = '<br />';

			// Processes \r\n's first so they aren't converted twice.
			$newstr = str_replace($order, $replace, $str);

			echo $newstr.'<br><br>';
		}
		
		/* This function is used for remove null data from array */
		function removeNull($input) {
			$ret = array();
			foreach ($input as $key => $val)
			{
				if(is_array($val)) 
					$ret[$key] = removeNull($val);
				else
				{
					if(!(is_null($val) || empty($val)))
					{
						$ret[$key] = $val;
					}
				}
			}
			return $ret;
		}

		/* This function is read paramater values from url */
		function read($param_name, $default = null) {
			$ret = isset($_REQUEST[$param_name]) 
					? trim($_REQUEST[$param_name]) 
					: (isset($_POST[$param_name]) 
						? trim($_POST[$param_name]) 
						: $default
					)
			;
			$ret = addslashes(urldecode($ret));
			return $ret;
		}

		function readOptional(&$data, $param_name, $default = "") {
			$ret = isset($_REQUEST[$param_name]) 
					? trim($_REQUEST[$param_name]) 
					: (isset($_POST[$param_name]) 
						? trim($_POST[$param_name]) 
						: null
					)
			;

			if($ret != null){
				$ret = urldecode($ret);
				$data[$param_name] = $ret;
			}
			return $ret;
		}

		/* This Function is used for upload image. When thumb_needed is true is also upload thumbnail image in thumb folder */
		function UploadImage($file, $thumb_needed, $prepend = "") {

			
	        $img_path = "";
			$thumb_needed = isset($thumb_needed) ? $thumb_needed : true;
			
			if(!isset($_FILES[$file]['size']) || $_FILES[$file]['size']=='' || $_FILES[$file]['size'] <= 0){
				return $img_path;
			}
			
			if(isset($_FILES[$file]['name']) && $_FILES[$file]['name']!='')
			{
				if($prepend == "") $prepend = time()."_";
	            //$filename = $prepend.str_replace(" ","",urldecode($_FILES[$file]['name']));

	            $ext = pathinfo($_FILES[$file]['name'], PATHINFO_EXTENSION);
	            $filename = uniqid().".".$ext;
				$this->Log('Uploading image:'.$filename);

				$success = move_uploaded_file($_FILES[$file]['tmp_name'],"upload/large/".$filename);
				if($success)
				{
					$img_path = WEB_SERVICE_PATH.UPLOAD.'large/'.$filename;
					$this -> Log('image uploaded: '.$img_path);
				}

				if($success && $thumb_needed == true)
				{
					$this->GetThumbnail("upload/large/".$filename,"upload/thumb/".$filename, 308);					
					$img_path = WEB_SERVICE_PATH.UPLOAD.'thumb/'.$filename;
					$this -> Log('thumb uploaded: '.$img_path);
				}
			}		
			return $img_path;
		}
		function UploadPDF($file, $thumb_needed, $prepend = "") {

			
	        $img_path = "";
			$thumb_needed = isset($thumb_needed) ? $thumb_needed : true;
			
			if(!isset($_FILES[$file]['size']) || $_FILES[$file]['size']=='' || $_FILES[$file]['size'] <= 0){
				return $img_path;
			}
			
			if(isset($_FILES[$file]['name']) && $_FILES[$file]['name']!='')
			{
				if($prepend == "") $prepend = time()."_";
	            //$filename = $prepend.str_replace(" ","",urldecode($_FILES[$file]['name']));

	            $ext = pathinfo($_FILES[$file]['name'], PATHINFO_EXTENSION);
	            if($ext != "pdf")
	            {
	            	return false;
	            }
	            $filename = uniqid().".".$ext;
				$this->Log('Uploading image:'.$filename);

				$success = move_uploaded_file($_FILES[$file]['tmp_name'],"upload/large/".$filename);
				if($success)
				{
					$img_path = WEB_SERVICE_PATH.UPLOAD.'large/'.$filename;
					$this -> Log('image uploaded: '.$img_path);
				}

				if($success && $thumb_needed == true)
				{
					$this->GetThumbnail("upload/large/".$filename,"upload/thumb/".$filename, 308);					
					$img_path = WEB_SERVICE_PATH.UPLOAD.'thumb/'.$filename;
					$this -> Log('thumb uploaded: '.$img_path);
				}
			}		
			return $img_path;
		}

		/* This function is used for get thumbnail size image */
		function GetThumbnail($big_img_path,$image_path, $wid){
			$this->debug($image_path." - " .$wid);
			$image = new SimpleImage();
			$image->load($big_img_path);
			if($wid > 0 && $wid != $image->getWidth())
			{
				$this->debug("Processing $image_path -> $wid");
				$image->resizeToWidth($wid);
				$result = $image->save($image_path);
				$this->debug($result);
				$this->debug("Processing done");				
			}
			else {
				$this->debug("No processing needed for $image_path");
			}
		}

		function get_array($ds, $col_name) 
		{
			$result = array();
			foreach ($ds as $key => $dr) {
				$result[] = $dr[$col_name];
			}
			return $result;
		}

		function LogHeaders() { 
			$headers = '';
			foreach ($_SERVER as $name => $value) 
			{ 
				if (substr($name, 0, 5) == 'HTTP_') 
				{ 
					$headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value; 
				} 
			} 
			//$this->Log($headers);
			return $headers;
		}

		function is_exist($ds, $col_name, $col_val) {
			if(count($ds) <= 0) return false;

			foreach ($ds as $key => $dr) {
				if(count($dr) > 0){
					if(isset($dr[$col_name]) && $dr[$col_name] == $col_val){
						return true;
					}
				}
			}
			return false;
		}

		function getLocalDate($mysql_date,$tz="UTC",$format="Y-m-d H:i:s") {
		    $UTC = new DateTimeZone("UTC");
		    $date = new DateTime($mysql_date, $UTC);
		    $newTZ = new DateTimeZone($tz);
		    $date->setTimezone($newTZ);
		    return $date->format($format);
		}

		function call_service($url,$parameter=""){
			$curl_handle = curl_init();	
			
			curl_setopt($curl_handle, CURLOPT_URL, $url);
			curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($curl_handle,CURLOPT_POST, 1);
			curl_setopt($curl_handle,CURLOPT_POSTFIELDS,$parameter);
			
			$buffer = curl_exec($curl_handle);
			$result = json_decode($buffer);
			curl_close($curl_handle);

			return $result;
		}

		function SendPushToMultiUser($user_list, $custom)	{
			global $db;
			$result = array();

			if(count($user_list) > 0)
			{
				$arr_android = array();

				foreach ($user_list as $key => $user) 
				{
					if($user["device_token"] != "")
					{
						$arr_android[] = array(
							"user_id" => $user["user_id"]
							, "device_token" => $user["device_token"]
						);
					} 
				}

				$this->debug($arr_android);

				if(count($arr_android) > 0){
					$result = $this->SendPushToAndroid($arr_android, $custom);
				}

			}
			return $result;
		}

		function SendPushToAndroid($arr_android, $data)
		{
	    	$url = 'https://android.googleapis.com/gcm/send';
			$fields = array(
				'registration_ids' => $this->get_array($arr_android, 'device_token'),
				'data' => $data
			);
			$headers = array(
				'Authorization: key='.GOOGLE_GCM_KEY,
				'Content-Type: application/json'
			);
			// Open connection
			$ch = curl_init();

			// Set the url, number of POST vars, POST data
			curl_setopt($ch, CURLOPT_URL, $url);

			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

			// Disabling SSL Certificate support temporarly
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

			// Execute post
			$result = curl_exec($ch);

			//echo "<pre>";print_r($result);

			if ($result === FALSE) {
				$this->Log("Android push failed", $result);
				die('Android push failed: ' . curl_error($ch));
				return false;
			}

			// Close connection
			curl_close($ch);
			
			$this->Log("Android push sent: ". print_r($data, true)."\n".print_r($result, true));

			return $result;
		}
	
	   	/**
		 * Returns an encrypted & utf8-encoded
		 */
		function encrypt($pure_string) {
			$key = ENCRYPTION_KEY;
		    $encrypted_string = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $pure_string, MCRYPT_MODE_CBC, md5(md5($key))));
		    return $encrypted_string;
		}

		/**
		 * Returns decrypted original string
		 */
		function decrypt($encrypted_string) {
			$key = ENCRYPTION_KEY;		
		    $decrypted_string = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($encrypted_string), MCRYPT_MODE_CBC, md5(md5($key))), "\0");
		    return $decrypted_string;
		}



		/*function send_email($email, $subject, $body) {

			$this->Log("Sending email with To: ". $email. "   <br>Subject: ". $subject ."		<br>Body: ".$body);

			$mail = new PHPMailer();
			$mail->IsHTML(true);
			$mail->isSMTP();
			
			//Enable SMTP debugging
			// 0 = off (for production use)
			// 1 = client messages
			// 2 = client and server messages

			$mail->SMTPDebug = 2;
			$mail->Debugoutput = 'html';
			
			//$mail->SMTPSecure = "tls"; 
			$mail->Host       = EMAIL_HOST; 
			$mail->Port = 25;
			$mail->SetFrom(EMAIL_ADDRESS, APP_NAME . ' Support');
			$mail->AddReplyTo(EMAIL_ADDRESS, APP_NAME . ' Support');
			// $mail->AddBCC('hitesh@weenggs.com');
			$mail->AddAddress($email);
			$mail->Subject  = $subject;
			$mail->Body     = $body;	
			$response = $mail->Send();
			return $response;
		}*/

		function send_email($email, $subject, $msg)
		{	
			$rtn = false;
			$this->Log("Sending email with To: ". $email. "   Subject: ". $subject ."");

			$mail = new PHPMailer(); // create a new object

			$mail->IsSMTP();
			$mail->SMTPDebug  = 0;
			$mail->SMTPAuth   = true;
			$mail->SMTPSecure = "tls";
			$mail->Host       = EMAIL_HOST;
			$mail->Port       = 587;
			$mail->Username   = EMAIL_USER;
			$mail->Password   = EMAIL_PASS;
			$mail->AddAddress($email);
			$mail->SetFrom(EMAIL_ADDRESS, APP_NAME . ' Support');
			$mail->AddReplyTo(EMAIL_ADDRESS, APP_NAME . ' Support');
			$mail->IsHTML(true);
			$mail->Subject = $subject;
			$mail->MsgHTML($msg);

			$rtn = $mail->Send();

			if(!$rtn) 
			{ 
				$this->log("Sending Email Failed: " . $email); 
		    	$this->log("Mailer Error: " . $mail->ErrorInfo); 
			}

			return $rtn;
		}

		function crypto_rand_secure($min, $max)
		{
		    $range = $max - $min;
		    if ($range < 1) return $min; // not so random...
		    $log = ceil(log($range, 2));
		    $bytes = (int) ($log / 8) + 1; // length in bytes
		    $bits = (int) $log + 1; // length in bits
		    $filter = (int) (1 << $bits) - 1; // set all lower bits to 1
		    do {
		        $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
		        $rnd = $rnd & $filter; // discard irrelevant bits
		    } while ($rnd > $range);
		    return $min + $rnd;
		}

		function getToken($length)
		{
		    $token = "";
		    $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		    $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
		    $codeAlphabet.= "0123456789";
		    $max = strlen($codeAlphabet); // edited

		    for ($i=0; $i < $length; $i++) {
		        $token .= $codeAlphabet[$this->crypto_rand_secure(0, $max-1)];
		    }

		    return $token;
		}

		function do_filter($ds, $col_name, $col_val, $singe_entry = false) {
			$result = array();
			foreach ($ds as $key => &$dr) {
				if(isset($dr[$col_name]) && $dr[$col_name] == $col_val){
					//unset($dr[$col_name]);
					$result[] = $dr;
				}
			}
			if($singe_entry == true && count($result) > 0){
				$result = $result[0];
			}
			return $result;
		}

		public function objectToArray ($object) 
		{
			if(!is_object($object) && !is_array($object))
				return $object;

			return array_map(array($this, 'objectToArray'), (array) $object);
		}


		function getTime($date)
		{
			$seconds = (strtotime(date('Y-m-d H:i:s')) - strtotime($date));
			$minutes = round($seconds) / 60;
			$hours = round($minutes) / 60;
			$days = round($hours) / 24;

			$time_ago = $seconds . ' seconds ago';
			if (round($minutes) > 0) {
				if(round($hours) > 0) {
					if(round($days) > 0) {
						$time_ago = round($days) . " day(s) ago.";
					}
					else {
						$time_ago = round($hours) . " hour(s) ago.";
					}
				}
				else {
					$time_ago = round($minutes) . " minute(s) ago.";
				}
			}
			return $time_ago;
		}


		
	}
?>