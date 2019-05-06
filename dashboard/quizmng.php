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
                                   <h2 class="text-center">QUIZ</h2>
                                 
                                   <br>
                               </div>
                               <div class="body">
                                 <button class="btn btn-success pull-right add">ADD</button>
                                 <br>
                                 <br>
                                <table class="table">
                                    <tbody>
                                <?php 
                                $rquiz_ID = $_REQUEST["quiz_ID"];
                               
                                    $sql = "SELECT * FROM `questions` WHERE quiz_ID = $rquiz_ID AND test_ID = 1";

                                    $result = mysqli_query($conn, $sql);
                                    $count_question = mysqli_num_rows($result) ;
                                    if (mysqli_num_rows($result) > 0) {
                                        $i = 1; 
                                        while($row = mysqli_fetch_assoc($result)) {
                                        $id = $row['question_ID'];
                                        $question = $row['question'];
                                        ?>
                                        <tr>
                                            <td><?php echo $i?>.)</td>
                                            <td class="col-sm-8"><?php echo $question?>
                                             <?php 
                                             $sql1 = "SELECT * FROM `choices` WHERE question_ID = $id LIMIT 4";
                                              $result1 = mysqli_query($conn, $sql1);
                                               $zx = 1;
                                               while($row1 = mysqli_fetch_assoc($result1)) {
                                             
                                              if ( $zx == 1) {
                                                $lc = "A";
                                              }
                                              if ( $zx == 2) {
                                                $lc = "B";
                                              }
                                              if ( $zx == 3) {
                                                $lc = "C";
                                              }
                                              if ( $zx == 4) {
                                                $lc = "D";
                                              }
                                                ?>
                                                <br><?php echo $lc.'. '.$row1["choice"]?> 
                                                <?php
                                                $zx++;
                                               }
                                             ?>
                                               
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                <button class="btn btn-info view" id="<?php echo $id?>">VIEW</button>
                                                <button class="btn btn-primary edit"  id="<?php echo $id?>">EDIT</button>
                                                <button class="btn btn-danger delete"  id="<?php echo $id?>">DELETE</button>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php
                                        $i++;
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
      <form action="action.php?quiz_ID=<?php echo $_REQUEST["quiz_ID"];?>&sy_ID=<?php echo $_REQUEST["sy_ID"];?>" method="POST" id='qform'>
      <div class="modal-body" >
         <div class="row clearfix">
                  <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                      <label for="question_name">QUESTION</label>
                  </div>
                  <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                      <div class="form-group">
                          <div class="form-line">
                              <input type="text" class="form-control" id="question_name" name="question_name" placeholder="" >
                          </div>
                      </div>
                  </div>
              </div>
              <br>
      <div class="row clearfix">
                  <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                      <label for="question_a">A</label>
                  </div>
                  <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                      <div class="form-group">
                          <div class="form-line">
                              <input type="text" class="form-control" id="question_a" name="question_a" placeholder="" >
                          </div>
                      </div>
                  </div>
              </div>
              <br>
              <div class="row clearfix">
                  <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                      <label for="question_b">B</label>
                  </div>
                  <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                      <div class="form-group">
                          <div class="form-line">
                              <input type="text" class="form-control" id="question_b" name="question_b" placeholder="" >
                          </div>
                      </div>
                  </div>
              </div>
              <br>
              <div class="row clearfix">
                  <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                      <label for="question_c">C</label>
                  </div>
                  <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                      <div class="form-group">
                          <div class="form-line">
                              <input type="text" class="form-control" id="question_c" name="question_c" placeholder="" >
                          </div>
                      </div>
                  </div>
              </div>
              <br>
              <div class="row clearfix">
                  <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                      <label for="question_d">D</label>
                  </div>
                  <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                      <div class="form-group">
                          <div class="form-line">
                              <input type="text" class="form-control" id="question_d" name="question_d" placeholder="" >
                          </div>
                      </div>
                  </div>
              </div>
              <br>
              <div class="row clearfix">
                  <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                      <label for="student_fname">Correct Answer</label>
                  </div>
                  <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                      <div class="form-group">
                          <div class="form-line">
                              <select class="form-control" name="question_correct" id="question_correct" >
                                <option value="">~~SELECT~~</option>
                                <option value="a">A</option>
                                <option value="b">B</option>
                                <option value="c">C</option>
                                <option value="d">D</option>
                             
                              </select>
                          </div>
                      </div>
                  </div>
              </div>
              <br>
      </div>
      <div class="modal-footer">
        <input type="hidden" name="que_ID" id="que_ID" >
        <input type="submit" name="submit_qq" id="submit_qq" class="btn btn-success">
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

  $(document).on('click', '.add', function(){
        $('#view_modal').modal('show');
        $('.modal-title').text("Add Question");
          $('#submit_qq').attr('name', 'submit_qq');
         $('#qform')[0].reset();

  }); 
  $(document).on('click', '.view', function(){
          var quest_ID = $(this).attr("id");  
        $('#view_modal').modal('show');
        $('.modal-title').text("View Question");
         $.ajax({
          url:"action.php",
          type:"POST",
          data:{get_question:quest_ID},
           dataType:"json",
          success:function(data)
          {
            $("#question_name").prop('disabled', true);
            $("#question_a").prop('disabled', true);
            $("#question_b").prop('disabled', true);
            $("#question_c").prop('disabled', true);
            $("#question_d").prop('disabled', true);
             $('#question_correct').prop('disabled', true);
           $('#question_name').val(data.question);
           $('#question_a').val(data.a.choice);
           $('#question_b').val(data.b.choice);
           $('#question_c').val(data.c.choice);
           $('#question_d').val(data.d.choice);
           if (data.a.is_correct == "1") {
                 $('#question_correct').val('a').change();
           }
           if (data.b.is_correct == "1") {
                 $('#question_correct').val('b').change();
           }
            if (data.c.is_correct == "1") {
                 $('#question_correct').val('c').change();
           }
            if (data.d.is_correct == "1") {
                 $('#question_correct').val('d').change();
           }
              $('#submit_qq').hide();
              $('#que_ID').val(quest_ID);
            
          }
        });

  }); 
   $(document).on('click', '.edit', function(){
      var quest_ID = $(this).attr("id");  
        $('#view_modal').modal('show');
        $('.modal-title').text("Edit Question");
         $.ajax({
          url:"action.php",
          type:"POST",
          data:{get_question:quest_ID},
           dataType:"json",
          success:function(data)
          {
             $('#submit_qq').attr('name', 'submit_upqq');
            $("#question_name").prop('disabled', false);
            $("#question_a").prop('disabled', false);
            $("#question_b").prop('disabled', false);
            $("#question_c").prop('disabled', false);
            $("#question_d").prop('disabled', false);
            $('#question_correct').prop('disabled', false);

           $('#question_name').val(data.question);
           $('#question_a').val(data.a.choice);
           $('#question_b').val(data.b.choice);
           $('#question_c').val(data.c.choice);
           $('#question_d').val(data.d.choice);
           if (data.a.is_correct == "1") {
                 $('#question_correct').val('a').change();
           }
           if (data.b.is_correct == "1") {
                 $('#question_correct').val('b').change();
           }
            if (data.c.is_correct == "1") {
                 $('#question_correct').val('c').change();
           }
            if (data.d.is_correct == "1") {
                 $('#question_correct').val('d').change();
           }
          $('#submit_qq').show();
           $('#que_ID').val(quest_ID);
           
          }
        });
  }); 
  $(document).on('click', '.delete', function(){
          var quest_ID = $(this).attr("id");  
      var sy_ID = <?php echo $_REQUEST['sy_ID']?>;
      var quiz_ID = <?php echo $_REQUEST['quiz_ID']?>;
  if(confirm("Are you sure you want to delete this?"))
    {
    
      $.ajax({
        url:"action.php",
        type:"POST",
        data:{delete_quizQuest:quest_ID,quiz_ID:quiz_ID},
        success:function(data)
        {
          alert(data);
         location.reload(' quizmng?sy_ID='+sy_ID+'&quiz_ID='+quiz_ID)

        }
      });
    }
    else
    {
      return false; 
    }
  }); 



// function timeout(){
// alert('asd');
// clearInterval(interval);
// }
// var timer2 = "0:10";
// var interval = setInterval(function() {


//   var timer = timer2.split(':');
//   //by parsing integer, I avoid all extra string processing
//   var minutes = parseInt(timer[0], 10);
//   var seconds = parseInt(timer[1], 10);
//   --seconds;
//   minutes = (seconds < 0) ? --minutes : minutes;
//   if (minutes < 0) timeout();
//   seconds = (seconds < 0) ? 59 : seconds;
//   seconds = (seconds < 10) ? '0' + seconds : seconds;
//   //minutes = (minutes < 10) ?  minutes : minutes;
//   $('#quiz_timer').html(minutes + ':' + seconds);
//   timer2 = minutes + ':' + seconds;
// }, 1000);


</script>
</body>

</html>

