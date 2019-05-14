<?php
include('db.php');
include('function.php');
if(isset($_POST["operation"]))
{

	if($_POST["operation"] == "Add")
	{
		
		$section_Name = $_POST["section_Name"];
		$sql = "INSERT INTO `ref_section` (`section_ID`, `section_Name`) VALUES (NULL, :section_Name);";
		$statement = $conn->prepare($sql);
		
		$result = $statement->execute(
			array(
				':section_Name'			=>	$section_Name
			)
		);

		if(!empty($result))
		{
			echo 'Successfully Section Added';
		}
	}

	if($_POST["operation"] == "Edit")
	{
		
		$section_ID = $_POST["section_ID"];
		
		$section_Name = $_POST["section_Name"];
		 $sql ="UPDATE `ref_section` SET `section_Name` = :section_Name WHERE `ref_section`.`section_ID` = :section_ID;";
		
		$statement = $conn->prepare($sql);
		
		$result = $statement->execute(
				array(
					':section_ID'			=>	$section_ID,
					':section_Name'			=>	$section_Name
				)
			);
		if(!empty($result))
		{
			echo 'Data Updated';
		}
	}
}
?>
