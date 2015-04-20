<html>
  <head>  
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <?php  
      foreach ($activity_chart as $object) {
        $url[] = "['".$object->question."', ".round($object->answer,2)."]"; 
      }

    ?>

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
          title: 'Среден резултат на отговорите:',
          is3D:'true',
          backgroundColor:'#FFFF99',
          legend: 'right',
          role: "annotation"       

        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      
      }
  </script>
  </head>
  <body>
  <div id='chart_container'>
  <br/>
  <h4 id='chart_title'> Среден резултат:</h4>
  <div id="piechart" style="width: 900px; height: 500px;"></div>
  </div>
  </body>
</html>
