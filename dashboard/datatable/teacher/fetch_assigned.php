<?php
include('db.php');
include('function.php');
$query = '';
$output = array();
$query .= "SELECT * ";
$query .= "FROM `schoolyear` `sy` 
 LEFT JOIN `ref_section` `rs` ON `sy`.`section_ID`  = `rs`.`section_ID`
 LEFT JOIN `record_teacher_details` `rtd` ON `sy`.`rtd_ID` =  `rtd`.`rtd_ID`
 ";
if(isset($_POST["search"]["value"]))
{
 $query .= 'WHERE rtd_ID LIKE "%'.$_POST["search"]["value"].'%" ';
    // $query .= 'OR rtd_EmpID LIKE "%'.$_POST["search"]["value"].'%" ';
    // $query .= 'OR rtd_FName LIKE "%'.$_POST["search"]["value"].'%" ';
    // $query .= 'OR rtd_MName LIKE "%'.$_POST["search"]["value"].'%" ';
    // $query .= 'OR rtd_LName LIKE "%'.$_POST["search"]["value"].'%" ';
    // $query .= 'OR section_Name LIKE "%'.$_POST["search"]["value"].'%" ';
}
if(isset($_POST["order"]))
{
  $query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
  $query .= 'ORDER BY sy_ID DESC ';
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
  $sub_array[] = $row['sy_ID'];
$sub_array[] = $row['sy_ID'];
$sub_array[] = $row['sy_ID'];
$sub_array[] = $row['sy_ID'];
$sub_array[] = $row['sy_ID'];
  // $sub_array[] = '<button type="button" name="delete" id="'.$row["id"].'" class="btn btn-danger btn-xs delete">Delete</button>';
  $data[] = $sub_array;
}
$output = array(
  "draw"        =>  intval($_POST["draw"]),
  "recordsTotal"    =>  $filtered_rows,
  "recordsFiltered" =>  get_total_all_records1(),
  "data"        =>  $data
);
echo json_encode($output);

?>



        
