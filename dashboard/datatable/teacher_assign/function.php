<?php


function get_total_all_records()
{
	include('db.php');
	$statement = $conn->prepare("SELECT * FROM `ref_schoolyear`");
	$statement->execute();
	$result = $statement->fetchAll();
	return $statement->rowCount();
}

function sy_stat($var){
	if ($var == 0) {
		$a = "Deactivate";
	}
	if ($var == 1) {
		$a = "Active";
	}
	return $a;

}
?>