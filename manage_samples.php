<?php
 require 'header.php';
 require 'sidebar.php';
?>
<style type="text/css">
  .tb_lable
  {
    font-size: 12px;
  }
  /*.multiselect
  {
    width: 100% !important;
  }*/
  .add_cmp
  {
    cursor: pointer;
  }
  .tbl_td
  {
    padding: 5px;
  }
  .coustom-form-control
  {
    box-shadow: none;
    border-color: #d2d6de;
    display: block;
    height: 34px;
    padding: 6px 12px;
    font-size: 14px;
    line-height: 1.42857143;
    color: #555;
    background-color: #fff;
    background-image: none;
    border: 1px solid #ccc;
    border-radius: 4px;
  }
  #sel_cmp_btn
  {
    min-width: 50px;
    padding: 7px 10px 6px 10px;
  }
  #sel_test_btn
  {
    min-width: 50px;
    padding: 7px 10px 6px 10px;
  }
  /* Multiselect */
  .multiselect-container > li > a { white-space: normal; }
  /*End*/


  /* Cross and check mark*/
  /*.fa-check
  {
    color: green;
  }
  .fa-times
  {
    color: red;
  }*/
  /* Cross and check mark*/

  .SelectPDFBtn
  {
    margin: 5px;
  }

</style>
<link rel="stylesheet" href="css/dropzone.css">
<!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
<link rel="stylesheet" href="css/jquery.fileupload.css">
<link rel="stylesheet" href="css/bootstrap-multiselect.css">

<script src="js/bootstrap-multiselect.js"></script>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         Order 
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"> Order </li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Info boxes -->
      <div class="row">

        <div class="col-md-12" style="">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Add New Order </h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus NavClick"></i>
                </button>
              </div>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" id="frm_order_details" name="frm_order_details" class="validate_form" method="POST" onsubmit="return false" enctype="multipart/form-data">
              <input type="hidden" class="form-control" id="td_sample_id">
              <div class="box-body">

                <!-- <div class="col-md-12">
                  <span class="btn btn-success fileinput-button">
                    <i class="glyphicon glyphicon-plus"></i>
                    <span>Select files...</span>
                    
                    <input id="fileupload" type="file" name="files" multiple>
                  </span>
                  <div id="progress" class="progress" style="margin: 5px 0px 0px 0px;">
                    <div class="progress-bar progress-bar-success"></div>
                  </div>
                  <div id="files" class="files"></div>
                </div> -->

                <!--  -->
                <div class="formData" style="width: 100%;overflow: auto;">
                  <table>
                    <tr>
                      <td class="tbl_td">
                        <label for="td_sample_received_on" class="tb_lable">Sample Rec. On</label>
                        <div class="input-group">
                          <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </div>
                        <input type="text" class="coustom-form-control datepicker"  id="td_sample_received_on" placeholder= "Enter Sample Received On" style="width: 130px;" value="<?php echo date('d/m/Y'); ?>">
                        </div>
                      </td>
                      <td class="tbl_td">
                        <label for="td_order_type" class="tb_lable">Order Type</label>
                        <select class="coustom-form-control" id="td_order_type" style="width: 80px;">
                          <option value="1">A</option>
                          <option value="2">B</option>
                        </select>
                        
                      </td>
                      <td class="tbl_td" style="display: table-caption;">
                        <label for="sel_company" class="tb_lable">Company</label>
                        <input type="hidden" id="up_company_id">
                        <button class="btn btn-success btn-sm" id="sel_cmp_btn">Select Company</button>
                        <!-- <div class="input-group">
                          <div class="input-group-addon add_cmp">
                            <i class="fa fa-plus"></i>
                          </div>
                          <select class="coustom-form-control" id="sel_company">
                          </select>
                        </div> -->
                        
                      </td>
                      <td class="tbl_td">
                        <label for="td_party_reference_no" class="tb_lable">Party Reference No</label>
                        <input type="text" class="coustom-form-control" id="td_party_reference_no" placeholder= "Enter Party Reference No" style="width: 130px;">
                        
                      </td>
                      <td class="tbl_td">
                        <label for="td_name_of_sample" class="tb_lable">Name Of Sample</label>
                        <input type="text" class="coustom-form-control" id="td_name_of_sample" placeholder= "Enter Name Of Sample">
                        
                      </td>
                      <td class="tbl_td">
                        <!-- <label for="td_sample_qty" class="tb_lable">Sample Qty</label> -->
                        <!-- <input type="hidden" class="coustom-form-control" id="td_sample_qty" placeholder= "Enter Sample Qty" style="width: 130px;" value="00"> -->
                        
                      </td>
                      <td class="tbl_td">
                        <label for="td_batch_no" class="tb_lable">Batch No</label>
                        <input type="text" class="coustom-form-control" id="td_batch_no" placeholder= "Enter Batch No" style="width: 130px;">
                        
                      </td>
                      <td class="tbl_td"  style="display: table-caption;">
                        <label for="sel_test" class="tb_lable">Test List</label>
                        <input type="hidden" id="up_test_id">
                        <button class="btn btn-success btn-sm" id="sel_test_btn">Select Test</button>
                        <!-- <select class="" id="sel_test" multiple></select> -->
                        
                      </td>
                      <td class="tbl_td">
                        <label for="td_order_type" class="tb_lable">Certificate Date</label>
                        <div class="input-group">
                          <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </div>
                          <input type="text" class="coustom-form-control datepicker"  id="td_certificate_date" placeholder= "Enter Certificate Date" style="width: 130px;"  value="<?php echo date('d/m/Y'); ?>">
                        </div>
                        
                      </td>
                      <td class="tbl_td">
                        <label for="td_payment_type" class="tb_lable">Pay. Type</label>
                        <select class="coustom-form-control" id="td_payment_type" width: 80px;>
                          <option value="1">Cash</option>
                          <option value="2">Pending</option>
                        </select>
                        
                      </td>


                    </tr>
                  </table>
                  
                </div>
                
                <div class="col-md-12" style="overflow-x: auto;">
                  <table class="priceCalculation" style="margin-top: 5px">

                  </table>
                  <!-- <div class="priceCalculation"></div> -->
                </div>

                <!--  -->
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary pull-right btnAddOrder " name="add_order" id="OrderFormBtn" style="    margin: 0px 5px 0px 5px;">Save order</button>
                <button type="submit" class="btn btn-info pull-right " " id="BtnCancel" style="    margin: 0px 5px 0px 5px;">Cancel</button>
              </div>
            </form>
          </div>
          <!-- /.box -->
          <div class="box  box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Orders List</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="overflow-x: auto;">   <!-- style="overflow-x: auto;" -->

              <!-- DATA TABLE  -->
              <!-- <table class="table table-bordered table-striped dt_users"> -->

<table class="table table-striped table-bordered responsive dataex-res-colreorder dt-responsive dt_users" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th class="sorting_disabled"  style="width: 5%">#</th>
                    <th class="" class="certificate_no" style="width: 10%">Sample Recieved Date</th>
                    <th class="" class="certificate_no" style="width: 10%">Sample Inward No</th>
                    <th class="company_name" style="width: 10%">Company Name</th>
                    <th class="company_name" style="width: 10%">Party Ref. Name</th>
                    <th class="name_of_sample" style="width: 10%">Name of Sample</th>
                    <th class="name_of_sample" style="width: 10%">Batch No</th>
                    <!-- <th class="name_of_sample" style="width: 10%">Test Name</th> -->
                    <th class="" class="certificate_no" style="width: 20%">COA No</th>
                    <th class="" class="certificate_no" style="width: 20%">COA Date</th>
                    <th class="" class="certificate_no" style="width: 10%">Remark</th>
                    <th class="table_action sorting_disabled" style="width: 30%">Action</th>
                  </tr>
                </thead>
                <tbody>

                </tbody>
              </table>

              <!-- DATA TABLE -->
            </div>
            <!-- /.box-body -->
          </div>

        </div>

      </div>
      <!-- /.row -->


    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


<div id="addCompanyModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Add New Company </h3>
              <!-- <div class="box-tools pull-right"> -->
                <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
              </div>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" id="frm_company" name="frm_company" class="validate_form" method="POST" onsubmit="return false">
              <input type="hidden" class="form-control" id="td_comapny_id">
              <div class="box-body">
                <div class="col-md-12">
                  <div class="form-group col-md-6">
                    <label for="td_comapny_name">Comapny Name</label>
                    <input type="text" class="form-control" id="td_comapny_name" placeholder="Enter Comapny name">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="td_address">Address</label>
                    <input type="text" class="form-control" id="td_address" placeholder="Enter address">
                  </div>
                </div>
                 <div class="col-md-12">
                  <div class="form-group col-md-6">
                    <label for="td_contact_no">Contact No</label>
                    <input type="text" class="form-control" id="td_contact_no" placeholder="Enter Contact no">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="td_contact_person">Contact Person</label>
                    <input type="text" class="form-control" id="td_contact_person" placeholder="Enter Contact Person">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group col-md-6">
                    <label for="td_email">Email</label>
                    <input type="text" class="form-control" id="td_email" placeholder="Enter Email">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="td_password">Password</label>
                    <input type="password" class="form-control" id="td_password" placeholder="Enter Password">
                  </div>
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary pull-right btnAddCompany"  name="add_company" id="CompanyFormBtn">Save company</button>
              </div>
            </form>
          </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
      </div>

  </div>
</div>



<div id="SelectCompanyModal" class="modal fade" >
  <div class="modal-dialog">
    
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Select Company</h4>
      </div>
      <div class="modal-body" style="min-height: 300px;text-align: center;margin: 0 auto;">
        <!-- <div class="input-group"> -->
          <!-- <div class="input-group-addon"> -->
            <!-- <i class="fa fa-plus"></i> -->
            <button class="btn btn-primary add_cmp" style="width: 100%;margin-bottom: 5px;">Add new company</button>
          <!-- </div> -->
        <!-- </div> -->
          <select class="coustom-form-control" id="sel_company">
          </select>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div id="ViewTestRecordsModal" class="modal fade" >
  <div class="modal-dialog">
    
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Test Records List</h4>
      </div>
      <div class="modal-body" style="min-height: 300px;text-align: center;margin: 0 auto;">
        <table class="table table-hover ViewTestRecordsTable">
          <thead>
            <tr>
              <th>#</th>
              <th style="width: 30%;text-align: justify;">Test Name</th>
              <th style="width: 10%;"">Price</th>
              <!-- <th style="width: 70%;text-align: justify;">Result</th> -->
              <th style="width: 70%;text-align: justify;">Action</th>
            </tr>
          </thead>
          <tbody>
            
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div id="AddResultsModal" class="modal fade" >
  <div class="modal-dialog">
    
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close ResultModalClose" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Result</h4>
      </div>
      <div class="modal-body" style="">
          <input type="hidden" name="" class="test_id_result">
          <div class="form-group divResult">
            
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default ResultModalClose" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary  SaveResult">Save</button>
      </div>
    </div>
  </div>
</div>





<div id="SelectTestModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Select Tests</h4>
      </div>
      <div class="modal-body" style="min-height: 300px;text-align: center;margin: 0 auto;">
        <select class="" id="sel_test" multiple></select>
        <input type="hidden" name="" id="TestPriceEdit">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div id="UploadPDFModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Upload Files</h4>
      </div>
      <div class="modal-body" style="min-height: 300px;text-align: center;margin: 0 auto;">
        <div class="uploads_no_of_files_div">
          
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div id="SelectsPDFModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Select File</h4>
      </div>
      <div class="modal-body" style="min-height: 300px;text-align: center;margin: 0 auto;">
        <div class="col-md-12">
                  <span class="btn btn-success fileinput-button">
                    <i class="glyphicon glyphicon-plus"></i>
                    <span>Select files...</span>
                    
                    <input id="fileupload" type="file" name="files" multiple>
                  </span>
                  <div id="progress" class="progress" style="margin: 5px 0px 0px 0px;">
                    <div class="progress-bar progress-bar-success"></div>
                  </div>
                  <!-- <div id="price_record_id_files" class="price_record_id_files"></div> -->
                  <input type="hidden" name="" id="price_record_id_files" class="price_record_id_files">
                </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
      get_samples();
        get_company();
        // get_tests();
  //Date picker
    $('.datepicker').datepicker({
      autoclose: false,
      format: 'dd/mm/yyyy',
    });

        $(document).on('show.bs.modal', '.modal', function (event) {
            var zIndex = 1040 + (10 * $('.modal:visible').length);
            $(this).css('z-index', zIndex);
            setTimeout(function() {
                $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
            }, 0);
        });



    $('#dt_orders').DataTable();

     $('#fileupload').fileupload({
          url: WEB_SERVICE_PATH + "service.php?op=ajax_PDF_upload",
          dataType: 'json',
          done: function (e, data) {
              // $.each(data.result.files, function (index, file) {
                  // $('<p/>').text(file.name).appendTo('#files');
              // });
          },
          success: function(data)
          {
            showAlert(data.message)}
          ,progressall: function (e, data) {
              var progress = parseInt(data.loaded / data.total * 100, 10);
              $('#progress .progress-bar').css(
                  'width',
                  progress + '%'
              );
          }
      }).prop('disabled', !$.support.fileInput)
          .parent().addClass($.support.fileInput ? undefined : 'disabled');

        
        $('#sel_test').multiselect({
          'selectAllValue': 'multiselect-all',
          'enableCaseInsensitiveFiltering': true,
          'enableFiltering': true,
          'maxHeight': '260',
          'buttonWidth': '100%',
          onChange: function(element, checked) {
            var TestList = $('#sel_test option:selected');
            var TestIds = [];
            var TestPrices = [];
            var textField = "";
            var test_name = $('#sel_test option:selected').text();
              // $("#sel_test_btn").text(test_name);
              var PriceSum = 0;
              var QtySum = 0;
               $("#sel_test_btn").text(TestList.length+ ' Selected');
            $(TestList).each(function(index, brand){
              var MainValue = $(this).val().split("-");
            
              var textTest  = $(this).text();
              TestIds.push(MainValue[0]);
              TestPrices.push(MainValue[1]);
              t_index = index+1
              QtySum = QtySum+1;
              PriceSum = parseInt(PriceSum)+parseInt(MainValue[1]);
              textField += '<tr>\
                        <td>\
                        <input type="text" name="" class="coustom-form-control data-id="'+t_index+'"  value="'+textTest+'" readonly style="background-color: #eee;min-width: 250px;max-width: 300px;border-radius: 0px;"></td>\
                        <td>\
                        <input type="hidden" name="" class="form-control  PerId_'+t_index+'" data-id="'+t_index+'"  value="'+MainValue[0]+'">\
                        <input type="text" name="" class="form-control PriceCls PerPrice_'+t_index+'" data-id="'+t_index+'"  value="'+MainValue[1]+'"  style="width: 60px;"></td>\
                        <td>\
                          <div class="input-group" style="width: 80px;">\
                            <span class="input-group-addon"><i class="fa fa-times"></i></span>\
                            <input type="text" class="form-control QtyCls PerQty_'+t_index+'" data-id="'+t_index+'" value="1">\
                          </div>\
                        </td>\
                        <td>\
                          <div class="input-group"  style="width: 100px;">\
                            <span class="input-group-addon"><i class="fa fa-exchange"></i></span>\
                            <input type="text" class="form-control TotalCls PerTotal_'+t_index+'" data-id="'+t_index+'" value="'+MainValue[1]+'" readonly>\
                          </div>\
                        </td>\
                        <td>\
                            <input type="hidden" class="form-control ResultCls PerResult_'+t_index+'" data-id="'+t_index+'">\
                        </td>\
                        \
                      </tr>';//check
            });
            // <td>\
            //                 <i class="fa fa-times AddResult_'+t_index+'"" id="AddResult" data-id="'+t_index+'" aria-hidden="true" style="font-size: 22px;cursor: pointer;"></i>\
            //             </td>\
            // showAlert(PriceSum);

            textField += '<tr>\
            <td>\
               <input type="text" name="" class="form-control" readonly value="Total">\
            </td><td>\
                <input type="text" name="" class="form-control"  readonly  style="width: 60px;">\
            </td>\
            <td>\
                <input type="text" name="" class="form-control TotalSumQty" value="'+QtySum+'"  style="width: 80px;" readonly>\
            </td>\
            <td>\
               <input type="text" name="" class="form-control TotalSumPrice" value="'+PriceSum+'"   style="width: 100px;" readonly>\
            </td>\
            </tr>';
            // <td>\
            //    <input type="text" name="" class="form-control" readonly>\
            // </td>\
            $(".priceCalculation").html(textField);
          }
        }); 

        $(document).on("keyup", ".PriceCls,.QtyCls", function() {
      var sum = 0;
      $(".TotalCls").each(function(){
          sum += +$(this).val();
      });
      $(".TotalSumPrice").val(sum);
      var sumQty = 0;
      $(".QtyCls").each(function(){
          sumQty += +$(this).val();
      });
      $(".TotalSumQty").val(sumQty);
            // showAlert(sum);
});
            // var sum = 0;
            // $(".TotalCls").each(function(){
            //   sum += +$(this).val();
            // });
            // $(".total").val(sum);



        $("#frm_order_details").delegate(".QtyCls,.PriceCls", "keyup", function(){
        tbId = $(this).attr("data-id");
        Price = $(".PerPrice_"+tbId).val();
        Qty = $(".PerQty_"+tbId).val();
        // showAlert($(".QtyCls").val())

        TotalCalculation = Price*Qty;
        $(".PerTotal_"+tbId).val(TotalCalculation);

        });



        $("#sel_company").multiselect({
        "maxHeight": 230,
        "minWidth": 315,
        "nonSelectedText" : "No Company Selected",
        
        "enableFiltering":true,
        "buttonWidth": '100%',
        // buttonWidth: '235',
          onChange: function(element, checked) {
            var company_id = $('#sel_company option:selected').val();
            var company_name = $('#sel_company option:selected').text();
            // showAlert(company_name);
              $("#sel_cmp_btn").text(company_name);
              $(".priceCalculation").html("");
              $("#SelectCompanyModal").modal("hide");
              // $("#thebutton span").text("My NEW Text");
              get_tests(null,company_id);
          }
        }); 
        
  });
    function get_company(response){
    if (response && response.success > 0) {
        $CompanyList = [];
        if(response.data) {
            CompanyList = [];
            companySelector = "";
            for(i=0;i<response.data.length;i++){
                obj = response.data[i];
                companySelector += "<option value='" + obj.company_id + "'>" + obj.name + "</option>";
                CompanyList.push({id:obj.company_id , text:obj.name});
            }
        }

        $("#sel_company").html("<option value=''>Select Company</option>" + companySelector);
        // $("#sel_company").html("<option value=''>Select Company</option>" + companySelector);
        $("#sel_company").multiselect("rebuild");

    }
    else if (response && response.success <= 0) {

        return false;
    }
    else if (!response) {

        var data = {
            "op": "get_company"
        };
        doServiceCall(data, get_company ,false);
    }
}

     /*========================================== : DATABASE OPERATION : =========================================*/

////////////////////////// ALL BUTTONS CLICK EVENT LIST
    // $("#btnAddsample").on("click",function(){
    //   add_samples();
    // });

    $("#frm_company").delegate(".btnAddCompany", "click", function(){
      add_companies();
    });

    $("#SelectCompanyModal").delegate(".add_cmp", "click", function(){
      $("#td_comapny_name").val("");
      $("#td_address").val("");
      $("#td_contact_no").val("");
      $("#td_email").val("");
      $("#td_contact_person").val("");
      $("#td_password").val("");
      $("#addCompanyModal").modal("show");
    });
    $("#frm_order_details").delegate("#BtnCancel", "click", function(){
        clear_data();
    });

    $("#frm_order_details").delegate(".btnAddOrder", "click", function(){
        add_samples();
    });
    $("#frm_order_details").delegate(".btnEditOrder", "click", function(){
        update_sample();
    });
    $("#frm_order_details").delegate("#sel_cmp_btn", "click", function(){
        $("#SelectCompanyModal").modal("show");
    });
    $("#frm_order_details").delegate("#sel_test_btn", "click", function(){
        $("#SelectTestModal").modal("show");
    });
    $("#frm_order_details").delegate("#sel_test_btn", "click", function(){
        $("#SelectTestModal").modal("show");
    });
    // $(".priceCalculation").delegate("#AddResult", "click", function(){
    //   $("#AddResultsModal").modal("show");
    //   var test_id_result =  $(this).attr("data-id");
    //   $(".test_id_result").val(test_id_result);
    //   $(".testID").removeClass("result_text");
    //   $(".testID").addClass("result_text_"+test_id_result);

    //   $(".result_text_"+test_id_result).val($(".PerResult_"+test_id_result).val());
      
    // });
    // $("#AddResultsModal").delegate(".ResultModalClose", "click", function(){
    //   $("#AddResultsModal").modal("hide");
    //   var test_id_result =  $(".test_id_result").val();
    //   $(".testID").addClass("result_text");
    //   $(".testID").removeClass("result_text_"+test_id_result);
      
    // });
    
    // $("#AddResultsModal").delegate(".SaveResult", "click", function(){
    //   $("#AddResultsModal").modal("hide");
    //   var test_id_result =  $(".test_id_result").val();
    //   var result_text =  $(".result_text_"+test_id_result).val();
    //   result_text_length = $.trim(result_text).length;
    //   if(result_text_length != '0')
    //   {
    //     $(".AddResult_"+test_id_result).removeClass("fa-times");
    //     $(".AddResult_"+test_id_result).addClass("fa-check");
    //   }
    //   else
    //   {
    //     $(".AddResult_"+test_id_result).addClass("fa-times");
    //     $(".AddResult_"+test_id_result).removeClass("fa-check"); 
    //   }
      
    //   $(".PerResult_"+test_id_result).val($(".result_text_"+test_id_result).val());
    // });
    
    $(".ViewTestRecordsTable").delegate("#AddResult", "click", function(){
      $("#AddResultsModal").modal("show");
      var test_id_result =  $(this).attr("data-id");
      $(".test_id_result").val(test_id_result);
      $(".AddResult_"+test_id_result).val(test_id_result);
      $(".testID").removeClass("result_text");
      $(".testID").addClass("result_text_"+test_id_result);
      
      // $(".TimeBtn").addClass("TimesBtn_"+test_id_result);
      // $(".result_text_"+test_id_result).val($(".PerResult_"+test_id_result).val());
      
    });
      $("#AddResultsModal").delegate(".SaveResult", "click", function(){
      // $("#AddResultsModal").modal("hide");
      // var test_id_result =  $(".test_id_result").val();
      // var result_text =  $(".result_text_"+test_id_result).val();
    // showAlert(result_text);
    add_test_results();
    });

////////////////////////// ALL BUTTONS CLICK EVENT LIST
var CurrentRow = [];
////////////////////////// GET SAMPLE LIST
        function get_samples(data,user_type){        
                 var t = $('.dt_users').DataTable( {
          "iDisplayLength": 10,
            "pagingType": "full_numbers",
            "bProcessing": true,
            "bServerSide": false,
            "aoColumnDefs": [{
                // "bSortable": true,
                "aTargets": ["sorting_disabled"],
                "bVisible": true,
                "orderable": false,
                //"aTargets": [0,1,5]  
            }],
            
            "aLengthMenu": [[5,10, 25, 50, 100, -1], [5,10, 25, 50, 100, "All"]],
            "bFilter" : true,               
            "bLengthChange": true,
            "bInfo": true,
            "bDestroy": true,
            "bProcessing": true,
            "serverSide": true,
            "bSortable": true,

          "ajax":{
                url :"<?php echo WEB_SERVICE_PATH;?>service.php",
                type: "post",
                data:  {"op": "get_samples"},
                dataSrc: function ( res ) {
                CurrentRow = res.data;
                return res.data;
                },  
                error: function(){  
                    $(".dt_users").css("display","none");
                }
            },
          "columnDefs": [ {
            "searchable": false,
            "orderable": false,
            "targets": 0
          } ],
          "columns": [
                { "data": null }
                ,{ "data": "sample_received_on" }
                // ,{ "data": "sample_no" }
                ,{"mRender": function ( data, type, row, meta ) {
                        return "\
            <a style='cursor: pointer' onclick='print_sample("+row.sample_id+")'>"+row.sample_no+"</a>";}
                }
                ,{ "data": "company_name" }
                ,{ "data": "party_reference_no" }
                ,{ "data": "name_of_sample" }
                ,{ "data": "batch_no" }
                // ,{"mRender": function ( data, type, row, meta ) {
                //   var ListArr = row.test_name_list.split(',');
                //   ListText = row.test_name_list;
                //   if(ListArr.length > 1)
                //   {
                //     var ListText = "<ul style='margin: 0px -40px;list-style-type: none;'>";
                //     $(ListArr).each(function(index, test){
                //       ListText += "<li style='margin-bottom: -5px;'>"+test+"</li>";
                //     });
                //     ListText += "</ul>";
                //   }
                //   var test_name_list =  row.test_name_list;
                //         return ListText;}
                // }
                ,{ "data": "certificate_no" }
                ,{ "data": "certificate_date" }
                ,{"mRender": function ( data, type, row, meta ) {
                    var btn =  "<button type='button' class='btn btn-danger' >Pending</button>";
                    if(row.remark == 1)
                    {
                      btn =  "<button type='button' class='btn btn-success' >Completed</button>";
                    }
                        return btn; }
                  }
                ,{"mRender": function ( data, type, row, meta ) {
                        return "\
            <div style='    display: inline-flex;'>\
            <button type='button' class='btn btn-default' onclick='upload_pdfs("+meta.row+")' style='margin: 0px 5px 0px 5px;'><i class='fa fa-upload'></i></button>\
            <button type='button' class='btn btn-success'  onclick='view_test_record("+meta.row+")' style='margin: 0px 5px 0px 5px;'><i class='fa fa-eye'></i></button>\
            <button type='button' class='btn btn-info'  onclick='edit_row("+meta.row+")' style='margin: 0px 5px 0px 5px;'><i class='fa fa-edit'></i></button>\
            <button type='button' class='btn btn-danger'onclick='delete_order(null,"+row.sample_id+")' style='margin: 0px 5px 0px 5px;'><i class='fa fa-trash' width: 14px;></i></button>\
            <button type='button' class='btn btn-warning' onclick='print_sample("+row.sample_id+")' style='margin: 0px 5px 0px 5px;'><i class='fa fa-print'></i></button>\
            </div>";}
                }
                ],
          "order": [[ 0, 'desc' ]]
        } );
          

         t.on( 'order.dt search.dt', function () {
          t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            // console.log(CurrentRow.length);
            cell.innerHTML = i+1;
          } );
        } ).draw();

    }

////////////////////////// PRINT SAMPLE DATA
    function print_sample(sample_id)
    {
          
          setTimeout(function(){ get_samples(); }, 3000);
         window.open('web_services/print_sample.php?sample='+sample_id+'');
    }

////////////////////////// UPLOAD PDF FILES
      function upload_pdfs(row_index) {
        data = CurrentRow[row_index];
        
        $("#UploadPDFModal").modal("show");
        var uploads_no_of_files = "";
        $(data.test_price_list).each(function(index, index_data){
          // console.log(index_data);
          var price_record_id = index_data.price_record_id;
                
          uploads_no_of_files += '<button class="btn btn-primary SelectPDFBtn" onclick="select_PDF_file('+index_data.price_record_id+')">+</button>';
        // console.log(uploads_no_of_files);
        });
        $(".uploads_no_of_files_div").html(uploads_no_of_files);
    }
    function select_PDF_file(price_record_id) {
      // $("#price_record_id_files").removeClass("price_record_id_files_"+price_record_id);
      //     $("#price_record_id_files").addClass("price_record_id_files_"+price_record_id);
      $("#price_record_id_files").val(price_record_id);
        $("#SelectsPDFModal").modal("show");
        
    }
////////////////////////// CLEAR SAMPLE FORM DATA
    function clear_data()
      {
          $("#td_order_type").val("1");
          $("#td_order_from").val("");
          // $("#td_certificate_date").val("");
          // $("#sel_company").val("");
          $('#sel_company option:selected').each(function() {
            $(this).prop('selected', false);
          });
          $('#sel_company').multiselect('refresh');
          $("#td_party_reference_no").val("");
          $("#td_name_of_sample").val("");
          $("#td_sample_qty").val("");
          $("#td_batch_no").val("");
          // $("#sel_test").val("");
          $('#sel_test option:selected').each(function() {
            $(this).prop('selected', false);
          })
          $('#sel_test').multiselect('refresh');
          $("#td_order_price").val("");
          $("#td_payment_type").val("1");
          // $("#td_sample_received_on").val("");
          $(".priceCalculation").html("");
          $("#sel_test_btn").text('Select Test');
          $("#sel_cmp_btn").text('Select Company');
        }




////////////////////////// ADD SAMPLE
      function add_samples(data) {
  if (data && data != null && data.success == true) {
   var sample_data = data.data;
         // $('.NavClick').trigger('click');
         $("#addsampleModel").modal('hide');
         clear_data();
         get_samples();
         showAlert(data.message);
         $(".priceCalculation").html("");
         return true;
       }
       else if (data && data != null && data.success == false) {
        showError(data.message);
        return false;
      }
      else if (!data) {
        temp = [];
        $('#sel_test :selected').each(function (i, selected) {
          var MainValue = $(selected).val().split("-");
          temp.push(MainValue[0]);
        });
        var test_list = temp.join();

        PriceData = [];
        $('.PriceCls').each(function (j) {
          index =  j+1;
          PerId = $(".PerId_"+index).val();
          PerPrice   = $(".PerPrice_"+index).val();
          PerQty    = $(".PerQty_"+index).val();
          PerTotal  = $(".PerTotal_"+index).val();
          PerResult  = $(".PerResult_"+index).val();
          PriceData.push(PerId+'-'+PerPrice+'-'+PerQty+'-'+PerTotal+'-'+PerResult);
        });
        var PriceDataList = PriceData.join();
        // console.log(PriceDataList);
        var data = {
          op: "add_samples"
          ,'admin_id' : $("#admin_id").val()
          ,'sample_received_on' :   $("#td_sample_received_on").val()
          ,'order_type'         :   $("#td_order_type").val()
          ,'company_id'         :   $("#sel_company").val()
          ,'party_reference_no' :   $("#td_party_reference_no").val()
          ,'name_of_sample'     :   $("#td_name_of_sample").val()
          ,'sample_qty'         :   $("#td_sample_qty").val()
          ,'batch_no'           :   $("#td_batch_no").val()
          ,'test_id'            :   test_list
          ,'certificate_no'     :   $("#td_certificate_no").val()
          ,'certificate_date'   :   $("#td_certificate_date").val()
          ,'order_price'        :   $("#td_order_price").val()
          ,'order_price_data'   :   PriceDataList
          ,'payment_type'       :   $("#td_payment_type").val()
          ,'total_sum_qty'          :   $(".TotalSumQty").val()
          ,'total_sum_price'        :   $(".TotalSumPrice").val()
        };
        doServiceCall(data, add_samples)
      }
      return false;           
    }
    
////////////////////////// SET EDIT SAMPLE DATA ON FORM
      function edit_row(row_index) {
        $("#OrderFormBtn").removeClass("btnAddOrder");
        $("#OrderFormBtn").addClass("btnEditOrder");
        data = CurrentRow[row_index];
        var textField = [];
        for(i=0;i<data.test_price_list.length;i++){
            obj = data.test_price_list[i];
            t_index = i+1;
            textField += '<tr>\
                        <td>\
                        <input type="text" name="" class="form-control data-id="'+t_index+'"  value="'+obj.test_name+'" readonly></td>\
                        <td>\
                        <input type="hidden" name="" class="form-control  PerId_'+t_index+'" data-id="'+t_index+'"  value="'+obj.test_id+'">\
                        <input type="text" name="" class="form-control PriceCls PerPrice_'+t_index+'" data-id="'+t_index+'"  value="'+obj.test_price+'"  style="width: 60px;"></td>\
                        <td>\
                          <div class="input-group" style="width: 80px;">\
                            <span class="input-group-addon"><i class="fa fa-times"></i></span>\
                            <input type="text" class="form-control QtyCls PerQty_'+t_index+'" data-id="'+t_index+'" value="'+obj.test_qty+'">\
                          </div>\
                        </td>\
                        <td>\
                          <div class="input-group"  style="width: 100px;">\
                            <span class="input-group-addon"><i class="fa fa-exchange"></i></span>\
                            <input type="text" class="form-control TotalCls PerTotal_'+t_index+'" data-id="'+t_index+'" value="'+obj.test_total_price+'" readonly>\
                          </div>\
                        </td>\
                        <td>\
                            <input type="text" class="form-control ResultCls PerResult_'+t_index+'" data-id="'+t_index+'"value="'+obj.result+'">\
                        </td>\
                      </tr>';
            
          }            
          textField += '<tr>\
            <td>\
               <input type="text" name="" class="form-control" readonly value="Total">\
            </td><td>\
                <input type="text" name="" class="form-control"  readonly  style="width: 60px;">\
            </td>\
            <td>\
                <input type="text" name="" class="form-control TotalSumQty" value="'+data.total_sum_qty+'"  style="width: 80px;" readonly>\
            </td>\
            <td>\
               <input type="text" name="" class="form-control TotalSumPrice" value="'+data.total_sum_price+'"   style="width: 100px;" readonly>\
            </td>\
            <td>\
               <input type="text" name="" class="form-control" readonly>\
            </td>\
            </tr>';
            $(".priceCalculation").html(textField);
        $("#TestPriceEdit").val(data.order_price_data);
        $(".priceCalculation").html(textField);
        $("#td_sample_id").val(data.sample_id);
        $("#td_certificate_no").val(data.certificate_no);
        $("#td_order_type").val(data.order_type);
        $("#td_certificate_date").val(data.certificate_date);
        $("#td_order_to").val(data.order_to);
        $("#up_company_id").val(data.company_id);
        $("#td_party_reference_no").val(data.party_reference_no);
        $("#td_name_of_sample").val(data.name_of_sample);
        $("#td_sample_qty").val(data.sample_qty);
        $("#td_batch_no").val(data.batch_no);
        $("#up_test_id").val(data.test_id);
        $("#td_order_price").val(data.order_price);
        $("#td_payment_type").val(data.payment_type);
        $("#td_sample_received_on").val(data.sample_received_on);
      }


      ////////////////////////// SET EDIT SAMPLE DATA ON FORM
      var CurrentResult = [];
      function view_test_record(row_index) {
        data = CurrentRow[row_index];
        
        $("#ViewTestRecordsModal").modal("show");
        var textField = [];
        CurrentResult = data.test_price_list;
        for(i=0;i<data.test_price_list.length;i++){
            obj = data.test_price_list[i];
            t_index = i+1;
            if(obj.result != '')
            {
                var RslBtn = '<button class="btn btn-success btnTimeBtn_'+obj.price_record_id+'" data-id='+obj.price_record_id+' onclick="showResult('+i+')"><i class="fa fa-check TimeBtn TimeBtn_'+obj.price_record_id+'"></i>';
            }
            else
            {
              var RslBtn = '<button class="btn btn-danger btnTimeBtn_'+obj.price_record_id+'" data-id='+obj.price_record_id+' onclick="showResult('+i+')"><i class="fa fa-times TimeBtn TimeBtn_'+obj.price_record_id+'"></i>';
            }
            
            textField += '<tr>\
              <th scope="row">'+t_index+'</th>\
              <td>'+obj.test_name+'</td>\
              <td>'+obj.test_total_price+'</td>\
              <td>'+RslBtn+'</td>\
            </tr>';
            
          }            
              // <td>'+obj.result+'</td>\
          $(".ViewTestRecordsTable tbody").html(textField);
      }


      function showResult(row_index) {
        var data = CurrentResult[row_index];
        $(".test_id_result").val(data.price_record_id);
        $(".divResult").html('<label for="result_text">Result:</label>\
            <textarea class="form-control result_text testID" value="" rows="5" id="">'+data.result+'</textarea>');
        
        $("#AddResultsModal").modal("show");
      }

////////////////////////// UPDATE SAMPLE
      function update_sample(data) {

        if (data && data != null && data.success == true) {
          get_samples();
          clear_data();
          $("#OrderFormBtn").removeClass("btnEditOrder");
          $("#OrderFormBtn").addClass("btnAddOrder");
          showAlert(data.message);
          $(".priceCalculation").html("");
          return true;
        }
        else if (data && data != null && data.success == false) {
          showError(data.message);
          return false;
        }
        else if (!data) {
          temp = [];
          $('#sel_test :selected').each(function (i, selected) {
            var MainValue = $(selected).val().split("-");
            temp.push(MainValue[0]);
          });
          var test_list = temp.join();
          if(test_list != $("#up_test_id").val())
          {
            test_list = $("#up_test_id").val();
          }
          var company_id = $("#sel_company").val();
          if(company_id != $("#up_company_id").val())
          {
            company_id = $("#up_company_id").val();
          }

        PriceData = [];
        $('.PriceCls').each(function (j) {
          index =  j+1;
          PerId = $(".PerId_"+index).val();
          PerPrice   = $(".PerPrice_"+index).val();
          PerQty    = $(".PerQty_"+index).val();
          PerTotal  = $(".PerTotal_"+index).val();
          PerResult  = $(".PerResult_"+index).val();
          PriceData.push(PerId+'-'+PerPrice+'-'+PerQty+'-'+PerTotal+'-'+PerResult);
        });
        var PriceDataList = PriceData.join();
        console.log(PriceDataList);

          var data = {
            op: "update_sample"
            ,'sample_id'          :   $("#td_sample_id").val()
            ,'sample_received_on' :   $("#td_sample_received_on").val()
            ,'order_type'         :   $("#td_order_type").val()
            ,'company_id'         :   company_id
            ,'party_reference_no' :   $("#td_party_reference_no").val()
            ,'name_of_sample'     :   $("#td_name_of_sample").val()
            ,'sample_qty'         :   $("#td_sample_qty").val()
            ,'batch_no'           :   $("#td_batch_no").val()
            ,'test_id'            :   test_list
            ,'certificate_no'     :   $("#td_certificate_no").val()
            ,'certificate_date'   :   $("#td_certificate_date").val()
            ,'order_price'        :   $("#td_order_price").val()
            ,'order_price_data'   :   PriceDataList
            ,'payment_type'       :   $("#td_payment_type").val()
            ,'total_sum_qty'          :   $(".TotalSumQty").val()
            ,'total_sum_price'        :   $(".TotalSumPrice").val()
          };
          doServiceCall(data, update_sample)
        }
        return false;           
      }
    


////////////////////////// DELETE SAMPLE
      function delete_order(data,sample_id){

        if (data && data != null && data.success == true) {
          clear_data();
          $("#OrderFormBtn").removeClass("btnEditOrder");
          $("#OrderFormBtn").addClass("btnAddOrder");
          get_samples();
          return true;
        }
        else if (data && data != null && data.success == false) {
          showError(data.message);
          return false;
        }
        else if (!data) {
          var sample_id = sample_id;
          if(confirm("Are you sure you want to delete sample ?") == true)
          {
            var data = {
              op: "delete_sample"
              ,'sample_id'   : sample_id
            };
          }

          doServiceCall(data, delete_order)
        }
        return false;           
      }


      ////////////////////////// ADD TEST RESULT
      function add_test_results(data){

        if (data && data != null && data.success == true) {
          var data = data.data ;
          $(".TimeBtn_"+data.price_record_id).removeClass("fa-times");
          $(".TimeBtn_"+data.price_record_id).addClass("fa-check");
          $(".btnTimeBtn_"+data.price_record_id).removeClass("btn-danger");
          $(".btnTimeBtn_"+data.price_record_id).addClass("btn-success");
          // $(".testID").removeClass("result_text_"+data.price_record_id);
          
          get_samples();
          $("#AddResultsModal").modal("hide");
          return true;
        }
        else if (data && data != null && data.success == false) {
          $(".TimeBtn_"+data.price_record_id).addClass("fa-times");
          $(".TimeBtn_"+data.price_record_id).removeClass("fa-check");
          $(".btnTimeBtn_"+data.price_record_id).addClass("btn-danger");
          $(".btnTimeBtn_"+data.price_record_id).removeClass("btn-success");
          $("#AddResultsModal").modal("hide");
          // showError(data.message);
          return false;
        }
        else if (!data) {
          var data = {
              op: "add_test_results"
              ,'price_record_id'  : $(".test_id_result").val()
              ,'result'           : $(".result_text").val()
            };
          doServiceCall(data, add_test_results)
        }
        return false;           
      }
    

////////////////////////// ADD NEW COMPANY AT A TIME
      function add_companies(data) {
        if (data && data != null && data.success == true) {
         $("#addCompanyModal").modal("hide");
         get_company();
         return true;
       }
       else if (data && data != null && data.success == false) {
        showError(data.message);
        return false;
      }
      else if (!data) {
        var data = {
          op: "add_companies"
          ,'name'       :   $("#td_comapny_name").val()
          ,'address'    :   $("#td_address").val()
          ,'contact_no' :   $("#td_contact_no").val()
          ,'email'      :   $("#td_email").val()
          ,'contact_person'   :   $("#td_contact_person").val()
          ,'password'         :   $("#td_password").val()

        };
        doServiceCall(data, add_companies)
      }
      return false;           
    }

////////////////////////// GET TEST LIST
    function get_tests(response,company_id){
      if (response && response.success > 0) {
        $CompanyList = [];
        if(response.data) {
          CompanyList = [];
          companySelector = "";
          for(i=0;i<response.data.length;i++){
            obj = response.data[i];
            companySelector += "<option data-id='"+obj.test_price+"' value='" + obj.test_id + "-" + obj.test_price + "'>" + obj.test_name + "</option>";
            CompanyList.push({id:obj.test_id , text:obj.test_name});
          }
        }

        $("#sel_test").html(companySelector);
            $("#sel_test").multiselect("rebuild");

          }
          else if (response && response.success <= 0) {

            return false;
          }
          else if (!response) {

            var data = {
              "op": "get_tests"
              ,"company_id" : company_id
            };
            doServiceCall(data, get_tests ,false);
          }
        }
</script>

<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
<script src="js/jquery.ui.widget.js"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="js/jquery.iframe-transport.js"></script>
<!-- The basic File Upload plugin -->
<script src="js/jquery.fileupload.js"></script>
<!-- Bootstrap JS is not required, but included for the responsive demo navigation -->


<?php
include 'footer.php';
?>