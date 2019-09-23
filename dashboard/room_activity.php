<?php 
include('../session.php');


require_once("../class.user.php");

  
$auth_user = new USER();
// $page_level = 3;
// $auth_user->check_accesslevel($page_level);
$pageTitle = "Manage Classroom";
?>
<!doctype html>
<html lang="en">
  <head>
    <?php 
      include('x-meta.php');
    ?>


  <?php 
  include('x-css.php');
  ?>
 



    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
      ul#myTab.nav.nav-tabs a{
        color:black !important;
      }
      ul#myTab.nav.nav-tabs .nav-link:hover{
           color:white !important;
      }
      ul#myTab.nav.nav-tabs .nav-link.active:hover{
       
        color:black !important;
      }
       ul#myTab.nav.nav-tabs .nav-link.active{
        background-color:#e9ecef !important;
        /*color:white!important;*/
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="../assets/css/dashboard.css" rel="stylesheet">
  </head>
  <body>
<?php 
include('x-nav.php');
?>

<div class="container-fluid">
  <div class="row">
      <?php 
    $rtab_n = "active_room";
    include('x-sidenav.php');
    ?>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <?php if($auth_user->admin_level() || $auth_user->instructor_level() ) { ?>
        <h1 class="h2">  MANAGE ACTIVITY</h1>
        <?php }?>
        <?php if($auth_user->student_level() ) { ?>
        <h1 class="h2">  ACTIVITY</h1>
        <?php }?>
        
      </div>

      <div class="table-responsive">
       
      <?php 
      $room_ID = $_GET["room_ID"];
      $rtab = "room_activity";
      $rtab_c = "Activity";
      include('x-roomtab.php');
      ?>
        <?php if($auth_user->admin_level() || $auth_user->instructor_level() ) { ?>
          <button type="button" class="btn btn-sm btn-success add" >
              Add 
          </button>
        <?php }?>
        <br><br>
        <table class="table table-striped table-sm" id="test_data">
          <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Added</th>
              <th>Expired</th>
              <th>Timer(Min)</th>
              <th>Type</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            
     
          </tbody>
        </table>














<div class="modal fade" id="test_modal" tabindex="-1" role="dialog" aria-labelledby="product_modal_title" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="test_modal_title">Add Activity</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="product_modal_content">
    
        <form method="post" id="test_form" enctype="multipart/form-data">
            <div class="form-row">
                <div class="form-group col-md-12">
                  <label for="test_name">Name</label>
                  <input type="text" class="form-control" id="test_name" name="test_name" placeholder="" value=""  required="">
                </div>
                <div class="form-group col-md-6">
                  <label for="test_expired">Expired</label>
                  <input type="datetime-local" class="form-control" id="test_expired" name="test_expired"  value=""  required="">
                </div>
                <div class="form-group col-md-6">
                  <label for="test_timer">Timer(Min):</label>
                  <input type="text" class="form-control" id="test_timer" name="test_timer" placeholder="00" value="" maxlength="4" minlength="1"required="">
                </div>
              </div>  

                <div class="form-group">
                <label for="prod_category">Type</label>
                <select class="form-control" id="test_type" name="test_type">
                  <?php 
                   $auth_user->ref_test_type();
                  ?>
                </select>
                <label for="prod_category">Status</label>
                <select class="form-control" id="test_status" name="test_status">
                  <?php 
                   $auth_user->ref_status();
                  ?>
                </select>
              </div>
      </div>
      <div class="modal-footer">

        <input type="hidden" name="test_ID" id="test_ID" />
        <input type="hidden" name="operation" id="operation" />
        <div class="btn-group">
          <button type="submit" class="btn btn-primary submit" id="submit_input" value="test_account">Submit</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
       </form>
    </div>
  </div>
</div>


      </div>

<div class="modal fade" id="deltest_modal" tabindex="-1" role="dialog" aria-labelledby="product_modal_title" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="test_modal_title">Delete this Activity</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="text-center">
        <div class="btn-group">
        <button type="submit" class="btn btn-danger" id="Section_delform">Delete</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

    </main>
  </div>
</div>

<?php 
include('x-script.php');
?>
        <script type="text/javascript">
   


          $(document).ready(function() {
             
            var dataTable = $('#test_data').DataTable({
            "processing":true,
            "serverSide":true,
            "order":[],
            "ajax":{
              url:"datatable/room/fetch_test.php",
              type:"POST"
            },
            "columnDefs":[
              {
                "targets":[0],
                "orderable":false,
              },
            ],

          });



          $(document).on('submit', '#test_form', function(event){
            event.preventDefault();

              $.ajax({
                url:"datatable/section/insert.php",
                method:'POST',
                data:new FormData(this),
                contentType:false,
                processData:false,
                success:function(data)
                {
                  alertify.alert(data).setHeader('Activity');
                  $('#test_form')[0].reset();
                  $('#test_modal').modal('hide');
                  dataTable.ajax.reload();
                }
              });
           
          });

          $(document).on('click', '.add', function(){
            $('#test_modal_title').text('Add Activity');
       
            $('#test_form')[0].reset();
            $('#test_modal').modal('show');
            $('#submit_input').show();
            $('#submit_input').text('Submit');
            $('#submit_input').val('submit_section');
            $('#operation').val("submit_section");
          });

                   $(document).on('click', '.view', function(){
            var test_ID = $(this).attr("id");
            $('#test_modal_title').text('View Test');
            $('#test_modal').modal('show');
            $("#acc_pass").hide();
            $("#acc_cpass").hide();
            $("#l_acc_pass").hide();
            $("#l_acc_cpass").hide();
            
             $.ajax({
                url:"datatable/room/fetch_single_test.php",
                method:'POST',
                data:{action:"test_view",test_ID:test_ID},
                dataType    :   'json',
                success:function(data)
                {

                $("#test_name").prop("disabled", true);
                $("#test_expired").prop("disabled", true);
                $("#test_timer").prop("disabled", true);
                $("#test_type").prop("disabled", true);
                $("#test_status").prop("disabled", true);

                  $('#test_name').val(data.test_Name);
                  $('#test_expired').val(data.test_Expired).change();
                  $('#test_timer').val(data.test_Timer);
                  $('#test_type').val(data.tstt_ID).change();
                  $('#test_status').val(data.status_ID).change();

                  $('#submit_input').hide();
                  $('#test_ID').val(test_ID);
                  $('#submit_input').text('Update');
                  $('#submit_input').val('test_edit');
                  $('#operation').val("test_edit");
                  
                }
              });


            });
          $(document).on('click', '.edit', function(){
            var test_ID = $(this).attr("id");
            $('#test_modal_title').text('Edit Account');
            $('#test_modal').modal('show');
          
            $("#acc_pass").show();
            $("#acc_cpass").show();
            $("#l_acc_pass").show();
            $("#l_acc_cpass").show();

            
             $.ajax({
                url:"datatable/room/fetch_single_test.php",
                method:'POST',
                data:{action:"test_view",test_ID:test_ID},
                dataType    :   'json',
                success:function(data)
                {
                  $("#test_name").prop("disabled", false);
                $("#test_expired").prop("disabled", false);
                $("#test_timer").prop("disabled", false);
                $("#test_type").prop("disabled", false);
                $("#test_status").prop("disabled", false);

                  $('#test_name').val(data.test_Name);
                  $('#test_expired').val(data.test_Expired);
                  $('#test_timer').val(data.test_Timer);
                  $('#test_type').val(data.tstt_ID).change();
                  $('#test_status').val(data.status_ID).change();

                  $('#submit_input').show();
                  $('#test_ID').val(test_ID);
                  $('#submit_input').text('Update');
                  $('#submit_input').val('test_update');
                  $('#operation').val("test_edit");
                  
                }
              });


            });
            $(document).on('click', '.delete', function(){
            var section_ID = $(this).attr("id");
             $('#deltest_modal').modal('show');
             $('.submit').hide();
             
             $('#section_ID').val(section_ID);
            });

           


          $(document).on('click', '#Section_delform', function(event){
             var section_ID =  $('#section_ID').val();
            $.ajax({
             type        :   'POST',
             url:"datatable/section/insert.php",
             data        :   {operation:"delete_section",section_ID:section_ID},
             dataType    :   'json',
             complete     :   function(data) {
               $('#deltest_modal').modal('hide');
               alertify.alert(data.responseText).setHeader('Delete this Section');
               dataTable.ajax.reload();
               dataTable_product_data.ajax.reload();
                
             }
            })
           
          });
          
          } );


        </script>
        </body>

</html>
