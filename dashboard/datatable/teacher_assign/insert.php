<?php
include('db.php');
include('function.php');
if(isset($_POST["operation"]))
{

	if($_POST["operation"] == "Add")
	{


		// $ast_teacherName = $_POST["ast_teacherName"];
		$ast_section =$_POST["ast_section"];
		$ast_sy =$_POST["ast_sy"];
		$rtd_ID =$_POST["rtd_ID"];
		$ast_status =$_POST["ast_status"];
		
		
		
		
		
			$sql = "SELECT * FROM `schoolyear` WHERE rtd_ID = :rtd_ID AND sy_year = '2018 - 2019'";
			$statement = $conn->prepare($sql);
			$statement->bindParam(':rtd_ID', $rtd_ID, PDO::PARAM_STR);
			$result = $statement->execute();
			$resultrows = $statement->rowCount();
			if (empty($resultrows)) { 

				$sql = "INSERT INTO `schoolyear` (`sy_ID`, `rtd_ID`, `sy_year`, `sy_stat`, `section_ID`) VALUES (NULL, :rtd_ID, :ast_sy, :ast_status, :ast_section);";
				$statement = $conn->prepare($sql);
				
				$result = $statement->execute(
					array(
						':rtd_ID'			=>	$rtd_ID,
						':ast_sy'			=>	$ast_sy,
						':ast_section'			=>	$ast_section
					)
				);

				if(!empty($result))
				{
					echo 'Successfully Assigned';
				}
			}
		
			
	}

	if($_POST["operation"] == "Edit")
	{
		$ast_section =$_POST["ast_section"];
		$ast_sy =$_POST["ast_sy"];
		$rtd_ID =$_POST["rtd_ID"];
		$sy_ID =$_POST["sy_ID"];
		$ast_status =$_POST["ast_status"];
		
		 $sql ="UPDATE `schoolyear` SET `section_ID` = :ast_section,sy_year = :ast_sy,sy_stat = :ast_status WHERE `schoolyear`.`sy_ID` = :sy_ID;";
		
		$statement = $conn->prepare($sql);
		
		$result = $statement->execute(
				array(
					':sy_ID'			=>	$sy_ID,
					':ast_sy'		=>	$ast_sy,
					':ast_status'		=>	$ast_status,
					':ast_section'		=>	$ast_section

				)
			);
		if(!empty($result))
		{
			echo 'Data Updated';
		}
	}
}
?>
