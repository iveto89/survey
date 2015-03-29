<html>
<head>

</head>
<body>
<div class='col-md-7'>
<table border = '1' class = 'table table-striped'>
<?php
$id = $this->uri->segment(3);
foreach($select_question as $row) 
{
  echo form_open('index/update_question/'.$id); 	

  echo "<tr><td class='col-md-6'>";
  $data =array(
    'name' => 'question',
    'value' => $row->question,
    'id' => 'edit_question'
  );
  echo form_input($data); 
  echo "</td>";
  echo "<td class='col-md-1'>";
  $data = array(
   	'name' => 'submit',
   	'value' => 'Промени',
   	'class' => 'btn btn-success'
  );
  echo form_submit($data); 
  echo "</td></tr>";
  echo "</form>";
  echo "</table>";
  echo "</div>";

}

echo "</body>";
echo "</html>";