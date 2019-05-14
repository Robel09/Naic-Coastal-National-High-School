<?php 

function side_dashboard(){
    ?>
    <li
      <?php if ($GLOBALS['pagename'] == "Dashboard"): ?>
          class="active"
      <?php else: ?>
          
      <?php endif ?>
      
      >
          <a href="index">
              <i class="material-icons">home</i>
              <span>Dashboard</span>
          </a>
      </li>
    <?php
}
function side_accoutMngt(){
    ?>
     <li
      <?php if ($GLOBALS['pagename'] == "Account Management"): ?>
          class="active"
      <?php else: ?>
          
      <?php endif ?>
      >
          <a href="account">
              <i class="material-icons">account_box</i>
              <span>Account</span>
          </a>
      </li>
    <?php
}
function side_studentMngt(){
    ?>
    <li
     <?php if ($GLOBALS['pagename'] == "Student Management"): ?>
         class="active"
     <?php else: ?>
         
     <?php endif ?>
     >
         <a href="student">
             <i class="material-icons">account_box</i>
             <span>Student Management</span>
         </a>
     </li>
    <?php
}
function side_instrucMngt(){
    ?>
    <li
     <?php if ($GLOBALS['pagename'] == "Teacher Management"): ?>
         class="active"
     <?php else: ?>
         
     <?php endif ?>
     >
         <a href="teacher">
             <i class="material-icons">account_box</i>
             <span>Teacher Management</span>
         </a>
     </li>
    <?php
}
function side_section(){
    ?>
    <li
     <?php if ($GLOBALS['pagename'] == "Section"): ?>
         class="active"
     <?php else: ?>
         
     <?php endif ?>
     
     >
         <a href="section">
             <i class="material-icons">class</i>
             <span>Assigned</span>
         </a>
     </li>
    <?php
}
function side_sectionmng(){
    ?>
    <li
     <?php if ($GLOBALS['pagename'] == "Section Management"): ?>
         class="active"
     <?php else: ?>
         
     <?php endif ?>
     
     >
         <a href="sectionmng">
             <i class="material-icons">class</i>
             <span>Section Management</span>
         </a>
     </li>
    <?php
}
function side_schoolyear(){
    ?>
    <li
     <?php if ($GLOBALS['pagename'] == "Schoolyear Management"): ?>
         class="active"
     <?php else: ?>
         
     <?php endif ?>
     
     >
         <a href="schoolyear">
             <i class="material-icons">class</i>
             <span>Schoolyear Management</span>
         </a>
     </li>
    <?php
}
function side_teacherAssign(){
    ?>
    <li
     <?php if ($GLOBALS['pagename'] == "Assign Teacher"): ?>
         class="active"
     <?php else: ?>
         
     <?php endif ?>
     
     >
         <a href="teacher_assign">
             <i class="material-icons">list</i>
             <span>Assigned Teacher</span>
         </a>
     </li>
    <?php
}


function side_room(){
    
    ?>
    <li
     <?php if ($GLOBALS['pagename'] == "Room"): ?>
         class="active"
     <?php else: ?>
         
     <?php endif ?>
     
     >
         <a href="room">
             <i class="material-icons">class</i>
             <span>Room</span>
         </a>
     </li>
    <?php
}
   
?>

<!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">
                    <img src="<?php echo $user_img?>" width="48" height="48" alt="User" id="r_img" />
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $username?></div>
                    <div class="email"><?php echo $user_email?></div>
                    
                </div>
            </div>

            <!-- Menu -->
            <div class="menu">
                 
                <ul class="list">
                    <li class="header">MAIN NAVIGATION</li>
                    <?php 
                    //student
                    if ($login_level == 1) {
                        // side_dashboard();
                        side_room();
                       
                    }
                    //instructor
                    else if ($login_level == 2) {
                        // side_dashboard();
                        side_section();
                      
                    }
                    //admin
                    else if ($login_level == 3) {
                        
                        // side_dashboard();
                        side_accoutMngt();
                        side_studentMngt();
                        side_instrucMngt();
                        side_sectionmng();
                        side_schoolyear();
                        side_teacherAssign();
                        
                    }
                    else{

                    }
                   
                    ?>
                    
                    
                    
                   <!--   <li
                    <?php if ($pagename == "Reports"): ?>
                        class="active"
                    <?php else: ?>
                        
                    <?php endif ?>
                     >
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">collections_bookmark</i>
                            <span>Reports</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="../assets/" class=" waves-effect waves-block" target="_BLANK">List of student</a>
                            </li>
                        </ul>
                    </li> -->
                </ul>
            </div>
            <!-- #Menu -->
            <!-- Footer -->
            <div class="legal">
                <div class="copyright">
                    <!--  &copy; <?php auto_copyright("2019"); ?> --> <a href="javascript:void(0);">NCNHS E-Learning
</a>
                </div>
                <!-- <div class="version">
                    <b>Version: </b> 1.0.5
                </div> -->
            </div>
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->