<?php
include('db.php');
include('function.php');
if(isset($_POST["operation"]))
{

	if($_POST["operation"] == "Add")
	{
		
		$rsy_syear = $_POST["rsy_syear"];
		$sql = "INSERT INTO `ref_schoolyear` (`rsy_ID`, `rsy_syear`) VALUES (NULL, :rsy_syear);";
		$statement = $conn->prepare($sql);
		
		$result = $statement->execute(
			array(
				':rsy_syear'			=>	$rsy_syear
			)
		);

		if(!empty($result))
		{
			echo 'Successfully Schoolyear Added';
		}
	}

	if($_POST["operation"] == "Edit")
	{
		
		$rsy_ID = $_POST["rsy_ID"];
		
		$rsy_syear = $_POST["rsy_syear"];
		 $sql ="UPDATE `ref_schoolyear` SET `rsy_syear` = :rsy_syear WHERE `ref_schoolyear`.`rsy_ID` = :rsy_ID;";
		
		$statement = $conn->prepare($sql);
		
		$result = $statement->execute(
				array(
					':rsy_ID'			=>	$rsy_ID,
					':rsy_syear'		=>	$rsy_syear
				)
			);
		if(!empty($result))
		{
			echo 'Data Updated';
		}
	}
}
?>
