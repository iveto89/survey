<body>

<div class='col-md-9' >
<br/>
<?php

$survey_id = $this->uri->segment(3); 
if($this->uri->segment(3) == 1) { ?>
<div id='survey_instructions'>
ЧАСТ I – Емоции, свързани с часовете
Учебните часове могат те карат да се чувстваш по различен начин. Тази част от въпросника се отнася до емоции (чувства), които може да изпитваш, когато си в часовете по този предмет. Припомни си типични ситуации, които си преживял в тези часове. Прочети внимателно всяко твърдение и използвай скалата под него, за да оцениш дали си съгласен(а) с него.   
С най-ниската оценка (1) оцени твърденията, с които въобще не си съгласен или въобще не си съгласна, а с най-високата оценка (5) - твърденията, с които си напълно съгласен (а). Можеш да използваш и останалите оценки между 1 и 5, ако си съгласен(a) само донякъде с твърденията, но те не отразяват точно твоите мисли и чувства в часовете по този предмет. 
Разгледай възможните оценки внимателно и използвай само една от тях за всяко от твърденията.
</div>
<br/><br/>
<a id='survey3_button' href="/survey/index.php/index/survey_show/3/" class='btn btn-primary'> Започни анкетата </a>
<?php } 
if($this->uri->segment(3) == 2) { ?>
<div id='survey_instructions'>
ЧАСТ II – Емоции, свързани с учене
Ученето може да те кара да се чувстваш по различен начин. Тази част от въпросника се отнася до емоции (чувства), които може да изпитваш,  докато учиш по този предмет. Припомни си типични ситуации, които си преживял, ДОКАТО УЧИШ за този  предмет. Прочети внимателно всяко твърдение и използвай скалата под него, за да оцениш дали си съгласен(а) с него.   
</div>
<br/><br/>
<a id='survey3_button' href="/survey/index.php/index/survey_show/4/" class='btn btn-primary'> Започни анкетата </a>
<?php } 
?>

</div>
</body>