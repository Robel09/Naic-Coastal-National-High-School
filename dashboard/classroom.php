 <?php 
    include('../session.php');
    include('dash-global-function.php');

   
    $pagename = "Classroom";
    $username = $_SESSION['user_Name'];
    $user_img = "../assets/images/user.png";
    $user_email = "mail@gmail.com";
    $script_for_specific_page = "jquery";
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
            <?php
              echo '<pre>';
            var_dump($_SESSION);
            echo '</pre>';
            ?>
            <?php 
            if (isset($_REQUEST['code'])) {
                include('classroom-code.php');
            }
            else{
                include('classroom-content.php');
            }

            ?>
        </div>
    </section>

    <?php 
        include("dash-js.php");
    ?>
</body>
<!-- Add Student In Classroom -->
            <div class="modal fade" id="JoinStudentInClass" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel">Add Student In Classroom</h4>
                        </div>
                        <div class="modal-body">
                           
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-link waves-effect">SAVE CHANGES</button>
                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                        </div>
                    </div>
                </div>
            </div>
<!-- Join Classroom -->
            <div class="modal fade" id="JoinClass" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-green">
                            <h4 class="modal-title" id="defaultModalLabel">Join Class</h4>
                        </div>
                        <div class="modal-body">
                              <form action="" method="POST">
                                <div class="row clearfix">
                                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                        <label for="class_name">Class Code</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="class_name" id="class_name" class="form-control" >
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                              </form>
                        </div>
                        <div class="modal-footer ">
                            <center>
                            <div class="btn-group ">
                                
                            <input type="submit" name="join_class" class="btn btn-success" value="Submit">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                            </div>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
<!-- Create Classroom -->
<div class="modal fade" id="CreateClass" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-green">
                <h4 class="modal-title" id="defaultModalLabel">Create Class</h4>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                <div class="row clearfix">
                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                        <label for="class_code">Class Code</label>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="class_code" id="class_code" class="form-control" >
                            </div>
                        </div>
                    </div>
                </div> 
                <div class="row clearfix">
                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                        <label for="class_name">Class Name</label>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="class_name" id="class_name" class="form-control" >
                            </div>
                        </div>
                    </div>
                </div> 
                <div class="row clearfix">
                    <div class="col-lg-3 col-md-2 col-sm-3 col-xs-5 form-control-label">
                        <label for="class_description">Description</label>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <textarea   name="class_description" id="class_description"class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                </div> 
                <div class="row clearfix">
                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                        <label for="class_color">Color</label>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                 <select class="form-control" name="class_color" id="class_color" >
                                  <option value="">~~SELECT~~</option>
                                  <option value="1">Red</option>
                        <option value="2">cyan</option>
                        <option value="3">green</option>
                        <option value="4">blue-grey</option>
                        <option value="5">bg-pink</option>
                        <option value="6">light-blue</option>
                        <option value="7">light-green</option>
                        <option value="8">amber</option>
                                </select>
                            </div>
                        </div>
                    </div>
               </div> 
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link waves-effect">Submit</button>
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
            </div>
        </div>
    </div>
</div>
</html>
