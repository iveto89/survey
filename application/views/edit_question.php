<html>
<head>

</head>
<body>
<div class='col-md-7'>
<br/><br/>
<table border = '1' class = 'table table-striped'>
<tr><th>Въпрос</th><th>Тип въпрос</th><th>Промени</th></tr> 
<?php
$survey_id = $this->uri->segment(3);
$id = $this->uri->segment(4);
foreach($select_question as $row) 
{
  echo form_open('survey_manage/update_question/'.$survey_id .'/' . $id); 	

  echo "<tr><td class='col-md-6'>";
  $data =array(
    'name' => 'question',
    'value' => $row->question,
    'id' => 'edit_question'
  );
  echo form_input($data); 
  echo "</td>";
  /*echo "<td class='col-md-2'>";
  
?>

<select name = 'group_id[]' >
<option name="group_id[]" value="<?= '0' ?>"
  <?php echo '0' ==  $row->group_id ? 'selected="selected"' : 
    '' ?>><?php echo '' ; ?></option> 
<?php      

foreach($groups_show as $group) 
{
?>
  <option name="group_id[]" value="<?= $group->id ?>"
  <?php echo $group->id == $row->group_id ? 'selected="selected"' : 
    '' ?>><?php echo $group->group_name ; ?></option>
         
<?php   
} 

echo "</select>";

echo "</td>";*/
echo "<td class='col-md-2'>";
  
?>
<select name = 'is_reverse[]' >

  <option name="is_reverse[]" value="<?= '0' ?>"
  <?php echo $row->is_reverse == '0' ? 'selected="selected"' : 
  '' ?>><?php echo 'Прав'  ; ?></option>
  <option name="is_reverse[]" value="<?= '1' ?>"
  <?php echo $row->is_reverse == '1' ? 'selected="selected"' : 
  '' ?>><?php echo 'Обърнат' ; ?></option>
         
 <?php         
  echo "</select>";
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