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
         Test 
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"> Test </li>
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
              <h3 class="box-title">Add New Test </h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
              </div>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" id="frm_test" name="frm_test" class="validate_form" method="POST" onsubmit="return false">
              <input type="hidden" class="form-control" id="td_test_id">
              <div class="box-body">
                <div class="col-md-6">
                  <div class="form-group col-md-6 col-sm-6 col-xs-6">
                    <label for="td_test_name">Test Name</label>
                    <input type="text" class="form-control" id="td_test_name" placeholder="Enter Test name">
                  </div>
                  <div class="form-group col-md-6 col-sm-6 col-xs-6">
                    <label for="td_test_price">Price</label>
                    <input type="text" class="form-control" id="td_test_price" placeholder="Enter price">
                  </div>
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary pull-right btnAddTest"  name="add_test" id="TestFormBtn">Save test</button>
              </div>
            </form>
          </div>
          <!-- /.box -->
          <div class="box  box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Test List</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body"  style="overflow-x: auto;">
              <!-- <table class="table table-hover " >
                 <thead>
                  <th>ID</th>
                  <th>Test Name</th>
                  <th>Price</th>
                  <th>Action</th>
                </thead>
                <tbody id="tbl_test_body"></tbody>
                
              </table> -->
              <!-- DATA TABLE  -->

              <!-- <table class="table table-bordered table-striped tbl_test_body"> -->
                <table class="table table-striped table-bordered responsive dataex-res-colreorder dt-responsive tbl_test_body" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th class="sorting_disabled"  style="width: 5%">#</th>
                    <th class="name_of_sample">Test Name</th>
                    <th class="company_name">Price</th>
                    <th class="table_action sorting_disabled">Action</th>
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


<script type="text/javascript">
    $(document).ready(function() {
      get_tests();
  //Date picker
    $('.datepicker').datepicker({
      autoclose: true
    });

    $('#dt_orders').DataTable();

        
            /*------Dropzone-----------*/

            
    });

     /*========================================== : DATABASE OPERATION : =========================================*/

    /*GET samples*/
    var CurrentRow = [];
    
        function get_tests(data){    
        var t = $('.tbl_test_body').DataTable( {
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
              "responsive": true,

              "ajax":{
                url :"<?php echo WEB_SERVICE_PATH;?>service.php",
                type: "post",
                data:  {"op": "get_tests"},
                dataSrc: function ( res ) {
                  CurrentRow = res.data;
                  return res.data;
                },  
                error: function(){  
                  $(".tbl_test_body").css("display","none");
                }
              },
              "columnDefs": [ {
                "searchable": false,
                "orderable": false,
                "targets": 0
              } ],
              "columns": [
              { "data": null }
              ,{ "data": "test_name" }
              ,{ "data": "test_price" }
              ,{"mRender": function ( data, type, row, meta ) {
                return "\
                <div style='display: inline-flex;'><button type='button' class='btn btn-info'  onclick='edit_row("+meta.row+")'  style='margin: 0px 5px 0px 5px;'><i class='fa fa-edit'></i></button>\
                <button type='button' class='btn btn-danger'onclick='delete_test(null,"+row.test_id+")' style='margin: 0px 5px 0px 5px;' ><i class='fa fa-trash' style='width: 14px;'></i></button><div>\
                ";}
              }
              ]
              
            } );
          
    //     $('#tbl_test_body tbody').on( 'click', 'tr.group', function () {
    //       var currentOrder = table.order()[0];
    //       if ( currentOrder[0] === 1 && currentOrder[1] === 'asc' ) {
    //         table.order( [ 1, 'desc' ] ).draw();
    //       }
    //       else {
    //         table.order( [ 1, 'asc' ] ).draw();
    //       }
    // } );

         t.on( 'order.dt search.dt', function () {
          t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            // console.log(CurrentRow.length);
            cell.innerHTML = i+1;
          } );
        } ).draw();    
      }
     /*End GET samples*/
     function edit_row(row_index) {
        $("#TestFormBtn").removeClass("btnAddTest");
        $("#TestFormBtn").addClass("btnEditTest");

        data = CurrentRow[row_index];
        console.log(data);
        $("#td_test_id").val(data.test_id);
        $("#td_test_name").val(data.test_name);
        $("#td_test_price").val(data.test_price);
     }

    /* ===== clear sample data===== */

    function clear_data()
    {
      $("#td_test_name").val("");
      $("#td_test_price").val("");
      $("#sel_test_category").val('0');
    }

    /* ===== clear sample data===== */


    /* ===== Add sample ===== */
    $("#frm_test").delegate(".btnAddTest", "click", function(){
        add_tests();
    });
    $("#frm_test").delegate(".btnEditTest", "click", function(){
        update_test();
    }); 

        function add_tests(data) {
            if (data && data != null && data.success == true) {
             clear_data();
             get_tests();
             return true;
         }
         else if (data && data != null && data.success == false) {
            alert(data.message);
            return false;
        }
        else if (!data) {
        var data = {
            op: "add_tests"
            ,'test_name'          :   $("#td_test_name").val()
            ,'test_price'         :   $("#td_test_price").val()
        };
        doServiceCall(data, add_tests)
    }
    return false;           
    }
    /* End Add sample */

    /* ===== Update sample ===== */
    function update_test(data) {

    if (data && data != null && data.success == true) {
            $("#TestFormBtn").removeClass("btnEditTest");
            $("#TestFormBtn").addClass("btnAddTest");
            clear_data();
            get_tests();
        return true;
       }
    else if (data && data != null && data.success == false) {
        $("#TestFormBtn").removeClass("btnEditTest");
        $("#TestFormBtn").addClass("btnAddTest");
        clear_data();
        alert(data.message);
        return false;
    }
    else if (!data) {
        var data = {
            op: "update_test"
            ,'test_id'            :   $("#td_test_id").val()
            ,'test_name'          :   $("#td_test_name").val()
            ,'test_price'         :   $("#td_test_price").val()
        };


        doServiceCall(data, update_test)
    }
    return false;           
}
    /* End Update sample */


    /* ===== Delete sample ===== */
     function delete_test(data,test_id){
        
            if (data && data != null && data.success == true) {
                $("#TestFormBtn").removeClass("btnEditTest");
                $("#TestFormBtn").addClass("btnAddTest");
               clear_data();
               get_tests();
               return true;
           }
           else if (data && data != null && data.success == false) {
                alert(data.message);
                return false;
                }
            else if (!data) {
                if(confirm("Are you sure you want to delete test ?") == true)
                {
                    var data = {
                        op: "delete_test"
                        ,'test_id'   : test_id
                    };
                }

                doServiceCall(data, delete_test)
            }
            return false;           
        }
    /* End Delete sample */
</script>
<script src="js/dropzone.js"></script>



<?php
include 'footer.php';
?>