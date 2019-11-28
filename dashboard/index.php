<?php 
include('../session.php');


require_once("../class.user.php");

  
$auth_user = new USER();
// $page_level = 3;
// $auth_user->check_accesslevel($page_level);
$pageTitle = "Dashboard";
?>
<!doctype html>
<html lang="en">
  <head>
    <?php 
      include('x-meta.php');
    ?>


    <!-- Bootstrap core CSS -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="../assets/css/icomoon/styles.css" rel="stylesheet" type="text/css">


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
     <!--    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Dashboard</h1> 
      </div>-->

    <div class="row">
                 <div class="col-sm-12 text-center " style="min-height: 100px;">
                     <img src="../assets/img/logo/logo.png" height="80" style="margin-left: -625px;"> <H3 style="margin-top: -50px;">NAIC COSTAL NATIONAL HIGH SCHOOL</H3>
                </div>
            </div>
            <div class="row" >
              <?php if($auth_user->admin_level() ){ ?>
             <div class="col-6 col-sm-6">
              <div class="card ">
                  <div class="card-header text-center" style=" border-bottom: 5px solid ;">
                    <strong>MISSION</strong>
                  </div>
                  <div class="card-body text-center"  style="min-height: 250px">
                    MISSION HERE
                  </div>
                  </div>
             <!--    <div class="card ">
                  <div class="card-header text-center" style=" border-bottom: 5px solid ;">
                   <strong>Student Enrolled</strong>
                  </div>
                  <div class="card-body text-center"  style="min-height: 250px">
                    
                  <div id="chartContainer" style="height: 300px; width: 100%;"></div>
                  </div>
                 -->
              </div>
              <div class="col-6 col-sm-6">
                <div class="card ">
                  <div class="card-header text-center" style=" border-bottom: 5px solid ;">
                    <strong>VISION</strong>
                  </div>
                  <div class="card-body text-center"  style="min-height: 250px">
                    VISION HERE
                  </div>
                </div>
                <!-- <div class="card ">
                  <div class="card-header text-center" style=" border-bottom: 5px solid ;">
                    <strong>Student Enrolled Per Section</strong>
                  </div>
                  <div class="card-body text-center"  style="min-height: 250px">
                    
                  <div id="chartContainer1" style="height: 300px; width: 100%;"></div>
                  </div>
                </div> -->
              </div>
              <?php } ?>
              <?php  if($auth_user->student_level()) { ?>
              <div class="col-12 col-sm-12" style="padding-bottom:5px;">
                <div class="card ">
                  <div class="card-header bg-primary text-white" style=" border-bottom: 5px solid #adb5bd ;">
                    <strong>Basic Information</strong>
                  </div>
                  <div class="card-body "  style="min-height: 250px">
                    <div class="row">
                      <div class="col-lg-4">
                        <img src="<?php $auth_user->getUserPic();?>"  height="125" width="125"  class="rounded-circle"  style="border:1px solid; border-color: #4caf50;">
                      </div>

                      <div class="col-lg-8">
                        <h3><b>Name:</b> <?php  $auth_user->profile_name()?> </h3>
                        <h3><b>LRN:</b> <?php  $auth_user->profile_school_id()?></h3>
                        <h3><b>Sex:</b> <?php $auth_user->profile_sex()?></h3>
                        
                      </div>
                    </div>

                  </div>
                </div>
              </div>

              <?php } ?>
              
              <?php  if($auth_user->instructor_level() ) { ?>
              <!-- INSTRUCTOR -->
            
                 <div class="col-12 col-sm-12" style="padding-bottom:5px;">
                <div class="card ">
                  <div class="card-header bg-primary text-white" style=" border-bottom: 5px solid #adb5bd ;">
                    <strong>Basic Information</strong>
                  </div>
                  <div class="card-body "  style="min-height: 250px">
                    <div class="row">
                      <div class="col-lg-4">
                        <img src="<?php $auth_user->getUserPic();?>"  height="125" width="125"  class="rounded-circle"  style="border:1px solid; border-color: #4caf50;">
                      </div>

                      <div class="col-lg-8">
                        <h3><b>Name:</b> <?php  $auth_user->profile_name()?> </h3>
                        <h3><b>School ID:</b> <?php  $auth_user->profile_school_id()?></h3>
                        <h3><b>Sex:</b> <?php  $auth_user->profile_sex()?></h3>
                        
                      </div>
                    </div>

                  </div>
                </div>
              </div>

              <?php } ?>

            </div>






    </main>
  </div>
</div>
<?php 
include('x-script.php');
?>

  
      </body>
</html>
