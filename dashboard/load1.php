<?php
require_once("../class.user.php");

$chingchong = new USER(); 

if (isset($_POST['action'])) {
	

	if ($_POST['action'] == "get_topic"){
		$output = array();
		$stmt = $chingchong->runQuery("SELECT * FROM `room_module_topic` WHERE mtopic_ID  = '".$_POST["topic_ID"]."' 
				LIMIT 1");
		$stmt->execute();
		$result = $stmt->fetchAll();
		foreach($result as $row)
		{

		
			
			$output["mtopic_ID"] = $row["mtopic_ID"];
			$output["mtopic_Title"] = $row["mtopic_Title"];
		
		}
		
		echo json_encode($output);

	}
	if ($_POST['action'] == "get_subtopic"){
		$output = array();
		$stmt = $chingchong->runQuery("SELECT * FROM `room_module_subtopic` WHERE submtop_ID  = '".$_POST["submtop_ID"]."' 
				LIMIT 1");
		$stmt->execute();
		$result = $stmt->fetchAll();
		foreach($result as $row)
		{

		
			
			$output["submtop_ID"] = $row["submtop_ID"];
			$output["submtop_Title"] = $row["submtop_Title"];
			$output["submtop_Content"] = $row["submtop_Content"];
		
		}
		
		echo json_encode($output);

	}
	if ($_POST['action'] == "add_topic"){
		
		$mod_ID = $_POST["mod_ID"];
		$topic_title = $_POST["topic_title"];
		$stmt = $chingchong->runQuery("INSERT INTO `room_module_topic` (`mtopic_ID`, `mod_ID`, `mtopic_Title`) VALUES (NULL, '$mod_ID', '$topic_title');");
		$stmt->execute();
		echo "Successfully  Add Topic";

	}
	if ($_POST['action'] == "update_topic"){
		

		$topic_ID = $_POST["topic_ID"];
		$topic_title = $_POST["topic_title"];
		$stmt = $chingchong->runQuery("UPDATE `room_module_topic` 
			SET `mtopic_Title` = '$topic_title'
			 WHERE `room_module_topic`.`mtopic_ID` = $topic_ID;");
		$stmt->execute();
		echo "Successfully  Update Topic";
	}

	if ($_POST['action'] == "update_subtopic"){
		

		$submtop_ID = $_POST["submtop_ID"];
		$subtopic_title = $_POST["subtopic_title"];
		$subtopic_content = $_POST["subtopic_content"];

		$stmt = $chingchong->runQuery("UPDATE `room_module_subtopic` 
			SET `submtop_Title` = '$subtopic_title',
			`submtop_Content` = '$subtopic_content'
			WHERE `room_module_subtopic`.`submtop_ID` = $submtop_ID;");
		$stmt->execute();
		echo "Successfully  Update Subtopic";
	}
	
	
	if ($_POST['action'] == "add_subtopic"){
		
		$mod_ID = $_POST["mod_ID"];
		$topic_ID = $_POST["topic_ID"];
		$subtopic_title = $_POST["subtopic_title"];
		$subtopic_content = $_POST["subtopic_content"];
		$stmt = $chingchong->runQuery("INSERT INTO `room_module_subtopic` 
			(`submtop_ID`, `mtopic_ID`, `submtop_Title`, `submtop_Content`) 
			VALUES (NULL, '$topic_ID', '$subtopic_title', '$subtopic_content');");
		$stmt->execute();
		echo "Successfully  Add SubTopic";

	}

	if ($_POST['action'] == "delete_topic"){
		
		$topic_ID = $_POST["topic_ID"];


		$stmt1 = $chingchong->runQuery("DELETE FROM `room_module_subtopic` WHERE `mtopic_ID` = $topic_ID");
		$stmt1->execute();

		$stmt2 = $chingchong->runQuery("DELETE FROM `room_module_topic` WHERE `mtopic_ID` = $topic_ID");
		$stmt2->execute();

		echo "Successfully  Delete Topic";

	}

	if ($_POST['action'] == "delete_subtopic"){
		
		$subtopicID = $_POST["subtopicID"];


		$stmt1 = $chingchong->runQuery("DELETE FROM `room_module_subtopic` WHERE `submtop_ID` = $subtopicID");
		$stmt1->execute();


		echo "Successfully  Delete Subtopic";

	}

	


	
	
	
}











 

?>