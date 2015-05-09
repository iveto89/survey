<html>
<head>
</head>
<body>
<div class='container'>
<br/>
<?php $this->load->library('session');
$confirm = $this->session->flashdata('confirm_participation'); 
if($confirm){
echo $confirm; 
} ?>
<div id = 'buttons'>
<a href="/survey/index.php/index/student_surveys/1/" class='btn btn-success'> Защо ходиш на училище? </a><br/><br/>
<a href='/survey/index.php/index/student_surveys/2/'class='btn btn-success'> Анкета 2 </a><br/><br/>
<a href='/survey/index.php/index/student_surveys/3/'class='btn btn-success'> Въросник за емоции, породени от ученето  </a><br/><br/>
</div>
</div>
</body>
</html>

