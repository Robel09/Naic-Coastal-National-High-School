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
if (isset($_POST['assignment_due'])) {
	print_r($_POST);
}
?>