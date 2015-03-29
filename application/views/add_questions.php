<html>
<head>
</head>
<body>
<div class='col-md-8' id='add_q'>
<br/><br/>

<table border='1' class=" table table-striped">
<tr><th>Въпрос</th><th>Анкета</th></tr>
<?php 

  echo validation_errors(); 
  echo form_open('admin/add_questions');

  echo "<tr><td class='col-md-6'>";
  $data =array(
    'name' => 'question',
    'class' => form_error('question') ? 'error' : '',
    'id' => 'question'
  );
  echo form_input($data);
  echo "</td><td class='col-md-2'>";
  
  /*$options =array(
   // 'name' => 'survey_id[]',
    //'value' => $row->survey_name
  );*/
  
foreach ($select_surveys as $row)
  {
    $array[$row->survey_id] = $row->survey_name;  
  }
  
  echo form_dropdown('survey[]', $array);
  echo "</td></tr><tr><td colspan='2'>";
  $data =array(
    'name' => 'submit',
    'value' => 'Добави въпрос',
    'class' => 'btn btn-success',
    'id' => 'add_question'
  );
  echo form_submit($data);
  echo "</td></tr>";
  echo form_close();
  echo "</table>";
  echo "</div>";
  echo "</body>";
  echo "</html>";