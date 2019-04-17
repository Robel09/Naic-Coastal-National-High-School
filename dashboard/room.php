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


 
if ($login_level == 1) {
 $sql = "SELECT * FROM `section_student`  ss
  LEFT JOIN record_student_details rsd ON rsd.rsd_ID = ss.rsd_ID
  LEFT JOIN user_accounts ua ON ua.user_ID = rsd.user_ID
  WHERE ua.user_ID = $user_id";
  $query = mysqli_query($conn,$sql);
  while($sy = mysqli_fetch_assoc($query)) {
    $reqsy_ID = $sy["sy_ID"];
  }
}
else {
  $reqsy_ID = $_REQUEST["sy_ID"];
}

 
$sql = "SELECT rtd.user_ID,rtd.rtd_FName,rtd.rtd_MName,rtd.rtd_LName,rsn.suffix,sy.*, rs.* FROM `schoolyear` sy
LEFT JOIN record_teacher_details rtd ON sy.rtd_ID = rtd.rtd_ID
LEFT JOIN ref_section rs ON sy.section_ID = rs.section_ID
LEFT JOIN ref_suffixname rsn ON rtd.suffix_ID = rsn.suffix_ID
WHERE  sy_ID = $reqsy_ID";
 $query = mysqli_query($conn,$sql);
                                                                       
                                                                         
  if (mysqli_num_rows($query) > 0) {
  // output data of each row
                                                               
  while($sec = mysqli_fetch_assoc($query)) 
  {
    $section_Name = $sec["section_Name"];
    $sy_year = $sec["sy_year"];
    $teacher_module = $sec["user_ID"];
    
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
                   
                </h2>
            </div>

            <ol class="breadcrumb breadcrumb-bg-blue">
                <li><a href="index"><i class="material-icons">home</i> Home</a></li>
                <li  class="active"><a href="javascript:void(0);"><i class="material-icons ">account_box</i> <?php echo $section_Name?></a></li>
            </ol>
            <div class="row clearfix">
                       <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                           <div class="card">
                               <div class="header">
                                   <h2 class="text-center"> MGA AKDANG PAMPANITIKANG MEDITERRANEAN AT KANLURANIN</h2>
                                   <H1 class="text-center"><?php echo $section_Name?></H1>
                                   <h2 class="text-center"><?php echo $sy_year?></h2>
                                   
                                   <br>
                               </div>
                               <div class="body">
                                <ul class="nav nav-tabs">
                                  <li class="active"><a data-toggle="tab" href="#announcement">ANNOUNCEMENT</a></li>
                                  <li><a data-toggle="tab" href="#modyuls">MODYULS</a></li>
                                  <li><a data-toggle="tab" href="#student">STUDENTS</a></li>
                                  <li><a data-toggle="tab" href="#activity">ROOM ACTIVITY</a></li>
                                </ul>

                                <div class="tab-content">
                                  <div id="announcement" class="tab-pane fade in active">
                                    <div class="row">
                                    <div class="col-sm-12">
                                      <div class="panel bg-grey">
                                          <div class="panel-heading text-center" style="border-bottom-style: groove;
                                              border-bottom-color: coral;
                                              border-bottom-width: 7px;">
                                              <h4>ANNOUNCEMENT BOARD</h4>

                                              
                                          </div>
                                          <div class="panel-body" style="min-height: 100px;">
<button class="btn btn-success pull-right" data-toggle="modal" data-target="#add_news">ADD ANNOUNCEMENT</button>
<br><br>
                                              <table class="table table-bordered">
                                                  <tbody>
                                                    
                                                        <?php 

                                                        $sql = "SELECT * FROM `news` WHERE sy_ID = $reqsy_ID ORDER BY `news`.`news_Pub` DESC";
                                                        $query = mysqli_query($conn,$sql);
                                                                       
                                                                         
                                                          if (mysqli_num_rows($query) > 0) {
                                                                // output data of each row
                                                             
                                                              while($news = mysqli_fetch_assoc($query)) 
                                                              {
                                                              ?>
                                                                <tr>
                                                              <td>
                                                               <h4><?php echo $news['news_Title']?></h4>
                                                               Pub: (<?php echo $news['news_Pub']?>)

                                                               <?php 
                                                               if ($login_level == 2) {
                                                                 ?>
                                                                 <div class="btn btn-danger pull-right delete_news" onclick="delete_news(<?php echo $news['news_ID']?>)" id="<?php echo $news['news_ID']?>">DELETE</div>
                                                                 <div class="btn btn-info pull-right update_news"  id="<?php echo $news['news_ID']?>">UPDATE</div>
                                                                 <?php
                                                               }
                                                               else{
                                                                ?>
                                                                <?php
                                                               }
                                                               ?>
                                                               

                                                               <div class="btn btn-primary pull-right" onclick="view_news(<?php echo $news['news_ID']?>)" id="<?php echo $news['news_ID']?>">VIEW</div>
                                                              </td>
                                                               </tr>
                                                              <?php
                                                              }
                                                             }
                                                             else{
                                                              ?>
                                                              <tr>
                                                              <td>
                                                               <h4>NO NEWS</h4>
                                                               
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
                                  
                                  <div id="modyuls" class="tab-pane fade">
                                     <div class="row">
                                         
                                    
                                  <?php 
                                  $sy_ID = 1;
                                  $sql = "SELECT * FROM `room_module` ";
                                  $query = mysqli_query($conn,$sql);
                                                 
                                                   
                                    if (mysqli_num_rows($query) > 0) {
                                          // output data of each row
                                        $bg = array();
                                        $bg[] = "bg-amber";
                                        $bg[] = "bg-light-blue";
                                        $bg[] = "bg-light-green";
                                        $i  = 0;
                                        while($mod = mysqli_fetch_assoc($query)) 
                                        {
                                        ?>
                                        <div class="col-sm-4">
                                          <div class="panel <?php echo $bg[$i]; ?>">
                                            <div class="panel-heading" style="border-bottom-style: groove;
                                              border-bottom-color: coral;
                                              border-bottom-width: 7px;"></div>
                                            <div class="body text-center" style="min-height: 100px; color: white;text-shadow: 2px 2px #000000;">
                                             <h3><a href="module.php?mod_ID=<?php echo $mod['mod_ID']; ?>" style="color:white;"><?php echo $mod['mod_Title']; ?></a> </h3>
                                            </div>
                                          </div>
                                        </div>
                                        <?php
                                        $i++;
                                        }
                                       }
                                  ?>
                                   </div>
                                  </div>
                                  <div id="student" class="tab-pane fade">
                                      <div class="row">
                                    <div class="col-sm-12">
                                      <div class="panel bg-green">
                                          <div class="panel-heading text-center" style="border-bottom-style: groove;
                                              border-bottom-color: coral;
                                              border-bottom-width: 7px;">
                                              <h4>STUDENT LIST</h4>
                                          </div>
                                          <div class="panel-body" style="min-height: 100px;">
                                              
                                              <table class="table table-bordered">
                                                  <tbody>
                                                    
                                                        <?php 

                                                        $sql = "SELECT * FROM `section_student` ss
                                                        LEFT JOIN record_student_details rsd ON rsd.rsd_ID = ss.rsd_ID
                                                        LEFT JOIN ref_suffixname rsn ON rsn.suffix_ID = rsd.rsd_Sex
                                                        WHERE sy_ID=  $reqsy_ID ";
                                                        $query = mysqli_query($conn,$sql);
                                                                       
                                                                         
                                                          if (mysqli_num_rows($query) > 0) {
                                                                // output data of each row
                                                             
                                                              while($stud = mysqli_fetch_assoc($query)) 
                                                              {
                                                              ?>
                                                                <tr>
                                                              <td>
                                                               <h4><?php echo $stud['rsd_FName']?> <?php echo $stud['rsd_MName']?> <?php echo $stud['rsd_LName']?>  <?php echo $stud['suffix']?></h4>
                                                               <div class="btn btn-primary pull-right" onclick="view_stud_activity(<?php echo $stud['rsd_ID']?>)">VIEW RECORD</div>
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
                                  <div id="activity" class="tab-pane fade">
                                    <ul class="nav nav-tabs">
                                      <li class="active"><a data-toggle="tab" href="#assignment">Assigment</a></li>
                                      <li><a data-toggle="tab" href="#quiz">Quiz</a></li>
                                      <li><a data-toggle="tab" href="#exam">Exam</a></li>
                                    </ul>

                                    <div class="tab-content">
                                      <div id="assignment" class="tab-pane fade in active">
                                        
                                    <div class="row">
                                    <div class="col-sm-12">
                                      <div class="panel bg-green">
                                          <div class="panel-heading text-center" style="border-bottom-style: groove;
                                              border-bottom-color: coral;
                                              border-bottom-width: 7px;">
                                              <h4>Assignment</h4>
                                          </div>
                                          <div class="panel-body" style="min-height: 100px;">
                                              <button class="btn btn-primary pull-right"  data-toggle="modal" data-target="#add_assignment">ADD ASSIGNMENT</button>
<br><br>
                                              <table class="table table-bordered">
                                                  <tbody>
                                                    
                                                        <?php 

                                                        $sql = "SELECT * FROM `assignment`  
                                                        WHERE sy_ID =$reqsy_ID
                                                        ORDER BY `assignment`.`assignment_Due` DESC";
                                                        $query = mysqli_query($conn,$sql);
                                                                       
                                                                         
                                                          if (mysqli_num_rows($query) > 0) {
                                                                // output data of each row
                                                             
                                                              while($assignment = mysqli_fetch_assoc($query)) 
                                                              {
                                                                $date_now = date("Y-m-d"); // this format is string comparable
                                                                $assignment_Due = $assignment['assignment_Due'];
                                                                
                                                              ?>
                                                                <tr>
                                                              <td>
                                                               <h4><?php echo $assignment['assignment_Name']?> (Pts.<?php echo $assignment['assignment_Points']?>)</h4>
                                                               Due(<?php echo $assignment['assignment_Due']?>)
                                                               <?php 
                                                               if ($date_now > $assignment_Due) {
                                                                }else{
                                                                    echo '<div class="btn btn-primary pull-right">VIEW</div>';
                                                                }
                                                               ?>
                                                               
                                                              </td>
                                                               </tr>
                                                              <?php
                                                              }
                                                             }
                                                            else{
                                                               ?>
                                                                <tr>
                                                              <td>
                                                               <h4> QUIZ EMPTY</h4>
                                                               
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
                                      <div id="quiz" class="tab-pane fade">
                                         <div class="row">
                                    <div class="col-sm-12">
                                      <div class="panel bg-green">
                                          <div class="panel-heading text-center" style="border-bottom-style: groove;
                                              border-bottom-color: coral;
                                              border-bottom-width: 7px;">
                                              <h4>QUIZ</h4>
                                          </div>
                                          <div class="panel-body" style="min-height: 100px;">
                                               <button class="btn btn-primary pull-right"  data-toggle="modal" data-target="#add_quiz">ADD QUIZ</button>
<br><br>
                                              <table class="table table-bordered">
                                                  <tbody>
                                                    
                                                        <?php 

                                                        $sql = "SELECT * FROM `quiz` WHERE sy_ID = $reqsy_ID";
                                                        $query = mysqli_query($conn,$sql);
                                                                       
                                                                         
                                                          if (mysqli_num_rows($query) > 0) {
                                                                // output data of each row
                                                             
                                                              while($quiz = mysqli_fetch_assoc($query)) 
                                                              {
                                                              ?>
                                                                <tr>
                                                              <td>
                                                               <h4><?php echo $quiz['quiz_Name']?></h4>
                                                               <div class="btn btn-primary pull-right" onclick="window.open('quiz?quiz_ID=<?php echo $quiz['quiz_ID']?>')">TAKE</div>
                                                              </td>
                                                               </tr>
                                                              <?php
                                                              }
                                                             }
                                                            else{
                                                               ?>
                                                                <tr>
                                                              <td>
                                                               <h4> QUIZ EMPTY</h4>
                                                               
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
                                      <div id="exam" class="tab-pane fade">
                                        <h3>Menu 2</h3>
                                        <p>Some content in menu 2.</p>
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
<div id="add_news" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="mtitle-ann">Add Announcement</h4>
      </div>
      <form action="action.php?sy_ID=<?php echo $_REQUEST["sy_ID"]?>" method="POST">
      <div class="modal-body" id="mbody-ann">
       <div class="row clearfix">
                  <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                      <label for="news_Title">Name</label>
                  </div>
                  <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                      <div class="form-group">
                          <div class="form-line">
                              <input type="text" class="form-control" id="news_Title" name="news_Title" placeholder="Announcement Title">
                          </div>
                      </div>
                  </div>
              </div>
              <br>
                <div class="row clearfix">
                  <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                      <label for="news_Content">Content</label>
                  </div>
                  <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                      <div class="form-group">
                          <div class="form-line">
                              <textarea class="form-control" id="news_Content" name="news_Content"></textarea>
                          </div>
                      </div>
                  </div>
              </div>
              <br>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success" value="submit_announcement" name="submit_announcement">Submit</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </form>
    </div>

  </div>
</div>
<!-- Modal -->
<div id="add_assignment" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="mtitle-ann">Add Assignment</h4>
      </div>
      <form action="action.php?sy_ID=<?php echo $_REQUEST["sy_ID"]?>" method="POST">
      <div class="modal-body" id="mbody-assign">
        <div class="row clearfix">
                  <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                      <label for="assignment_Name">Name</label>
                  </div>
                  <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                      <div class="form-group">
                          <div class="form-line">
                              <input type="text" class="form-control" id="assignment_Name" name="assignment_Name" placeholder="Assignment Name">
                          </div>
                      </div>
                  </div>
              </div>
              <br>
               <div class="row clearfix">
                  <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                      <label for="assignment_Instruction">Instruction</label>
                  </div>
                  <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                      <div class="form-group">
                          <div class="form-line">
                              <textarea class="form-control" id="assignment_Instruction" name="assignment_Instruction"></textarea>
                          </div>
                      </div>
                  </div>
              </div>
              <br>
               <div class="row clearfix">
                  <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                      <label for="assignment_Points">Points</label>
                  </div>
                  <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                      <div class="form-group">
                          <div class="form-line">
                            <input type="number" class="form-control" id="assignment_Points" name="assignment_Points" placeholder="Points">
                          </div>
                      </div>
                  </div>
              </div>
              <br>
               <div class="row clearfix">
                  <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                      <label for="assignment_due">Due Date</label>
                  </div>
                  <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                      <div class="form-group">
                          <div class="form-line">
                            <input type="datetime-local" class="form-control" id="assignment_due" name="assignment_due" >
                          </div>
                      </div>
                  </div>
              </div>
              <br>
             
              
      </div>
   
      <div class="modal-footer">
        <button type="submit" class="btn btn-success" value="submit_assignment" name="submit_assignment">Submit</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
       </form>
    </div>

  </div>
</div>
<!-- Modal -->
<div id="add_quiz" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="mtitle-ann">Add Quiz</h4>
      </div>
      <form action="action.php?sy_ID=<?php echo $_REQUEST["sy_ID"]?>" method="POST">
      <div class="modal-body" id="mbody-ann">
       <div class="row clearfix">
                  <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                      <label for="assignment_Name">Name</label>
                  </div>
                  <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                      <div class="form-group">
                          <div class="form-line">
                              <input type="text" class="form-control" id="assignment_Name" name="assignment_Name" placeholder="Assignment Name">
                          </div>
                      </div>
                  </div>
              </div>
              <br>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success" value="submit_quiz" name="submit_quiz">Submit</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </form>
    </div>

  </div>
</div>
<!-- Modal -->
<div id="view_news" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title newsmod" id="mtitle-ann">Modal Header</h4>
      </div>
      <div class="modal-body newsmod" id="mbody-ann">
        <p>Some text in the modal.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<!-- Modal -->
<div id="view_stud_activity" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title actvmod" id="mtitle-ann">Modal Header</h4>
      </div>
      <div class="modal-body actvmod" id="mbody-ann">
        <p>Some text in the modal.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<div id="update_news" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title unewsmod" id="mtitle-ann">Add Announcement</h4>
      </div>
      <form action="action.php?sy_ID=<?php echo $_REQUEST["sy_ID"]?>" method="POST">
      <div class="modal-body unewsmod" id="mbody-ann">
       <div class="row clearfix">
                  <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                      <label for="unews_Title">Name</label>
                  </div>
                  <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                      <div class="form-group">
                          <div class="form-line">
                              <input type="text" class="form-control" id="unews_Title" name="news_Title" placeholder="Announcement Title">
                          </div>
                      </div>
                  </div>
              </div>
              <br>
                <div class="row clearfix">
                  <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                      <label for="unews_Content">Content</label>
                  </div>
                  <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                      <div class="form-group">
                          <div class="form-line">
                              <textarea class="form-control" id="unews_Content" name="news_Content"></textarea>
                          </div>
                      </div>
                  </div>
              </div>
              <br>
      </div>
      <div class="modal-footer">
         <input type="hidden" class="form-control" id="unews_ID" name="news_ID" placeholder="Announcement Title">
        <button type="submit" class="btn btn-success" value="edit_announcement" name="edit_announcement">Submit</button>
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
    <script type="text/javascript">
   

    function view_stud_activity($var){
    var rsd_ID = $var;
    $('#view_stud_activity').modal('show');
      $.ajax({
          url:"module-topic-content.php",
          type:"POST",
          data:{view_stud_activity:rsd_ID},
          dataType:"json",
          success:function(data)
          {
            $('.modal-title.actvmod').html(data.news_Title);
            $('.modal-body.actvmod').html(data.news_Content);
            
          },
          error:function(data) {
            alert(JSON.stringify(data));
          }
        });
  

    }
    function view_news($var){
    var news_ID = $var;
    $('#view_news').modal('show');
      $.ajax({
          url:"module-topic-content.php",
          type:"POST",
          data:{news_ID:news_ID},
          dataType:"json",
          success:function(data)
          {
            $('.modal-title.newsmod').html(data.news_Title);
            $('.modal-body.newsmod').html(data.news_Content);
            
          },
          error:function(data) {
            alert(JSON.stringify(data));
          }
        });
  

    }


    $(document).on('click', '.delete_news', function(){
    var ann_ID = $(this).attr("id");
    if(confirm("Are you sure you want to delete this?"))
    {
    
      $.ajax({
        url:"action.php",
        type:"POST",
        data:{delete_announcement:ann_ID},
        success:function(data)
        {
          alert(data);
        }
      });
    }
    else
    {
      return false; 
    }
  });
     $(document).on('click', '.update_news', function(){
    var news_ID = $(this).attr("id");  
        $.ajax({
      
         url:"module-topic-content.php",
          type:"POST",
          data:{news_ID:news_ID},
          dataType:"json",
          success:function(data)
          {
            $('#update_news').modal('show');
            $('#unews_Title').val(data.news_Title);
            $('#unews_Content').val(data.news_Content);
            $('#unews_ID').val(news_ID);
            
          },
          error:function(data) {
            alert(JSON.stringify(data));
          }
      });
  
  });
    
    


    </script>
</body>

</html>
