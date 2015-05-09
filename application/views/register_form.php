<!DOCTYPE html>
<html>
  <head>   
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  
    <script>

  $(document).ready(function(){
      $(":radio").click(function(){
          $('#region').val('Моля изберете регион');
          $('#school').val('Моля изберете училище');
          $('#teacher').val('Моля изберете учител');
          $('#gender').val('Моля изберете пол');
          $('#birth_day').val('Моля изберете ден');
          $('#birth_month').val('Моля изберете месец');
          $('#birth_year').val('Моля изберете година');
          $('#ethnic_origin').val('Моля изберете език');
          $('#class').val('Моля изберете клас');
          $('#class_divisions').val('Моля изберете паралелка');
      });
  });
 
         

/* $(document).ready(function(){


  if($('#radio1').is(':checked') )  {
       
    $(" .student").show();
      


});*/



    function showHide(self, show){

          $(".all_teachers_show, .student, .toggle, .school,  .teacher_school, .teacher, .class, .teacher_class").hide();
 
          if (show)

              $('.toggle').show();
          else
              $('.toggle').hide();

          $(":radio").prop('checked',false);
          $(self).prop('checked',true);
      }

    function studentShow(yes, no){
 if(document.getElementById("radio1").checked===true){
           if (no)
              $('.student').show();
          else
              $('.student').hide();
          $("class").prop('checked',false);
          $(yes).prop('checked',true);
}
      }
      
      function show(yes, no){
          if (no)
              $('.school').show();
          else
              $('.school').hide();
          $("region").prop('checked',false);
          $(yes).prop('checked',true);
      }
      
      function school_show(yes, no){
  
        if(document.getElementById("radio1").checked===true){
           document.getElementById('class_label').innerHTML = 'Клас:*';
          if (no)
            
                $('.teacher').show();
            else
                $('.teacher').hide();
            $("school").prop('checked',false);
            $(yes).prop('checked',true);
        }
       
        if(document.getElementById("radio2").checked===true){
            document.getElementById('class_label').innerHTML = 'Класен ръководител:';
          if (no)
              $('.class').show();
          else
              $('.class').hide();
          $("school").prop('checked',false);
          $(yes).prop('checked',true);

        }
      }
     
      function class_show(yes, no){
      
        if (no)
              $('.class').show();


          else
              $('.class').hide();
              
          $("teacher").prop('checked',false);
          $(yes).prop('checked',true);
      
      }
      
      function teachers_show(yes, no){
        $(".toggle, .all_teachers_show,  .school,  .teacher_school, .teacher, .class, .teacher_class").hide();
          if (no)
              $('.all_teachers_show').show();
          else
              $('.all_teachers_show').hide();
          $(":radio").prop('checked',false);
          $(yes).prop('checked',true);
      }
       
  </script>   
  <script>
        $(document).ready(function() {
            $('#region').change(function() {
                var url = "<?= base_url() ?>index.php/home/get_schools";
                var postdata = {region: $('#region').val()};
                $.post(url, postdata, function(result) {
                    var $school_sel = $('#school');
                    $school_sel.empty();
                    $school_sel.append("<option>Моля изберете училище</option>");
                    var schools_obj = JSON.parse(result);
                    $.each(schools_obj, function(key, val) {
                        var option = '<option  value="' + val.school_id + '">' + val.school_name + '</option>';
                        $school_sel.append(option);
                    });
                });
            });
        });
  </script>  
  <script>
        $(document).ready(function() {
            $('#school').change(function() {
                var url = "<?= base_url() ?>index.php/home/get_teachers";
                var postdata = {school: $('#school').val()};
                $.post(url, postdata, function(result) {
                    var $teacher_sel = $('#teacher');
                    $teacher_sel.empty();
                    $teacher_sel.append("<option>Моля изберете учител</option>");
                    var teachers_obj = JSON.parse(result);
                    $.each(teachers_obj, function(key, val) {
                        var option = '<option value="' + val.user_id + '">' + val.first_name  + "&nbsp;" + val.last_name  + '</option>';
                        $teacher_sel.append(option);
                    });
                });
            });
        });
  </script>
  
  </head>
  <style>

  form input {
    width: 180px;
    height: 30px;
  }
select {
    font-size: 16px !important;
}

  </style>
</head>

<body>
<?php
  
  echo validation_errors();
  echo "<div class='container' id='register_container'>";
  echo form_open('home/register');

  echo "<h3>Регистрация:</h3><br/>";  
  echo "<table border = '0' >";
  echo "<tr><td><label>  Потребителско име:* </label></td><td>";
  $data=array(
    'name' => 'username',
    'class' => form_error('username') ? 'error' : '',
    'value' => set_value('username')
  );
  echo form_input($data);
  echo "</td></tr>";
  echo "<tr><td><label> Парола:* </label></td><td>";
  $data=array(
    'name' => 'password',
    'class' => form_error('password') ? 'error' : ''
  );
  echo form_password($data);
  echo "</td></tr>";
  echo "<tr><td><label> Повтори парола:* </label></td><td>";
  $data=array(
    'name' => 'password2',
    'class' => form_error('password2') ? 'error' : ''
  );
  echo form_password($data);
  echo "</td></tr>";
  echo "<tr><td><label>  Име:*  </label></td><td>";
  $data=array(
    'name' => 'first_name',
    'class' => form_error('first_name') ? 'error' : '',
    'value' => set_value('first_name')
  );
  echo form_input($data);
  echo "</td></tr>";
  echo "<tr><td><label>  Фамилия:*  </label></td><td>";
  $data=array(
    'name' => 'last_name',
    'class' => form_error('last_name') ? 'error' : '',
    'value' => set_value('last_name')
  );
  echo form_input($data);
  echo "</td></tr>";
  echo "<tr><td><label>  Населено място:*  </label></td><td>";
  $data=array(
    'name' => 'location',
    'class' => form_error('location') ? 'error' : '',
    'value' => set_value('location')
  );
  echo form_input($data);
  echo "</td></tr>";
  echo "<tr><td><label>  Имейл:*  </label></td><td>";
  $data=array(
    'name' => 'email',
    'id' => 'email',
    'class' => form_error('email') ? 'error' : '',
    'value' => set_value('email')
  );
  echo form_input($data);
  echo "</td></tr>";


  echo "<tr><td><label>  Изберете роля:* </label> </td><td>";
  echo "<label id='radio'>";
  $data=array(
    'name' => 'role_id',
    'value' => set_value('role_id', '1'),
    'id' => 'radio1',
    'onclick' => 'showHide(this, true)'
    );
  echo form_radio($data); 

 //echo <input type="radio"   name="role_id" onClick='showHide(this, true)' id="radio1"  value="1" />
  echo " Ученик " . "&nbsp;" ;
echo "</label>";
 echo "<label id='radio'>";
   $data=array(
    'name' => 'role_id',
    'value' => set_value('role_id', '2'),
    'id' => 'radio2',
    'onclick' => 'showHide(this, true)'
    );
  echo form_radio($data);
  echo " Учител " . "&nbsp;";
echo "</label>";
 echo "<label id='radio'>";
  $data=array(
    'name' => 'role_id',
    'value' => set_value('role_id', '5'),
    'id' => 'radio5',
    'onclick' => 'teachers_show(this, true)'
    );
  echo form_radio($data);
  echo " Координатор ";
echo "</label>";

  echo "</td></tr>";


  echo "<tr class='toggle' style='display:none;' ><td><label>  Регион:*  </label></td><td>";
  ?>

  <select name='region'   id='region' onChange='show(this, true)'>
  <option value="<?php echo set_select('region'); ?>">Моля изберете регион</option>
      <?php foreach ($regions as $row) { ?>
        <option name='region' value= "<?= $row->region ?>" 
        <?php echo 'region' == $row->region ? 'selected="selected"' : 
    '' ?>><?= $row->region ?></option>
      <?php } ?>
  </select> 
  <?php
  echo "</td></tr>";

  echo "<tr class='school' style='display:none;' ><td><label> Училище:*  
  </label></td><td>";  
  ?>
<select id="school" name="school[]"  onChange='school_show(this, true)'>
 <option value="<?php echo set_select('school[]'); ?>">Моля изберете училище</option>
  </select>
  <?php echo "</td></tr>";

  echo "<tr class='teacher' style='display:none;' onChange='class_show(this, true)'><td><label>  Учител:* 
  </label> </td><td>";
  
  echo '<select id="teacher"  name="teacher[]">';
  ?>
  <option value="<?php echo set_select('teacher'); ?>">Моля изберете учител</option>
  </select>  
  </td></tr>
<?php
  echo "<tr class='class'  style='display:none;' onChange='studentShow(this, true)'><td>  <label  id='class_label'> Клас:* </label> </td><td>";

  ?>
   <select name='class[]'  id='class'>
   <option  value="<?php echo set_select('class[]'); ?>">Моля изберете клас</option>
      <?php foreach ($classes as $row) { ?>
        <option value= "<?= $row->id ?>"><?= $row->class_id ?></option>
      <?php } ?>
  </select> 

 <select name='class_divisions[]'  id='class_divisions'>
    <option  value="<?php echo set_select('class_divisions[]'); ?>">Моля изберете паралелка</option>
    <?php foreach ($class_divisions as $row) { ?>
 <option value= "<?= $row->id ?>"><?= $row->division ?></option>
      <?php } ?>
  </select>  
    
  </td></tr>
<?php
 echo "<tr class='student' style='display:none;' ><td><label>  Пол:* </label> </td><td>"; ?>
<select name='gender'   id='gender'>
  <option value="<?php echo set_select('gender'); ?>">Моля изберете пол</option>
     <option value="Мъж" >Мъж</option>
  <option value="Жена" >Жена</option> 
  </select> 
<?php
  echo "</td></tr>";
 echo "<tr class='student' style='display:none;' ><td><label>  Дата на раждане:* </label> </td><td>"; 
?>
  <select name='birth_day'   id='birth_day'>
  <option value="<?php echo set_select('birth_day'); ?>" >Моля изберете ден</option>
<?php for($i=1; $i<=31; $i++) { ?>
     <option value="<?php echo $i; ?>" ><?php echo $i; ?></option>
  <?php } ?> 
  </select> 
<select name='birth_month'   id='birth_month'>
  <option value="<?php echo set_select('birth_month'); ?>">Моля изберете месец</option>
 <option value="1">Януари</option>
<option value="2">Февруари</option>
<option value="3">Март</option>
<option value="4">Април</option>
<option value="5">Май</option>
<option value="6">Юни</option>
<option value="7">Юли</option>
<option value="8" >Август</option>
<option value="9">Септември</option>
<option value="10">Октомври</option>
<option value="11">Ноември</option>
<option value="12">Декември</option>
  </select> 

<select name='birth_year'   id='birth_year'>
  <option value="<?php echo set_select('birth_year'); ?>" >Моля изберете година</option>
<?php for($i=1990; $i<=2011; $i++) { ?>
     <option value="<?php echo $i; ?>" ><?php echo $i; ?></option>
  <?php } ?> 
  </select>
</td></tr>
<tr class='student' style='display:none;' ><td><label>  Кой е основният език,<br/> на който се говори във Вашето семейство?: </label> </td><td>
<select name='ethnic_origin'   id='ethnic_origin'>
  <option  value="<?php echo set_select('ethnic_origin'); ?>">Моля изберете език</option>
     <option value="Български">Български</option>
  <option value="Друг" >Друг</option> 
  </select> 
</td></tr>

  <?php
  echo "<tr class='all_teachers_show' style='display:none;'><td><label>  Учители:*  </label></td><td>";
  ?>
 <table border='0'>
  <tr>
  <?php    
           $ind = 0;

           foreach ($all_teachers_show as $row) { 
           $ind++; 
?>
  <td>
  <input type="checkbox" id='all_teachers_show' <?php echo set_checkbox('all_teachers_show[]'); ?> name="all_teachers_show[]"
   value="<?= $row->user_id ?>"><?= $row->first_name . ' ' . $row->last_name ?> <td>
      <?php 
      if($ind % 3 == 0)
       echo '</tr> <tr>';
} ?>
</table>
<?php
  echo "</td></tr>";
  echo "</div>";
  echo "</table><br/>";
  $data=array(
    "name" => 'mysubmit',
    'class' => 'btn btn-success ',
    'id' => 'reg',
    'value' => 'Регистрация',
    'onsubmit'=>"radio()"
  );
  echo form_submit($data);
  ?>
  </form>
  </div>
  </body>
   
  </html>