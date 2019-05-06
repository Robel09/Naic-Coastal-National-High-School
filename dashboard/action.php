<?php  
include('../session.php');

if (isset($_POST['submit_announcement'])) {
	
	$sy_ID = $_REQUEST["sy_ID"];
	$news_Title = $_POST["news_Title"];
	$news_Content = $_POST["news_Content"];
	$sql = "INSERT INTO `news` (`news_ID`, `news_Title`, `news_Content`, `news_Pub`, `sy_ID`) VALUES (NULL, '$news_Title', '$news_Content', CURRENT_TIMESTAMP, '$sy_ID');";
	if ($result = mysqli_query($conn, $sql)) {
		echo "<script>alert('Successfully Add');
											window.location='room?sy_ID=$sy_ID';
										</script>";
	}
	else{
	echo "<script>alert('Failed to  Add');
											window.location='room?sy_ID=$sy_ID';
										</script>";
	}
}
if (isset($_POST['view_announcement'])) {
	
	$news_Title = $_POST["news_Title"];
	$news_Content = $_POST["news_Content"];
}
if (isset($_POST['edit_announcement'])) {
$sy_ID = $_REQUEST["sy_ID"];
	$news_ID = $_POST["news_ID"];
	$news_Title = $_POST["news_Title"];
	$news_Content = $_POST["news_Content"];
	$sql = "UPDATE `news` SET `news_Title` = '$news_Title',news_Content = '$news_Content'  WHERE `news`.`news_ID` = $news_ID;";
	
	if ($result = mysqli_query($conn, $sql)) {
		echo "<script>alert('Successfully Update');
											window.location='room?sy_ID=$sy_ID';
										</script>";
	}
	else{
	echo "<script>alert('Failed to  Update');
											window.location='room?sy_ID=$sy_ID';
										</script>";
	}
}
if (isset($_POST['delete_announcement'])) {
	$ann_ID = $_POST['delete_announcement'];
	$sql = "DELETE FROM `news` WHERE `news`.`news_ID` = $ann_ID";
	if ($result = mysqli_query($conn, $sql)) {
		echo "Announcement Delete";

	}
	else{
	echo "Delete Failed";
	}
}
if (isset($_POST['submit_assignment'])) {
	$sy_ID = $_REQUEST["sy_ID"];
	$assignment_Name = $_POST["assignment_Name"];
	$assignment_Instruction = $_POST["assignment_Instruction"];
	$assignment_Points = $_POST["assignment_Points"];
	$assignment_due = $_POST["assignment_due"];


			$sql = "INSERT INTO `assignment` (`assignment_ID`, `sy_ID`, `assignment_Name`, `assignment_Instruction`, `assignment_Points`, `assignment_Due`) VALUES (NULL,'$sy_ID', '$assignment_Name', '$assignment_Instruction', '$assignment_Points', '$assignment_due');";
			if ($result = mysqli_query($conn, $sql)) {
				echo "<script>alert('Successfully Added');
													window.location='room?sy_ID=$sy_ID';
												</script>";

			}
			else{
			echo "<script>alert('Failed');
													window.location='room?sy_ID=$sy_ID';
												</script>";
			}
	
}
if (isset($_POST["update_assignment"])) {
	$sy_ID = $_REQUEST["sy_ID"];
	$ass_ID = $_REQUEST["ass_ID"];
	$assignment_Name = $_POST["assignment_Name"];
	$assignment_Instruction = $_POST["assignment_Instruction"];
	$assignment_Points = $_POST["assignment_Points"];
	$assignment_due = $_POST["assignment_due"];
		$sql = "UPDATE `assignment` SET 
		`assignment_Name` = '$assignment_Name', 
		`assignment_Instruction` = '$assignment_Instruction',
		`assignment_Points` = '$assignment_Points',
		`assignment_due` = '$assignment_due'
		WHERE `assignment`.`assignment_ID` = '$ass_ID';";
	
	if ($result = mysqli_query($conn, $sql)) {
		echo "<script>alert('Successfully Updated');
											window.location='room?sy_ID=$sy_ID';
										</script>";

	}
	else{
	echo "<script>alert('Failed');
											window.location='room?sy_ID=$sy_ID';
										</script>";
	}
	
}


if (isset($_POST['delete_assignment'])) {
	$ass_ID = $_POST['delete_assignment'];
	$sql = "DELETE FROM `assignment` WHERE `assignment`.`assignment_ID` = '$ass_ID'";
	if ($result = mysqli_query($conn, $sql)) {
		echo "Assignment Delete";

	}
	else{
	echo "Delete Failed";
	}
}
if (isset($_POST["submit_quiz"])) {
	$sy_ID = $_REQUEST["sy_ID"];
	$q_Name = $_POST["q_Name"];
	$q_Time = $_POST["q_Time"];
	$sql = "INSERT INTO `quiz` (`quiz_ID`, `sy_ID`, `quiz_Name`,`time_allotted`) VALUES (NULL, '$sy_ID', '$q_Name','$q_Time');";
	if ($result = mysqli_query($conn, $sql)) {
		echo "<script>alert('Successfully Added');
											window.location='room?sy_ID=$sy_ID';
										</script>";

	}
	else{
	echo "<script>alert('Failed');
											window.location='room?sy_ID=$sy_ID';
										</script>";
	}

}
if (isset($_POST["update_quiz"])) {
	$sy_ID = $_REQUEST["sy_ID"];
	$q_Name = $_POST["q_Name"];
	$q_Time = $_POST["q_Time"];
	
	$quiz_ID = $_POST["quiz_IDx"];
	
	$sql = "UPDATE `quiz` SET `quiz_Name` = '$q_Name' ,
	`time_allotted` = '$q_Time'
	WHERE `quiz`.`quiz_ID` = $quiz_ID;";
	if ($result = mysqli_query($conn, $sql)) {
		echo "<script>alert('Successfully Updated');
											window.location='room?sy_ID=$sy_ID';
										</script>";

	}
	else{
	echo "<script>alert('Failed');
											window.location='room?sy_ID=$sy_ID';
										</script>";
	}

}

if (isset($_POST["get_quiz"])) {
	$get_quiz = $_POST["get_quiz"];
	$output = array();
	$sql = "SELECT * FROM `quiz` WHERE quiz_ID  = $get_quiz LIMIT 1";
	$result = mysqli_query($conn, $sql);

   while($row = mysqli_fetch_assoc($result)) {
		$output["quiz_Name"] = $row["quiz_Name"];
		$output["time_allotted"] = $row["time_allotted"];
	}
	
	echo json_encode($output);
}

if (isset($_POST["delete_quiz"])) {
	$quiz_ID = $_POST["delete_quiz"];
	
	$sql = "DELETE FROM `quiz` WHERE `quiz`.`quiz_ID` = $quiz_ID;";
	if ($result = mysqli_query($conn, $sql)) {
		echo "Successfully Delete";

	}
	else{
	echo "Failed";
	}

}
if (isset($_POST["delete_quizQuest"])) {
	$quest_ID = $_POST["delete_quizQuest"];
	$quiz_ID = $_POST["quiz_ID"];
	
	
	$sql = "DELETE FROM `questions` WHERE `questions`.`question_ID` = $quest_ID";
	if ($result = mysqli_query($conn, $sql)) {
		echo "Successfully Delete";

	}
	else{
	echo "Failed";
	}

}

if (isset($_POST["submit_qq"])) {
	
	function choices($conn,$letter,$question_ID){

		if ($_POST["question_correct"] == $letter) {
			$is_correct = "1";
		}
		else{
			$is_correct = "0";
		}
		
		$choice =  $_POST["question_".$letter];
		 $sql = "INSERT INTO `choices` (`choice_ID`, `question_ID`, `is_correct`, `choice`) VALUES (NULL, '$question_ID', '$is_correct', '$choice');";
		if ($result = mysqli_query($conn, $sql)) {

		}
	}
	$question_name = $_POST["question_name"];
	$quiz_ID = $_REQUEST["quiz_ID"];
	$sy_ID = $_REQUEST["sy_ID"];

	$sql = "INSERT INTO `questions` (`question_ID`, `question`, `test_ID`, `quiz_ID`) VALUES (NULL, '$question_name', '1', '$quiz_ID');";
	if ($result = mysqli_query($conn, $sql)) {
		$l_question_ID = mysqli_insert_id($conn);

		choices($conn,"a",$l_question_ID);
		choices($conn,"b",$l_question_ID);
		choices($conn,"c",$l_question_ID);
		choices($conn,"d",$l_question_ID);
		
		echo "<script>alert('Success');
											window.location='quizmng?sy_ID=$sy_ID&quiz_ID=$quiz_ID';
										</script>";
	}

}
if (isset($_POST["submit_upqq"])) {

		function up_choices($conn,$letter,$choice_ID){

		if ($_POST["question_correct"] == $letter) {
			$is_correct = "1";
		}
		else{
			$is_correct = "0";
		}
		
		$choice =  $_POST["question_".$letter];
		echo $sql3 = "
		 UPDATE `choices` SET `choice` = '$choice',
		 `is_correct` = '$is_correct'
		 WHERE `choices`.`choice_ID` = '$choice_ID';
		 ";
		if ($result3 = mysqli_query($conn, $sql3)) {

		}
	}
	$question_name = $_POST["question_name"];
	$quiz_ID = $_REQUEST["quiz_ID"];
	$que_ID = $_POST["que_ID"];
	$sy_ID = $_REQUEST["sy_ID"];
	$k = array();
	$k[] = 'a';
	$k[] = 'b';
	$k[] = 'c';
	$k[] = 'd';
	$x = 0;
	$sql = "UPDATE `questions` SET `question` = '$question_name' WHERE `questions`.`question_ID` = $que_ID;";
	if ($result = mysqli_query($conn, $sql)) {
		$sql1 = "SELECT * FROM `choices` WHERE question_ID = $que_ID ";
		if ($result1 = mysqli_query($conn, $sql1)) {
			 while($row1 = mysqli_fetch_assoc($result1)) {
			 	$choice_ID = $row1['choice_ID'];
			 	
			 	up_choices($conn,$k[$x],$choice_ID);
			 	$x++;
			 }
			 	echo "<script>alert('Success');
											window.location='quizmng?sy_ID=$sy_ID&quiz_ID=$quiz_ID';
										</script>";
		}
		
	}
	


}


if (isset($_POST["delete_qq"])) {
	// DELETE FROM `choices` WHERE `choices`.`question_ID` = 12
}

if (isset($_POST["get_question"])) {
	$get_question = $_POST["get_question"];
	$output = array();
	
	$sql = "SELECT * FROM `questions` WHERE question_ID =  $get_question LIMIT 1";
	 
	$result = mysqli_query($conn, $sql);

   while($row = mysqli_fetch_assoc($result)) {
		$output["question"] = $row["question"];

	}
	$sql = "SELECT * FROM `choices` WHERE question_ID  = $get_question LIMIT 4";
	$result = mysqli_query($conn, $sql);


	$i = 1;
   while($row = mysqli_fetch_assoc($result)) {
		if ($i == 1) {
			$output['a']["choice"] = $row["choice"];
			$output['a']["choice_ID"] = $row["choice_ID"];
			$output['a']["is_correct"] = $row["is_correct"];

		}
		elseif ($i == 2) {
			$output['b']["choice"] = $row["choice"];
			$output['b']["choice_ID"] = $row["choice_ID"];
			$output['b']["is_correct"] = $row["is_correct"];
		}
		elseif ($i == 3) {
			$output['c']["choice"] = $row["choice"];
			$output['c']["choice_ID"] = $row["choice_ID"];
			$output['c']["is_correct"] = $row["is_correct"];
		}
		else{
			$output['d']["choice"] = $row["choice"];
			$output['d']["choice_ID"] = $row["choice_ID"];
			$output['d']["is_correct"] = $row["is_correct"];
		}
	$i++;
	}
	
	
	echo json_encode($output);
}

if (isset($_POST['update_topic'])) {
	$update_topic = $_POST["update_topic"];
	$output = array();
	$sql = "SELECT * FROM `room_module_topic` WHERE topic_ID =   $update_topic LIMIT 1";
	 
	$result = mysqli_query($conn, $sql);

   while($row = mysqli_fetch_assoc($result)) {
		$output["topic_Title"] = $row["topic_Title"];

	}
	echo json_encode($output);
	
}

if (isset($_POST['update_subtopic'])) {
	$update_subtopic = $_POST["update_subtopic"];
	$output = array();
	$sql = "SELECT * FROM `room_module_subtopic` WHERE subtop_ID =   $update_subtopic LIMIT 1";
	 
	$result = mysqli_query($conn, $sql);

   while($row = mysqli_fetch_assoc($result)) {
		$output["subtop_Title"] = $row["subtop_Title"];
		$output["subtop_Content"] = $row["subtop_Content"];
		

	}
	echo json_encode($output);
	
}

if (isset($_POST['update_topics'])) {


	if ($_POST['update_topics'] == 'submit_edittopic') {
		$topic_ID = $_POST['ID'];
		$topic_name = $_POST['topic_name'];
	
		$sql = "UPDATE `room_module_topic` 
		SET `topic_Title` = '$topic_name' 
		WHERE `room_module_topic`.`topic_ID` =  $topic_ID;";
	
		if ($result = mysqli_query($conn, $sql)) {
		
		}
	}
	else{
		$subtopic_ID = $_POST['ID'];
		$topic_name = $_POST['topic_name'];
		$stopic_content = $_POST['stopic_content'];
		
		$sql = "UPDATE `room_module_subtopic` 
		SET `subtop_Content` = '$stopic_content' ,
		`subtop_Title` = '$topic_name'
		WHERE `room_module_subtopic`.`subtop_ID` = $subtopic_ID;";
	
		if ($result = mysqli_query($conn, $sql)) {
	
		}
	}
}

if (isset($_POST['submit_score'])) {
$quiz_ID = $_REQUEST['quiz_ID'];
 $user_id = $_SESSION['login_id'];
$answer = $_POST;
$count_question = $_POST["count_question"];
$is_correct = 0;
$z = count($answer);
$x = 1;
foreach ($answer as $value) {
	$x++;
	if ($value == "submit" ) {
		
	}
	else if ($z == $x){
		
	}
	else{
		$q = "select * from `choices` where choice_ID = $value and is_correct=1";
	    $res = mysqli_query($conn, $q);
	    $count = mysqli_num_rows($res);
	    $is_correct += $count;
  
	}
   
}


	
	 $sql = "SELECT * FROM `quiz_score`  WHERE quiz_ID = $quiz_ID AND user_ID = $user_id";
                                       
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
    	while($row = mysqli_fetch_assoc($result)) {
           $score_ID = $row['score_ID'];                               
        }
    	$sql = "UPDATE `quiz_score` SET `score` = '$is_correct' WHERE `quiz_score`.`score_ID` = '$score_ID';";
    	$result = mysqli_query($conn, $sql);
    }
    else{
    	$sql = "INSERT INTO `quiz_score` (`score_ID`, `quiz_ID`, `score`) VALUES (NULL, '$quiz_ID', '$is_correct');";
    	$result = mysqli_query($conn, $sql);

    }

    echo "<script>window.alert('Quiz score:".$is_correct.' correct out of '.$count_question." answer');
					parent.window.close();					
										</script>";
	

}
if (isset($_POST['get_score'])) {
 $quiz_ID = $_POST['get_score'];
 $user_id = $_SESSION['login_id'];
 	$sql = "select * from `questions` WHERE test_ID =1 AND quiz_ID = $quiz_ID";

	$result = mysqli_query($conn, $sql);
	$count_question = mysqli_num_rows($result) ;
$sql = "SELECT * FROM `quiz_score`  WHERE quiz_ID = $quiz_ID AND user_ID = $user_id";
$result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
    	while($row = mysqli_fetch_assoc($result)) {
          $score_ID = $row['score_ID']; 
          $score = $row['score'];                                
        }
        echo $score.' out of '.$count_question;
    }
}


if (isset($_POST['get_scoret'])) {
	$quiz_ID = $_POST['get_scoret'];
  	$sql = "select * from `questions` WHERE test_ID =1 AND quiz_ID = $quiz_ID";

	$result = mysqli_query($conn, $sql);
	$count_question = mysqli_num_rows($result) ;
	$sql = "SELECT qs.*,rsd.* FROM `quiz_score` qs
	LEFT JOIN user_accounts ua ON qs.user_ID =  ua.user_ID 
	LEFT JOIN record_student_details rsd ON ua.user_ID = rsd.user_ID
	WHERE quiz_ID = $quiz_ID ORDER BY `qs`.`score`  DESC";
	$result = mysqli_query($conn, $sql);
	?>
	<table class="table table-bordered">
		<thead>
			<th>#</th>
			<th>LRN</th>
			<th>Name</th>
			<th>Score</th>
		</thead>
		<tbody>
			<?php 
			 if (mysqli_num_rows($result) > 0) {
			 	$m = 1;
    		while($row = mysqli_fetch_assoc($result)) {
    			$score_name = $row["rsd_FName"].' '.$row["rsd_MName"].' '.$row["rsd_LName"];
    			$score_lrn = $row["rsd_StudNum"];
    		    $std_score = $row["score"];
				?>
				<tr>
					
					<td><?php echo $m?></td>
					<td><?php echo $score_lrn?></td>
					<td><?php echo $score_name?></td>
					<td><?php echo $std_score?> / <?php echo $count_question?></td>
				</tr>
				<?php
				$m++;
			}
			}
			else{
				echo "<tr><td colspan='4'>No Score Available</td></tr>";
			}
			?>
		</tbody>
	</table>
	<?php
}




?>
