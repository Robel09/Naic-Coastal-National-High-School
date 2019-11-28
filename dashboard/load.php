<?php 
if (isset($mod_ID))
{
  try{
      $stmt = $auth_user->runQuery("SELECT * FROM `room_module_topic` WHERE mod_ID = '$mod_ID' LIMIT 1");
      $stmt->execute();
      $result = $stmt->fetchAll();
      if ($stmt->rowCount() > 0){
         foreach($result as $row)
          {
             $mtopic_ID = $row["mtopic_ID"];
          }
            $stmt = $auth_user->runQuery("SELECT * FROM `room_module_subtopic` WHERE mtopic_ID = $mtopic_ID");
          $stmt->execute();
          $result = $stmt->fetchAll();
          // $count = $stmt->rowCount();
          ?>
        
          <br> <br>
          <?php
          foreach($result as $row)
          {
             $submtop_ID = $row["submtop_ID"];
            
             ?>
             
               <div class="d-flex bd-highlight  list-group-item list-group-item-action" >
             <div class="p-2 w-100 bd-highlight topic" id="list-home-list" data-toggle="list" href="#list-home" role="tab" aria-controls="home"  subtopic-id="<?php echo $submtop_ID?>">
                    <?php  echo $submtop_Title = $row["submtop_Title"];?>
                    </div>
                    <div class="p-2 flex-shrink-1 bd-highlight btn-group">
                      <div class="btn btn-primary btn-sm edit_subtopic" subtopic-id="<?php echo $mtopic_ID?>">
                        Edit
                      </div>

                   <div class="btn btn-primary btn-sm  delete_subtopic" subtopic-id="<?php echo $mtopic_ID?>">
                     Delete
                   </div>
                    </div>
            </div>
          
             <?php
          }
         ?>
          <?php
      }
      

  }
  catch (PDOException $e)
  {
        echo "There is some problem in connection: " . $e->getMessage();
  }
}
if (isset($_REQUEST["topic_ID"]))
{
  require_once("../class.user.php");
  session_start();
  $xtp = $_REQUEST["topic_ID"];
  
  $auth_user = new USER();
  $stmt = $auth_user->runQuery("SELECT * FROM `room_module_subtopic` WHERE mtopic_ID = ".$xtp."");
  $stmt->execute();
  $result = $stmt->fetchAll();
  // $count = $stmt->rowCount();
   ?>

   
  <?php 
  if($auth_user->student_level()){
    
  }
  else{
    ?>
     <button class="btn btn-success btn-sm add_subtopic" topic-id="<?php echo $xtp?>">ADD SUBTOPIC</button>  
    <?php
  }
  ?>
  <br> <br>

 
  <?php
  foreach($result as $row)
  {
     $submtop_ID = $row["submtop_ID"];
    ?>

   <div class="d-flex bd-highlight  list-group-item list-group-item-action" >
             <div class="p-2 w-100 bd-highlight topic" id="list-home-list" data-toggle="list" href="#list-home" role="tab" aria-controls="home"  subtopic-id="<?php echo $submtop_ID?>">
                    <?php  echo $submtop_Title = $row["submtop_Title"];?>
                    </div>
                    <div class="p-2 flex-shrink-1 bd-highlight btn-group">
                      <div class="btn btn-primary btn-sm edit_subtopic" subtopic-id="<?php echo $mtopic_ID?>">
                        Edit
                      </div>

                   <div class="btn btn-primary btn-sm  delete_subtopic" subtopic-id="<?php echo $mtopic_ID?>">
                     Delete
                   </div>
                    </div>
    </div>
     <?php
  }
   ?>


  <?php

  
}
?>