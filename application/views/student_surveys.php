<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>
        $(document).ready(function() {
            $('#select_teacher').change(function() {
                var url = "<?= base_url() ?>index.php/survey_show/get_subjects";
                var postdata = {teacher: $('#select_teacher').val()};
                $.post(url, postdata, function(result) {
                    var $subject_sel = $('#subject');
                    $subject_sel.empty();
                    $subject_sel.append("<option>Моля изберете учител</option>");
                    var subjects_obj = JSON.parse(result);
                    $.each(subjects_obj, function(key, val) {
                        var option = '<option  value="' + val.teacher_subject_id + '">' + val.subject_name + '</option>';
                        $subject_sel.append(option);
                    });
                });
            });
        });

       
    </script>
    <script>
     $('#select_teacher').val('');
          $('#subject').val('Моля изберете предмет');
         $(function() {

  if($("#select_teacher").val() == "")
  {
    $("#subject").prop("disabled", true);
  }
  $('#select_teacher').change(function() {
    if($("#select_teacher").val() == "")
      $("#subject").prop("disabled", true);
    else
      $("#subject").prop("disabled", false);
  });

});
    </script>
 
</head>

<body>
<br/>
<div class='col-md-9' id='student_surveys'>

<?php

$survey_id = $this->uri->segment(3); 

if (!$this->session->userdata('survey') OR $survey_id == 1 OR $survey_id == 2) { 


if($this->uri->segment(3) == 1) { ?>
<div id='instructions'>
Защо ходиш на училище? <br/>
В този въпросник трябва да оцениш причините, заради които ходиш на училище. Използвай скалата под всяко твърдение, за да оцениш дали си съгласен(а) с него. С най-ниската оценка (1) оцени причините да си в училище, с които въобще не си съгласен или въобще не си съгласна, а с най-високата оценка (5) - причините да си в училище, с които си напълно съгласен (а). Можеш да използваш и останалите оценки между 1 и 5, ако твърденията отразяват донякъде твоите причини, но ти не си напълно съгласен (а) с тях. Разгледай възможните оценки внимателно и използвай само една от тях за всяко от твърденията. <br/>
1-  Въобще не съм съгласен (а). Това въобще не е причина за мен да ходя на училище. <br/>
2 - Не съм съгласен (а). Това не е причина за мен да съм в училище. <br/>
3 - И съм съгласен (а), и не съм. Това донякъде е причина да съм в училище, но тя не е много важна за мен.  <br/>
4 – Съгласен (а) съм. Това е причина да съм в училище. <br/>
5 - Напълно съм съгласен (а). Това е една от причините да съм в училище. 

</div>
<?php } 
if($this->uri->segment(3) == 2) { ?>
<div id='instructions'>
Твърденията в този въпросник отразяват конкретни нагласи, мисли и стратегии за учене на учениците по този предмет. Използвай скалата под всяко твърдение, за да оцениш дали твърдението е вярно за теб.  С най-ниската оценка (1) оцени твърденията, които въобще не са верни за теб, а с най-високата (5) - твърденията, които вярно описват начина, по който учиш и мислиш за този предмет. Можеш да използваш и останалите оценки между 1 и 5, ако твърденията се отнасят донякъде за теб, но не напълно: <br/>
1 - въобще не е вярно за мен <br/>
2 - не  е вярно за мен <br/>
3 - колкото е вярно, толкова и не е <br/>
4 - вярно е <br/>
5 - много е вярно  <br/>

Тук няма правилни и грешни отговори. Важно е да отбележиш онзи отговор, който е верен за теб и добре описва твоите собствени мисли, отношение и начин на учене по този предмет.
 

</div>
<?php }
if($this->uri->segment(3) == 3) { ?>
<div id='instructions3'>
<b> Усещания и мисли за училищните преживявания 
- Въпросник за емоции, породени от ученето    </b><br/><br/>

Този въпросник пита за нещата, които мислиш и чувстваш, откакто си в училище. Няма правилни или грешни отговори. Важни са твоите чувства и мисли за нещата, които ти се случват в училище. Интересува ни твоето лично мнение. Твоята самоличност (твоите лични данни) и отговори ще бъдат запазени в тайна. Информацията ще се използва само с научна цел и няма да се разпространява. 
Въпросникът се състои от 155 твърдения, подредени в две части. В ЧАСТ I ще отговаряш дали твърденията се отнасят за теб, докато си в часовете по този предмет. В ЧАСТ II  ще отговаряш дали твърденията се отнасят за теб, докато учиш и се подготвяш по този предмет. 
Твърденията ще се представят едно по едно на екрана, заедно със скалата за оценка. Ако те отговарят на чувствата, които изпитваш, натисни бутона под най-високата оценка в скалата (5).  Ако твърденията въобще не отговарят на твоите чувства, натисни бутона под най-ниската оценка (1). Може да използваш и останалите оценки между 1 и 5, ако твърденията не отговарят напълно на твоите чувства, мисли и преживявания, но се е случвало да чувстваш и мислиш такива неща. <br/>
Твоето участие в проучването е важно за неговия успех и ние високо оценяваме времето, което отделяш, за да попълниш въпросника. <br/><br/>

Благодарим ти за подкрепата! 

</div>
<?php }
?>
<br/>
<?php
/*echo "<div class = 'valid_errors' >";
echo validation_errors();
echo "</div>";*/
echo '<div>' . validation_errors() . '</div>';
echo "<div class='col-md-10'>";
echo form_open('survey_show/student_surveys/' . $survey_id);
echo "<table border = '0' class='table table-striped'>";
echo "<tr id='thead_teacher_subject'><th>Учител</th><th>Предмет</th><th>Място на попълване</th>"; //<th>Код</th>
echo "<tr><td id='add_teacher_subject1' class='col-md-1'>";

$selected_teacher = $this->input->post('teacher');  

echo '<select id="select_teacher" name="teacher">';
echo '<option value = "">Моля изберете учител</option>';
foreach ($teachers as $row) { ?>
     <option value= "<?= $row->teacher_id ?>" <?php echo $selected_teacher == $row->teacher_id ? 'selected="selected"' : 
    '' ?>><?php echo $row->first_name . "&nbsp;" . $row->last_name; ?></option>
<?php } 
echo '</select>';
echo "</td><td  class='col-md-2'>";

echo '<select id="subject" name="subject">';
echo '<option value = "">Моля изберете учител</option>'; 
foreach ($subjects as $row) { ?>
<option value= "<?= $row->subject_id ?>" ><?php echo $row->subject_name ; ?></option>
<?php }
echo '</select>';

echo '</td><td class="col-md-5">';
$selected_location = $this->input->post('location_filling');  
echo '<select  id="location_filling" name="location_filling">';
echo '<option value="">Моля изберете място на попълване</option>'; ?>
<option value="На училище" <?php echo $selected_location == "На училище" ? 'selected="selected"' : 
    ''?>>На училище</option>
<option value="Вкъщи" <?php echo $selected_location == "Вкъщи" ? 'selected="selected"' : 
    '' ?>>Вкъщи</option>
    <?php
echo '</select>';
echo '</td>';
//echo "</td><td class='col-md-3'>";
$code=random_string();
//echo $code;
?>
<input type='hidden' name='random_code' value=<?php echo $code; ?> >
<?php
echo "</td></tr>";
echo "</table>";
echo '<input type="submit" name="submit" value="Изпрати" class="btn btn-success" id="student_surveys_submit" />
';
echo "<br/><br/><br/><br/></div>";

} 
if ($this->session->userdata('survey') && $survey_id == 3)  {
    redirect('index/survey3_show');
}

?>


</form>

</div>
</body>
</html>