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
      "last": "Последна",
      "first": "Първа"

    }
  },

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
<style>
   input {
    display:block;
    margin:0 auto;
  
  }
  #change_coord {
      display:block;
      margin:0 auto;
      width: 60%; 
  }
  #teachers_show1 {
    margin-left: 50px;
  }
</style>
<body>
<div class='col-md-10' id='teachers_show1'>
<h3>Управление на учители</h3>
<br/><br/>
<?php
echo validation_errors();

?>
<table id="example">
  <thead>
  	<tr>
    	<th>Учители</th>  	
    	<th>Координатори</th>
    	<th>Промени координатор</th>
      <th>Деактивирай учител</th>
    </tr>
  </thead>  
  <thead class="filters"> 
    <tr>
      <td>Учители</td>    
      <td>Координатори</td>
      <td>Промени</td>
      <td>Деактивирай</td>
    </tr>
  </thead>  
  <tfoot>
        <tr>
          <th>Учители</th>  	
  		  	<th>Координатори</th>
  		  	<th>Промени</th>
          <th>Деактивирай</th>
        </tr>
  </tfoot> 
  <tbody>

<?php   
foreach ($teachers_show as $teacher)
{
echo form_open('coordinator/deactivate_teacher'); 	
  ?>
  <tr>
  <td>
  <?php echo $teacher->username; 
  echo "<input type='hidden' name='teacher' value='$teacher->user_id' />";
  ?>	
  </td>
  <td>
  <?php  echo $teacher->U ; ?> 
    	 
  </td><td>
  <?php 
    echo '<a href="edit_coordinator/' . $teacher->user_id . '" class="btn btn-success" id="change_coord">  Промени координатор </a>';
?>
</td><td>
<?php 

 echo "<input type='hidden' name='teacher' value='$teacher->user_id' />";
echo '<input type="submit" name="deactivate" value="Деактивирай учител" id="change_coord" class="btn btn-danger" onclick="return confirm(\'Сигурни ли сте, че искате да деактивирате учителя?\'); " />';
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

  