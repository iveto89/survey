<html>
<head>
<link href="//cdn.datatables.net/1.10.2/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
<script src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
<script src="//cdn.datatables.net/1.10.2/js/jquery.dataTables.js"></script>

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
<div class='col-md-4' id='coord_show'>
<h3>Управление на координатори</h3>
<br/><br/>
<?php
$this->load->library('session');
$deactivated_coord = $this->session->flashdata('deactivated_coord'); 
if($deactivated_coord){
echo "<div id='quaestors'>$deactivated_coord </div>";
} 
echo "<br/><br/>";

echo validation_errors();
?>
<table id="example">
 <thead>
    <tr>
      <th>Координатори</th> 
      <th>Брой учители</th>   
      <th>Промени</th>   
      <th>Изтрий</th>
    </tr>
       
    </thead>  
    <tfoot>
        <tr>
          <th>Координатори</th> 
          <th>Брой учители</th>
          <th>Промени</th>   
          <th>Изтрий</th>            
        </tr>

    </tfoot> 
    <tbody>

<?php   
foreach ($coordinators_show as $coordinator)
{
  
?>
<tr>
<td>
<?php 
echo form_open('admin/deactivate_coordinator'); 
echo $coordinator->C; 
echo "<input type='hidden' name='coordinator' value='$coordinator->CU' />";
?>
</td><td>
<?php echo $coordinator->T; ?>

</td><td>
  <?php echo '<a href="/survey/index.php/admin/edit_coordinators/' . $coordinator->CU .'", class = "btn btn-success"> Промени </a>'; ?>
</td><td>
<?php

echo "<input type='hidden' name='coordinator' value='$coordinator->CU' />";
echo '<input type="submit" name="deactivate" value="Изтрий" id="change_coord" class="btn btn-danger" onclick="return confirm(\'Сигурни ли сте, че искате да изтриете координатора?\'); " />';
?>
</td></tr>  
<?php

echo form_close();  
}

?>

</tbody>
</table>
</div>
</body>
</html>
