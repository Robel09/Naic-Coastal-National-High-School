<?php 
include('../session.php');


require_once("../class.user.php");

  
$auth_user = new USER();
// $page_level = 3;
// $auth_user->check_accesslevel($page_level);
$pageTitle = "Manage Room";
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
    include('x-sidenav.php');
    ?>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Manage Room</h1>
        
      </div>
<nav aria-label="breadcrumb" >
        <ol class="breadcrumb bcrum">
          <li class="breadcrumb-item "><a href="index" class="bcrum_i_a">Dashboard</a></li>
          <li class="breadcrumb-item  active bcrum_i_ac" aria-current="page">Room</li>
        </ol>
      </nav>
      <div class="table-responsive">
         <button type="button" class="btn btn-sm btn-success add" >
            Add 
          </button>
         <br><br>
        <table class="table table-striped table-sm" id="classroom_data">
          <thead>
          
            <?php 
              if($auth_user->student_level()){
                ?>
                <tr>
                  <th>#</th>
                  <th>Section</th>
                  <th>School Year</th>
                  <th>Action</th>
                </tr>
                <?php
              }
              else{
                ?>
                <tr>
                  <th>#</th>
                  <th>Teacher</th>
                  <th>Section</th>
                  <th>School Year</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                <?php
              }
              ?>
          </thead>
          <tbody>
            
     
          </tbody>
        </table>




<!-- Modal -->
<div class="modal fade" id="classroom_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Classroom</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="btn-group float-right" >
            <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#browse_teacher_modal">BROWSE TEACHER</button>
            </div>
            <br><br>
      <form method="post" id="classroom_form" enctype="multipart/form-data">
            <div class="form-row">
             
                <div class="form-group col-md-12">
                  <label for="teacher_name">Teacher Name<span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="teacher_name" name="teacher_name" placeholder="" value=""  required="" disabled >
                </div>
                  <div class="form-group col-md-6">
                  <label for="teacher_section">Section<span class="text-danger">*</span></label>
                  <select class="form-control" id="teacher_section" name="teacher_section">
                  <?php 
                   $auth_user->ref_section();
                  ?>
                </select>
                </div>
                  <div class="form-group col-md-6">
                  <label for="teacher_semester">School Year<span class="text-danger">*</span></label>
                  <select class="form-control" id="teacher_semester" name="teacher_semester">
                  <?php 
                   $auth_user->ref_semester();
                  ?>
                </select>
                </div>
          </div>
      </div>
      <div class="modal-footer">
       <input type="hidden" name="rsd_ID" id="rsd_ID" />
        <input type="hidden" name="room_ID" id="room_ID"  />
        <input type="hidden" name="operation" id="operation" />
        <div class="">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary submit" id="submit_input" value="submit_classroom">Submit</button>
        </div>
      </div>
    </form>
    </div>
  </div>
</div>



<!-- Modal -->
<div class="modal fade" id="browse_teacher_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">TEACHER</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-striped table-sm" id="teacher_data">
          <thead>
            <tr>
              <th>#</th>
              <th>School ID</th>
              <th>Name</th>
              <th>Sex</th>
              <th>RID</th>
            </tr>
          </thead>
          <tbody>
            
     
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="delclassroom_modal" tabindex="-1" role="dialog" aria-labelledby="product_modal_title" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="classroom_modal_title">Delete this Classroom</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="text-center">
        <div class="btn-group">
        <button type="submit" class="btn btn-danger" id="classroom_delform">Delete</button>
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
             
            var dataTable = $('#classroom_data').DataTable({
            "processing":true,
            "serverSide":true,
            "order":[],
            "ajax":{
              <?php 
              if($auth_user->admin_level()){
                ?>
              url:"datatable/room/fetch.php",
                <?php
              }
              ?>
              <?php 
              if($auth_user->student_level()){
                ?>
              url:"datatable/room/fetch_studentlevel.php",
                <?php
              }
              ?>
              <?php 
              if($auth_user->student_level()){
                ?>
              url:"datatable/room/fetch_teacherlevel.php",
                <?php
              }
              ?>
              type:"POST"
            },
            "columnDefs":[
              {
                "targets":[0],
                "orderable":false,
              },
            ],

          });

         var teacher_dataTable = $('#teacher_data').DataTable({
            "processing":true,
            "serverSide":true,
            "order":[],
              "bAutoWidth": false,
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
         teacher_dataTable.columns( [4] ).visible( false );


  //JQUERY FOR SELECTING  TEACHER FOR ROOM  WHEN BROWSING
  //----------------------------------------------------------------
    var teach_Rec = '#teacher_data tbody';

    $(teach_Rec).on('click', 'tr', function(){
      
      var cursor = teacher_dataTable.row($(this));//get the clicked row
      var data=cursor.data();// this will give you the data in the current row.
       if(confirm("Are you sure you want to use ("+data[2]+") for this room?"))
        {

          
          jQuery('#rsd_ID').val(data[0])
          $('#classroom_form').find("input[name='teacher_name'][type='text']").val(data[2]);
          

        }
          else
        {
          return false; 
        }
      $('#browse_teacher_modal').modal('hide');
      
    });



          $(document).on('submit', '#classroom_form', function(event){
            event.preventDefault();

              $.ajax({
                url:"datatable/room/insert.php",
                method:'POST',
                data:new FormData(this),
                contentType:false,
                processData:false,
                success:function(data)
                {
                  alertify.alert(data).setHeader('Classroom');
                  $('#classroom_form')[0].reset();
                  $('#classroom_modal').modal('hide');
                  dataTable.ajax.reload();
                }
              });
           
          });

          $(document).on('click', '.add', function(){
            $('#classroom_modal_title').text('Add Classroom');
            $("#teacher_name").prop("disabled", true);
            $('#classroom_form')[0].reset();
            $('#classroom_modal').modal('show');
            $('#submit_input').show();
            $('#submit_input').text('Submit');
            $('#submit_input').val('submit_classroom');
            $('#operation').val("submit_classroom");
          });

          $(document).on('click', '.view', function(){
            var room_ID = $(this).attr("id");
            $('#classroom_modal_title').text('View Classroom');
            $('#classroom_modal').modal('show');
            $("#submit_input").hide();
            
             $.ajax({
                url:"datatable/section/fetch_single.php",
                method:'POST',
                data:{action:"classroom_view",room_ID:room_ID},
                dataType    :   'json',
                success:function(data)
                {

                $("#section_title").prop("disabled", true);

                  $('#section_title').val(data.section_Name);

                  $('#submit_input').hide();
                  $('#room_ID').val(room_ID);
                  $('#submit_input').text('View');
                  $('#submit_input').val('classroom_view');
                  $('#operation').val("classroom_view");
                  
                }
              });


            });
          $(document).on('click', '.edit', function(){
            var room_ID = $(this).attr("id");
            $('#classroom_modal_title').text('Edit Classroom');
            $('#classroom_modal').modal('show');
            $("#submit_input").show();

            
             $.ajax({
                url:"datatable/section/fetch_single.php",
                method:'POST',
                data:{action:"classroom_view",room_ID:room_ID},
                dataType    :   'json',
                success:function(data)
                {

                  
                $("#section_title").prop("disabled", false);

                  $('#section_title').val(data.section_Name);

                  $('#submit_input').show();
                  $('#room_ID').val(room_ID);
                  $('#submit_input').text('Update');
                  $('#submit_input').val('section_update');
                  $('#operation').val("section_edit");
                  
                }
              });


            });
            $(document).on('click', '.delete', function(){
            var room_ID = $(this).attr("id");
             $('#delclassroom_modal').modal('show');
            $('#classroom_modal_title').text('Delete Classroom');
             $('.submit').hide();
             
             $('#room_ID').val(room_ID);
            });

           


          $(document).on('click', '#classroom_delform', function(event){
             var room_ID =  $('#room_ID').val();
            $.ajax({
             type        :   'POST',
             url:"datatable/room/insert.php",
             data        :   {operation:"delete_classroom",room_ID:room_ID},
             dataType    :   'json',
             complete     :   function(data) {
               $('#delclassroom_modal').modal('hide');
               alertify.alert(data.responseText).setHeader('Delete this Classroom');
               dataTable.ajax.reload();
               dataTable_product_data.ajax.reload();
                
             }
            })
           
          });
          
          } );


        </script>
        </body>

</html>
