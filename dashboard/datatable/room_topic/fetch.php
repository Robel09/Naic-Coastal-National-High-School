<?php
require_once('../class.function.php');
$room = new DTFunction();  		 // Create new connection by passing in your configuration array
session_start();

$query = '';
$output = array();
$query .= "SELECT 
*
";
$query .= " FROM `room_module_topic` rmt";

if (isset($_REQUEST['mod_ID'])) {
	$mod_ID = $_REQUEST['mod_ID'];
 	$query .= '  WHERE rmt.mod_ID = '.$mod_ID.' AND';
}
else{
	 $query .= ' WHERE';
}
if(isset($_POST["search"]["value"]))
{
 $query .= '(mtopic_ID LIKE "%'.$_POST["search"]["value"].'%" ';
    $query .= 'OR mtopic_Title LIKE "%'.$_POST["search"]["value"].'%" )';
}

if(isset($_POST["order"]))
{
	$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
	$query .= 'ORDER BY mtopic_ID ASC ';
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
	  // if($room->student_level()){
		  //   	$btnx = '<a class="dropdown-item view"  id="'.$row["mtopic_ID"].'">View</a>';
		  //   }
		  //   else{
		  //   	$btnx = '
		  //   <';
		  //   }
		if($i == 1){
			$ac = 'active';
		}
		else{
			$ac = "";
		}
		$sub_array[] = 	'<a class="topic list-group-item list-group-item-action $ac" id="list-home-list" data-toggle="list" href="#'.$i.'" role="tab" aria-controls="'.$i.'" topic-id="'.$row["mtopic_ID"].'">'.$row["mtopic_Title"].'</a>
		<div class="btn-group float-right">
		  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		    
		  </button>
		  <div class="dropdown-menu">
		  <a class="dropdown-item view"  id="'.$row["mod_ID"].'">View</a>
		    <a class="dropdown-item edit"  id="'.$row["mod_ID"].'">Edit</a>
		     <div class="dropdown-divider"></div>
		    <a class="dropdown-item delete" id="'.$row["mod_ID"].'">Delete</a>
		  </div>
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



        
