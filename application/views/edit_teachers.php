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
    
    $('#example2 .filters td').each( function () {
        var title = $('#example2 thead td').eq( $(this).index() ).text();
        $(this).html( '<input type="text" placeholder="Търси '+title+'" />' );
    } );
 
    var table = $('#example2').DataTable();
 
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
$student_id = $this->uri->segment(3);
$school_id = $this->uri->segment(4);

$deleted_teachers = $this->session->flashdata('deleted_teachers'); 
if($deleted_teachers){
echo "<div id='quaestors'>$deleted_teachers </div>";
} 

$added_teachers = $this->session->flashdata('added_teachers'); 
if($added_teachers){
echo "<div id='quaestors'>$added_teachers </div>";
} 
echo "<br/><br/>";

foreach($teacher_name as $name) 
{
?>
<h3>Ученик: <?php echo $name->first_name . " "; echo $name->last_name;?></h3>
<br/>
<h3 id='added_users'>Добавени учители</h3><br/><br/> <h3 id='other_users'>Други учители</h3><br/><br/> 
<?php
}

?>
<div style="width: 100%;">
<div style="width: 40%; float: left; margin-left:30px;">
<?php 
echo form_open('admin/delete_teachers/'.$student_id .'/' .$school_id);  ?>
<table id="example" >
   <thead>
    <tr>
        <th>Учител</th>    
        
    </tr>
  </thead>  
  <thead class="filters"> 
    <tr>
      <td>Учител</td>    
         
    </tr>
  </thead>  
  <tfoot>
        <tr>
          <th>Учител</th>    
          
        </tr>
  </tfoot> 
  <tbody>
<?php

foreach($select_teachers_students as $select) 
{
 
?>  
    <tr>
    <td>
    <input type="checkbox" name="teacher[]"   value="<?php echo $select->teacher_id; ?>"  />
    <?php echo $select->U; ?>
</td>
    </tr>
      <?php
      }     
?>

</table>
<br/>
<input type="submit" name="change" id="delete_users" value="Изтрий учители" class="btn btn-danger" />
</form>
  </div>
<div style="width: 40%; float: left; margin-left:60px;">
<?php 
echo form_open('admin/add_teachers/'.$student_id .'/' .$school_id);  
?>
<table id="example2" class="display" >
   <thead>
    <tr>
        <th>Учител</th>          
    </tr>
  </thead>  
  <thead class="filters"> 
    <tr>
      <td>Учител</td>           
    </tr>
  </thead>  
  <tfoot>
    <tr>
      <th>Учител</th>            
    </tr>
  </tfoot> 
  <tbody>
<?php

foreach($select_teachers as $T) 
{
 
?>  
    <tr>
    <td class='col-md-1'>
    <input type="checkbox" name="teacher2[]"   value="<?php echo $T->user_id; ?>"  />
    <?php echo $T->username; ?>
    </td>
    </tr>
      <?php
      }     
?>
</tbody>
</table>
<br/>
<input type="submit" name="add" id="add_users" value="Добави учители" class="btn btn-success" />
</form>
</div>
</div>
</div>
</body>
</html>