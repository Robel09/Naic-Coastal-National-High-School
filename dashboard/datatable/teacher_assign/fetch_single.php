<?php
include('db.php');
include('function.php');
if(isset($_POST["sy_ID"]))
{
	$output = array();
	$statement = $conn->prepare(
		"SELECT * FROM `schoolyear` `sy`
LEFT JOIN `record_teacher_details` `rtd` ON `sy`.`rtd_ID` = `rtd`.`rtd_ID`
LEFT JOIN `ref_section` rs ON `sy`.`section_ID` = `rs`.`section_ID`
		WHERE `sy`.`sy_ID` = '".$_POST["sy_ID"]."' 
		LIMIT 1"
	);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		$output["ast_fullname"] = $row["rtd_FName"].' '.$row["rtd_MName"].' '.$row["rtd_LName"];
		$output["ast_section"] = $row["section_ID"];
		$output["ast_year"] = $row["sy_year"];
		$output["rtd_ID"] = $row["rtd_ID"];
		$output["ast_status"] = $row["sy_stat"];
	
		
	}
	echo json_encode($output);
}
?>