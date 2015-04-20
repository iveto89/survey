<html>
<head>
<link href="//cdn.datatables.net/1.10.2/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
<script src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
<script src="//cdn.datatables.net/1.10.2/js/jquery.dataTables.js"></script>

<script src="//cdn.datatables.net/1.10.2/js/jquery.dataTables.js">
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
    "paginate": {
      "previous": "Предишна",
      "next": "Следваща",
      "last": false,
      "first": false

    }
  }


    } );
} );
</script>
<script>
$(document).ready(function() {
    
    $('#example .filters td').each( function () {
        var title = $('#example thead td').eq( $(this).index() ).text();
        $(this).html( '<input type="text" placeholder="Търси '+title+'" />' );
    } );
 
    var table = $('#example').DataTable();
 
    table.columns().eq( 0 ).each( function ( colIdx ) {
        $( 'input', $('.filters td')[colIdx] ).on( 'keyup change', function () {
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
</head>
<body>
<div class='col-md-4' id='teacher_student_show'>
<h3>Управление на ученици</h3>
<br/><br/>
<?php
echo validation_errors();
 
?>
<table id='example'>

<thead>
    <tr>
      <th>Ученици</th>    
      <th>Брой учители</th>
      <th>Промени</th>
      <th>Изтрий</th>
    </tr>  
</thead> 
<thead class='filters'>
    <tr>
      <td>Ученици</td>    
      <td>Брой учители</td>
      <td>Промени</td>
      <td>Изтрий</td>
    </tr>  
</thead>  
    <tfoot>
        <tr>
          <th>Ученици</th>    
          <th>Брой учители</th>
          <th>Промени</th> 
          <th>Изтрий</th>           
        </tr>
    </tfoot> 
    <tbody>
<?php   
foreach($teachers_show as $teacher) 
{
   
?>
    <tr><td class='col-md-2'>
    <?php
     echo $teacher->username; 
     echo "<input type='hidden' name='student' value='$teacher->user_id' />";
    
?>   
    </td>    
    <td class='col-md-2'>           
    <?php echo $teacher->S ; ?>     
    </td>

    <td class='col-md-1'>
    <?php echo '<a href="/survey/index.php/admin/edit_teachers/' . $teacher->user_id .'/'. $teacher->school_id .'", class = "btn btn-success"> Промени </a>'; ?>
    </td><td>
 <?php  

echo form_open('admin/deactivate_student'); 

echo "<input type='hidden' name='student' value='$teacher->user_id' />";
echo '<input type="submit" name="deactivate" value="Изтрий" id="change_coord" class="btn btn-danger" onclick="return confirm(\'Сигурни ли сте, че искате да деактивирате ученика?\'); " />';
?>
</td></tr>
<?php
echo form_close();
  } ?>

</tbody>
</table>  