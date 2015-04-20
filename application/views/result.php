<html>
<?php  
  foreach ($activity_chart as $object) {
    $url[] = "['".$object->answer."', ".$object->question_id."]"; 

//$percentQuestion1 = ($result_question1 / $total_rows)*100;
//echo round($percentQuestion1,2);
  }
 
  //echo implode(",", $url);
?>
  <head>  
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
     
     google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      
       function drawChart() {
       
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows([
        <?php echo implode(",", $url);?>
        ]);
        var options = {
          title: 'Резултати: ',
          is3D:'true',
          backgroundColor:'none'
        };

        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }

    </script>
  </head>

  <body>
   
    <div id="chart_div"></div>
  </body>
</html>