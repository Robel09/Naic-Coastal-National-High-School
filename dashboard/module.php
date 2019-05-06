<?php 
    include('../session.php');
    include('dash-global-function.php');

   
    $pagename = "MGA AKDANG PAMPANITIKANG MEDITERRANEAN AT KANLURANIN";

    $username = $_SESSION['user_Name'];
    $user_id = $_SESSION['login_id'];
    $user_img = $_SESSION['user_img'];
    $user_email = $_SESSION['user_Email'];
    $script_for_specific_page = "";
    if(isset($_SESSION['login_level']) )
    {      
        $login_level = $_SESSION['login_level'];
        // if ($login_level != 3) {
         
        //   header('location: error404.php');
        // }
         
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
        $mod_ID = $_REQUEST['mod_ID'];
        ?>

    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>
                   
                </h2>
            </div>

            <ol class="breadcrumb breadcrumb-bg-blue">
                <li><a href="index"><i class="material-icons">home</i> Home</a></li>
                <li><a href="javascript:void(0);"><i class="material-icons ">account_box</i> Room</a></li>
                <li  class="active"><a href="javascript:void(0);"><i class="material-icons ">account_box</i> Modyul <?php echo  $mod_ID;?></a></li>
            </ol>
            <div class="row clearfix">
                       <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                           <div class="card">
                               <div class="header">
                                   <h2 class="text-center"> MGA AKDANG PAMPANITIKANG MEDITERRANEAN AT KANLURANIN</h2>
                                 
                                   <br>
                               </div>
                               <div class="body">
                                <?php 
                                  $sql = "SELECT * FROM `room_module_topic` WHERE mod_ID = $mod_ID";
                                  $query = mysqli_query($conn,$sql);
                                                 
                                                   
                                    if (mysqli_num_rows($query) > 0) {
                                          // output data of each row
                                        $bg = array();
                                        
                                        while($topic = mysqli_fetch_assoc($query)) 
                                        {
                                        ?>
                                        <div class="panel panel-info">
                                          <div class="panel-heading"><?php echo $topic['topic_Title']; ?>
                                             <?php if ($login_level == 2): ?>
                                            <button class="btn btn-info pull-right btn-sm edit_topic" id="<?php echo $topic["topic_ID"]?>">Edit</button>
                                            <?php endif ?> 
                                          </div>
                                          <div class="body" style="min-height: 100px;">
                                            <ul style="list-style: none ;">
                                              <?php 
                                              $topicID = $topic['topic_ID'];
                                              $sql = "SELECT * FROM `room_module_subtopic` WHERE topic_ID = $topicID";
                                              $subquery = mysqli_query($conn,$sql);
                                              if (mysqli_num_rows($subquery) > 0) {
                                                while($subtopic = mysqli_fetch_assoc($subquery)) 
                                                {
                                                  ?>
                                                  <li>
                                                    <?php if ($login_level == 2): ?>
                                                      <button class="btn btn-info btn-sm edit_subtopic" id="<?php echo $subtopic["subtop_ID"]?>">Edit</button>
                                                    <?php endif ?> <a href="#" onclick="view(<?php echo $subtopic["subtop_ID"]?>)"><?php echo $subtopic["subtop_Title"]?></a></li>

                                                  <?php
                                                }
                                              }
                                              ?>
                                            </ul>
                                          </div>
                                        </div>
                                        <?php
                                        }
                                       }
                                  ?>
                                    
    
                               </div>
                           </div>
                    </div>
            </div>   
   
          
        </div>

    </section>

<!-- Modal -->
<div id="view_modal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body" >
        <p>Some text in the modal.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<!-- Modal -->
<div id="edittopic_modal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title topic">Modal Header</h4>
      </div>
      <form>
      <div class="modal-body" >
        <label>Title</label>
       <input type="text" name="topic_name" id="topic_name" class="form-control">
       <br>
       <div class="stopic_content">
       <label>Content</label>
       <textarea class="form-control" id="stopic_content" style="min-height: 450px;">
         
       </textarea>
      </div>
      <div class="modal-footer">
        <input type="hidden" name="topic_ID" id="topic_ID">
        <input type="hidden" name="subtype" id="subtype">
        <button type="button" class="btn btn-info sub_uptopic" >Update</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>

  </div>
</div>



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

function view($var){
    var subtop_ID = $var;
    $('#view_modal').modal('show');
    $.ajax({
        url:"module-topic-content.php",
        method:"POST",
        data:{subtop_ID:subtop_ID},
        dataType:"json",
        success:function(data)
        {
          $('.modal-title').html(data.subtopic_title);
          $('.modal-body').html(data.subtopic_content);

          
        }
      });
}

   $(document).on('click', '.edit_topic', function(){
      var topic_ID = $(this).attr("id");  
   
        $('#edittopic_modal').modal('show');
        $('.modal-title.topic').text("Edit Topic");
        $('#topic_ID').val(topic_ID);

        $('#subtype').val('submit_edittopic');
         $.ajax({
          url:"action.php",
          type:"POST",
          data:{update_topic:topic_ID},
           dataType:"json",
          success:function(data)
          {
           
             $('#topic_name').val(data.topic_Title);
            
             $('.stopic_content').hide();
           
          }
        });
  }); 
      $(document).on('click', '.edit_subtopic', function(){
      var subtopic_ID = $(this).attr("id");  
   
        $('#edittopic_modal').modal('show');
        $('.modal-title.topic').text("Edit Subtopic");
         $('#topic_ID').val(subtopic_ID);
          $('#subtype').val('submit_editsubtopic');
         $.ajax({
          url:"action.php",
          type:"POST",
          data:{update_subtopic:subtopic_ID},
           dataType:"json",
          success:function(data)
          {
           $('.stopic_content').show();
           $('#topic_name').val(data.subtop_Title);
           $('#stopic_content').val(data.subtop_Content);
           
          
           
          }
        });
  }); 
  $(document).on('click', '.sub_uptopic', function(){
      var topic_name = $('#topic_name').val();
      var stopic_content = $('#stopic_content').val();
      var subtype = $('#subtype').val();
      var topic_ID = $('#topic_ID').val();
      
     $.ajax({
          url:"action.php",
          type:"POST",
          data:{update_topics:subtype,ID:topic_ID,topic_name:topic_name,stopic_content:stopic_content},
          dataType:"json",
          success:function(data)
          {
          
          }
        });
          alert('Successfully');
          window.location='module?mod_ID=<?php echo $mod_ID?>';
    
        }); 
</script>
</body>

</html>
