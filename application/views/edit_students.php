<html>
<head>
<link href="//cdn.datatables.net/1.10.6/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
<script src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
<script src="//cdn.datatables.net/1.10.2/js/jquery.dataTables.js"></script>

<script src="../../media/js/dataTables.editor.min.js"></script>

<script>
$(document).ready(function() {
    $('#example').dataTable( {
        "pagingType": "full_numbers",
         "bSort": true,
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
$(document).ready(function() {
    $('#example2').dataTable( {
        "pagingType": "full_numbers",
         "bSort": true,
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
$(document).ready(function() {
    
    $('#example tfoot th').each( function () {
        var title = $('#example thead th').eq( $(this).index() ).text();
        $(this).html( '<input type="text" placeholder="Търси '+title+'" />' );
    } );
 
    
    var table = $('#example').DataTable();
 
    table.columns().eq( 0 ).each( function ( colIdx ) {
        $( 'input', table.column( colIdx ).footer() ).on( 'keyup change', function () {
            table
                .column( colIdx )
                .search( this.value )
                .draw();
        } );
    } );
} );
</script>
<script>
$(document).ready(function() {
    
    $('#example2 tfoot th').each( function () {
        var title = $('#example thead th').eq( $(this).index() ).text();
        $(this).html( '<input type="text" placeholder="Търси '+title+'" />' );
    } );
 
    
    var table = $('#example2').DataTable();
 
    table.columns().eq( 0 ).each( function ( colIdx ) {
        $( 'input', table.column( colIdx ).footer() ).on( 'keyup change', function () {
            table
                .column( colIdx )
                .search( this.value )
                .draw();
        } );
    } );
} );
</script>
<style>
table.dataTable thead .sorting,table.dataTable thead .sorting_asc,table.dataTable thead .sorting_desc  {
  background-color: #B8B8B8;
}
</style>
</head>
<body>
<div class="container">
<?php  
$teacher_id = $this->uri->segment(3);
$school_id = $this->uri->segment(4);

$this->load->library('session');
$deactivated_students = $this->session->flashdata('deactivated_students'); 
if($deactivated_students){
echo "<div id='quaestors'>$deactivated_students </div>";
} 
$added_students = $this->session->flashdata('added_students'); 
if($added_students){
echo "<div id='quaestors'>$added_students </div>";
} 
echo "<br/><br/>";

foreach($teacher_name as $name) 
{
?>
<h3>Учител: <?php echo $name->first_name . " "; echo $name->last_name;?></h3>
<br/>
<h3 id='added_users'>Добавени ученици</h3><br/><br/> <h3 id='other_users'>Други ученици</h3><br/><br/> 
<?php
}

?>
<div style="width: 100%;">
<div style="width: 40%; float: left; margin-left:30px;">
<?php 
echo form_open('admin/edit_students/'.$teacher_id .'/' .$school_id);  ?>
<table id="example" >
   <thead>
    <tr>
        <th>Ученик</th>    
        <th>Клас</th>
    </tr>
  </thead>  
  <thead class="filters"> 
    <tr>
      <td>Ученик</td>    
      <td>Клас</td>    
    </tr>
  </thead>  
  <tfoot>
        <tr>
          <th>Ученик</th>    
          <th>Клас</th>
        </tr>
  </tfoot> 
  <tbody>
<?php

foreach($select_teachers_students as $select) 
{
 
?>
  
    <tr>

    <td >
    <input type="checkbox" name="student[]"   value="<?php echo $select->user_id; ?>"  />
    <?php echo $select->username; ?>
</td><td>

     <?php echo $select->class;  
      echo $select->division; ?>
    </td>
    </tr>
      <?php
      }     
?>

</table><br/>
<input type="submit" name="change" id="delete_users" value="Изтрий ученици" class="btn btn-danger" />
</form>
  </div>

<div style="width: 40%; float: left; margin-left:60px;">

<?php 
echo form_open('admin/add_students/'.$teacher_id .'/' .$school_id);  
?>

<table id="example2" class="display" >
   <thead>
    <tr>
        <th>Ученик</th>    
        <th>Клас</th>
    </tr>
  </thead>  
  <thead class="filters"> 
    <tr>
      <td>Ученик</td>    
      <td>Клас</td>    
    </tr>
  </thead>  
  <tfoot>
        <tr>
          <th>Ученик</th>    
          <th>Клас</th>
        </tr>
  </tfoot> 
  <tbody>
<?php

foreach($select_students as $student) 
{
 
?>

    <tr>

    <td class='col-md-1'>
    <input type="checkbox" name="student[]"   value="<?php echo $student->user_id; ?>"  />

    <?php echo $student->username; ?>
</td><td class='col-md-1'>

     <?php echo $student->class;  
      echo $student->division; ?>
    </td>
    </tr>
      <?php
      }     
?>
</tbody>
</table></br>
<input type="submit" name="add" id="add_users" value="Добави ученици" class="btn btn-success" />
</form>
</div>
</div>
</div>
</body>
</html>