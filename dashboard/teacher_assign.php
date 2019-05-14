<?php 
    include('../session.php');
    include('dash-global-function.php');

   
    $pagename = "Assign Teacher";
    
    $username = $_SESSION['user_Name'];
    $user_id = $_SESSION['login_id'];
    $user_img = $_SESSION['user_img'];
    $user_email = $_SESSION['user_Email'];
    $script_for_specific_page = "";
    if(isset($_SESSION['login_level']) )
    {      
        $login_level = $_SESSION['login_level'];
        if ($login_level != 3) {
         
          header('location: error404.php');
        }
         
    }

?>

<!DOCTYPE html>
<html>

 <?php
    include("dash-head.php");
    ?>

<body class="theme-red ">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <?php 
        include('dash-topnav.php');
    ?>
    <section>
        <?php 
        include("dash-sidenav-left.php");
        ?>

    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>
                    Assigned Teacher Management
                </h2>
            </div>

            <ol class="breadcrumb breadcrumb-bg-blue">
                <li><a href="index"><i class="material-icons">home</i> Home</a></li>
                <li  class="active"><a href="javascript:void(0);"><i class="material-icons ">account_box</i> Assigned Teacher Management</a></li>
            </ol>
            <div class="row clearfix">
 
                       <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                           <div class="card">
                               <div class="header">
                                   <h2>List of Assigned Teacher</h2>
                                   <div class="btn-group pull-right">
                                   <button type="button" class="btn btn-success waves-effect add" data-toggle="modal" data-target="#ast_modal">ASSIGN TEACHER</button>
                                   </div>
                                   <br>
                               </div>
                               <div class="body">
                                   <div class="table-responsive" style="overflow-x: hidden;">
                                          <table id="ast_data" class="table table-bordered table-striped">
                                            <thead>
                                              <tr>
                                                <th width="5%">ID</th>
                                                <th width="15%">Teacher</th>
                                                <th width="15%">Section</th>
                                                <th width="15%">Schoolyear</th>
                                                <th width="15%">Visible</th>
                                                <th width="10%">Action</th>
                                              </tr>
                                            </thead>
                                          </table>
                                       
                                   </div>
                               </div>
                           </div>
                    </div>
            </div>   
          <!--    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <iframe src="map/user-map.php" style=" display:block; width:100%; height: 800px;"></iframe>
                    </div>
                </div> -->
          
        </div>

    </section>

 

 <!-- add modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="ast_modal">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><span class="glyphicon glyphicon-plus-sign"></span> Assign Teacher</h4>
          </div>
          
          <form class="form-horizontal" action="#" method="POST" id="ast_form" enctype="multipart/form-data">

          <div class="modal-body">
               
              <div class="row clearfix">
                     <button type="button" class="btn btn-info waves-effect btn-sm pull-right t_modal" data-toggle="modal" data-target="#t_modal">BROWSE TEACHER</button>
              </div>
              <br>
              <div class="row clearfix">
                  <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                      <label for="ast_teacherName">Teacher </label>
                  </div>
                  <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                      <div class="form-group">
                          <div class="form-line">
                              <input type="text" class="form-control" id="ast_teacherName" name="ast_teacherName" placeholder="Name"  disabled="">
                          </div>
                      </div>
                  </div>
              </div>
              <br>
               <div class="row clearfix">
                  <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                      <label for="status">Section</label>
                  </div>
                  <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                      <div class="form-group">
                          <div class="form-line">
                               <select class="form-control" name="ast_section" id="ast_section" >
                                <option value="">~~SELECT~~</option>
                               <?php 
                                  $sql1 = "SELECT * FROM `ref_section`";
                                  $result = mysqli_query($conn, $sql1);
                                   while($row = mysqli_fetch_assoc($result)) {
                                    ?><option value="<?php echo $row ["section_ID"]?>"><?php echo $row ["section_Name"]?></option>
                                    <?php
                                   }

                                ?>
                              </select>
                          </div>
                      </div>
                  </div>
              </div>
              <br> 
              <div class="row clearfix">
                  <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                      <label for="status">Schoolyear</label>
                  </div>
                  <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                      <div class="form-group">
                          <div class="form-line">
                               <select class="form-control" name="ast_sy" id="ast_sy" >
                                <option value="">~~SELECT~~</option>
                                <?php 
                                  $sql1 = "SELECT * FROM `ref_schoolyear`";
                                  $result = mysqli_query($conn, $sql1);
                                   while($row = mysqli_fetch_assoc($result)) {
                                    ?><option value="<?php echo $row ["rsy_syear"]?>"><?php echo $row ["rsy_syear"]?></option>
                                    <?php
                                   }

                                ?>
                              </select>
                          </div>
                      </div>
                  </div>
              </div>
              <br>
              <div class="row clearfix">
                  <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                      <label for="ast_status">Status</label>
                  </div>
                  <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                      <div class="form-group">
                          <div class="form-line">
                               <select class="form-control" name="ast_status" id="ast_status" >
                                <option value="">~~SELECT~~</option>
                                <option value="1">Active</option>
                                <option value="0">Deactivate</option>
                              </select>
                          </div>
                      </div>
                  </div>
              </div>
              <br>
          </div>
          <div class="modal-footer">
          <input type="hidden" name="rtd_ID" id="rtd_ID"  value="1" />
          <input type="hidden" name="sy_ID" id="sy_ID" />
          <input type="hidden" name="operation" id="operation" value="Add" />
          <input type="submit" name="action" id="action" class="btn btn-success" value="Submit" />
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
          </form> 
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- /add modal -->

    <!-- /add modal -->
    <!-- add modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="t_modal">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><span class="glyphicon glyphicon-plus-sign"></span>Teacher List</h4>
          </div>
          <div class="modal-body">
                 <div class="table-responsive" style="overflow-x: hidden;">
                                          <table id="teacher_data" class="table table-bordered table-striped">
                                            <thead>
                                              <tr>
                                                <th width="5%">ID</th>
                                                <th width="5%">Teacher ID</th>
                                                <th >Name</th>
                                                <th width="10%">Sex</th>
                                              </tr>
                                            </thead>
                                          </table>
                                       
                                   </div>
  
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- /add modal -->
    <!-- Jquery Core Js -->
    <script src="../assets/plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="../assets/plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <script src="../assets/plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="../assets/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="../assets/plugins/node-waves/waves.js"></script>

    <!-- Jquery DataTable Plugin Js -->
    <script src="../assets/plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="../assets/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="../assets/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
    <script src="../assets/plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
    <script src="../assets/plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
    <script src="../assets/plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
    <script src="../assets/plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
    <script src="../assets/plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
    <script src="../assets/plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>

    <!-- Custom Js -->
    <script src="../assets/js/admin.js"></script>
    <script src="../assets/js/pages/tables/jquery-datatable.js"></script>

    <!-- Demo Js -->
    <script src="../assets/js/demo.js"></script>
    <script type="text/javascript" language="javascript" >
             //NUMBER ONLY
  function numberInputOnly(elem) {
      var validChars = /[0-9]/;
      var strIn = elem.value;
      var strOut = '';
      for(var i=0; i < strIn.length; i++) {
        strOut += (validChars.test(strIn.charAt(i)))? strIn.charAt(i) : '';
      }
      elem.value = strOut;
  }
$(document).ready(function(){



  var dataTable = $('#ast_data').DataTable({
    "processing":true,
    "serverSide":true,
    "order":[],
    "ajax":{
      url:"datatable/teacher_assign/fetch.php",
      type:"POST"
    },
    "columnDefs":[
      {
        "targets":[0],
        "orderable":false,
      },
    ],

  });
  var dataTable1 = $('#teacher_data').DataTable({
    "processing":true,
    "serverSide":true,
    "autoWidth": false,
    "order":[],
    "ajax":{
      url:"datatable/teacher/fetch.php",
      type:"POST"
    },
    "columnDefs":[
      {
        "targets":[0],
        "orderable":false,
      },
    ],

  });

  //----------------------------------------------------------------
  //JQUERY FOR SELECTING STUDENT ID WHEN BROWSING
  //----------------------------------------------------------------
    var teacher_data_data = '#teacher_data tbody';

    $(teacher_data_data).on('click', 'tr', function(){
      
      var cursor = dataTable1.row($(this));//get the clicked row
      var data=cursor.data();// this will give you the data in the current row.
    
      
      if(confirm("Are you sure you want to assign ("+data[2]+")?"))
      {
        $('#rtd_ID').val(data[0]);
        $('#ast_teacherName').val(data[2]);
      }
      else
      {
        return false; 
      }
      $('#t_modal').modal('hide');
      
    });

  $(document).on('submit', '#ast_form', function(event){
    event.preventDefault();

            $.ajax({
              url:"datatable/teacher_assign/insert.php",
              method:'POST',
              data:new FormData(this),
              contentType:false,
              processData:false,
              success:function(data)
              {
                $('#action').val("Add");
                $('#operation').val("Add");

                alert(data);
                $('#ast_form')[0].reset();
                $('#ast_modal').modal('hide');
                dataTable.ajax.reload();
              }
            });
 
  });

   $(document).on('click', '.add', function () {
      
       $('.t_modal').show();
       $('#action').text("Add");
       $('#operation').val("Add");
       $('.modal-title').text("Assign Teacher Info");
       document.getElementById('ast_form').reset();
      
  });
  $(document).on('click', '.update', function(){
    var sy_ID = $(this).attr("id");
     $('.t_modal').hide();
    $.ajax({
      url:"datatable/teacher_assign/fetch_single.php",
      method:"POST",
      data:{sy_ID:sy_ID},
      dataType:"json",
      success:function(data)
      {
        $('#ast_modal').modal('show');
        $('#ast_teacherName').val(data.ast_fullname);
        $('#rtd_ID').val(data.rtd_ID);
        $('#ast_sy').val(data.ast_year).change();
        $('#ast_section').val(data.ast_section).change();
        $('#ast_status').val(data.ast_status).change();
        
        $('#action').val("Update");
        $('#operation').val("Edit");
        $('.modal-title').text("Edit Schoolyear Info");
        $('#sy_ID').val(sy_ID);
      }
    })
  });
  
  $(document).on('click', '.delete', function(){
    var sy_ID = $(this).attr("id");
    if(confirm("Are you sure you want to delete this?"))
    {
      $.ajax({
        url:"datatable/teacher_assign/delete.php",
        method:"POST",
        data:{sy_ID:sy_ID},
        success:function(data)
        {
          alert(data);
          dataTable.ajax.reload();
        }
      });
    }
    else
    {
      return false; 
    }
  });
  


  
});
</script>
</body>

</html>
