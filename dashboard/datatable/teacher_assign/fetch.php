<?php
include('db.php');
include('function.php');
$query = '';
$output = array();
$query .= "SELECT * FROM `schoolyear` `sy`
LEFT JOIN `record_teacher_details` `rtd` ON `sy`.`rtd_ID` = `rtd`.`rtd_ID`
LEFT JOIN `ref_section` rs ON `sy`.`section_ID` = `rs`.`section_ID`";
if(isset($_POST["search"]["value"]))
{
	$query .= 'WHERE sy_ID LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR sy_year LIKE "%'.$_POST["search"]["value"].'%" ';
}
if(isset($_POST["order"]))
{
	$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
	$query .= 'ORDER BY sy_ID ASC ';
}
if($_POST["length"] != -1)
{
	$query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}
$statement = $conn->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$data = array();
$filtered_rows = $statement->rowCount();
foreach($result as $row)
{
	

	$sub_array = array();
	$sub_array[] = $row["sy_ID"];
	$sub_array[] = $row["rtd_FName"].' '.$row["rtd_MName"].' '.$row["rtd_LName"];
	$sub_array[] = $row["section_Name"];
	$sub_array[] = $row["sy_year"];
	$sub_array[] = sy_stat($row["sy_stat"]);
	
	$sub_array[] = '<div class="dropdown text-center"><button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Action<span class="caret"></span></button><ul class="dropdown-menu"><li><a href="#" id="'.$row["sy_ID"].'" class="update">Update</a></li><li><a href="#" id="'.$row["sy_ID"].'" class="delete">Delete</a></li>';
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



        
