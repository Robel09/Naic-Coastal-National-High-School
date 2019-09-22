<?php
require_once('../class.function.php');
$acadyear = new DTFunction();  		 // Create new connection by passing in your configuration array


$query = '';
$output = array();
$query .= "SELECT 
*,
CONCAT(YEAR(sem_start),' - ',YEAR(sem_end)) semyear  ";
$query .= "FROM `ref_semester` ";
if(isset($_POST["search"]["value"]))
{
 $query .= 'WHERE sem_ID LIKE "%'.$_POST["search"]["value"].'%" ';
    $query .= 'OR CONCAT(YEAR(sem_start)," - ",YEAR(sem_end)) LIKE "%'.$_POST["search"]["value"].'%" ';
}


if(isset($_POST["order"]))
{
	$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
	$query .= 'ORDER BY sem_ID DESC ';
}
if($_POST["length"] != -1)
{
	$query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}
$statement = $acadyear->runQuery($query);
$statement->execute();
$result = $statement->fetchAll();
$data = array();
$filtered_rows = $statement->rowCount();
foreach($result as $row)
{
	

		$sub_array = array();
	
		$stat_ID = $row["stat_ID"];
		if($stat_ID == "1")
		{
			$stat = "<span class='badge badge-primary'>Active</span>";
		}
		else{
			$stat = "<span class='badge badge-danger'>Deactivate</span>";
		}
		$sub_array[] = $row["sem_ID"];
		$sub_array[] =  $row["semyear"];
		$sub_array[] =  $stat;
		$sub_array[] = '
		<div class="btn-group">
		  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		    Action
		  </button>
		  <div class="dropdown-menu">
		    <a class="dropdown-item view"  id="'.$row["sem_ID"].'">View</a>
		    <a class="dropdown-item edit"  id="'.$row["sem_ID"].'">Edit</a>
		     
		    
		  </div>
		</div>';
		// <div class="dropdown-divider"></div>
		// <a class="dropdown-item delete" id="'.$row["sem_ID"].'">Delete</a>
	$data[] = $sub_array;
}

$q = "SELECT * FROM `ref_semester`";
$filtered_rec = $acadyear->get_total_all_records($q);

$output = array(
	"draw"				=>	intval($_POST["draw"]),
	"recordsTotal"		=> 	$filtered_rows,
	"recordsFiltered"	=>	$filtered_rec,
	"data"				=>	$data
);
echo json_encode($output);



?>



        
