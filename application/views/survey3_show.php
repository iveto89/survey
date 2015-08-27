<html>
<head>
</head>
<body>
<div class='container'>
<br/>

<div id = 'survey3'>
<?php
$survey_fill = $this->session->flashdata('survey_fill'); 
if($survey_fill){
echo "<div id='quaestors'>$survey_fill </div><br/>";
} 
?>
<span id='part1_survey3'><a href="/survey/index.php/survey_show/survey_instructions/1/" class='btn btn-success'> ЧАСТ I – Емоции, свързани с часовете </a></span>
<span id='part2_survey3'><a href='/survey/index.php/survey_show/survey_instructions/2/' class='btn btn-success'> ЧАСТ II – Емоции, свързани с учене </a></span>

</div>
</div>
</body>
</html>