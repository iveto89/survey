<html>
<head>
<link href="//cdn.datatables.net/1.10.5/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
<script src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
<script src="//cdn.datatables.net/1.10.2/js/jquery.dataTables.js"></script>
<script src="//cdn.datatables.net/1.10.2/js/jquery.dataTables.js"></script>
<script src="../../media/js/dataTables.editor.min.js"></script>

<script>
$(document).ready(function() {
    $('#example').dataTable( {
        "pagingType": "full_numbers",
         "bSort": true,
         "sDom": 'T<"clear">lfrtip',
         "columns": [
    { "width": "20%" },
    null,
    null,
    null,
    null
  ],

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
        var title = $('#example thead td').eq( $(this).index() ).text();
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

</head>
<body>
<div class='col-md-10' id='teachers_show'>
<h3>Управление на учители</h3>
<br/><br/>
<?php
$this->load->library('session');
$deactivated_teacher = $this->session->flashdata('deactivated_teacher'); 
if($deactivated_teacher){
echo "<div id='quaestors'>$deactivated_teacher </div>";
} 
echo "<br/><br/>";

echo validation_errors();
 
?>
<table id="example">
  <thead>
    <tr>
        <th>Учител</th>    
        <th>Училище</th>
        <th>Регион</th>
        <th>Брой класове</th>
        <th>Брой ученици</th>
        <th></th>
        <th></th>
    </tr>
  </thead>  
  <thead class="filters"> 
    <tr>
      <td>Учител</td>    
      <td>Училище</td>
      <td>Регион</td>
      <td>Брой класове</td>
      <td>Брой ученици</td>
      <td></td>
      <td></td>
    </tr>
  </thead>  
  <tfoot>
        <tr>
            <th>Учител</th>    
            <th>Училище</th>
            <th>Регион</th>
            <th>Брой класове</th>
            <th>Брой ученици</th>
            <th></th>
            <th></th>
        </tr>
  </tfoot> 
  <tbody>

<?php   
foreach ($teachers_show as $teacher)
{

  ?>
  <tr>
  <td>
  <?php echo $teacher->T; 
  //echo "<input type='hidden' name='teacher' value='$teacher->user_id' />";
   ?>
   </td><td>
   <?php echo $teacher->school_name; ?>
   </td><td>
   <?php echo $teacher->region; ?>
    </td><td>
   <?php echo $teacher->count_classes; ?>
    </td><td>
     <?php echo $teacher->S; ?>
    </td><td>
    <?php echo '<a href="/survey/index.php/admin/edit_students/' . $teacher->TU .'/'. $teacher->school_id .'", class = "btn btn-success"> Промени </a>'; ?>
    </td><td>
    <?php
    echo form_open('admin/deactivate_teacher');  
   echo "<input type='hidden' name='teacher' value='$teacher->TU' />";
   echo '<input type="submit" name="deactivate" value="Изтрий" id="change_coord" class="btn btn-danger" onclick="return confirm(\'Сигурни ли сте, че искате да изтриете учителя?\'); " />';
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