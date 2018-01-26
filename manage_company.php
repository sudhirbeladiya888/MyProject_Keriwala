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
         Company 
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"> Company </li>
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
              <h3 class="box-title">Add New Company </h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
              </div>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" id="frm_company" name="frm_company" class="validate_form" method="POST" onsubmit="return false">
              <input type="hidden" class="form-control" id="td_comapny_id">
              <div class="box-body">
                <div class="col-md-4">
                  <div class="form-group col-md-6">
                    <label for="td_comapny_name">Comapny Name</label>
                    <input type="text" class="form-control" id="td_comapny_name" placeholder="Enter Comapny name">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="td_address">Address</label>
                    <input type="text" class="form-control" id="td_address" placeholder="Enter address">
                  </div>
                </div>
                 <div class="col-md-4">
                  <div class="form-group col-md-6">
                    <label for="td_contact_no">Contact No</label>
                    <input type="text" class="form-control" id="td_contact_no" placeholder="Enter Contact no">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="td_contact_person">Contact Person</label>
                    <input type="text" class="form-control" id="td_contact_person" placeholder="Enter Contact Person">
                  </div>
                </div>
                <div class="col-md-4">
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
          <!-- /.box -->
          <div class="box  box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Company List</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover " >
                 <thead>
                  <th>ID</th>
                  <th>Company Name</th>
                  <th>Address</th>
                  <th>Contact No</th>
                  <th>Email</th>
                  <th>Action</th>
                </thead>
                <tbody id="tbl_company_body"></tbody>
                
              </table>
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


<script type="text/javascript">
    $(document).ready(function() {
      get_company();
  //Date picker
    $('.datepicker').datepicker({
      autoclose: true
    });

    $('#dt_orders').DataTable();

        
            /*------Dropzone-----------*/

            
    });

     /*========================================== : DATABASE OPERATION : =========================================*/

    /*GET samples*/
    var CurrntRow = [];
    function get_company(data){        
        if (data && data != null && data.success == true) {
            $("#tbl_company_body").html('');
            var dictionary = data.data;
            var row_index = -1;
            CurrntRow = dictionary;
            for(var i in dictionary) {
                row_index = (parseInt(i));
                $("#tbl_company_body").append("\
                  <tr>\
                        <td>"+(parseInt(i)+1)+"</td>\
                        <td>"+dictionary[i].name+"</td>\
                        <td>"+dictionary[i].address+"</td>\
                        <td>"+dictionary[i].contact_no+"</td>\
                        <td>"+dictionary[i].email+"</td>\
                        <td>\
                          <div class='btn-group'>\
                              <button type='button' class='btn btn-info edit_btn' onclick='edit_row("+row_index+")'><i class='fa fa-edit'></i></button>\
                              <button type='button' class='btn btn-danger del_btn' onclick='delete_company(null,"+dictionary[i].company_id+")'><i class='fa fa-trash'></i></button>\
                          </div>\
                        </td>\
                        </tr>\
                  ");
             // <button type='button' class='btn btn-warning'><i class='fa fa-print'></i></button>\
            }
            
            return true;
        }
        else if (data && data != null && data.success == false) {
            // alert(data.message);
                $("#tbl_company_body").html("");
                $("#tbl_company_body").append("<tr><td colspan='15'><h3 align='center'>"+data.message+"</h3></td>");

            return false;
        }
        else if (!data) {        
            var data = {
                op: "get_company"
            };
            doServiceCall(data, get_company)
        }
        return false;
    }
     /*End GET samples*/
     function edit_row(row_index) {
        $("#CompanyFormBtn").removeClass("btnAddCompany");
        $("#CompanyFormBtn").addClass("btnEditCompany");

        data = CurrntRow[row_index];
        $("#td_comapny_id").val(data.company_id);
        $("#td_comapny_name").val(data.name);
        $("#td_address").val(data.address);
        $("#td_contact_no").val(data.contact_no);
        $("#td_email").val(data.email);
        $("#td_contact_person").val(data.contact_person);
        $("#td_password").val('');
     }

    function print_sample(sample_id)
    {
         window.open('../web_services/print_sample.php?sample='+sample_id+',no');
    }
    
    /* ===== clear sample data===== */

    function clear_data()
    {
      $("#td_comapny_name").val("");
      $("#td_address").val("");
      $("#td_contact_no").val("");
      $("#td_email").val("");
      $("#td_contact_person").val("");
      $("#td_password").val("");
    }

    /* ===== clear sample data===== */


    /* ===== Add sample ===== */
    $("#frm_company").delegate(".btnAddCompany", "click", function(){
        add_companies();
    });
    $("#frm_company").delegate(".btnEditCompany", "click", function(){
        update_company();
    }); 

        function add_companies(data) {
            if (data && data != null && data.success == true) {
             var sample_data = data.data;
             clear_data();
             get_company();
             return true;
         }
         else if (data && data != null && data.success == false) {
            alert(data.message);
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
    /* End Add sample */


    /* ===== Edit sample  ===== */
    function edit_sample(sample_id,t)
        {
            
            $('#up_sample_id').val($(t).parents().find('.sampleId_'+sample_id).val());
            $('#up_sample_size').val($(t).parents().find('.sampleSize_'+sample_id).html());
            $('#up_sample_price').val($(t).parents().find('.samplePrice_'+sample_id).html());
            $('#up_sample_description').val($(t).parents().find('.sampleDescription_'+sample_id).html());
            var samplePhotoUrl =  $(t).parents().find('.samplePhoto_'+sample_id).attr("src");
            $('#up_sample_photo').attr("src", samplePhotoUrl);
            $("#updatesampleModel").modal('show');
        }
    /* =====end Edit sample  ===== */

    /* ===== Update sample ===== */
    function update_company(data) {

    if (data && data != null && data.success == true) {
            $("#CompanyFormBtn").removeClass("btnEditCompany");
            $("#CompanyFormBtn").addClass("btnAddCompany");
            clear_data();
            get_company();
        return true;
       }
    else if (data && data != null && data.success == false) {
        clear_data();
        alert(data.message);
        return false;
    }
    else if (!data) {
        var up_sample_photo = $("#up_sample_photo_url").val();                
        if (up_sample_photo == "")
        {
            up_sample_photo = $("#up_sample_photo").attr("src");
        }

        var data = {
            op: "update_company"
            ,'company_id' :     $("#td_comapny_id").val()
            ,'name'       :     $("#td_comapny_name").val()
            ,'address'    :     $("#td_address").val()
            ,'contact_no' :     $("#td_contact_no").val()
            ,'email'      :     $("#td_email").val()
            ,'contact_person' : $("#td_contact_person").val()
            ,'password' :       $("#td_password").val()
        };


        doServiceCall(data, update_company)
    }
    return false;           
}
    /* End Update sample */


    /* ===== Delete sample ===== */
     function delete_company(data,company_id){
        
            if (data && data != null && data.success == true) {
              $("#CompanyFormBtn").removeClass("btnEditCompany");
              $("#CompanyFormBtn").addClass("btnAddCompany");
              clear_data();
              get_company();
               return true;
           }
           else if (data && data != null && data.success == false) {
                alert(data.message);
                return false;
                }
            else if (!data) {
                if(confirm("Are you sure you want to delete company ?") == true)
                {
                    var data = {
                        op: "delete_company"
                        ,'company_id'   : company_id
                    };
                }

                doServiceCall(data, delete_company)
            }
            return false;           
        }
    /* End Delete sample */
</script>
<script src="js/dropzone.js"></script>



<?php
include 'footer.php';
?>