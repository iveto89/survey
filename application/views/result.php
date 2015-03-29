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
    <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">

      // Load the Visualization API and the piechart package.
     google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      
       function drawChart() {
        // Create the data table.
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
    <!--Div that will hold the pie chart-->
    <div id="chart_div"></div>
  </body>
</html>