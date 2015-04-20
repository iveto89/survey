<html>
<head>
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>

<script>

$(function () {
        $( document ).ready(hideAllRows);
    });

function hideAllRows(){
	$('#questionsTable tr').each(function() {
	    $(this).hide();
	});
}

$(function () {
        $("#next").click(showNextQuestion);
    });

var currentInd = 0;
var prevInd = 0;
function showNextQuestion(){
$(function () {

	var indId = "#"+currentInd;
	prevInd = currentInd - 1;
	var prevId = "#"+prevInd;
	//validation
	var isAnyClicked = false;
	// $(prevId).children("radio").each(function(){
	// 	if($(this).is(':checked')){
	// 		isAnyClicked = true;
	// 	}
	// });

	if ($("input[name='answer']:checked").val()) {
   		isAnyClicked = true;
	}
	if(currentInd > 0 && isAnyClicked == false)
	{
		alert('Otgowori!');
	}
	else{
		//hide previous question
		
		$(prevId).hide();
		
		//show next question 
		var indId = "#"+currentInd;
	        $(indId).show();
	        currentInd++;
    }
    });
}

</script>

</head>
<body>
<br/><br/>
<?php
$survey_id = $this->uri->segment(3);
$question_id = $this->uri->segment(4);
if($this->session->userdata('role_id')==4) {
	echo "<div class='col-md-11'>";
}
else {
	echo "<div class='col-md-9'>";
}
?>
<?php 
echo form_open('index/survey_fill/' .$survey_id .'/'. $question_id ); ?>
<table id='questionsTable' >
  <thead>
  	<tr><th>Въпрос</th></tr>
  </thead>   
  <tbody>
  <?php
	echo validation_errors();

    /*foreach ($survey as $k => $s) {
        echo '<a href="' . base_url() .'index.php/index/survey_show/' . $s->survey_id .'/'. $s->question_id . '">въпрос ' . ($k + 1) . '</a> ::';
    }*/

    $index = 0;
	foreach ($question as $row)
	{
		echo "<tr id='$index'>";
		$index++;
	?>
		
	   	<td> 
		<?php echo "$row->question"; ?><br/>
		<?php echo "<input type='hidden' name='question_id' value='$row->question_id' />"; ?>
		<?php 
		 
		$data=array(
			'name' =>  'answer['.$row->question_id.']',
			'value' => '5',
			'class' => 'answer'
		);

		echo "<input type='hidden' name='survey_id' value='$row->survey_id'>"; 
		
		echo form_radio($data); 
		echo " Напълно съм доволен ";
		$data=array(
			'name' =>  'answer['.$row->question_id.']',
			'value' => '4',
			'class' => 'answer'
		);
		echo form_radio($data);
		echo " Много съм доволен ";
		$data=array(
			'name' => 'answer['.$row->question_id.']',
			'value' => '3',
			'class' => 'answer'
			
		);
		echo form_radio($data);
		echo " Донякъде съм доволен ";
		$data=array(
			'name' => 'answer['.$row->question_id.']',
			'value' => '2',
			'class' => 'answer'
		);
		echo form_radio($data);
		echo " Не съм доволен ";
		$data=array(
			'name' => 'answer['.$row->question_id.']',
			'value' => '1',
			'class' => 'answer'
		);
		echo form_radio($data);
		echo " Изобщо не съм доволен ";
		?>
		</td></tr>
   
	<?php 
	}

?>		

	</tbody>
</table>

<?php echo "<input type='hidden' name='question_id' value='$row->question_id' />"; ?>
  <?php  echo '<input type="submit" id="button" name = "submit" value="Submit" class="btn btn-success">';
  ?>
<input type="button" id="next" name = "next" value="Next" class="btn btn-success">
</form>
</div>
  
</body>
</html>