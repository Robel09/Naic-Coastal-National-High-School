 <?php  
    include('../session.php');
    include('dash-global-function.php');

   
    $pagename = "Account Management";
    $username = $_SESSION['user_Name'];
    $user_img = "../assets/images/user.png";
    $user_email = "mail@gmail.com";
    $script_for_specific_page = "";
    if(isset($_SESSION['login_level']) )
    {      
        $login_level = $_SESSION['login_level'];
        if ($login_level != 3) {
         
          header('location: error404.php');
        }
         
    }

    if (empty($_REQUEST['page'])) {
        $page = "";
    }
    else{
        $page = $_REQUEST['page'];
    }
?>

<!DOCTYPE html>
<html>
 <?php
    include("dash-head.php");
    ?>
<body class="theme-light-blue">
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
            <?php
              echo '<pre>';
            var_dump($_SESSION);
            echo '</pre>';
            ?>
             <!-- Account Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Account Management
                            </h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                     <div class="removeMessages"></div>


                <button type="button" class="btn bg-green pull pull-right" data-toggle="modal" data-target="#ActionModal" data-id="A-<?php echo $row['user_ID'] ?>" id="action"> <span class="glyphicon glyphicon-plus-sign"></span> Add Member</button>
                <br /> <br /> <br />

                  <table class="table table-bordered table-striped table-hover dataTable" id="table">                    
                      <thead>
                          <tr>
                              <th>ID</th>
                              <th>Level</th>                                                  
                              <th>Username</th>
                              <th>Status</th>                             
                              <th>Option</th>
                          </tr>
                      </thead>
                      <tbody id="tbody">
                      <?php 
                       $sql =  mysqli_query($conn,"SELECT ua.user_ID,ul.level_name,ua.user_Name,ua.user_status FROM `user_accounts` ua
LEFT JOIN user_level ul ON ua.level_ID = ul.level_ID");
                       while ($row = mysqli_fetch_array($sql)) {
                         ?>
                          <tr>
                            <td><?php echo $row['user_ID'] ?></td>
                            <td><?php echo $row['level_name'] ?></td>
                            <td><?php echo $row['user_Name'] ?></td>
                            <td>
                             <?php $user_status = '';
                              if($row['user_status'] == 1) {
                                $user_status = '<label class="label label-success">Active</label>';
                              } 
                              else if($row['user_status'] == 0) {
                                $user_status = '<label class="label label-warning">Deactive</label>';
                              } 
                              else {
                                $user_status = '<label class="label label-danger">Ban</label>'; 
                              }
                              ?>
                              </td>
                            <td>
                              <div class="btn-group">
                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#ActionModal" data-id="E-<?php echo $row['user_ID'] ?>" id="action">Edit</button>
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#ActionModal" data-id="D-<?php echo $row['user_ID'] ?>" id="action">Delete</button>
                              </div>
                            </td>
                          </tr>
                         <?php 
                       }
                      ?>
                   </tbody>
                  </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Account Table -->
        </div>
    </section>

<!-- Modal -->
<div id="ActionModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" id="modal_header" style="border-radius:  5px 5px 0px 0px;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
        <div id="modal-loading"  style="display: none; text-align: center;">
          <center>
          <div class="loader"></div>
          </center>
        </div>
        <div id="modal-content"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<!-- /Modal -->
    <!-- jquery plugin -->
    <script type="text/javascript" src="../assets/jquery/jquery.min.js"></script>
    
    <!-- include custom index.js -->
    <script type="text/javascript" src="../assets/js/index.js"></script>
    <?php 
        include("dash-js.php");
    ?>
      <script type="text/javascript">

    $(document).ready(function(){
    
    $(document).on('click', '#action', function(e)
    {
      e.preventDefault();
      // get the value of data-id of each clicked elements
      var data_id = $(this).data('id');
      // removing all content of selected id
      var  action = data_id.slice(0,1);
      var  id = data_id.slice(2);
      console.log(data_id);

      if (action == 'A') {
        var mh = document.getElementById("modal_header");
        mh.className = mh.className.replace(/\bbg-info\b/g, "");
        mh.className = mh.className.replace(/\bbg-danger\b/g, "");
        mh.classList.add("modal-header");
        mh.classList.add("bg-success");
        $('#modal-title').html('Add New Data');
        $('#modal-loading').show();
      }
      else if (action == 'E'){
        var mh = document.getElementById("modal_header");
        mh.className = mh.className.replace(/\bbg-success\b/g, "");
        mh.className = mh.className.replace(/\bbg-danger\b/g, "");
        mh.classList.add("modal-header");
        mh.classList.add("bg-info");
        $('#modal-title').html('Edit This Data');
        $('#modal-loading').show();
      }
      else if (action == 'D'){

        var mh = document.getElementById("modal_header");
        mh.className = mh.className.replace(/\bbg-success\b/g, "");
        mh.className = mh.className.replace(/\bbg-info\b/g, "");
        mh.classList.add("bg-danger");
        $('#modal-title').html('Delete This Data');
        $('#modal-loading').show();
      }
      else if (action == 'S'){
        var x = document.getElementById("add-fName").innerHTML;
         console.log(x);

      }
      else{
        $('#modal-title').html('Error');
        $('#modal-loading').show();
      }
      $.ajax({
        url: 'data.php',
        type: 'POST',
        data: 'data_id='+data_id,
        dataType: 'html'
      })
      .done(function(success_data_fetch){
          $('#modal-content').html('');  
          $('#modal-content').html(success_data_fetch);  
          $('#modal-loading').hide();
      })
      .fail(function(){
        $('#target_div').html('<div class="panel-heading">Something went wrong</div><div class="panel-body"><i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...</div><div class="panel-footer"></div>');
       
      });
    
    });
  });

    </script>

</body>


    </div>
</div>
</html>
