<?php

include('db.php');
include("function.php");

if(isset($_POST["section_ID"]))
{
	
	$statement = $conn->prepare(
		"DELETE FROM `ref_section` WHERE section_ID = :section_ID"
	);
	$result = $statement->execute(
		array(
			':section_ID'	=>	$_POST["section_ID"]
		)
	);
	
	if(!empty($result))
	{
		echo 'Data Deleted';
	}
}



?>