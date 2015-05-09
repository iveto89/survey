<html>
<head>
</head>
<body>
<div class='container' id='participation_show'>


Здравей, <br/><br/>
тук се намират три въпросника,  чрез които се изследва мотивацията за учене.  Целта на нашето изследване е да съберем информация за причините, поради които учениците ходят на училище, за техните чувства по отношение на ученето, за общите подходи в училище. За тази цел използваме следните въпросници: <br/><br/>
•	Въпросник за академична мотивация (мотивация за учене) <br/>
•	Въпросник за мотивация и стратегии за учене  <br/>
•	Въпросник за емоции, свързани с ученето и училището  <br/><br/>
Тези въпросници се попълват от ученици от 5 до 12 клас у нас. Първите два въпросника отнемат около 10-15 минути всеки, а третият, който е по-дълъг, отнема около 30-40 минути за попълване.  Моля да попълниш тези въпросници, като имаш предвид учебния предмет, например английски, химия, история и т.н., по който ти преподава учителят или учителката от програмата „Заедно в час“. <br/><br/>
Тук няма правилни или грешни отговори, това не е тест. За нас са важни твоите мисли, мнение, чувства, и те молим да бъдеш откровен/а в отговорите си. <span id='instructions_survey'>Участието ти е доброволно</span> и от него не зависят твоите оценки по този или друг предмет. Може да се оттеглиш от участие във всеки момент, като това няма да има никакви последствия за теб или твоя учител.  <span id='instructions_survey'>Отговорите и личните данни се запазват в тайна.</span> Информацията се обобщава и групира за анализите, а отговорите на даден ученик не се дават никога на други хора. <br/><br/>
Събраните данни за мотивацията на учениците ще ни позволят да изработим по-добри инструменти за нейното измерване в бъдеще. Това ще помогне да вървим напред към такова училище у нас, в което учениците се чувстват добре, искат и могат да учат. <br/><br/>
Участието ти в това изследване е от голямо значение за неговия успех и ние ти благодарим за отделеното време. Може да се свържеш с нас на следния имейл: phristova@cogs.nbu.bg <br/><br/>
Благодарим за участието!
<br/></br>


<div id = 'participation'>
<?php echo form_open('index/participation/'); 
 foreach($participation as $row) { 
if($row->participation == 'Искам да участвам' ) {
redirect('index/surveys_show');
} 
if($row->participation == 'Не искам да участвам' ) {
?>
<span id='reject_participation'><?php echo "<input type='hidden' name='reject_participation' value='Не искам да участвам' />";  
 echo '<input type="submit" name="submit" value="Не искам да участвам" style="display:none;"   class="btn btn-danger" 
    onclick="return confirm(\'Сигурни ли сте, че искате да откажете да участвате?\'); ">'; 
 echo " </span>";

 }  else { ?>
<span id='reject_participation'><?php echo "<input type='hidden' name='reject_participation' value='Не искам да участвам' />"; 
echo '<input type="submit" name="submit" value="Не искам да участвам"   class="btn btn-danger " 
    onclick="return confirm(\'Сигурни ли сте, че искате да откажете да участвате?\'); ">'; 
 } echo " </span>"; 
 ?>
 
 

<span id='confirm_participation'> 
<?php 
//if($row->participation == 'Не искам да участвам' OR $row->participation == '') {
 
 echo "<input type='hidden' id='confirm' name='confirm_participation' value='Искам да участвам' />"; 
 echo '<input type="submit" name="submit"   value="Искам да участвам" 
class="btn btn-success confirm">';  
}
 ?>

</span>
<?php echo form_close(); ?>
</div>
</div>
</body>
</html>