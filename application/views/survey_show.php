<html>
<head>
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>

<script>

$(function () {
        $( document ).ready(hideAllRows);
         $( document ).ready(showFirst);        
    });

function hideAllRows(){
	$('#questionsTable tr').each(function() {
	    $(this).hide();

	});
}


$(document).ready(function() {
    $('.answer').click(function() {
        $(this).attr('checked', true);
       // $('#survey_instructions').hide();
    })
    
    var current = 1;
    $('#next').click(function(e) {

        var valid = null;

        $('#' + current).find('input[type="radio"]').each(function(i, v) {
            if ($(v).attr('checked') !== undefined) {
                // Validation passed
              //  $('#survey_instructions').show();
                $('#' + current).css({ display: 'none' });
                //random question_id
                 already_used = $('#' + current).find('input[name="question_id"]').val();
                
                current++;
                valid++;

                $('#' + current).css({ display: 'block' });
              //  $('#survey_instructions').hide();
            }
        });

        if (!valid) {
            alert('Моля, отговорете!');
        }
        if (current == $('input[name="questions_count"]').val()) {
    		$('#next').attr('value', 'Submit');
		}
        if (current <= $('input[name="questions_count"]').val()) {
            e.preventDefault();
        }
    })
    
})
function showFirst(){
	$(function () {
	$('#1').show();
});
}
</script>
<style>

label {
font-weight: 200;
}
</style>
</head>
<body>

<?php
$survey_id = $this->uri->segment(3);
$question_id = $this->uri->segment(4);

	echo "<div  id='survey_container'>";


$name=$survey_name; ?>
<h3 style='text-align:center;'> <?php echo $name['survey_name']; ?> </h3><br/>
<?php
 
$att=array('id'=>'form');
echo form_open('index/survey_fill/' .$survey_id .'/'. $question_id , $att); ?>
<input type='hidden' name='questions_count' id='questions_count' value='<?php echo count($question); ?>' />

<table id='questionsTable' style='border:0;'>
  <thead>
<tr><th>Въпрос</th><th>Въпрос</th></tr>
  </thead>
<tbody>

  <?php
	echo validation_errors();

    /*foreach ($survey as $k => $s) {
        echo '<a href="' . base_url() .'index.php/index/survey_show/' . $s->survey_id .'/'. $s->question_id . '">въпрос ' . ($k + 1) . '</a> ::';
    }*/
      
    $index = 1;
	foreach ($question as $row)
	{
		echo "<tr id='$index'>";
		$index++;
	?>
		
	   <?php echo	"<td>";
	        // echo "<div id= 'answers_div'>";
		 
		
		/*if ($survey_id == 4 && $row->time == 2 ) {
			$this->load->library('session');

			if (!$this->session->userdata('time')) {
        		
        		redirect('admin/instructions_during');
    		}
		
		 	
		}*/
	if ($survey_id == 4 && $row->time == 1 ) { 

		if (!$this->session->userdata('time1')) { ?>
	
			<div id='survey_instructions' >
				<span id='instructions_bold '>ЧАСТ II – Емоции, свързани с учене <br/></span>
				<span id='instructions_bold '>ПРЕДИ ДА УЧИШ   <br/></span>
				Следващите твърдения се отнасят до чувствата, които може да преживяваш ПРЕДИ да учиш за този предмет. Посочи как се чувстваш обикновено, преди да започнеш да учиш по този предмет, като използваш оценка от скалата:<br/>
				1 – Въобще не съм съгласен(а). <br/>
				2 – Не съм съгласен(а). <br/>
				3 – И съм съгласен(а), и не съм. <br/>
				4 – Съгласен(а)съм. <br/>
				5 – Напълно съм съгласен(а). <br/><br/>
			</div>
		<?php }
		$this->load->library('session');
		$newdata = array('time1' => 1);
		$this->session->set_userdata($newdata);
	} 	


	if ($survey_id == 4 && $row->time == 2 ) { 

		if (!$this->session->userdata('time2')) { ?>
	
			<div id='survey_instructions' >
				<span id='instructions_bold '>ЧАСТ II – Емоции, свързани с учене <br/></span>
				<span id='instructions_bold '>ДОКАТО УЧИШ   <br/></span>
				Следващите твърдения се отнасят до чувствата, които може да преживяваш ДОКАТО учиш по този предмет. Посочи как се чувстваш обикновено, 
				докато учиш по този предмет, като използваш оценка от скалата: <br/>
				1 – Въобще не съм съгласен(а). <br/>
				2 – Не съм съгласен(а). <br/>
				3 – И съм съгласен(а), и не съм. <br/>
				4 – Съгласен(а)съм. <br/>
				5 – Напълно съм съгласен(а). <br/><br/>
			</div>
		<?php }
		$this->load->library('session');
		$newdata = array('time2' => 2);
		$this->session->set_userdata($newdata);
	} 

	if ($survey_id == 4 && $row->time == 3 ) { 

		if (!$this->session->userdata('time3')) { ?>
	
			<div id='survey_instructions' >
				<span id='instructions_bold '>ЧАСТ II – Емоции, свързани с учене <br/></span>
				<span id='instructions_bold '>СЛЕД КАТО УЧИШ   <br/></span>
				Следващите твърдения се отнасят до чувствата, които може да преживяваш СЛЕД КАТО учиш по този предмет. Посочи как се чувстваш обикновено, 
				след като вече си учил по този предмет, като използваш оценка от скалата: <br/>
				1 – Въобще не съм съгласен(а). <br/>
				2 – Не съм съгласен(а). <br/>
				3 – И съм съгласен(а), и не съм. <br/>
				4 – Съгласен(а)съм. <br/>
				5 – Напълно съм съгласен(а). <br/><br/>

			</div>
		<?php }
		$this->load->library('session');
		$newdata = array('time3' => 3);
		$this->session->set_userdata($newdata);
	} 

	echo "<span id='question_span'> $row->question "; ?><br/><br/>
		<?php echo "<input type='hidden' name='question_id' value='$row->question_id' />"; ?></span>
		<?php 

            echo "<div id='answers_div' class='col-md-10'>";
			foreach ($answers as $answer) {
			$data2=array(
				'name' =>  'answer['.$row->question_id.']',
				'value' => $answer['answer_value'],
				'class' => 'answer'

			);
                echo "<span id='span' class='col-md-2'>"; 
		
		echo "<input type='hidden' name='survey_id' value='$row->survey_id'>"; 
		
		echo form_radio($data2);  
                echo "<br/>";
                echo "$answer[answer_name]"; 
                echo "</span>";
}
                echo "</div>";
	        ?>
		</td></tr>
   
	<?php 
	}

?>		

	</tbody>

</table>
<br/><br/><br/><br/><br/><br/><br/><br/><br/>
 <?php  echo '<input type="submit" id="next" name = "submit" value="Next" class="btn btn-success">'; ?>
</form>
</div>
  
</body>
</html>