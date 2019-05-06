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
    $quiz_ID = $_REQUEST["quiz_ID"];

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
                <li  class="active"><a href="javascript:void(0);"><i class="material-icons ">account_box</i> Quiz</a></li>
            </ol>
            <div class="row clearfix">
                       <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                           <div class="card">
                               <div class="header">
                                   <h2 class="text-center">QUIZ

                                   </h2>
                               <div class="pull-right">
                                    ATTEMPT(<?php 
                                        $sql = "SELECT * FROM `quiz_attemp` WHERE quiz_ID = $quiz_ID AND user_ID = $user_id";
                                       
                                        $result = mysqli_query($conn, $sql);
                                        if (mysqli_num_rows($result) > 0) {
                                            while($row = mysqli_fetch_assoc($result)) {
                                                $atmp_ID = $row['atmp_ID'];
                                                $count = $row['count'];
                                                   
                                            }
                                            if ($count <= 0) {
                                                echo "<script>alert('0 Retake');
                                                        window.location='room';
                                                </script>";
                                             
                                            }
                                            $count--;
                                            $sql = "UPDATE `quiz_attemp` SET `count` = '$count' WHERE `quiz_attemp`.`atmp_ID` = $atmp_ID;";
                                            echo $count;
                                            $z11 = mysqli_query($conn, $sql);
                                            

                                        }
                                        else{
                                             $sql = "INSERT INTO 
                                             `quiz_attemp` (`atmp_ID`, `user_ID`, `quiz_ID`, `count`) 
                                             VALUES (NULL, $user_id, $quiz_ID, '3');";
                                              $z12 = mysqli_query($conn, $sql);
                                             echo "3";
                                        }
                                        ?>)
                                </div>
                                   <br>
                               </div>
                               <div class="body">
                                  <div class="panel panel-default">
                                  <div class="panel-heading">Time</div>
                                  <div class="panel-body" id="quiz_timer"></div>
                                </div>
                                <iframe src="loadquiz.php?quiz_ID=<?php echo $quiz_ID?>" style=" display:block;width:100%; height: 650px;"  frameBorder="0" id="frame_quiz"></iframe>

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

function timeout(){


var MyIFrame = document.getElementById("frame_quiz");
var MyIFrameDoc = (MyIFrame.contentWindow || MyIFrame.contentDocument);
if (MyIFrameDoc.document) MyIFrameDoc = MyIFrameDoc.document;
MyIFrameDoc.getElementById("subtmi_qscore").click();
clearInterval(interval);
}
var timer2 = "0:5";
var interval = setInterval(function() {


  var timer = timer2.split(':');
  //by parsing integer, I avoid all extra string processing
  var minutes = parseInt(timer[0], 10);
  var seconds = parseInt(timer[1], 10);
  --seconds;
  minutes = (seconds < 0) ? --minutes : minutes;
  if (minutes < 0) timeout();
  seconds = (seconds < 0) ? 59 : seconds;
  seconds = (seconds < 10) ? '0' + seconds : seconds;
  //minutes = (minutes < 10) ?  minutes : minutes;
  $('#quiz_timer').html(minutes + ':' + seconds);
  timer2 = minutes + ':' + seconds;
}, 1000);
</script>
</body>

</html>
