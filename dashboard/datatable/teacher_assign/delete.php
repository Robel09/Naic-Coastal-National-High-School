<?php

include('db.php');
include("function.php");

if(isset($_POST["sy_ID"]))
{
	
	$statement = $conn->prepare(
		"DELETE FROM `schoolyear` WHERE sy_ID = :sy_ID"
	);
	$result = $statement->execute(
		array(
			':sy_ID'	=>	$_POST["sy_ID"]
		)
	);
	
	if(!empty($result))
	{
		echo 'Data Deleted';
	}
}



?>