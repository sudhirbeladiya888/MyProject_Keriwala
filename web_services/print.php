<?php
    require_once("../lib/fpdf/fpdf.php");
    require_once("_CONFIG.php");
    require_once("_HELPER.php");
    require_once('_DB.php');

   // include("word.php");
    global $outputjson, $gh, $db, $DEBUG;

    $db = new MysqliDB(db_host, db_user, db_pass, db_name);
    $gh = new HELPER();
    $fpdf = new FPDF();
    $sample_id = $gh->read('sample');

    $sample_data = $db->execute("SELECT * from tbl_samples where sample_id='$sample_id'");
// echo "SELECT * from tbl_samples where sample_id='$sample_id'";
// print_r($sample_data);
    $sample_data_dtl = $sample_data[0];


    $number_of_sample_data = count($sample_data);
    $companyAddress = "99/100 Yogi Estate,Nr. 66 Kv Substation ,KarmaturChowkdi, G.I.D.C., Ankleshwar, Di-Bharuch, Gujarat.";
    $companyMobile ="Mob : +91 9327770619, +91 9033185885";
    $companyEmail = "Email : info@cubicanalytical.com";
    $companyWeb ="Website : www.cubicanalytical.com";

    $clientAddress = "";
    $total = 0;
    
    if ($number_of_sample_data > 0) {

        foreach($sample_data as $key => $row) {
         $fpdf->AddPage();
/*$fpdf->SetDrawColor(201,201,201);*/

            $fpdf->SetFont('Arial','B',12);
            
            /*$fpdf->SetDrawColor(201,201,201);*/

            $fpdf->SetFont('Arial','B',12);
            
            // if($companyMobile != ""){
            //     $companyAddress .= $companyMobile;
            // }
            
           
            $fpdf->SetXY(40, 10);
            // if(!empty($row['company_logo'])){
                $fpdf->Cell($fpdf->Image("images/cubic_logo.png",10,10,75));
            // }

            $fpdf->SetFont("Arial", "", 10);
            $fpdf->SetXY(100, 12);
            $fpdf->MultiCell(90,5,$companyAddress,0,'R',false);

            $fpdf->SetFont("Arial", "", 10);
            $fpdf->SetXY(100, 27);
            $fpdf->MultiCell(90,5,$companyMobile,0,'R',false);

            $fpdf->SetFont("Arial", "", 10);
            $fpdf->SetXY(100, 32);
            $fpdf->MultiCell(90,5,$companyEmail,0,'R',false);
            $fpdf->SetFont("Arial", "", 10);
            $fpdf->SetXY(100, 37);
            $fpdf->MultiCell(90,5,$companyWeb,0,'R',false);


            $fpdf->Line(0, 45, 250-20, 45);



//Fill Color Text background
                $fpdf->Ln(12);
                $title = "CERTIFICATE OF ANALYSIS";
                // Arial bold 15
                $fpdf->SetFont('Arial','B',12);
                // Calculate width of title and position
                $w = $fpdf->GetStringWidth($title)+100;
                $fpdf->SetX((210-$w)/2);
                // Colors of frame, background and text
                $fpdf->SetDrawColor(0,80,180);
                $fpdf->SetFillColor(255,255,255);
                $fpdf->SetTextColor(0);
                // Thickness of frame (1 mm)
                $fpdf->SetLineWidth(0.3);
                // Title
                $fpdf->Cell($w,7,$title,0,1,'C',true);
            //Fill Color Text background End
            
}
}

$fpdf->Output();
?>