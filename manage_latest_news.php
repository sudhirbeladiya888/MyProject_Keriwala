<?php
 require 'header.php';
 require 'sidebar.php';
?>

<link rel="stylesheet" href="css/jquery.fileupload.css">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         Latest news 
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"> Latest news </li>
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
              <h3 class="box-title">Add news </h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
              </div>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" id="frm_latestnews" name="frm_latestnews" class="validate_form" method="POST" onsubmit="return false">
              <input type="hidden" class="form-control" id="td_news_id">
              <div class="box-body">
                <div class="col-md-4">
                  <span class="btn btn-success fileinput-button">
                    <i class="glyphicon glyphicon-plus"></i>
                    <span>Select files...</span>
                    
                    <input id="fileupload" type="file" name="files" multiple>
                  </span>

                  <br>
                  <br>

                  <div id="progress" class="progress">
                    <div class="progress-bar progress-bar-success"></div>
                  </div>
                  <input type="hidden" class="imageUrl" id="imageUrl" name="imageUrl">
                  <div id="files" class="files"></div>
                  <br>
                </div>
                <div class="col-md-4">
                  <div class="form-group col-md-6">
                    <label for="td_news_title">News Title</label>
                    <input type="text" class="form-control" id="td_news_title" placeholder="Enter News Title">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="td_news_discription">Discription</label>
                    <input type="text" class="form-control" id="td_news_discription" placeholder="Enter Discription">
                  </div>
                </div>
                 <div class="col-md-4">
                  <div class="form-group col-md-6">
                    <label for="td_news_author">News Author</label>
                    <input type="text" class="form-control" id="td_news_author" placeholder="Enter News Author">
                  </div>
                  <!-- <div class="form-group col-md-6">
                    <label for="td_contact_person">Contact Person</label>
                    <input type="text" class="form-control" id="td_contact_person" placeholder="Enter Contact Person">
                  </div> -->
                </div>
                
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary pull-right btnAddlatestnews"  name="add_latestnews" id="latestnewsFormBtn">Save latestnews</button>
              </div>
            </form>
          </div>
          <!-- /.box -->
          <div class="box  box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">News List</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover " >
                 <thead>
                  <th>ID</th>
                  <th>Image</th>
                  <th>News Title</th>
                  <th>Discription</th>
                  <th>Author</th>
                  <th>Action</th>
                </thead>
                <tbody id="tbl_latestnews_body"></tbody>
                
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
      get_latest_news();
  //Date picker
    $('.datepicker').datepicker({
      autoclose: true
    });

    $('#dt_orders').DataTable();

          $('#fileupload').fileupload({
          url: WEB_SERVICE_PATH + "service.php?op=ajax_file_upload",
          dataType: 'json',
          done: function (e, data) {
              
              // $.each(data.result.files, function (index, file) {
              //     $('<p/>').text(file.name).appendTo('#files');
              // });
          },
          success:function (data) {
            
            // console.log(data.file_url);
            $("#imageUrl").val(data.file_url)
          },
          progressall: function (e, data) {
              var progress = parseInt(data.loaded / data.total * 100, 10);
              $('#progress .progress-bar').css(
                  'width',
                  progress + '%'
              );
          }
      }).prop('disabled', !$.support.fileInput)
          .parent().addClass($.support.fileInput ? undefined : 'disabled');

            
    });

     /*========================================== : DATABASE OPERATION : =========================================*/

    /*GET samples*/
    var CurrntRow = [];
    function get_latest_news(data){        
        if (data && data != null && data.success == true) {
            $("#tbl_latestnews_body").html('');
            var dictionary = data.data;
            var row_index = -1;
            CurrntRow = dictionary;
            for(var i in dictionary) {
                row_index = (parseInt(i));
                $("#tbl_latestnews_body").append("\
                  <tr>\
                        <td>"+(parseInt(i)+1)+"</td>\
                        <td><img src="+dictionary[i].news_image+" style='width: 45px;'></img></td>\
                        <td>"+dictionary[i].news_title+"</td>\
                        <td>"+dictionary[i].news_discription+"</td>\
                        <td>"+dictionary[i].news_author+"</td>\
                        <td>\
                          <div class='btn-group'>\
                              <button type='button' class='btn btn-info edit_btn' onclick='edit_row("+row_index+")'><i class='fa fa-edit'></i></button>\
                              <button type='button' class='btn btn-danger del_btn' onclick='delete_latest_news(null,"+dictionary[i].news_id+")'><i class='fa fa-trash'></i></button>\
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
                $("#tbl_latestnews_body").html("");
                $("#tbl_latestnews_body").append("<tr><td colspan='15'><h3 align='center'>"+data.message+"</h3></td>");

            return false;
        }
        else if (!data) {        
            var data = {
                op: "get_latest_news"
            };
            doServiceCall(data, get_latest_news)
        }
        return false;
    }
     /*End GET samples*/
     function edit_row(row_index) {
        $("#latestnewsFormBtn").removeClass("btnAddlatestnews");
        $("#latestnewsFormBtn").addClass("btnEditlatestnews");

        data = CurrntRow[row_index];
        $("#td_news_id").val(data.news_id);
        $("#td_news_title").val(data.news_title);
        $("#td_news_discription").val(data.news_discription);
        $("#td_news_author").val(data.news_author);
     }

    function print_sample(sample_id)
    {
         window.open('../web_services/print_sample.php?sample='+sample_id+',no');
    }
    
    /* ===== clear sample data===== */

    function clear_data()
    {
      $("#td_news_title").val("");
      $("#td_news_discription").val("");
      $("#td_news_author").val("");
    }

    /* ===== clear sample data===== */


    /* ===== Add sample ===== */
    $("#frm_latestnews").delegate(".btnAddlatestnews", "click", function(){
        add_latest_news();
    });
    $("#frm_latestnews").delegate(".btnEditlatestnews", "click", function(){
        update_latest_news();
    }); 

        function add_latest_news(data) {
            if (data && data != null && data.success == true) {
             var sample_data = data.data;
             clear_data();
             get_latest_news();
             return true;
         }
         else if (data && data != null && data.success == false) {
            alert(data.message);
            return false;
        }
        else if (!data) {
        var data = {
            op: "add_latest_news"
            ,'news_image'       :   $("#imageUrl").val()
            ,'news_title'       :   $("#td_news_title").val()
            ,'news_discription' :   $("#td_news_discription").val()
            ,'news_author'      :   $("#td_news_author").val()

        };
        doServiceCall(data, add_latest_news)
    }
    return false;           
    }
    /* End Add sample */



    /* ===== Update sample ===== */
    function update_latest_news(data) {

    if (data && data != null && data.success == true) {
            $("#latestnewsFormBtn").removeClass("btnEditlatestnews");
            $("#latestnewsFormBtn").addClass("btnAddlatestnews");
            clear_data();
            get_latest_news();
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
            op: "update_latest_news"
            ,'news_id'          :     $("#td_news_id").val()
            ,'news_image'       :     $("#imageUrl").val()
            ,'news_title'       :     $("#td_news_title").val()
            ,'news_discription' :     $("#td_news_discription").val()
            ,'news_author'      :     $("#td_news_author").val()
        };


        doServiceCall(data, update_latest_news)
    }
    return false;           
}
    /* End Update sample */


    /* ===== Delete sample ===== */
     function delete_latest_news(data,news_id){
        
            if (data && data != null && data.success == true) {
              $("#latestnewsFormBtn").removeClass("btnEditlatestnews");
              $("#latestnewsFormBtn").addClass("btnAddlatestnews");
              clear_data();
              get_latest_news();
               return true;
           }
           else if (data && data != null && data.success == false) {
                alert(data.message);
                return false;
                }
            else if (!data) {
                if(confirm("Are you sure you want to delete news ?") == true)
                {
                    var data = {
                        op: "delete_latest_news"
                        ,'news_id'   : news_id
                    };
                }

                doServiceCall(data, delete_latest_news)
            }
            return false;           
        }
    /* End Delete sample */
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