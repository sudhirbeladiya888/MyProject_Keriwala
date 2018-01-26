<?php	
	function add_samples($param=array())
	{
		global $outputjson, $gh, $db;
    	$data = array();
    	$outputjson['success'] = '0';
		
												
		$data['admin_id']					=	$admin_id				=	$gh->read("admin_id",1);
		// $data['sample_received_on']			=	$sample_received_on		=	date('Y-m-d',strtotime($gh->read('sample_received_on')));
		$sample_received_on		=	$gh->read("sample_received_on");
		$data['order_type']					=	$order_type				=	$gh->read("order_type");
		$data['company_id']					=	$company_id				=	$gh->read("company_id");
		$data['party_reference_no']			=	$party_reference_no		=	$gh->read("party_reference_no");
		$data['name_of_sample']				=	$name_of_sample			=	$gh->read("name_of_sample");
		// $data['sample_qty']					=	$sample_qty				=	$gh->read("sample_qty");
		$data['batch_no']					=	$batch_no				=	$gh->read("batch_no");
		$data['test_id']					=	$test_id				=	$gh->read("test_id");
												
		$data['certificate_date']			=	$certificate_date		=	date('Y-m-d',strtotime($gh->read("certificate_date")));
		$data['order_price']				=	$order_price			=	$gh->read("order_price",10);
		$data['order_price_data']			=	$order_price_data		=	$gh->read("order_price_data");
		$data['payment_type']				=	$payment_type			=	$gh->read("payment_type");
		$data['total_sum_qty']				=	$total_sum_qty			=	$gh->read("total_sum_qty");
		$data['total_sum_price']			=	$total_sum_price			=	$gh->read("total_sum_price");
		$data['added_on']					=	$added_on				=	date('Y-m-d H:i:s');

		$date_arr= explode("/",$sample_received_on);
		$date_frmt = $date_arr[2].'-'.$date_arr[1].'-'.$date_arr[0];
		$data['sample_received_on']			=	$date_frmt;
		$Today =  date('d',strtotime($date_frmt));
		$ThisMonth =  date('m',strtotime($date_frmt));
		$ThisYear =  date('Y',strtotime($date_frmt));
		// die();


		if(empty($admin_id))
		{
			$outputjson['message'] = "Missing Admin Id";
			return false;
		}
		if(empty($sample_received_on))
		{
			$outputjson['message'] = "Missing Sample Received On";
			return false;
		}
		if(empty($order_type))
		{
			$outputjson['message'] = "Missing Order Type";
			return false;
		}
		if(empty($company_id))
		{
			$outputjson['message'] = "Missing Company Id";
			return false;
		}
		if(empty($party_reference_no))
		{
			$outputjson['message'] = "Missing Party Reference No";
			return false;
		}
		if(empty($name_of_sample))
		{
			$outputjson['message'] = "Missing Name Of Sample";
			return false;
		}
		// if(empty($sample_qty))
		// {
		// 	$outputjson['message'] = "Missing Sample Qty";
		// 	return false;
		// }
		if(empty($batch_no))
		{
			$outputjson['message'] = "Missing Batch No";
			return false;
		}
		if(empty($test_id))
		{
			$outputjson['message'] = "Missing Test Id";
			return false;
		}
		if(empty($certificate_date))
		{
			$outputjson['message'] = "Missing Certificate Date";
			return false;
		}
		if(empty($order_price))
		{
			$outputjson['message'] = "Missing Order Price";
			return false;
		}
		if(empty($payment_type))
		{
			$outputjson['message'] = "Missing Payment Type";
			return false;
		}
		////////////////////GENERATE NUMBER SERIES
		$where_se ="";
		if($order_type == '2')
		{
			$where_se = " AND sample_no LIKE  '%B%'";
		}
		if($order_type == '1')
		{
			$where_se = " AND sample_no NOT LIKE  '%B%'";
		}
		$total_record = $db->getRowcount("tbl_samples", "IFNULL(is_deleted,0) ='0' AND date(sample_received_on) = STR_TO_DATE('$date_frmt', '%Y-%m-%d') $where_se");
		if($order_type == '1')
		{
			$data['sample_no']			=		$ThisMonth."-".$Today."-".sprintf("%'.03d\n", $total_record+1);
			$data['certificate_no']		=		"CAS/".$ThisYear."/".$ThisMonth."/".$Today."/".sprintf("%'.03d\n", $total_record+1);
		}
		else
		{
			$data['sample_no']			=		'B/'.$ThisMonth."/".$Today."/".sprintf("%'.03d\n", $total_record+1);	
		$data['certificate_no']		=		"CAS/B/".$ThisYear."/".$ThisMonth."/".$Today."/".sprintf("%'.03d\n", $total_record+1);
		}

		$order_price_data_arr = explode(",",$order_price_data);
		$sample_id = $db->insert('tbl_samples',$data);
		if(count($sample_id) > 0)
	    {	
			foreach ($order_price_data_arr as $key1 => $value) {
				$per_record_arr = explode("-",$value);
		
				$dataPrice['company_id'] 			= $company_id;
				$dataPrice['sample_id'] 			= $sample_id;
				$dataPrice['test_id'] 				= $per_record_arr[0];
				$dataPrice['test_price'] 			= $per_record_arr[1];
				$dataPrice['test_qty'] 				= $per_record_arr[2];
				$dataPrice['test_total_price'] 		= $per_record_arr[3];
				$dataPrice['result'] 				= $per_record_arr[4];
				$dataPrice['added_on'] 				= date('Y-m-d H:i:s');
				$price_record_id = $db->insert('tbl_price_record',$dataPrice);
			}

	    	$data = $db->execute("SELECT * FROM tbl_samples WHERE sample_id='$sample_id'");
	    	$outputjson['success'] = '1';
	    	$outputjson['data'] = $data[0];
	    	$outputjson['message'] = 'Sample addedd Success';
	    }
	    else
	    {
	    	$outputjson['success'] = '0';
	    	$outputjson['data'] = [];
	    	$outputjson['message'] = 'Sample addedd faild !!!!';
	    }

		
	}
?>