
<form action="" method="POST">
<?PHP
    include('../session.php');
    if (isset($_REQUEST['quiz_ID'])) {
    	echo $_REQUEST['quiz_ID'];
    }
	$test_ID = 1;
	$sql = "select * from `questions` WHERE test_ID =$test_ID ";

	$result = mysqli_query($conn, $sql);
	$count_question = mysqli_num_rows($result) ;
	if (mysqli_num_rows($result) > 0) {
		$i = 1;
		while($row = mysqli_fetch_assoc($result)) {
			$id = $row['question_ID'];
			echo $i.".) ".$row['question'];
			?>
			  <fieldset id="group<?php echo $row['question_ID']?>">
			  	<?php 
			  	$sqlx = "SELECT * FROM `choices` WHERE question_ID = $id";

				$saw = mysqli_query($conn, $sqlx);
				while($row1 = mysqli_fetch_assoc($saw)) {
					echo $row1['choice'];
					?>
			    	<input type="radio" value="<?php echo $row1['choice_ID']?>" name="Q_<?php echo $i?>">
					<?php
				}
			  	?>
			  </fieldset>
			<?php
			$i++;
		 }

	}
?>

	      <input type="submit" value="submit" />
</form>

<pre>
<?php 

$answer = $_POST;
echo "user:".$user_ID = 1;

print_r($answer);
$is_correct = 0;
foreach ($answer as $value) {
   
     $q = "select * from `choices` where choice_ID = $value and is_correct=1";
    echo $q." : ";
    $res = mysqli_query($conn, $q);
    echo $count = mysqli_num_rows($res);
    $is_correct += $count;
    echo "<br>";
}
echo "quiz score:".$is_correct."/".$count_question;
?>
</pre>