<?php

include('db.php');
include("function.php");

if(isset($_POST["rsy_ID"]))
{
	
	$statement = $conn->prepare(
		"DELETE FROM `ref_schoolyear` WHERE rsy_ID = :rsy_ID"
	);
	$result = $statement->execute(
		array(
			':rsy_ID'	=>	$_POST["rsy_ID"]
		)
	);
	
	if(!empty($result))
	{
		echo 'Data Deleted';
	}
}



?>