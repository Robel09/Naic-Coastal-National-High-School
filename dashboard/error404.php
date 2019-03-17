 <?php 
    include('../session.php');
    include('dash-global-function.php');

   
    $pagename = "Error404";
    $username = $_SESSION['user_Name'];
    $script_for_specific_page = "index";
    $user_img = "../assets/images/user.png";
    $user_email = "mail@gmail.com";
  

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
<body class="four-zero-four">
   <div class="four-zero-four-container">
        <div class="error-code">404</div>
        <div class="error-message">This page doesn't exist</div>
        <div class="button-place">
            <a href="index" class="btn btn-default btn-lg waves-effect">GO TO HOMEPAGE</a>
        </div>
    </div>

    <?php 
        include("dash-js.php");
    ?>
</body>

</html>
