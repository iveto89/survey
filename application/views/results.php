<html>
<head>
  <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
  <script  src="https://www.google.com/jsapi"></script>

<script>
$(document).ready(function(){
    //  When user clicks on tab, this code will be executed
    $("#mtabs li").click(function() {
        //  First remove class "active" from currently active tab
        $("#mtabs li").removeClass('active');
 
        //  Now add class "active" to the selected/clicked tab
        $(this).addClass("active");
 
        //  Hide all tab content
        $(".mtab_content").hide();
 
        //  Here we get the href value of the selected tab
        var selected_tab = $(this).find("a").attr("href");
 
        //  Show the selected tab content
        $(selected_tab).fadeIn();
 
        //  At the end, we add return false so that the click on the link is not executed
        return false;
    });
  $("#simulate").click(function(){
    $('a[rel="tab2"]').trigger("click");
  });
});

</script>
</head>
<body>
<div class='col-md-8' id='chart'>
<br/><br/>

	<div class="mtabs_wrapper"> 
	    <div id="mtabs">
	        <ul>
	            <li><a href="#tab1" rel="tab1">Tab 1</a></li>            
	            <li class="active"><a href="#tab2" rel="tab2">Tab 2</a></li>
	        </ul>
	    </div>
	    <?php
	    foreach ($result_question1 as $row) {
			$percent=round("$row->answer",2); 
	    }
	    ?> 	
     	
	    <div id="mtabs_content_container">
	    
	        <div id="tab1" class="mtab_content">
	         <h4 id='average_tab1'> Среден резултат: </h4><br/>
	         <a id="simulate" href="#mtabs_wrapper#mtabs_content_container#tab2"></a>
	       		<?php foreach ($result_question1 as $row) {
	    	 		echo "<h4 id='question_name'> $row->question </h4>";

					$percent=(round("$row->answer",2)*20); 
					$point=round("$row->answer",2);
		    	 	echo "<br/>";
	    	 	?>   	
				<div class="progress">
	    			<div class="progress-bar" role="progressbar" style="width: 
	    				<?php echo round($percent,2); ?>%;">
	     			
					<?php echo round($point,2); ?>		
					</div>
				</div>
				
				<h6><?php  } ?></h6>
	      		
	        </div>

	        <div id="tab2" class="mtab_content">

	        	<div class='contain'>
	            	<h4 id='average'> Среден резултат: </h4><br/>
					<?php 
					$x = 0;
					foreach ($result_question1 as $row) {
						$x++;
						echo '<div class="meow">';

		    	 		echo "<h4 id='question2_name'>$row->question</h4>";
		    	 		echo "<br/>";
						$percent=(round("$row->answer",2)*20); 
						$point=round("$row->answer",2);	

		    	 	?>
	    	 		
		     			<div aria-valuemax="80" aria-valuemin="-50" class="progress vertical 
		     			bottom active">
	    					<div aria-valuemax="80" class="progress-bar " style="height: 
	    					<?php echo round($percent,2); ?>%;"><?php echo round($point,2);  ?> </div>	

							</div>
							<br/>
				
						</div>
						<?php 
						if ($x == 2) {
						    echo '<div class="clearfix"></div>';
						    $x = 0;
						}

					}

					?>

						</div>
				</div>

			<h6><?php //echo $total_rows; } ?></h6>


	        </div>   
    
    	</div>
	</div> 

</div>
</body>
</html>