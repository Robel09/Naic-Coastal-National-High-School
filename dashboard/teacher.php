<?php 
    include('../session.php');
    include('dash-global-function.php');

   
    $pagename = "Teacher Management";
    
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
                    Teacher Management
                </h2>
            </div>

            <ol class="breadcrumb breadcrumb-bg-blue">
                <li><a href="index"><i class="material-icons">home</i> Home</a></li>
                <li  class="active"><a href="javascript:void(0);"><i class="material-icons ">account_box</i> Teacher Management</a></li>
            </ol>
            <div class="row clearfix">

                       <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                           <div class="card">
                               <div class="header">
                                   <h2>LIST OF TEACHER</h2>
                                   <div class="btn-group pull-right">
                                   <button type="button" class="btn btn-success waves-effect add" data-toggle="modal" data-target="#teacher_modal">ADD TEACHER</button>
                                   </div>
                                   <br>
                               </div>
                               <div class="body">
                                   <div class="table-responsive" style="overflow-x: hidden;">
                                          <table id="teacher_data" class="table table-bordered table-striped">
                                            <thead>
                                              <tr>
                                                <th width="5%">ID</th>
                                                <th width="5%">Teacher ID</th>
                                                <th >Name</th>
                                                <th width="10%">Sex</th>
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
    <div class="modal fade" tabindex="-1" role="dialog" id="teacher_modal">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><span class="glyphicon glyphicon-plus-sign"></span> Add Teacher Detail</h4>
          </div>
          
          <form class="form-horizontal" action="#" method="POST" id="teacher_form" enctype="multipart/form-data">

          <div class="modal-body">
              <div class="row clearfix">
                  <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                      <label for="teacherID">Teacher Number</label>
                  </div>
                  <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                      <div class="form-group">
                          <div class="form-line">
                              <input type="text" class="form-control" id="teacherID" name="teacherID" placeholder="Teacher ID Number" onkeyup="numberInputOnly(this);">
                          </div>
                      </div>
                  </div>
              </div>
              <br>
              <div class="row clearfix">
                  <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                      <label for="firstname">First Name </label>
                  </div>
                  <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                      <div class="form-group">
                          <div class="form-line">
                              <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Teacher First Name" >
                          </div>
                      </div>
                  </div>
              </div>
              <br>
              <div class="row clearfix">
                  <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                      <label for="middlename">Middle Name</label>
                  </div>
                  <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                      <div class="form-group">
                          <div class="form-line">
                              <input type="text" class="form-control" id="middlename" name="middlename" placeholder="Teacher Middle Name">
                          </div>
                      </div>
                  </div>
              </div>
              <br>
              <div class="row clearfix">
                  <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                      <label for="lastname">Last Name</label>
                  </div>
                  <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                      <div class="form-group">
                          <div class="form-line">
                              <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Teacher Last Name">
                          </div>
                      </div>
                  </div>
              </div>
              <br>
              <div class="row clearfix">
                  <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                      <label for="suffix">Suffix</label>
                  </div>
                  <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                      <div class="form-group">
                          <div class="form-line">
                               <select class="form-control" name="suffix" id="suffix" >
                                <option value="">~~SELECT~~</option>
                              <?php 

                              $sql = "SELECT * FROM `ref_suffixname`";
                              $query = mysqli_query($conn,$sql);
                                             
                                               
                                if (mysqli_num_rows($query) > 0) {
                                      // output data of each row

                                    while($rsn = mysqli_fetch_assoc($query)) 
                                    {
                                    ?>
                                    <option value="<?php echo $rsn['suffix_ID']; ?>"><?php echo $rsn['suffix']; ?></option>
                                    <?php
                                    }
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
                      <label for="sex">Sex</label>
                  </div>
                  <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                      <div class="form-group">
                          <div class="form-line">
                               <select class="form-control" name="sex" id="sex" >
                                <option value="">~~SELECT~~</option>
                              <?php 

                              $sql = "SELECT * FROM `ref_sex`";
                              $query = mysqli_query($conn,$sql);
                                             
                                               
                                if (mysqli_num_rows($query) > 0) {
                                      // output data of each row

                                    while($rsn = mysqli_fetch_assoc($query)) 
                                    {
                                    ?>
                                    <option value="<?php echo $rsn['sex_ID']; ?>"><?php echo $rsn['sex_Name']; ?></option>
                                    <?php
                                    }
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
                      <label for="contact">Contact</label>
                  </div>
                  <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                      <div class="form-group">
                          <div class="form-line">
                              <input type="text" class="form-control" id="contact" name="contact" placeholder="Teacher Contact">
                          </div>
                      </div>
                  </div>
              </div>
              <br>                  
               <div class="row clearfix">
                  <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                      <label for="address">Address</label>
                  </div>
                  <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                      <div class="form-group">
                          <div class="form-line">
                              <input type="text" class="form-control" id="address" name="address" placeholder="Address">
                          </div>
                      </div>
                  </div>
              </div>
              <br> 
          </div>
          <div class="modal-footer">
          <input type="hidden" name="rtd_ID" id="rtd_ID" />
          <input type="hidden" name="operation" id="operation" value="Add" />
          <input type="submit" name="action" id="action" class="btn btn-success" value="Submit" />
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
          </form> 
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- /add modal -->


    <!-- add modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="assigned_section">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><span class="glyphicon glyphicon-plus-sign"></span> Assigned Section</h4>
          </div>
          
          <form class="form-horizontal" action="#" method="POST" id="teacher_form" enctype="multipart/form-data">

          <div class="modal-body as_bod">
             
                         
                             
                                   <div class="btn-group pull-right">
                                   <button type="button" class="btn btn-success waves-effect add" data-toggle="modal" data-target="#teacher_modal">ADD TEACHER</button>
                                   </div>
                                   <br>
                               <br>
                               
                                   <div class="table-responsive" style="overflow-x: hidden;">
                                          <table id="asteacher_data" class="table table-bordered table-striped">
                                            <thead>
                                              <tr>
                                                <th width="5%">ID</th>
                                                <th >Teacher</th>
                                                <th width="15%">School Year</th>
                                                <th width="15%">Section</th>
                                                <th width="10%">Action</th>
                                              </tr>
                                            </thead>
                                          </table>
                                       
                                   </div>
                               
                       </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
          </form> 
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

  //select specific dropdown when updating 1 data
  function setSelectedValue(dropDownList, valueToSet) {
    var option = dropDownList.firstChild;
    for (var i = 0; i < dropDownList.length; i++) {
        if (option.text.trim().toLowerCase() == valueToSet.trim().toLowerCase()) {
            option.selected = true;
            return;
        }
        option = option.nextElementSibling;
    }
}



  var dataTable = $('#teacher_data').DataTable({
    "processing":true,
    "serverSide":true,
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
   var dataTable1 = $('#asteacher_data').DataTable({
    "processing":true,
    "serverSide":true,
    "order":[],
    "ajax":{
      url:"datatable/teacher/fetch_assigned.php",
      type:"POST"
    },
    "columnDefs":[
      {
        "targets":[0],
        "orderable":false,
      },
    ],

  });

  

  $(document).on('submit', '#teacher_form', function(event){
    event.preventDefault();
    var teacherID = $('#teacherID').val();
    var firstname = $('#firstname').val();
    var middlename = $('#middlename').val();
    var lastname = $('#lastname').val();
    var suffix = $('#suffix').val();
    var contact = $('#contact').val();
    var address = $('#address').val();
    var sex = $('#sex').val();
    if(teacherID != '' && firstname != '' && middlename != '' && lastname != '' && suffix != '' && sex != ''  && address != ''  && contact != '')
    {
            $.ajax({
              url:"datatable/teacher/insert.php",
              method:'POST',
              data:new FormData(this),
              contentType:false,
              processData:false,
              success:function(data)
              {
                $('#action').val("Add");
                $('#operation').val("Add");

                alert(data);
                $('#teacher_form')[0].reset();
                $('#teacher_modal').modal('hide');
                dataTable.ajax.reload();
              }
            });
      
    
    }
    else
    {
      alert("Fields are Required");
    }
  });

   $(document).on('click', '.add', function () {
      
       $('#action').text("Add");
       $('#operation').val("Add");
       $('.modal-title').text("Add Teacher Info");
       $('#suffix').val('').change();
       $('#sex').val('').change();
       document.getElementById('teacher_form').reset();
      
  });
  $(document).on('click', '.update', function(){
    var rtd_ID = $(this).attr("id");
    
    $.ajax({
      url:"datatable/teacher/fetch_single.php",
      method:"POST",
      data:{rtd_ID:rtd_ID},
      dataType:"json",
      success:function(data)
      {
        $('#teacher_modal').modal('show');
        $('#teacherID').val(data.teacherID);
        $('#firstname').val(data.firstname);
        $('#middlename').val(data.middlename);
        $('#lastname').val(data.lastname);
        $('#suffix').val(data.suffix).change();
        $('#sex').val(data.sex).change();
        $('#contact').val(data.contact);
        $('#address').val(data.address);
        $('#action').val("Update");
        $('#operation').val("Edit");
        $('.modal-title').text("Edit Teacher Info");
        $('#rtd_ID').val(rtd_ID);
      }
    })
  });
  
  $(document).on('click', '.delete', function(){
    var rtd_ID = $(this).attr("id");
    if(confirm("Are you sure you want to delete this?"))
    {
      $.ajax({
        url:"datatable/teacher/delete.php",
        method:"POST",
        data:{rtd_ID:rtd_ID},
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
  
  $(document).on('click', '.assigned_section', function(){
    var rtd_ID = $(this).attr("id");
   
    $('#assigned_section').modal('show');
  });

  
});
</script>
</body>

</html>
