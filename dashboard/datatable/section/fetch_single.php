<?php
include('db.php');
include('function.php');
if(isset($_POST["section_ID"]))
{
	$output = array();
	$statement = $conn->prepare(
		"SELECT * FROM `ref_section`
		WHERE section_ID = '".$_POST["section_ID"]."' 
		LIMIT 1"
	);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{

		$output["section_Name"] = $row["section_Name"];
	
	}
	echo json_encode($output);
}
?>