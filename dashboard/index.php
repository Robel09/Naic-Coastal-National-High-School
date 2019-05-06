 <?php 
    include('../session.php');
    include('dash-global-function.php');

   
    $pagename = "Dashboard";
    $username = $_SESSION['user_Name'];
    $user_id = $_SESSION['login_id'];
    $user_img = $_SESSION['user_img'];
    $user_email = $_SESSION['user_Email'];
    $script_for_specific_page = "index";
    if(isset($_SESSION['login_level']) )
    {      
    echo $login_level = $_SESSION['login_level'];
       
         
    }
?>
<!DOCTYPE html>
<html>
 <?php
    include("dash-head.php");
    ?>
<body class="theme-red">
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
                <h2>DASHBOARD</h2>
            </div>
            <ol class="breadcrumb breadcrumb-bg-light-blue">
                <li><a href="javascript:void(0);"><i class="material-icons">home</i> Home</a></li>
            </ol>

             
            <div class="row">
                <div class="col-sm-12 text-center " style="min-height: 100px;">
                     <img src="../assets/images/logo.png" height="80" style="margin-left: -550px;"> <H3 style="margin-top: -50px;">NAIC COSTAL NATIONAL HIGH SCHOOL</H3>
                </div>
            </div>
          
             <div class="row">
                <div class="col-sm-6">
                     <div class="panel panel-default"  style="min-height: 250px">
                         <div class="panel-heading  text-center" style=" border-bottom: 5px solid ;"><strong> MISSION</strong></div>
                         <div class="panel-body text-center">
                          MISSION MISSION   MISSION MISSION   MISSION MISSION  MISSION MISSION
                         </div>
                     </div>
                 </div>
                 <div class="col-sm-6">
                     <div class="panel panel-default"  style="min-height: 250px">
                         <div class="panel-heading text-center" style="border-bottom: 5px solid ;"><strong> VISION</strong></div>
                         <div class="panel-body text-center">
                           VISION VISION VISION VISION VISION VISION VISION VISION
                           
                         </div>
                     </div>
                 </div>
                 
             </div>
         
        </div>
    </section>

    <?php 
        include("dash-js.php");
    ?>


</body>

</html>
