<html>
<head>
<link rel="stylesheet" href="//cdn.datatables.net/1.10.5/css/jquery.dataTables.min.css" type="text/css"  />

<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="//cdn.datatables.net/1.10.5/js/jquery.dataTables.min.js"></script>
<script src="https://www.datatables.net/release-datatables/media/js/jquery.js"></script>
<script src="https://www.datatables.net/release-datatables/media/js/jquery.dataTables.js"></script>
<script src="https://www.datatables.net/release-datatables/extensions/TableTools/js/dataTables.tableTools.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/zeroclipboard/2.2.0/ZeroClipboard.Core.min.js"></script>
<link rel="stylesheet" 
href="https://www.datatables.net/release-datatables/media/css/jquery.dataTables.css" type="text/css" />
<script src="../../media/js/dataTables.editor.min.js"></script>
<script>
$(document).ready(function() {
    $('#example').dataTable( {
        "pagingType": "full_numbers",

        "language": {
    "paginate": {
      "previous": "Предишна",
      "next": "Следваща",
      "last": "Последна",
      "first": "Първа"

    }
  },

         "bSort": true,
         "sDom": 'T<"clear">lfrtip',
         
	     "tableTools": {
	    "sSwfPath": "//cdn.datatables.net/tabletools/2.2.2/swf/copy_csv_xls_pdf.swf",
    
		"aButtons": [
		
		{
			"sExtends": "csv",
      		"sFileName": 'download.csv',
      		"sFieldSeperator": "," 
    	},
		
		
		{
		"sExtends": "pdf",
		"sButtonText": "Print PDF"
		
		},

		"xls"
		
		] 
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
	    "sSwfPath": "//cdn.datatables.net/tabletools/2.2.2/swf/copy_csv_xls_pdf.swf",
    
		"aButtons": [
		
		{
			"sExtends": "csv",
      		"sFileName": 'download.csv',
      		"sFieldSeperator": "," 
    	},
		
		
		{
		"sExtends": "pdf",
		"sButtonText": "Print PDF"
		},

		"xls"
		
		] 
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
    
    $('#example .filters td').each( function () {
        var title = $('#example thead th').eq( $(this).index() ).text();
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
<div class='col-md-8' id='student_results'>

<table  id='example'>
 
 <thead>
    <tr><th>Потребител</th><th>Училище</th><th>Клас</th><th>Анкета</th><th>Въпрос</th><th>Отговор</th></tr>
  </thead>  
 <thead class="filters">   
    <tr><td>Потребител</td><td>Училище</td><td>Клас</td><td>Анкета</td><td>Въпрос</td><td>Отговор</td></tr>
   </thead> 

  <tfoot>
      <tr>
          <th>Потребител</th>
          <th>Училище</th>
          <th>Клас</th>
          <th>Анкета</th>
          <th>Въпрос</th>
          <th>Отговор</th>
      </tr>
  </tfoot> 
  <tbody>

<?php 

foreach ($student_results as $row)
{

?>
	<tr><td>
	<?php echo $row->username; ?>
	</td><td>
	<?php echo $row->school_name; ?>
	</td><td>
	<?php echo $row->class; ?>
	</td><td>
	<?php echo $row->survey_id; ?>
  	</td><td>
  	<?php echo $row->question_id; ?>
  	</td><td>
  	<?php echo $row->answer; ?>
  	</td></tr>
  	<?php 
 }
 ?>
	
	</table>
<br/><br/>
<div id='table2'>
	<table id='example2'>
	<thead>
	<tr><th>Въпрос</th><th>Среден резултат</th></tr>
	</thead>
	<tfoot>
            <tr>
                <th>Въпрос</th>
               <th>Среден резултат</th>
            </tr>
        </tfoot> 
	<tbody>
<?php
foreach ($average_results as $row)
{
?>  	
  	<td>
  	<?php echo $row->question_id ; ?>
  	</td><td>
  	<?php echo round("$row->answer",2); ?>
  	</td></tr>
  	<?php
}
?>
	</tbody>
</table>

</div>

</div>
</body>
</html>