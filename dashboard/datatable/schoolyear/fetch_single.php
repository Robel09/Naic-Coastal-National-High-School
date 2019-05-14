<?php
include('db.php');
include('function.php');
if(isset($_POST["rsy_ID"]))
{
	$output = array();
	$statement = $conn->prepare(
		"SELECT * FROM `ref_schoolyear`
		WHERE rsy_ID = '".$_POST["rsy_ID"]."' 
		LIMIT 1"
	);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{

		$output["rsy_syear"] = $row["rsy_syear"];
	
	}
	echo json_encode($output);
}
?>