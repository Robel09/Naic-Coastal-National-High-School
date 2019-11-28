<?php
require_once('dbconfig.php');

class USER
{	

	private $conn;
	public function __construct()
	{
		$database = new Database();
		$db = $database->dbConnection();
		$this->conn = $db;
    }
	
	public function runQuery($sql)
	{
		$stmt = $this->conn->prepare($sql);
		return $stmt;
	}
	//log in function 
	public function doLogin($login_user,$login_password)
	{
		try
		{
			$stmt = $this->conn->prepare("SELECT user_ID, lvl_ID ,user_Name, user_Pass,user_Img FROM user_account WHERE user_Name=:user_Name");
			$stmt->execute(array(':user_Name'=>$login_user));
			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
			if($stmt->rowCount() == 1)
			{
				if(password_verify($login_password, $userRow['user_Pass']))
				{
					$_SESSION['lvl_ID'] = $userRow['lvl_ID'];
					$_SESSION['user_ID'] = $userRow['user_ID'];
					$_SESSION['user_Name'] = $userRow['user_Name'];
					if (!empty($userRow['user_Img'])) {
					 $s_img = 'data:image/jpeg;base64,'.base64_encode($userRow['user_Img']);
					}
					else{
					  $s_img = "../assets/img/users/default.jpg";
					}
					 $_SESSION['user_Img'] = $s_img;
					return true;
				}
				else
				{
					return false;
				}
			}
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	// register function
	public function register($reg_studentnum,$reg_password,$reg_email)
	{
		try
		{	
			
			$stmt = $this->conn->prepare("SELECT * FROM `record_student_details` WHERE rsd_StudNum = :reg_studentnum OR rsd_Email = :reg_email LIMIT 1");
			$stmt->bindparam(":reg_studentnum", $reg_studentnum);	
			$stmt->bindparam(":reg_email", $reg_email);	
			$stmt->execute();
			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
			if($stmt->rowCount() == 1)
			{
				$rsd_ID = $userRow["rsd_ID"];
				$new_password = password_hash($reg_password, PASSWORD_DEFAULT);

				$stmt = $this->conn->prepare("INSERT INTO `user_account` (`user_ID`, `lvl_ID`, `user_Img`, `user_Name`, `user_Pass`, `user_Registered`) VALUES (NULL, 1, NULL, :reg_studentnum, :reg_password, CURRENT_TIMESTAMP);");
						
				$stmt->bindparam(":reg_studentnum", $reg_studentnum);	 
				$stmt->bindparam(":reg_password", $new_password);	
				$stmt->execute();
				$user_ID = $this->conn->lastInsertId();

				$stmt = $this->conn->prepare("UPDATE `record_student_details` SET `user_ID` = :user_ID WHERE `record_student_details`.`rsd_ID` = :rsd_ID;");
				$stmt->bindparam(":user_ID", $user_ID);	
				$stmt->bindparam(":rsd_ID", $rsd_ID); 
				$stmt->execute();		

				
				
				return $stmt;
			}
			


			
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}				
	}
	
	public function is_loggedin()
	{
		if(isset($_SESSION['user_ID']))
		{
			return true;
		}
	}
	public function check_accesslevel($page_level)
	{
		if (isset($_SESSION['lvl_ID'])) {

			if ($_SESSION['lvl_ID'] !=  $page_level) {
			    header('Location: ../error');
			}
		}
	}
	public function redirect_dashboard()
	{
		if (isset($_SESSION['lvl_ID'])) 
		{
			header("Location: dashboard");
			
		}
	}
	public function redirect($url)
	{
		header("Location: $url");
	}
	public function doLogout()
	{
		session_destroy();
		unset($_SESSION['user_ID']);
		return true;
	}
	public function parseUrl()
	{
		if(isset($_GET['url'])){

			$url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));

			return $url;

		}

	}
	public function getUsername()
	{
		echo $_SESSION['user_Name'];
	}
	public function getUserPic()
	{
		echo $_SESSION['user_Img'] ;
	}
	public function page_url()
	{
		$url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		return $url;
	}
	public function close()
	{
		return mysql_close();
	}
	//ACCOUNT PAGE
	public function user_level_option()
	{
		$query ="SELECT * FROM `user_level`";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		$result = $stmt->fetchAll();
		
		foreach($result as $row)
		{
			echo '<option value="'.$row["lvl_ID"].'">'.$row["lvl_Name"].'</option>';
		}
		
	}
	public function ref_test_type()
	{
		$query ="SELECT * FROM `ref_test_type`";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		$result = $stmt->fetchAll();
		
		foreach($result as $row)
		{
			echo '<option value="'.$row["tstt_ID"].'">'.$row["tstt_Name"].'</option>';
		}
	}
		public function ref_status()
	{
		$query ="SELECT * FROM `ref_status`";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		$result = $stmt->fetchAll();
		
		foreach($result as $row)
		{
			echo '<option value="'.$row["status_ID"].'">'.$row["status_Name"].'</option>';
		}
		
	}
	public function ref_year_level()
	{
		$query ="SELECT * FROM `ref_year_level`";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		$result = $stmt->fetchAll();
		
		foreach($result as $row)
		{
			echo '<option value="'.$row["yl_ID"].'">'.$row["yl_Name"].'</option>';
		}
		
	}
		public function ref_position()
	{
		$query ="SELECT * FROM `ref_position`";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		$result = $stmt->fetchAll();
		
		foreach($result as $row)
		{
			echo '<option value="'.$row["pos_ID"].'">'.$row["pos_Name"].'</option>';
		}
		
	}
		public function ref_section()
	{
		$query ="SELECT * FROM `ref_section`";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		$result = $stmt->fetchAll();
		
		foreach($result as $row)
		{
			echo '<option value="'.$row["section_ID"].'">'.$row["section_Name"].'</option>';
		}
		
	}
		public function ref_semester()
	{
		$query ="SELECT *,CONCAT(YEAR(sem_start),' - ',YEAR(sem_end)) sem_year FROM `ref_semester`";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		$result = $stmt->fetchAll();
		
		foreach($result as $row)
		{
			$stat_ID = $row["stat_ID"];
			if($stat_ID == "1")
			{
				$stat = " (Active)";
			}
			else{
				$stat = " (Deactivate)";
			}
			echo '<option value="'.$row["sem_ID"].'">'.$row["sem_year"].$stat.'</option>';
		}
		
	}
		public function ref_subject()
	{
		$query ="SELECT * FROM `ref_subject`";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		$result = $stmt->fetchAll();
		
		foreach($result as $row)
		{
			echo '<option value="'.$row["subject_ID"].'">'.$row["subject_Title"].'</option>';
		}
		
	}
	

	public function ref_sex()
	{
		$query ="SELECT * FROM `ref_sex`";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		$result = $stmt->fetchAll();
		
		foreach($result as $row)
		{
			echo '<option value="'.$row["sex_ID"].'">'.$row["sex_Name"].'</option>';
		}
		
	}
	public function user_suffix_option()
	{
		$query ="SELECT * FROM `ref_suffixname`";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		$result = $stmt->fetchAll();
		
		foreach($result as $row)
		{
			echo '<option value="'.$row["suffix_ID"].'">'.$row["suffix"].'</option>';
		}
		
	}
	public function get_suffix($suffix_ID)
	{
		$query ="SELECT * FROM `ref_suffixname` WHERE suffix_ID = $suffix_ID";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		$result = $stmt->fetchAll();
		
		foreach($result as $row)
		{
			if ($row["suffix"] == "N/A")
			{
				$suffix = "";
			}
			else
			{
				$suffix =  $row["suffix"];
			}
		}
		
	}
	public function get_test($test_ID)
	{
		$query ="SELECT * FROM `room_test` WHERE test_ID = $test_ID";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		$result = $stmt->fetchAll();
		return $result;
		
	}
	public function get_score($score_ID)
	{
		$query ="SELECT * FROM `room_test_score` WHERE score_ID = $score_ID";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		$result = $stmt->fetchAll();
		return $result;
		
	}

	public function user_sex_option()
	{
		$query ="SELECT * FROM `ref_sex`";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		$result = $stmt->fetchAll();
		
		foreach($result as $row)
		{
			echo '<option value="'.$row["sex_ID"].'">'.$row["sex_Name"].'</option>';
		}
		
	}
	
	public function user_marital_option()
	{
		$query ="SELECT * FROM `ref_marital`";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		$result = $stmt->fetchAll();
		
		foreach($result as $row)
		{
			echo '<option value="'.$row["marital_ID"].'">'.$row["marital_Name"].'</option>';
		}
		
	}
	public function user_course_option()
	{
		$query ="SELECT * FROM `cvsu_course`";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		$result = $stmt->fetchAll();
		
		foreach($result as $row)
		{
			echo '<option value="'.$row["course_ID"].'">'.$row["course_Name"].'</option>';
		}
		
	}
	
	//SCHOOL YEAR PAGE
	public function schoolyear_status_option()
	{
		$query ="SELECT * FROM `status`";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		$result = $stmt->fetchAll();
		
		foreach($result as $row)
		{
			echo '<option value="'.$row["status_ID"].'">'.$row["status_Name"].'</option>';
		}
		
	}
	public function profile_email()
	{
		$user_type = "";
		$user_type_acro = "";
		if ($_SESSION['lvl_ID'] == "1")
		{
			$user_type = "student";
			$user_type_acro = "rsd";
		}
		if ($_SESSION['lvl_ID'] == "2")
		{
			$user_type = "instructor";
			$user_type_acro = "rid";
		}
		if ($_SESSION['lvl_ID'] == "3")
		{
			$user_type = "admin";
			$user_type_acro = "rad";
		}
		$query ="SELECT ".$user_type_acro."_Email FROM `record_".$user_type."_details` WHERE user_ID = ".$_SESSION['user_ID'];
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		$result = $stmt->fetchAll();
		
	
		if($stmt->rowCount() == 1)
		{
			foreach($result as $row)
			{
				echo $row[$user_type_acro."_Email"];
			}
		}
		else{
			echo "Empty";
		}
	}
			public function profile_sex()
	{
		$user_type = "";
		$user_type_acro = "";
		if ($_SESSION['lvl_ID'] == "1")
		{
			$user_type = "student";
		}
		if ($_SESSION['lvl_ID'] == "2")
		{
			$user_type = "instructor";
		}
		if ($_SESSION['lvl_ID'] == "3")
		{
			$user_type = "admin";
		}
		$query ="SELECT sex_Name FROM `record_".$user_type."_details`  rid
				LEFT JOIN ref_sex sex ON sex.sex_ID = rid.sex_ID
				WHERE rid.user_ID = ".$_SESSION['user_ID'];
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		$result = $stmt->fetchAll();
		if($stmt->rowCount() == 1)
		{
			foreach($result as $row)
			{
				echo $row["sex_Name"];
			}
		}
		else{
			echo "Empty";
		}	
	}
	public function profile_address()
	{
		$user_type = "";
		$user_type_acro = "";
		if ($_SESSION['lvl_ID'] == "1")
		{
			$user_type = "student";
			$user_type_acro = "rsd";
		}
		if ($_SESSION['lvl_ID'] == "2")
		{
			$user_type = "instructor";
			$user_type_acro = "rid";
		}
		if ($_SESSION['lvl_ID'] == "3")
		{
			$user_type = "admin";
			$user_type_acro = "rad";
		}
		$query ="SELECT ".$user_type_acro."_Address FROM `record_".$user_type."_details` WHERE user_ID = ".$_SESSION['user_ID'];
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		$result = $stmt->fetchAll();
		if($stmt->rowCount() == 1)
		{
			foreach($result as $row)
			{
				echo $row[$user_type_acro."_Address"];
			}
		}
		else{
			echo "Empty";
		}	
	}
	public function profile_name()
	{
		$user_type = "";
		$user_type_acro = "";
		if ($_SESSION['lvl_ID'] == "1")
		{
			$user_type = "student";
			$user_type_acro = "rsd";
		}
		if ($_SESSION['lvl_ID'] == "2")
		{
			$user_type = "instructor";
			$user_type_acro = "rid";
		}
		if ($_SESSION['lvl_ID'] == "3")
		{
			$user_type = "admin";
			$user_type_acro = "rad";
		}
		$query ="SELECT ".$user_type_acro."_FName,".$user_type_acro."_MName,".$user_type_acro."_LName, suffix_ID FROM `record_".$user_type."_details` WHERE user_ID = ".$_SESSION['user_ID'];
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		$result = $stmt->fetchAll();
		if($stmt->rowCount() == 1)
		{
			foreach($result as $row)
			{
				$full_name = "";
				$full_name .= $row[$user_type_acro."_LName"].", ";
				$full_name .= $row[$user_type_acro."_FName"]." ";
				$full_name .= $row[$user_type_acro."_MName"]." ";
				$full_name .= $this->get_suffix($row["suffix_ID"]);

			}
				echo $full_name;
		}
		else{
			echo "Empty";
		}	
	}
	public function profile_school_id()
	{
		$user_type = "";
		$user_type_acro = "";
		if ($_SESSION['lvl_ID'] == "1")
		{
			$user_type = "student";
			$id_type = "rsd_StudNum";
		}
		if ($_SESSION['lvl_ID'] == "2")
		{
			$user_type = "instructor";
			$id_type = "rid_EmpID";
		}
		if ($_SESSION['lvl_ID'] == "3")
		{
			$user_type = "admin";
			$id_type = "rad_EmpID";
		}
		$query ="SELECT ".$id_type." FROM `record_".$user_type."_details` WHERE user_ID = ".$_SESSION['user_ID'];
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		$result = $stmt->fetchAll();
		if($stmt->rowCount() == 1)
		{
			foreach($result as $row)
			{
				echo $row[$id_type];
			}
		}
		else{
			echo "Empty";
		}	
	}
	public function  student_level()
	{
		if ($_SESSION['lvl_ID'] == "1")
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	public function  instructor_level()
	{
		if ($_SESSION['lvl_ID'] == "2")
		{
			return true;
		}
		else
		{
			return false;
		}	
	}
	public function  admin_level()
	{
		if ($_SESSION['lvl_ID'] == "3")
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function room_adviser($room_ID){
		$output = array();
		try{
		
			$query = "SELECT 
			rm.room_ID,
			rid.rid_FName,
			rid.rid_MName,
			rid.rid_LName,
			sn.suffix,
			sec.section_Name,
			CONCAT(YEAR(sem.sem_start),' - ',YEAR(sem.sem_end)) semyear,
			sta.status_Name
			FROM `room` rm 
			LEFT JOIN record_instructor_details rid ON rid.rid_ID = rm.rid_ID
			LEFT JOIN ref_suffixname sn ON sn.suffix_ID = rid.suffix_ID
			LEFT JOIN ref_section sec ON sec.section_ID = rm.section_ID
			LEFT JOIN ref_semester sem ON sem.sem_ID = rm.sem_ID
			LEFT JOIN ref_status sta ON sta.status_ID  = rm.status_ID

			WHERE rm.room_ID = '$room_ID' LIMIT 1";
			$stmt = $this->conn->prepare($query);
			$stmt->execute();
			$result = $stmt->fetchAll();
		
			if($stmt->rowCount() == 1)
			{
				foreach($result as $row)
				{

					if($row["suffix"] =="N/A")
					{
						$suffix = "";
					}
					else
					{
						$suffix = $row["suffix"];
					}

					if($row["rid_MName"] ==" " || $row["rid_MName"] == NULL || empty($row["rid_MName"]) )
					{
						$mname = " ";
					}
					else
					{
						$mname = $row["rid_MName"].'. ';
					}

					$output["fullname"] =  $row["rid_FName"].' '.$mname.$row["rid_LName"].' '.$suffix;
					$output["schoolyear"] =  $row["semyear"];
					$output["sectionname"] =  $row["section_Name"];
					
				}
			}
			else{
				
				$output["fullname"] =  "Empty";  
				$output["schoolyear"] =  "Empty"; 
				$output["sectionname"] =  "Empty";
			}

		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
		return $output;
	}
	public function test_choices($choices_ID,$i_x_n){
		
		$query ="SELECT * FROM `room_test_choices` WHERE question_ID = $choices_ID";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		$result = $stmt->fetchAll();
		
		$x = 1;
		foreach($result as $row)
		{
			?>
			<div class="form-check ">
                <input class="form-check-input" type="radio" name="q_coption<?php echo $i_x_n?>" id="inlineRadio<?php echo $x?>" value="<?php echo $row["choice_ID"]?>">
                <label class="form-check-label" for="inlineRadio<?php echo $x?>"><?php echo $row["choice"]?></label>
             </div>
			<?php

			$x++;
		}
	}
	public function test_question($test_ID){
		$query ="SELECT * FROM `room_test_questions` WHERE test_ID = $test_ID AND  type  = 1";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		$result = $stmt->fetchAll();
		$count = $stmt->rowCount();
		$x = 1;
		if($count < 1){
			// echo "NO CONTENT";
		}
		else{

			echo '<h4>Multiple Choices</h4>';
			foreach($result as $row)
			{
				

				?>
				<div class="form-group col-md-4">
	              <label for=""><?php echo $x?>.) <?php echo $row["question"]?></label>
	              <?php $this->test_choices($row["question_ID"],$x)?>
	            </div>
				<?php

				$x++;
			}

		}
		echo "<hr>";
		$query1 ="SELECT * FROM `room_test_questions` WHERE test_ID = $test_ID AND  type  = 2";
		$stmt1 = $this->conn->prepare($query1);
		$stmt1->execute();
		$result1 = $stmt1->fetchAll();
		$count1 = $stmt1->rowCount();
		$x1 = 1;
		if($count1 < 1){
			// echo "NO CONTENT";
		}
		else{
			echo '<h4>True or False</h4>';
			foreach($result1 as $row)
			{
				

				?>
				<div class="form-group col-md-4">
	              <label for=""><?php echo $x1?>.) <?php echo $row["question"]?></label>
	              <?php $this->test_choices($row["question_ID"],$x1+3)?>
	            </div>
				<?php

				$x1++;
			}

		}
		// $tcount = $count+$count1;

		
		?>
		<input type="hidden" name="qcount" value="<?php echo $count;?>">
		<input type="hidden" name="qcount_tf" value="<?php echo $count1;?>">
		<?php
	}

	public function test_time($test_ID){
		$query ="SELECT test_Timer FROM `room_test` WHERE test_ID =$test_ID";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		$result = $stmt->fetchAll();
		foreach($result as $row)
		{
			$time = $row["test_Timer"];
		}
		return $time;
	}
	




	
}