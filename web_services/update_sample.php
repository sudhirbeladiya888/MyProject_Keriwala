<?php	
	function update_sample($param=array())
	{
		global $outputjson, $gh, $db;
    	$data = array();
    	$outputjson['success'] = '0';
    	$sample_id		=		$gh->read('sample_id');
		$data['sample_received_on']			=	$sample_received_on		=	date('Y-m-d',strtotime($gh->read('sample_received_on')));
		$data['order_type']					=	$order_type				=	$gh->read("order_type");
		$data['company_id']					=	$company_id				=	$gh->read("company_id");
		$data['party_reference_no']			=	$party_reference_no		=	$gh->read("party_reference_no");
		$data['name_of_sample']				=	$name_of_sample			=	$gh->read("name_of_sample");
		$data['sample_qty']					=	$sample_qty				=	$gh->read("sample_qty");
		$data['batch_no']					=	$batch_no				=	$gh->read("batch_no");
		$data['test_id']					=	$test_id				=	$gh->read("test_id");
												
		$data['certificate_date']			=	$certificate_date		=	date('Y-m-d',strtotime($gh->read("certificate_date")));
		$data['order_price']				=	$order_price			=	$gh->read("order_price",10);
		$data['order_price_data']			=	$order_price_data		=	$gh->read("order_price_data");
		$data['payment_type']				=	$payment_type			=	$gh->read("payment_type");
		$data['total_sum_qty']				=	$total_sum_qty			=	$gh->read("total_sum_qty");
		$data['total_sum_price']			=	$total_sum_price			=	$gh->read("total_sum_price");

		// print_r($data);
		// die();

		if(empty($sample_id))
		{
			$outputjson['message'] = "Missing Sample";
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
		if(empty($sample_qty))
		{
			$outputjson['message'] = "Missing Sample Qty";
			return false;
		}
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
		
	    $sample_data = $db->update('tbl_samples',$data,array("sample_id"=>$sample_id));
		if(count($sample_data) > 0)
	    {	

	    	$data = $db->execute("SELECT * FROM tbl_samples WHERE sample_id='$sample_id'");
	    	$outputjson['success'] = '1';
	    	$outputjson['data'] = $data[0];
	    	$outputjson['message'] = 'Sample update successfully';
	    }
	    else
	    {
	    	$outputjson['success'] = '0';
	    	$outputjson['data'] = [];
	    	$outputjson['message'] = 'Sample u faild !!!!';
	    }

		
	}
?>