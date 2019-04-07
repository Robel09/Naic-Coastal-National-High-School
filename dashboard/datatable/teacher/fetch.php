<?php
include('db.php');
include('function.php');
$query = '';
$output = array();
$query .= "SELECT * ";
$query .= "FROM `record_teacher_details` as `rtd` LEFT JOIN `ref_sex` as `rs` ON `rtd`.`sex_ID` = `rs`.`sex_ID`";
if(isset($_POST["search"]["value"]))
{
 $query .= 'WHERE rtd_ID LIKE "%'.$_POST["search"]["value"].'%" ';
    $query .= 'OR rtd_EmpID LIKE "%'.$_POST["search"]["value"].'%" ';
    $query .= 'OR rtd_FName LIKE "%'.$_POST["search"]["value"].'%" ';
    $query .= 'OR rtd_MName LIKE "%'.$_POST["search"]["value"].'%" ';
    $query .= 'OR rtd_LName LIKE "%'.$_POST["search"]["value"].'%" ';
    $query .= 'OR sex_Name LIKE "%'.$_POST["search"]["value"].'%" ';
}
if(isset($_POST["order"]))
{
  $query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
  $query .= 'ORDER BY rtd_ID DESC ';
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
  $sub_array[] = $row['rtd_ID'];
  $sub_array[] = $row['rtd_EmpID'];
  $sub_array[] = $row['rtd_FName'].' '.$row['rtd_MName'].' '.$row['rtd_LName'];
  $sub_array[] = $row['sex_Name'];
  $sub_array[] = '<div class="dropdown"><button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Action<span class="caret"></span></button><ul class="dropdown-menu"><li><a href="#" id="'.$row["rtd_ID"].'" class="update">Update</a></li><li><a href="#" id="'.$row["rtd_ID"].'" class="delete">Delete</a></li></ul></div>';
  // $sub_array[] = '<button type="button" name="delete" id="'.$row["id"].'" class="btn btn-danger btn-xs delete">Delete</button>';
  $data[] = $sub_array;
}
$output = array(
  "draw"        =>  intval($_POST["draw"]),
  "recordsTotal"    =>  $filtered_rows,
  "recordsFiltered" =>  get_total_all_records(),
  "data"        =>  $data
);
echo json_encode($output);

?>



        
