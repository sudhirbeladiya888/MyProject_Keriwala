<?php
function ajax_PDF_upload($param = array())
{
    global $outputjson, $gh, $db;
    $outputjson['success'] = 0;

    $path = 'upload/large/';
    // move_uploaded_file($_FILES['file']['tmp_name'],$path.$_FILES['file']['name']);

    $file_url = $gh->UploadPDF("files", false);
  
    if ($file_url != "") {
        $outputjson['success'] = '1';
        $outputjson['message'] = 'File uploaded successfully.';
        $outputjson['file_url'] = $file_url;
    } else {
        $outputjson['success'] = '0';
        $outputjson['message'] = 'Upload only pdf file...'; 
    }
}

?>