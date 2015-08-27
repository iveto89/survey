<html>
<head>
<link href="//cdn.datatables.net/1.10.2/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
<script src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
<script src="//cdn.datatables.net/1.10.2/js/jquery.dataTables.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="//cdn.datatables.net/1.10.2/js/jquery.dataTables.js"></script>
<script src="../../media/js/dataTables.editor.min.js"></script>


  
<script>
$(document).ready(function() {
    $('#example').dataTable( {
        "pagingType": "full_numbers",
         "bSort": false,
         "sDom": 'T<"clear">lfrtip',
         "tableTools": {
    "sSwfPath": "http://cdn.datatables.net/tabletools/2.2.2/swf/copy_csv_xls_pdf.swf",
    "aButtons": [
		"csv",
		
		{
		"sExtends": "pdf",
		"sButtonText": "Print PDF",
		"mColumns": "visible"
		},
		"xls"

		] 
	},
   "language": {
 "emptyTable": "Няма данни",
    "paginate": {
      "previous": "Предишна",
      "next": "Следваща",
      "last": "Последна",
      "first": "Първа"

    }
  }

    } );
} );
</script>
<script>
$(document).ready(function(){
    
          
         /* $('#school').val('Моля изберете училище');
          $('#quaestor').val('Моля изберете учител');        
          $('#day').val('Моля изберете ден');
          $('#month').val('Моля изберете месец');
          $('#year').val('Моля изберете година');  */       
         // $('#class').val('');
        //  $('#class_divisions').val('');
         
      });
 
</script>


</head>
<body>
<div  class='col-md-10' >
<h3>Управление на квестори</h3>

<?php
$this->load->library('session');
$added_quaestor = $this->session->flashdata('added_quaestor'); 
if($added_quaestor){
echo "<div id='quaestors'>$added_quaestor </div>";
} 
echo "<br/><br/>";
 echo validation_errors();
 echo form_open('admin/add_quaestors'); ?>

<table id='example'>
 <thead>
    <tr>
      <th>Училище</th> 
      <th>Клас</th>   
      <th>Паралелка</th>   
      <th>Квестор</th>
      <th>Ден</th>
      <th>Месец</th> 
      <th>Година</th> 
    </tr>
       
    </thead>  
    
    <tbody>


  

<tr>
<td>

<?php $selected_school= $this->input->post('school');  ?>
<select name='school'   id='school'>
  <option value="<?php echo set_select('school'); ?>">Моля изберете училище</option>
      <?php foreach ($schools_show as $row) {  ?>
        <option name='school' value= "<?= $row->school_id ?>" <?php echo $selected_school == $row->school_id ? 'selected="selected"' : 
    '' ?>><?= $row->school_name ?></option>
      <?php } ?>
  </select> 

</td><td>
<?php $selected_class= $this->input->post('class[]');  
/*<select name='class[]'  id='class'>
   <option  value="">Моля изберете клас</option>
      <?php foreach ($classes as $row) { ?>
        <option value= "<?= $row->id ?>" <?php echo $selected_class == $row->id ? 'selected="selected"' : 
    '' ?>><?= $row->class_id ?></option>
      <?php } ?>
  </select> */ ?>
    
<select name='class[]' id='class'>
   <option  value="" >Моля изберете клас</option>
      <?php foreach ($classes as $row) { 
      echo "<option value='$row->id' " . set_select('class[]', $row->id) . " >". $row->class_id."</option>";
    
       } ?>
  </select> 

</td><td>
<select name='class_divisions[]'  id='class_divisions'>
    <option  value="" >Моля изберете паралелка</option>
    <?php foreach ($class_divisions as $row) { 
     echo "<option value='$row->id' " . set_select('class_divisions[]', $row->id) . " >". $row->division ."</option>";
 
      } ?>
  </select>  
</td><td>
<?php $selected_quaestor= $this->input->post('quaestor');  ?>
<select name='quaestor'   id='quaestor' >
  <option value="">Моля изберете квестор</option>
  <option value="Друг" <?php echo $selected_quaestor == "Друг" ? 'selected="selected"' : 
    '' ?>>Друг</option>
      <?php foreach ($quaestors_show as $quaestor) { ?>
        <option name='school' value= "<?= $quaestor->user_id ?>" <?php echo $selected_quaestor == $quaestor->user_id ? 'selected="selected"' : 
    '' ?>><?= $quaestor->first_name . "&nbsp;" . 
        $quaestor->last_name; ?></option>
      <?php } ?>
  </select> 
  </td><td>

<?php $selected_day= $this->input->post('day');  ?>
<select name='day'   id='day'>
  <option value="" >Моля изберете ден</option>
<?php for($i=1; $i<=31; $i++) { ?>
     <option value="<?php echo $i; ?>" <?php echo $selected_day == $i ? 'selected="selected"' : 
    '' ?>><?php echo $i; ?></option>
  <?php } ?> 
  </select> 
    </td><td>

<?php $selected_month= $this->input->post('month');  ?>
<select name='month'   id='month'>
  <option value="">Моля изберете месец</option>
 <option value="1" <?php echo $selected_month == "1" ? 'selected="selected"' : 
    '' ?>>Януари</option>
<option value="2" <?php echo $selected_month == "2" ? 'selected="selected"' : 
    '' ?>>Февруари</option>
<option value="3" <?php echo $selected_month == "3" ? 'selected="selected"' : 
    '' ?>>Март</option>
<option value="4" <?php echo $selected_month == "4" ? 'selected="selected"' : 
    '' ?>>Април</option>
<option value="5" <?php echo $selected_month == "5" ? 'selected="selected"' : 
    '' ?>>Май</option>
<option value="6" <?php echo $selected_month == "6" ? 'selected="selected"' : 
    '' ?>>Юни</option>
<option value="7" <?php echo $selected_month == "7" ? 'selected="selected"' : 
    '' ?>>Юли</option>
<option value="8" <?php echo $selected_month == "8" ? 'selected="selected"' : 
    '' ?>>Август</option>
<option value="9" <?php echo $selected_month == "9" ? 'selected="selected"' : 
    '' ?>>Септември</option>
<option value="10" <?php echo $selected_month == "10" ? 'selected="selected"' : 
    '' ?>>Октомври</option>
<option value="11" <?php echo $selected_month == "11" ? 'selected="selected"' : 
    '' ?>>Ноември</option>
<option value="12" <?php echo $selected_month == "12" ? 'selected="selected"' : 
    '' ?>>Декември</option>
  </select> 
  </td><td>

  <?php $selected_year= $this->input->post('year');  ?>
<select name='year'   id='year'>
  <option value="<?php echo set_select('year'); ?>" >Моля изберете година</option>
<?php for($i=2014; $i<=2030; $i++) { ?>
     <option value="<?php echo $i; ?>" <?php echo $selected_year == $i ? 'selected="selected"' : 
    '' ?>><?php echo $i; ?></option>
  <?php } ?> 
  </select>
</td></tr>  


</tbody>
</table>
<br/><br/>
<input type="submit" name="submit" value="Добави" class="btn btn-success" id="add_quaestor" />
<?php echo form_close(); ?>
</div>
</body>
</html>
