
<form action="action.php?quiz_ID=<?php echo $_REQUEST['quiz_ID']?>" method="POST" id="load_quiz">
<?PHP
    include('../session.php');
    if (isset($_REQUEST['quiz_ID'])) {
    	$quiz_ID =  $_REQUEST['quiz_ID'];
    }
	$test_ID = 1;
	$sql = "select * from `questions` WHERE test_ID =$test_ID AND quiz_ID = $quiz_ID";

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
		<input type="hidden" name="count_question" value="<?php echo $count_question?>">
	      <input type="submit" value="submit" name="submit_score" id="subtmi_qscore" />
</form>


