<?php 
	include('../session.php');
	$output = array();
	if (isset($_POST["subtop_ID"])) {
		$subtop_ID = $_POST["subtop_ID"];
		$sql = "SELECT * FROM `room_module_subtopic` WHERE subtop_ID = $subtop_ID";
	    $query = mysqli_query($conn,$sql);
	                   
	                     
	    if (mysqli_num_rows($query) > 0) 
	    {
	          // output data of each row
	        while($content = mysqli_fetch_assoc($query)) 
	        {
				$output["subtop_ID"] = $content["subtop_ID"];
				$output["subtopic_title"] = $content["subtop_Title"];
				$output["subtopic_content"] = $content["subtop_Content"];
	        }
	    }
		
	}
	if (isset($_POST["news_ID"])) {
		$news_ID = $_POST["news_ID"];
		
		$sql = "SELECT * FROM `news` WHERE news_ID = $news_ID";
	    $query = mysqli_query($conn,$sql);
	                   
	                     
	    if (mysqli_num_rows($query) > 0) 
	    {
	          // output data of each row
	        while($news = mysqli_fetch_assoc($query)) 
	        {
				
				$output["news_Title"] = $news["news_Title"];
				$output["news_Content"] = $news["news_Content"];
				// $output["news_Pub"] = $news["news_Pub"];
	        }
	    }

		
	}
	if (isset($_POST["view_stud_activity"])) {
		$output["news_Title"] = "Student";
		$output["news_Content"] = "asdasd";

		
	}
	if (isset($_POST["view_assignment"])) {
		$ass_ID = $_POST["view_assignment"];
		

		$sql = "SELECT * FROM `assignment` WHERE assignment_ID = '$ass_ID'";
	    $query = mysqli_query($conn,$sql);
	                   
	                     
	    if (mysqli_num_rows($query) > 0) 
	    {
	          // output data of each row
	        while($ass = mysqli_fetch_assoc($query)) 
	        {
				
				$output["Name"] = $ass["assignment_Name"];
				$output["Instruction"] = $ass["assignment_Instruction"];
				$output["Points"] = $ass["assignment_Points"];
				$input = $ass["assignment_Due"]; 
				$d = new DateTime($input);
				// Output the microseconds.
				 $d->format('u'); // 012345
				// Output the date with microseconds.
				$output["Due"] = $d->format('Y-m-d\TH:i:s'); 
				
					
				
	        }
	    }

		
	}

	
	echo json_encode($output,JSON_UNESCAPED_UNICODE);
?>