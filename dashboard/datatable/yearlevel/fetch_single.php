<?php
require_once('../class.function.php');
$yearlevel = new DTFunction(); 

if (isset($_POST['action'])) {
	
	$output = array();
	$stmt = $yearlevel->runQuery("SELECT * FROM `ref_year_level` WHERE yl_ID  = '".$_POST["yl_ID"]."' 
			LIMIT 1");
	$stmt->execute();
	$result = $stmt->fetchAll();
	foreach($result as $row)
	{

	
		
		$output["yl_ID"] = $row["yl_ID"];
		$output["yl_Name"] = $row["yl_Name"];
	
	}
	
	echo json_encode($output);
	
}









 

?>