<?php
include('db.php');
include('function.php');
if(isset($_POST["rtd_ID"]))
{
	$output = array();
	$statement = $connection->prepare(
		"SELECT * FROM `record_teacher_details`
		WHERE rtd_ID = '".$_POST["rtd_ID"]."' 
		LIMIT 1"
	);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		$output["teacherID"] = $row["rtd_EmpID"];
		$output["firstname"] = $row["rtd_FName"];
		$output["middlename"] = $row["rtd_MName"];
		$output["lastname"] = $row["rtd_LName"];
		$output["suffix"] = $row["suffix_ID"];
		$output["sex"] = $row["sex_ID"];
		$output["contact"] = $row["rtd_Contact"];
		$output["address"] = $row["rtd_Address"];
	
	}
	echo json_encode($output);
}
?>