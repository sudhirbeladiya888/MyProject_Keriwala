<?php
 require 'header.php';
 require 'sidebar.php';
?>

<link rel="stylesheet" href="css/dropzone.css">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         Comparison 
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"> Comparison </li>
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
                <h3 class="box-title">Comparison List</h3>
                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                  <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
                </div>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              <div class="box-body table-responsive no-padding cmplist">
                <div class="form-group col-md-6">
                    <label for="sel_company" class="tb_lable">Company List</label>
                    <select class="form-control" id="sel_company">
                  </select>
                  </div>
                <table class="table table-hover " >
                   <thead>
                    <th>ID</th>
                    <th>Test Name</th>
                    <th>Price</th>
                    <th>Date</th>
                  </thead>
                  <tbody id="tbl_sample_body"></tbody>
                </table>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>
      </div>
      <!-- /.row -->


    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


<script type="text/javascript">
  $(document).ready(function() {
    get_samples(null,null);
    //Date picker
    $('.datepicker').datepicker({
      autoclose: true
    });

    $('#dt_orders').DataTable();
    get_company();
  });

     /*========================================== : DATABASE OPERATION : =========================================*/

    /*GET samples*/
    var CurrntRow = [];
   /*GET samples*/
    function get_samples(data,company_id){        
        if (data && data != null && data.success == true) {
            $("#tbl_sample_body").html('');
            var dictionary = data.data;
            var row_index = -1;
            CurrntRow = dictionary;
            var new_certificat = dictionary.length + 1;
            $("#td_certificate_no").val('COA-080-'+ new_certificat).attr("readonly","readonly");
            for(var i in dictionary) {
              row_index = (parseInt(i));
                $("#tbl_sample_body").append("\
                  <tr>\
                        <td>"+(parseInt(i)+1)+"</td>\
                        <td>"+dictionary[i].test_name_list+"</td>\
                        <td>"+dictionary[i].order_price+"</td>\
                        <td>"+dictionary[i].sample_received_on+"</td>\
                        </tr>\
                  ");
             
            }
            
            return true;
        }
        else if (data && data != null && data.success == false) {
            // alert(data.message);
                $("#tbl_sample_body").html("");
                $("#tbl_sample_body").append("<tr><td colspan='15'><h3 align='center'>"+data.message+"</h3></td>");
                $("#td_certificate_no").val('COA-080-1').attr("readonly","readonly");
            return false;
        }
        else if (!data) {        
            var data = {
                op: "get_samples"
                ,'company_id' : company_id
            };
            doServiceCall(data, get_samples)
        }
        return false;
    }
     /*End GET samples*/
     
    $(".cmplist").delegate("#sel_company", "change", function(){
        // add_tests();
        // alert($(this).val());
        get_samples(null,$(this).val());
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

        $("#sel_company").html(companySelector);
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

</script>

<?php
include 'footer.php';
?>