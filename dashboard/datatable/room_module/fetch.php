<?php
require_once('../class.function.php');
$room = new DTFunction();  		 // Create new connection by passing in your configuration array
session_start();

$query = '';
$output = array();
$query .= "SELECT 
*
";
$query .= " FROM `room_module` rm";

if (isset($_REQUEST['room_ID'])) {
	$room_ID = $_REQUEST['room_ID'];
 	$query .= '  WHERE rm.room_ID = '.$room_ID.' AND';
}
else{
	 $query .= ' WHERE';
}
if(isset($_POST["search"]["value"]))
{
 $query .= '(mod_ID LIKE "%'.$_POST["search"]["value"].'%" ';
    $query .= 'OR mod_Title LIKE "%'.$_POST["search"]["value"].'%" )';
}

if(isset($_POST["order"]))
{
	$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
	$query .= 'ORDER BY mod_ID DESC ';
}
if($_POST["length"] != -1)
{
	$query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}
$statement = $room->runQuery($query);
$statement->execute();
$result = $statement->fetchAll();
$data = array();
$filtered_rows = $statement->rowCount();
$i = 1;
foreach($result as $row)
{
	
		$sub_array = array();
	
		
		$sub_array[] = $i;
		$sub_array[] = '<a href="module?room_ID='.$room_ID.'&mod_ID='.$row["mod_ID"].'">'.$row["mod_Title"].'</a>';
		  if($room->student_level()){
		    	$btnx = '<button type="button" class="btn btn-info  btn-sm view_file" id="'.$row["mod_ID"].'">View Files</button> 
		    	';
		    }
		    else{
		    	$btnx = '
	<button type="button" class="btn btn-info  btn-sm view_file" id="'.$row["mod_ID"].'">View Files</button> 
	<button type="button" class="btn btn-primary  btn-sm edit" id="'.$row["mod_ID"].'">Edit</button>
	<button type="button" class="btn btn-danger  btn-sm delete" id="'.$row["mod_ID"].'">Delete</button>';
		    }
		$sub_array[] = '
		 
		<div class="btn-group" role="group" aria-label="Basic example">
		  '.$btnx.'
		</div>';
		 $i++;
	$data[] = $sub_array;
}

$q = "SELECT * FROM `room`";
$filtered_rec = $room->get_total_all_records($q);

$output = array(
	"draw"				=>	intval($_POST["draw"]),
	"recordsTotal"		=> 	$filtered_rows,
	"recordsFiltered"	=>	$filtered_rec,
	"data"				=>	$data
);
echo json_encode($output);



?>



        
