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

if (isset($_POST["submit_quiz"])) {
	$sy_ID = $_REQUEST["sy_ID"];
	$q_Name = $_POST["q_Name"];
	$sql = "INSERT INTO `quiz` (`quiz_ID`, `sy_ID`, `quiz_Name`) VALUES (NULL, '$sy_ID', '$q_Name');";
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
?>