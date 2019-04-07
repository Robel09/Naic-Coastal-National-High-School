<?php
include('db.php');
include('function.php');
if(isset($_POST["operation"]))
{

	if($_POST["operation"] == "Add")
	{
		 
		$teacherID = $_POST["teacherID"];
		$firstname = $_POST["firstname"];
		$middlename = $_POST["middlename"];
		$lastname = $_POST["lastname"];
		$suffix = $_POST["suffix"];
		$sex = $_POST["sex"];
		$contact = $_POST["contact"];
		$address = $_POST["address"];
			
		$sql = "SELECT * FROM `record_teacher_details` WHERE `rtd_EmpID`= :teacherID;";
		$statement = $connection->prepare($sql);
		$statement->bindParam(':teacherID', $teacherID, PDO::PARAM_STR);
		$result = $statement->execute();
		$resultrows = $statement->rowCount();

		if (empty($resultrows)) { 
		   // if username is available

			$sql = "INSERT INTO `record_teacher_details` (
			`rtd_ID`,
			 `user_ID`,
			  `rtd_EmpID`,
			   `rtd_FName`,
			    `rtd_MName`,
			     `rtd_LName`,
			      `suffix_ID`,
			       `sex_ID`,
			        `rtd_Contact`,
			         `rtd_Address`) 
			         VALUES (
			         '',
			          '',
			           :teacherID,
			            :firstname,
			             :middlename,
			              :lastname,
			               :suffix,
			                :sex,
			                 :contact,
			                  :address);";
			$statement = $connection->prepare($sql);
			
			$result = $statement->execute(
				array(	
					':teacherID' 	=> $teacherID,
					':firstname' 	=> $firstname,
					':middlename' 	=> $middlename,
					':lastname' 	=> $lastname,
					':suffix' 		=> $suffix,
					':sex' 			=> $sex,
					':contact' 		=> $contact,
					':address' 		=> $address
				)
			);

			if(!empty($result))
			{
				echo 'Successfully Teacher Added';
			}

		} else {
		   // if username is not available
			echo 'Teacher ID is Already Use';

		}

	
	}

	if($_POST["operation"] == "Edit")
	{
		
		$rtd_ID = $_POST["rtd_ID"];
		
		$teacherID = $_POST["teacherID"];
		$firstname = $_POST["firstname"];
		$middlename = $_POST["middlename"];
		$lastname = $_POST["lastname"];
		$suffix = $_POST["suffix"];
		$sex = $_POST["sex"];
		$contact = $_POST["contact"];
		$address = $_POST["address"];
		$sql = "SELECT * FROM `record_teacher_details` WHERE `rtd_EmpID`= :teacherID;";
		$statement = $connection->prepare($sql);
		$statement->bindParam(':teacherID', $teacherID, PDO::PARAM_STR);
		$result = $statement->execute();
		$resultrows = $statement->rowCount();

		if (empty($resultrows)) { 
			$sql ="UPDATE `record_teacher_details` 
			SET 
			`rtd_EmpID` = :teacherID,
			`rtd_FName` = :firstname,
			`rtd_MName` = :middlename,
			`rtd_LName` = :lastname,
			`suffix_ID` = :suffix,
			`sex_ID` = :sex,
			`rtd_Contact` = :contact,  
			`rtd_Address` = :address   
			WHERE `record_teacher_details`.`rtd_ID` = :rtd_ID;";
			
			$statement = $connection->prepare($sql);
			
			$result = $statement->execute(
					array(
						':rtd_ID'		=>	$rtd_ID ,
						':teacherID' 	=> $teacherID,
						':firstname' 	=> $firstname,
						':middlename' 	=> $middlename,
						':lastname' 	=> $lastname,
						':suffix' 		=> $suffix,
						':sex' 			=> $sex,
						':contact' 		=> $contact,
						':address' 		=> $address
					)
				);
			if(!empty($result))
			{
				echo 'Data Updated';
			}
		}
		else {
		   
			$fetch = $statement->fetchAll();
			foreach($fetch as $row)
			{
				$chk_ID = $row["rtd_ID"];
				$chk_TeachID = $row["rtd_EmpID"];
			}

			if ($chk_TeachID == $teacherID AND $chk_ID  == $rtd_ID) 
			{
				$sql ="UPDATE `record_teacher_details` 
				SET 
				`rtd_EmpID` = :teacherID,
				`rtd_FName` = :firstname,
				`rtd_MName` = :middlename,
				`rtd_LName` = :lastname,
				`suffix_ID` = :suffix,
				`sex_ID` = :sex,
				`rtd_Contact` = :contact,  
				`rtd_Address` = :address   
				WHERE `record_teacher_details`.`rtd_ID` = :rtd_ID;";
				
				$statement = $connection->prepare($sql);
				
				$result = $statement->execute(
						array(
							':rtd_ID'		=>	$rtd_ID ,
							':teacherID' 	=> $teacherID,
							':firstname' 	=> $firstname,
							':middlename' 	=> $middlename,
							':lastname' 	=> $lastname,
							':suffix' 		=> $suffix,
							':sex' 			=> $sex,
							':contact' 		=> $contact,
							':address' 		=> $address
						)
					);
				if(!empty($result))
				{
					echo 'Data Updated';
				}
			}
			else{

				echo 'Teacherr ID is Already Use';
			}
			

		}
		
	}
}
?>
