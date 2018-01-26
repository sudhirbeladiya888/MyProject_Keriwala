<?php
    require_once('TCPDF/tcpdf.php');
    require_once("fpdfi/fpdi.php");
    require_once("_CONFIG.php");
    require_once("_HELPER.php");
    require_once('_DB.php');
      
    
    global $outputjson, $gh, $db, $DEBUG;
        $db = new MysqliDB(db_host, db_user, db_pass, db_name);
    $gh = new HELPER();
    
    $sample_id = $gh->read('sample');
        $sample_data = $db->execute("SELECT * from tbl_samples where sample_id='$sample_id'");

        $result_data = $db->execute("SELECT rec . * , ts.test_name
            FROM  `tbl_price_record` rec
            LEFT JOIN tbl_tests ts ON rec.test_id = ts.test_id
            WHERE rec.sample_id ='$sample_id'");
    // $result_data = $result_data[0];
    // print_r($result_data);

        $sample_data_dtl = $sample_data[0];
        // print_r($sample_data_dtl);

            $result_data = $db->execute("SELECT rec . * , ts.test_name
        FROM  `tbl_price_record` rec
        LEFT JOIN tbl_tests ts ON rec.test_id = ts.test_id
        WHERE rec.sample_id ='$sample_id'");

// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

    //Page header
    public function Header() {
        // Logo
        $company_image = "images/cubic_logo.png";

        $this->SetFont('helvetica', '', 10);

        // $html = '
        //     <table border="3" cellpadding="0" cellspacing="1" nobr="true" style="padding:0px;width:110%;border:0px #fff;" border="0">
        //         <tr>
        //             <td rowspan="5" style="text-align:right;" height="100px" width="200px">
        //                 <div style="height:200px">
        //                      <img src="'.$company_image.'" alt=" " style="" />
        //                 </div>
        //             </td>
        //             <td  width="380px">'.'WeEnggs Technology'.'</td>
        //         </tr>
        //         <tr>
        //             <td>221, Avalon, Katargam, Surat, Gujarat</td>
        //         </tr>
        //         <tr>
        //             <td>Phone: 0261 - 6536120</td>
        //         </tr>
        //     </table>
        // ';
        $html = '
        <table border="0" style="padding:0px;border-bottom:1px solid #000">
            <tr>
                <td>
                    <img src="'.$company_image.'" alt=" " style="width:240px" />
                </td>
                <td style="text-align:right">
                    <lable>99/100 Yogi Estate,Nr. 66 Kv Substation,</lable><br>
                    <lable>KarmaturChowkdi, G.I.D.C., Ankleshwar,</lable><br>
                    <lable>Di-Bharuch, Gujarat.</lable><br>
                    <lable>Mob : +91 9327770619, +91 9033185885</lable><br>
                    <lable>Email : info@cubicanalytical.com</lable><br>
                    <lable>Website : www.cubicanalytical.com</lable>
                </td>
            </tr>

        </table>
        ';
        
        $this->writeHTML($html);
    }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Cubic Analysis');
$pdf->SetTitle('Cubic');
$pdf->SetSubject('Cubic Analysis');
$pdf->SetKeywords('Cubic Analysis, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('times', '', 12);

// add a page
$pdf->AddPage();

// set some text to print
// $txt = <<<EOD
// TCPDF Example 003

// Custom page header and footer are defined by extending the TCPDF class and overriding the Header() and Footer() methods.
// EOD;

// print a block of text using Write()
// $pdf->Write(0, $txt, '', 0, 'C', true, 0, false, false, 0);

        $html = '
        <table border="0" style="padding:0px;">
            <tr>
                <td style="text-align:center;font-weight: bold;">CERTIFICATE OF ANALYSIS</td>
            </tr>
        </table>
        ';

        $html .= '
        <table border="1" style="padding:10px 5px 10px 5px">
            <tr>
                <td>Certificate No</td>
                <td>'.$sample_data_dtl['certificate_no'].'</td>
                <td>Date</td>
                <td>'.$sample_data_dtl['certificate_date'].'</td>
            </tr>
            <tr>
                <td>Certificate Isssue To</td>
                <td>-</td>
                <td>Party Reference No</td>
                <td>'.$sample_data_dtl['party_reference_no'].'</td>
            </tr>
            <tr>
                <td>Name Of Sample</td>
                <td>'.$sample_data_dtl['name_of_sample'].'</td>
                <td>Sample Received On</td>
                <td>'.$sample_data_dtl['sample_received_on'].'</td>
            </tr>
            <tr>
                <td>Batch No</td>
                <td>'.$sample_data_dtl['batch_no'].'</td>
                <td>Batch Size</td>
                <td>-</td>
            </tr>
            <tr>
                <td>Original Mfg Name</td>
                <td>-</td>
                <td>Sample Qty</td>
                <td>-</td>
            </tr>
        </table>
        ';

        $html .= '
        <table border="0" style="padding:0px;">
            <tr>
                <td style=""></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Analysis Result</td>
            </tr>
        </table>
        ';

        
        $result_tbl = "";
        foreach ($result_data as $key1 => $value_res) {
            $result_tbl .= '<tr>
                <td style="text-align:center;">'.($key1+1).'</td>
                <td style="">'.($value_res['test_name']).'</td>
                <td style="">-</td>
                <td style="">'.($value_res['result']).'</td>
                </tr>';
            }
        $html .= '
        <table border="1" style="padding:5px;">
            <tr style="font-weight: bold;">
                <td style="width:10%;text-align:center;">Sr No.</td>
                <td style="width:40%">Test Parameters</td>
                <td style="width:20%">Spacification</td>
                <td style="width:30%">Results</td>
            </tr>
            '.$result_tbl.'
        </table>
        ';
        
                $html .= '
        <table border="0" style="padding:0px;">
            <tr>
                <td style="" colspan="2"></td>
            </tr>
            <tr>
                <td style="" colspan="2">Note : Party asked for above tests only</td>
            </tr>
            <tr>
                <td style="" colspan="2">Report Date : '.Date("d-m-Y").'</td>
            </tr>
            <tr>
                <td style=""></td>
                <td style=""></td>
            </tr>
            <tr>
                <td style=""></td>
                <td style=""></td>
            </tr>
            <tr>
                <td style=""></td>
                <td style=""></td>
            </tr>
            <tr>
                <td style="padding-top:10px;">Analyzed By:</td>
                <td style="padding-top:10px;">Authorized Sign:</td>
            </tr>
        </table>
        ';
        $html .= '
        <table border="0" style="padding:0px;">
            <tr>
                <td style="" colspan="2"></td>
            </tr>
            <tr>
                <td style="" colspan="2">Note  : </td>
            </tr>
            <tr>
                <td style="" colspan="2"><ol style="list-style-type:decimal">
                <li>The result listed, refer only to the samples analyzed applicable parameters,endorsement of products is  neither inferred nor implied.</li>
                <li>Total liability of our organization is limited to the invoice amount.</li>
                <li>This report cannot be reproduced completely or part, in any form of media (including print) , without an explicit</li>
                <li>written permission from Cubic Analytical Solution.</li>
                <li>Sample drawn and submitted by the party for analysis unless otherwise stated.</li>
                <li>Analyzed samples are destroyed after completion of test.</li>
                </ol></td>
            </tr>
        </table>
        ';
        // output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('example_003.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
?>