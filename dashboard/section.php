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
                   
                </h2>
            </div>

            <ol class="breadcrumb breadcrumb-bg-blue">
                <li><a href="index"><i class="material-icons">home</i> Home</a></li>
                <li  class="active"><a href="javascript:void(0);"><i class="material-icons ">account_box</i> Section</a></li>
            </ol>
            <div class="row clearfix">
                       <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                           <div class="card">
                               <div class="header">
                                   <h2 class="text-center"> MGA AKDANG PAMPANITIKANG MEDITERRANEAN AT KANLURANIN</h2>
                                   
                                   <br>
                               </div>
                               <div class="body">
                                <div class="row">
                                    <div class="col-sm-12">
                                      <div class="panel bg-grey">
                                          <div class="panel-heading text-center" style="border-bottom-style: groove;
                                              border-bottom-color: coral;
                                              border-bottom-width: 7px;">
                                              <h4>SECTION ASSIGN</h4>
                                          </div>
                                          <div class="panel-body" style="min-height: 100px;">
                                              
                                              <table class="table table-bordered">
                                                  <tbody>
                                                    
                                                        <?php 

                                                        $sql = "SELECT rtd.user_ID,rtd.rtd_FName,rtd.rtd_MName,rtd.rtd_LName,rsn.suffix,sy.*, rs.* FROM `schoolyear` sy
                                                        LEFT JOIN record_teacher_details rtd ON sy.rtd_ID = rtd.rtd_ID
                                                        LEFT JOIN ref_section rs ON sy.section_ID = rs.section_ID
                                                        LEFT JOIN ref_suffixname rsn ON rtd.suffix_ID = rsn.suffix_ID
                                                        WHERE `rtd`.`user_ID` = '$user_id'";
                                                        $query = mysqli_query($conn,$sql);
                                                                       
                                                                         
                                                          if (mysqli_num_rows($query) > 0) {
                                                                // output data of each row
                                                             
                                                              while($section = mysqli_fetch_assoc($query)) 
                                                              {
                                                              ?>
                                                                <tr>
                                                              <td>
                                                               <h4><?php echo $section['section_Name']?></h4>
                                                               <?php echo $section['sy_year']?>
                                                               <a class="btn btn-primary pull-right" href="room?sy_ID=<?php echo $section['sy_ID']?>">VIEW</a>
                                                              </td>
                                                               </tr>
                                                              <?php
                                                              }
                                                             }
                                                        ?>
                                                          
                                                      
                                                  </tbody>
                                              </table>
                                            
                                            </div>
                                          </div>
                                      </div>
                                    </div>
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
        <h4 class="modal-title" id="mtitle-ann">Modal Header</h4>
      </div>
      <div class="modal-body" id="mbody-ann">
        <p>Some text in the modal.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
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
    <script type="text/javascript">
   

    function view($var){
    var news_ID = $var;
    $('#view_modal').modal('show');
      $.ajax({
          url:"module-topic-content.php",
          type:"POST",
          data:{news_ID:news_ID},
          dataType:"json",
          success:function(data)
          {
            $('.modal-title').html(data.news_Title);
            $('.modal-body').html(data.news_Content);
            
          },
          error:function(data) {
            alert(JSON.stringify(data));
          }
        });
  

    }


    </script>
</body>

</html>
