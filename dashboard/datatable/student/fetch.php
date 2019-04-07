<?php
include('db.php');
include('function.php');
$query = '';
$output = array();
$query .= "SELECT * FROM `record_student_details` `rsd`
LEFT JOIN `ref_suffixname` `rs` ON `rsd`.`suffix_ID` = `rs`.`suffix_ID`
LEFT JOIN `ref_sex` `rss` ON `rsd`.`rsd_Sex` = `rss`.`sex_ID`";
if(isset($_POST["search"]["value"]))
{
	$query .= 'WHERE rsd_StudNum LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR rsd_FName LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR rsd_MName LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR rsd_LName LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR sex_Name LIKE "%'.$_POST["search"]["value"].'%" ';
}
if(isset($_POST["order"]))
{
	$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
	$query .= 'ORDER BY rsd_ID DESC ';
}
if($_POST["length"] != -1)
{
	$query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}
$statement = $connection->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$data = array();
$filtered_rows = $statement->rowCount();
foreach($result as $row)
{
	$sub_array = array();
	$sub_array[] = $row["rsd_ID"];
	$sub_array[] = $row["rsd_StudNum"];
	$sub_array[] = $row["rsd_FName"].' '.$row["rsd_MName"].' '.$row["rsd_LName"].' '.$row["suffix"];
	$sub_array[] = $row["sex_Name"];
	$sub_array[] = '<div class="dropdown"><button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Action<span class="caret"></span></button><ul class="dropdown-menu"><li><a href="#" id="'.$row["rsd_ID"].'" class="update">Update</a></li><li><a href="#" id="'.$row["rsd_ID"].'" class="delete">Delete</a></li></ul></div>';
	// $sub_array[] = '<button type="button" name="delete" id="'.$row["id"].'" class="btn btn-danger btn-xs delete">Delete</button>';
	$data[] = $sub_array;
}
$output = array(
	"draw"				=>	intval($_POST["draw"]),
	"recordsTotal"		=> 	$filtered_rows,
	"recordsFiltered"	=>	get_total_all_records(),
	"data"				=>	$data
);
echo json_encode($output);

?>



        
