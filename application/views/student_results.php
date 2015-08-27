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
"emptyTable": "Няма данни",
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
		
		/*{
			"sExtends": "csv",
      		"sFileName": 'download.csv',
      		"sFieldSeperator": "," 
    	},
		
		
		{
		"sExtends": "pdf",
		"sButtonText": "Print PDF"
		
		},*/

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
		
		/*{
			"sExtends": "csv",
      		"sFileName": 'download.csv',
      		"sFieldSeperator": "," 
    	},
		
		
		{
		"sExtends": "pdf",
		"sButtonText": "Print PDF"
		},*/

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
$(document).ready(function(){
   
    $(".DTTT_container a").addClass("btn btn-info");
    
});
</script>

</head>
<body>

<div class='col-md-8' id='student_results'>

<table  id='example'>
 
 <thead>
    <tr><th>Имена</th><th>Потребител</th><th>Идент.№</th> <th>Населено място</th><th>Училище</th><th>Клас</th><th>Пол</th><th>Дата на раждане</th><th>Майчин език</th><th>Анкета</th><th>Учител</th><th>Въпрос</th><th>Отговор</th>
    <th>Код</th><th>Тип въпрос</th> <th>Преизчислено</th><th>Скала</th><th>Емоц. компонент</th><th>Ем. опит</th>
    <th>Време</th><th>Емоции</th><th>Дата</th></tr>
  </thead>  
 <thead class="filters">   
    <tr><td>Имена</td><td>Потребител</td><td>Идент.№</td> <td>Населено място</td><td>Училище</td><td>Клас</td><td>Пол</td><td>Дата на раждане</td><td>Майчин език</td><td>Анкета</td><td>Учител</td><td>Въпрос</td><td>Отговор</td>
    <td>Код</td><td>Тип въпрос</td> <td>Преизчислено</td><td>Скала</td><td>Емоц. компонент</td><td>Ем. опит</td><td>Време</td><td>Емоции</td><td>Дата</td></tr>
   </thead> 

  <tfoot>
      <tr>
          <th>Имена</th>
          <th>Потребител</th>
          <th>Идент.№</th>
          <th>Населено място</th>
          <th>Училище</th>
          <th>Клас</th>
          <th>Пол</th>
          <th>Дата на раждане</th>
          <th>Майчин език</th>
          <th>Анкета</th>
          <th>Учител</th>
          <th>Въпрос</th>
          <th>Отговор</th>
          <th>Код</th>
          <th>Тип въпрос</th>
          <th>Преизчислено</th>
          <th>Скала</th>
          <th>Емоц. компонент</th>
          <th>Ем. опит</th>
          <th>Време</th>
          <th>Емоции</th>
          <th>Дата</th>
      </tr>
  </tfoot> 
  <tbody>

<?php 

foreach ($student_results as $row)
{

?>
       <tr><td>
  
       <?php echo $row->first_name . "&nbsp;" . $row->last_name; ?>
  	</td><td>
	 <?php echo $row->username; ?>
        </td><td>
	<?php echo $row->user_id; ?>
	</td><td>
        <?php echo $row->location; ?>
	</td><td>
	<?php echo $row->school_name; ?>
	 </td><td>
	 <?php echo $row->class; echo $row->division; ?>
        </td><td>
	 <?php echo $row->gender; ?>
        </td><td>
	<?php echo $row->birth_day. "&nbsp;" .$row->birth_month. "&nbsp;" .$row->birth_year; ?>
         </td><td>
	<?php echo $row->ethnic_origin; ?>
	</td><td>
	<?php echo $row->survey_name; ?>
  	</td><td>
    <?php //echo $row->survey_name; ?>
    </td><td>
  	<?php echo $row->question; ?>
  	</td><td>
  	<?php echo $row->answer; ?>
    </td><td>
    
    <?php if($row->code == 0) { echo "";} else { echo $row->code; } ?>
    </td><td>
    
    <?php if($row->is_reverse == 0) { echo "Прав"; } else { echo "Обърнат"; } ?>
    </td><td>
    <?php if($row->is_reverse == 1) { echo 6 - $row->answer; } ?>
    </td><td>
    <?php echo $row->scale; ?>
    </td><td>
    <?php echo $row->emotion_component; ?>
    </td><td>
    <?php echo $row->c_emotional_experience; ?>
    </td><td>
   
    <?php if($row->time == 0) { echo ""; } elseif($row->time == 1) { echo "Before"; }
    elseif($row->time == 2) { echo "During"; } elseif($row->time == 3) { echo "After"; } ?>
    </td><td>
    <?php echo $row->emotions; ?>
      </td><td>
    <?php echo $row->created_at; ?>
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