<html>
<head>
</head>
<body>
<br/><br/>
<?php
$survey_id = $this->uri->segment(3);
$question_id=$this->uri->segment(4);
 if($this->session->userdata('role_id')==4) {
echo "<div class='col-md-11'>";
}
else {
	echo "<div class='col-md-9'>";
}

echo "<table border='0'>";   
echo validation_errors();

foreach ($survey as $row)
{
	echo "<tr>";
	echo form_open('index/survey_fill/' .$survey_id . $question_id);
    echo "<td class='col-md-9'>"; 
	echo "$row->question";
	echo "<input type='hidden' name='question_id' value='$row->question_id' />";
	echo "</td>";
	if($this->session->userdata('role_id')==4) {
		echo "<td rowspan='2' class='col-md-1'>";
	 	echo '<a href="/survey/index.php/index/edit_question/' . $row->question_id . '", class = "btn btn-success"> Промени въпрос </a>';
	  	echo "</td>";
	}
	echo "</tr><tr><td>";  
	$data=array(
		'name' =>  'answer['.$row->question_id.']',
		'value' => '5'
	);
	  echo "<input type='hidden' name='survey_id' value='$row->survey_id'>";
	echo "<input type='hidden' name='question_id' value='$row->question_id' />";
	echo form_radio($data);
	echo " Напълно съм доволен ";
	$data=array(
		'name' =>  'answer['.$row->question_id.']',
		'value' => ' 4'
	);
	echo form_radio($data);
	echo " Много съм доволен ";
	$data=array(
		'name' => 'answer['.$row->question_id.']',
		'value' => ' 3'
	);
	echo form_radio($data);
	echo " Донякъде съм доволен ";
	$data=array(
		'name' => 'answer['.$row->question_id.']',
		'value' => '2'
	);
	echo form_radio($data);
	echo " Не съм доволен ";
	$data=array(
		'name' => 'answer['.$row->question_id.']',
		'value' => '1'
	);
	echo form_radio($data);
	echo " Изобщо не съм доволен ";
	echo "</td></tr><tr><td>";
  	if($this->session->userdata('role_id')==4) {
  		echo "</td></tr><tr><td colspan='2'>";
  	}
}

	$data=array(
		'name' => 'submit',
		'value' => 'Изпрати',
		'class' => 'btn btn-primary',
		 'id' => 'survey_submit'
	);
	echo form_submit($data);
	echo "</td></tr>";
	echo form_close();
	echo "</table>";
    echo $links;
    echo '<div class="clearfix"></div>';
	echo "</div>";
	echo "</body>";
	echo "</html>";