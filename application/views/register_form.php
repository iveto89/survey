<!DOCTYPE html>
<html>
  <head>   
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  
    <script>

  $(document).ready(function(){
      $(":radio").click(function(){
          $('#region').val('');
        //  $('#school').val('');
          $('#teacher').val('Моля изберете учител');
          $('#gender').val('');
          $('#birth_day').val('');
          $('#birth_month').val('');
          $('#birth_year').val('');
          $('#ethnic_origin').val('');
          $('#class').val('');
          $('#class_divisions').val('');
      });
  });
 
   $(document).ready(function(){
   if($('#radio1').is(':checked') )  {

    var dropDown = document.getElementById("region");
    var region = dropDown.options[dropDown.selectedIndex].value;

     $('.toggle, .teacher, .student').show();
   
   }  
   if( $('#radio2').is(':checked'))  {

    var dropDown = document.getElementById("region");
    var region = dropDown.options[dropDown.selectedIndex].value;

     $('.toggle').show();
   
  }      
  if( $('#radio5').is(':checked'))  {
     $('.all_teachers_show').show();

  }

});

    function showHide(self, show){

          $(".all_teachers_show, .student, .toggle, .school,  .teacher_school, .teacher, .class, .teacher_class").hide();
    if(document.getElementById("radio1").checked===true){
       document.getElementById('class_label').innerHTML = 'Клас:*';
          if (show)

              $('.toggle, .teacher, .student').show();
             
          else
              $('.toggle, .teacher, .student').hide();
              

          $(":radio").prop('checked',false);
          $(self).prop('checked',true);
        }
        if(document.getElementById("radio2").checked===true){
           document.getElementById('class_label').innerHTML = 'Класен ръководител:';
          if (show)

              $('.toggle').show();
             
          else
              $('.toggle').hide();
              

          $(":radio").prop('checked',false);
          $(self).prop('checked',true);
        }
       
        
      }

   

$(function() {
  $('input:radio[name="role_id"]').change(function(){
    if($(this).val() == '1' || $(this).val() == '2'){

          if($("#region").val() == "")
          {
            $("#school").prop("disabled", true);
          }
          $('#region').change(function() {
            if($("#region").val() == "")
              $("#school").prop("disabled", true);
            else
              $("#school").prop("disabled", false);
          });
      }
  });

});

/*$(function() {
  $('input:radio[name="role_id"]').change(function(){
    if($(this).val() == '1'){
          if($("#teacher").val() == "Моля изберете учител" )
          {
            $("#class, #class_divisions").prop("disabled", true);
          }
          $('#teacher').change(function() {
            if($("#teacher").val() == "" )
              $("#class,#class_divisions").prop("disabled", true);
            else
              $("#class, #class_divisions").prop("disabled", false);
          });
    }
  });
});*/

$(function() {
  $('input:radio[name="role_id"]').change(function(){
    if($(this).val() == '2'){
         
              $("#teacher").prop("disabled", true);
            $("#teacher").val("");
          
    }
  });
});



$(function() {
  $('input:radio[name="role_id"]').change(function(){
    if($(this).val() == '1'){
          if($("#school").val() == "" )
          {
            $("#teacher, #class, #class_divisions").prop("disabled", true); //there is another method
          }
          $('#school').change(function() {
            if($("#school").val() == "" )
              $("#teacher, #class, #class_divisions").prop("disabled", true); //there is another method
            else
              $("#teacher, #class, #class_divisions").prop("disabled", false); //there is another method
          });
    }

    if($(this).val() == '2' ){
          if($("#school").val() == "" )
          {
            $("#class,#class_divisions").prop("disabled", true);
          
          }
          $('#school').change(function() {
            if($("#school").val() == "" )
              $("#class,#class_divisions").prop("disabled", true);
             
            else
              $("#class,#class_divisions").prop("disabled", false);
             
          });
    }
  });
});

  $(function() {
  $('input:radio[name="role_id"]').change(function(){
    if($(this).val() == '1'){
        if($("#class_divisions").val() == "")
        {
          $("#gender").prop("disabled", true);
        }
        $('#class_divisions').change(function() {
          if($("#class_divisions").val() == "")
            $("#gender").prop("disabled", true);
          else
            $("#gender").prop("disabled", false);
        });
    }
  });

});

    $(function() {
  $('input:radio[name="role_id"]').change(function(){
    if($(this).val() == '1'){
        if($("#gender").val() == "")
        {
          $("#birth_day, #birth_month, #birth_year").prop("disabled", true);
        }
        $('#gender').change(function() {
          if($("#gender").val() == "")
            $("#birth_day, #birth_month, #birth_year").prop("disabled", true);
          else
            $("#birth_day, #birth_month, #birth_year").prop("disabled", false);
        });
    }
  });

});
    $(function() {
  $('input:radio[name="role_id"]').change(function(){
    if($(this).val() == '1'){
        if($("#birth_year").val() == "")
        {
          $("#ethnic_origin").prop("disabled", true);
        }
        $('#birth_year').change(function() {
          if($("#birth_year").val() == "")
            $("#ethnic_origin").prop("disabled", true);
          else
            $("#ethnic_origin").prop("disabled", false);
        });
    }
  });

});
   /* function studentShow(yes, no){
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
      
      }*/
      
      function teachers_show(yes, no){
        $(".toggle, .all_teachers_show,  .student, .school,  .teacher_school, .teacher, .class, .teacher_class").hide();
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
                var url = "<?= base_url() ?>index.php/authentication/get_schools";
                var postdata = {region: $('#region').val()};
                $.post(url, postdata, function(result) {
                    var $school_sel = $('#school');
                    $school_sel.empty();
                    $school_sel.append("<option>Моля изберете училище</option>");
                    var schools_obj = JSON.parse(result);
                    $.each(schools_obj, function(key, val) {
                        var option = '<option  value="' + val.school_id + '">' + val.school_name + '</option>';
                       // var selected = $('#school option[value="' + val.school_id + '"]').prop('selected', true);
                         $school_sel.append(option);
                        
                        

                    });
                });
            });
        });
  </script>  
   
  <script>
     $(function() {
     $("#school").change(function() {
      var a = $("#school option:selected").val();
      //  $('#school option[value=" a "]').prop('selected', true);
       //  document.getElementById('school').value="a Selected";
      alert( a );
var option=document.getElementById('school').value;

    if(option=="5"){
            document.getElementById('school').value="5 Selected";
    }
        });
     });
  </script>
  <script>
        $(document).ready(function() {
            $('#school').change(function() {
                var url = "<?= base_url() ?>index.php/authentication/get_teachers";
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
  echo form_open('authentication/register');

  echo "<h3>Регистрация:</h3><br/>";  
  echo "<table border = '0' >";
  echo "<tr><td><label>  Потребителско име:* </label></td><td>";
  $data=array(
    'name' => 'username',
    'class' => form_error('username') ? 'error' : '',
    'value' => set_value('username')
  );
  echo form_input($data);
   echo "<span id='min_symbols'> &nbsp;Потребителското име трябва да бъде минимум 6 символа.</span>"; 
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
  /*echo "<label id='radio'>";
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
echo "</label>";*/

$selected_role = $this->input->post('role_id');  ?>
  <input type="radio" name="role_id" id="radio1" onclick="showHide(this, true)" value="1" 
  <?php echo '1' ==  $selected_role ? 'checked="checked"' : 
      '' ?>/>
      <?php  echo " Ученик "; ?>
      <input type="radio" name="role_id" id="radio2" onclick="showHide(this, true)" value="2" 
  <?php echo '2' ==  $selected_role ? 'checked="checked"' : 
      '' ?>/>
       <?php  echo " Учител "; ?>
      <input type="radio" name="role_id" id="radio5" onclick="teachers_show(this, true)" value="5" 
  <?php echo '5' ==  $selected_role ? 'checked="checked"' : 
      '' ?>/>
  <?php  echo " Координатор "; 

  echo "</td></tr>";


  echo "<tr class='toggle' style='display:none;' ><td><label>  Регион:*  </label></td><td>";
  $selected_region = $this->input->post('region');  ?>

  <select name='region'   id='region' >
  <option value="<?php echo set_select('region'); ?>">Моля изберете регион</option>
      <?php foreach ($regions as $row) { ?>
        <option name='region' value= "<?= $row->region ?>" <?php echo $selected_region == $row->region ? 'selected="selected"' : 
    '' ?>><?= $row->region ?></option>
      <?php } ?>
  </select> 
  <?php
  echo "</td></tr>";

  echo "<tr class='toggle' style='display:none;' ><td><label> Училище:*  
  </label></td><td>";  

  //$selected_school= $this->input->post('school[]'); ?>
<select id="school" name="school[]"  >
 <option value="" >Моля изберете училище</option>
  </select>
  <?php echo "</td></tr>";

  echo "<tr class='teacher' style='display:none;' onChange='class_show(this, true)'><td><label>  Учител:* 
  </label> </td><td>";
  
  echo '<select id="teacher"  name="teacher[]" >';
  ?>
  <option value="<?php echo set_select('teacher[]',''); ?>">Моля изберете учител</option>
  </select>  
  </td></tr>
<?php
  echo "<tr class='toggle'  style='display:none;' ><td>  <label  id='class_label'> Клас:* </label> </td><td>";  ?>
   <select name='class[]' id='class'>
   <option  value="" >Моля изберете клас</option>
      <?php foreach ($classes as $row) { 
      echo "<option value='$row->id' " . set_select('class', $row->id) . " >". $row->class_id."</option>";
    
       } ?>
  </select> 

<?php

 $selected_division = $this->input->post('class_divisions[]');  ?>
 <select name='class_divisions[]'  id='class_divisions'>
    <option  value="" >Моля изберете паралелка</option>
    <?php foreach ($class_divisions as $row) { 
     echo "<option value='$row->id' " . set_select('class_divisions[]', $row->id) . " >". $row->division ."</option>";
 
      } ?>
  </select>  
    
  </td></tr>
<?php
 echo "<tr class='student' style='display:none;' ><td><label>  Пол:* </label> </td><td>"; 
 $selected_gender = $this->input->post('gender');  ?>
<select name='gender'   id='gender'>
  <option value="<?php echo set_select('gender'); ?>">Моля изберете пол</option>
     <option value="Мъж" <?php echo $selected_gender == "Мъж" ? 'selected="selected"' : 
    '' ?> >Мъж</option>
  <option value="Жена" <?php echo $selected_gender == "Жена" ? 'selected="selected"' : 
    '' ?>>Жена</option> 
  </select> 
<?php
  echo "</td></tr>";
 echo "<tr class='student' style='display:none;' ><td><label>  Дата на раждане:* </label> </td><td>"; 
 $selected_day = $this->input->post('birth_day');  ?>
  <select name='birth_day'   id='birth_day'>
  <option value="" <?php echo set_select('birth_day',''); ?>>Моля изберете ден</option>
<?php for($i=1; $i<=31; $i++) { ?>
     <option value="<?php echo $i; ?>" <?php echo $selected_day ==  $i  ? 'selected="selected"' : 
    '' ?>><?php echo $i; ?></option>
  <?php } ?> 
  </select> 
  <?php  $selected_month = $this->input->post('birth_month');  ?>
<select name='birth_month'   id='birth_month'>
  <option value="" <?php echo set_select('birth_month',''); ?>>Моля изберете месец</option>
 <option value="1" <?php echo $selected_month ==  "01"  ? 'selected="selected"' : 
    '' ?>>Януари</option>
<option value="2" <?php echo $selected_month ==  "02"  ? 'selected="selected"' : 
    '' ?>>Февруари</option>
<option value="3" <?php echo $selected_month ==  "03"  ? 'selected="selected"' : 
    '' ?>>Март</option>
<option value="4" <?php echo $selected_month ==  "04"  ? 'selected="selected"' : 
    '' ?>>Април</option>
<option value="5" <?php echo $selected_month ==  "05"  ? 'selected="selected"' : 
    '' ?>>Май</option>
<option value="6" <?php echo $selected_month ==  "06"  ? 'selected="selected"' : 
    '' ?>>Юни</option>
<option value="7" <?php echo $selected_month ==  "07"  ? 'selected="selected"' : 
    '' ?>>Юли</option>
<option value="8" <?php echo $selected_month ==  "08"  ? 'selected="selected"' : 
    '' ?>>Август</option>
<option value="9" <?php echo $selected_month ==  "09"  ? 'selected="selected"' : 
    '' ?>>Септември</option>
<option value="10" <?php echo $selected_month ==  "10"  ? 'selected="selected"' : 
    '' ?>>Октомври</option>
<option value="11" <?php echo $selected_month ==  "11"  ? 'selected="selected"' : 
    '' ?>>Ноември</option>
<option value="12" <?php echo $selected_month ==  "12"  ? 'selected="selected"' : 
    '' ?>>Декември</option>
  </select> 
<?php  $selected_year = $this->input->post('birth_year');  ?>
<select name='birth_year'   id='birth_year'>
  <option value="" <?php echo set_select('birth_year',''); ?>>Моля изберете година</option>
<?php for($i=1990; $i<=2011; $i++) { ?>
     <option value="<?php echo $i; ?>" <?php echo $selected_year ==  $i  ? 'selected="selected"' : 
    '' ?>><?php echo $i; ?></option>
  <?php } ?> 
  </select>
</td></tr>
<tr class='student' style='display:none;' ><td><label>  Кой е основният език,<br/> на който се говори във Вашето семейство?: </label> </td><td>
 <?php $selected_language = $this->input->post('ethnic_origin');  ?>
<select name='ethnic_origin'   id='ethnic_origin'>
  <option  value="<?php echo set_select('ethnic_origin'); ?>">Моля изберете език</option>
     <option value="Български" <?php echo $selected_language == "Български" ? 'selected="selected"' : 
    '' ?>>Български</option>
  <option value="Друг" <?php echo $selected_language == "Друг" ? 'selected="selected"' : 
    '' ?>>Друг</option> 
  </select> 
</td></tr>

  <?php
  echo "<tr class='all_teachers_show' style='display:none;'><td><label>  Учители:*  </label></td><td>";
  ?>
 <table border='0'>
  <tr>
  <?php    
        
$ind = 0;

foreach ($all_teachers_show as $row)
{
$ind++;

$userId = $row->user_id;
$first_name = $row->first_name;
$last_name = $row->last_name;
$teacherSelected = (isset($_POST['user_ids'][$userId])) ? true : false;

?>

<td>
<input
type="checkbox"
class='all_teachers_show'
name="user_ids[<?php echo $userId; ?>]"
<?php
if ( $teacherSelected )
echo 'checked="checked"';
?>
value="<?php echo $userId; ?>"
>
<?php echo $first_name . ' ' . $last_name ?>
<td><?php
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
  <br/><br/><br/><br/><br/><br/><br/><br/><br/>
  </form>
  </div>
  </body>
   
  </html>