<?php

$this->load->library('session');
$newdata = array('time' => 6);
$this->session->set_userdata($newdata);
?>
<body>

<div class='col-md-9' >
<br/>


<div id='survey_instructions'>
<span id='before'>ЧАСТ II – Емоции, свързани с учене <br/></span>
<span id='before'>СЛЕД КАТО УЧИШ  <br/></span>
Следващите твърдения се отнасят до чувствата, които може да преживяваш СЛЕД КАТО учиш по този предмет. Посочи как се чувстваш обикновено, след като вече си учил по този предмет, като използваш оценка от скалата: <br/>
1 – Въобще не съм съгласен(а). <br/>
2 – Не съм съгласен(а). <br/>
3 – И съм съгласен(а), и не съм. <br/>
4 – Съгласен(а)съм. <br/>
5 – Напълно съм съгласен(а). <br/>




</div>
<br/><br/>
<a id='survey3_button' href="/survey/index.php/index/survey_show/4/" class='btn btn-primary'> Продължи </a>