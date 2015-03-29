<html>
  <head>
    <script  src="https://www.google.com/jsapi"></script>
    <?php  
  foreach ($activity_chart as $object) {
    $url[] = "['".$object->question."', ".round($object->answer,2)."]"; 
  }

?>
    <script>
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
          var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Точки');
        data.addRows([
        <?php echo implode(",", $url);?>
        ]);


        var options = {
          title: 'Средни резултати на въпросите',
          hAxis: {title: 'Въпрос',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="chart_div" style="width: 900px; height: 500px;"></div>
  </body>
</html>
