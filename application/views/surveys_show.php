<html>
<head>
<link rel="stylesheet" href="//cdn.datatables.net/1.10.5/css/jquery.dataTables.min.css" type="text/css"  />

<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="//cdn.datatables.net/1.10.5/js/jquery.dataTables.min.js"></script>

<style>
	a {
		background-color: none;
		color: none;
		font-size: 18px
	}
	#add_question_table {
		width: 250px;
		height: 30px;	
	}
	#placeholder {
		width: 250px;
		height: 30px;
		text-align: center;
		margin-left: -7px;
	}
	div#example_info.datatables_info {
		display: none;
	}
</style>
<script>

	$(document).ready(function() {
    $('#example').dataTable( {
        "pagingType": "simple",
         "bSort": true,
          "lengthMenu": [1, 2, 5, 10],
           "language": {
    "paginate": {
      "previous": false,
      "next": false
    }
  }
    } );

} );


</script>

</head>
<body>
<br/>
<?php
$survey_id = $this->uri->segment(3);

	echo "<div class='col-md-10' id='survey_manage'>";

?>

<?php
$name=$survey_name; ?>
<h3> <?php echo $name['survey_name']; ?> </h3><br/>
<?php
echo "<table border='0'>";   
echo validation_errors();

foreach ($survey as $row)
{
	echo form_open('admin/survey_show/' . $survey_id);
	echo "<tr>";
	
    echo "<td class='col-md-8'>"; 
	echo "$row->question";
	echo "<input type='hidden' name='question_id' value='$row->question_id' />";
	echo "</td>";
	echo "<td rowspan='2' class='col-md-1'>";
	echo '<a href="/survey/index.php/index/edit_question/' . $row->survey_id . '/' . $row->question_id . '", class = "btn btn-success"> Промени </a>';
	echo "</td><td class='col-md-1'>";
	echo '<input type="submit" name="deactivate" value="Изтрий"   class="btn btn-danger" 
    onclick="return confirm(\'Сигурни ли сте, че искате да изтриете въпроса?\'); ">';
	echo "</td></tr><tr><td>";  
	echo form_close();
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
	echo " 4 ";
	$data=array(
		'name' => 'answer['.$row->question_id.']',
		'value' => ' 3'
	);
	echo form_radio($data);
	echo " 3 ";
	$data=array(
		'name' => 'answer['.$row->question_id.']',
		'value' => '2'
	);
	echo form_radio($data);
	echo " 3 ";
	$data=array(
		'name' => 'answer['.$row->question_id.']',
		'value' => '1'
	);
	echo form_radio($data);
	echo " Изобщо не съм доволен ";
	echo "</td></tr>";
  
}
	
    echo "</table>";
	
	$data=array(
		'name' => 'submit',
		'value' => 'Изпрати',
		'class' => 'btn btn-primary',
		 'id' => 'survey_submit'
	);
	echo form_submit($data);
	echo form_close();

	echo form_open('admin/add_questions/' .$survey_id);
	?>
	<br/>
	<table id='example'>
		<thead>
  	<tr><th>Въпрос</th><th>Код</th><th>Група</th><th>Тип въпрос</th></tr>
  	</thead>  
  	<tfoot>
            <tr>
                <th></th>
                <th></th>
                <th></th>
                <th></th>                             
            </tr>
        </tfoot> 
  	<tbody>
 	<?php	for($i=0; $i<=20; $i++) {
  	?>
  		<tr>
  		<td>
  			<input type="text" name="question[]" value="<?php echo set_value('question[]'); ?>" id="add_question_table" />
  		</td><td>
  			<input type="text" name="code[]" value="<?php echo set_value('code[]'); ?>" id="add_question_table" />
  		</td><td>

  		<select name = 'group_id[]' >
  		<?php
  		echo '<option name = "group_id[]"  value="0"></option>';
		foreach($groups_show as $row) 
		{
			echo '<option name = "group_id[]" value="'.$row->id.'">'.$row->group_name.'</option>';
		  	
		} 		
		echo "</select>";
		?>
  		</td><td>
  		<select name = 'is_reverse[]' >
  			<option value="0">Прав</option>
	  		<option value="1">Обърнат</option>			
		</select>				  
  		</td></tr>
  		<?php 
  	}

  	?>

	</tbody>
  	</table>
	<br/>
	<input type="submit" name="add_question" value ="Добави въпрос" class="btn btn-success" id="submit_add_question"/>
	<br/><br/>
	</form>
	</div>
	</body>
	</html>