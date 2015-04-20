<!DOCTYPE html>
<html>
  <head>   
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script>

      function showHide(self, show){

          $(".all_teachers_show, .toggle, .school,  .teacher_school, .teacher, .class, .teacher_class").hide();
 
          if (show)
              $('.toggle').show();
          else
              $('.toggle').hide();
          $(":radio").prop('checked',false);
          $(self).prop('checked',true);
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
            document.getElementById('class_label').innerHTML = 'Класен ръководител:*';
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
                    $school_sel.append("<option>Моля изберете регион</option>");
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
                    $teacher_sel.append("<option>Моля изберете училище</option>");
                    var teachers_obj = JSON.parse(result);
                    $.each(teachers_obj, function(key, val) {
                        var option = '<option value="' + val.user_id + '">' + val.username + '</option>';
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

  </style>
</head>

<body>
<?php
  
  echo validation_errors();
  echo "<div class='container'>";
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
    'class' => form_error('email') ? 'error' : '',
    'value' => set_value('email')
  );
  echo form_input($data);
  echo "</td></tr>";

  echo "<tr><td><label>  Изберете роля:* </label> </td><td>";

  $data=array(
    'name' => 'role_id[]',
    'value' => '1',
    'id' => 'radio1',
    'onclick' => 'showHide(this, true)'
    );
  echo form_radio($data);
  echo " Ученик ";

   $data=array(
    'name' => 'role_id[]',
    'value' => '2',
    'id' => 'radio2',
    'onclick' => 'showHide(this, true)'
    );
  echo form_radio($data);
  echo " Учител ";

  $data=array(
    'name' => 'role_id[]',
    'value' => '5',
    'id' => 'radio5',
    'onclick' => 'teachers_show(this, true)'
    );
  echo form_radio($data);
  echo " Координатор ";
  echo "</td></tr>";
  echo "<tr class='toggle' style='display:none;' ><td><label>  Регион:*  </label></td><td>";
  ?>

  <select name='region' id='region' onClick='show(this, true)'>
      <?php foreach ($regions as $row) { ?>
        <option name='region' value= "<?= $row->region ?>"><?= $row->region ?></option>
      <?php } ?>
  </select> 
  <?php
  echo "</td></tr>";

  echo "<tr class='school' style='display:none;' ><td><label> Училище:*  
  </label></td><td>";  
  ?>
<select id="school" name="school[]" onClick='school_show(this, true)'>
 <?php echo '<option name="school[]">Моля изберете регион</option>';
  echo '</select>'; 
  echo "</td></tr>";

  echo "<tr class='teacher' style='display:none;' onClick='class_show(this, true)'><td><label>  Учител:* 
  </label> </td><td>";
  
  echo '<select id="teacher" name="teacher[]">';
  echo '<option >Моля изберете училище</option>';
  echo '</select>';  
  echo "</td></tr>";

  echo "<tr class='class' id='class' style='display:none;'><td>  <label  id='class_label'> Клас:* </label> </td><td>";

  ?>
   <select name='class[]' id='class'>
      <?php foreach ($classes as $row) { ?>
        <option value= "<?= $row->id ?>"><?= $row->class_id ?></option>
      <?php } ?>
  </select> 
 
   <select name='class_divisions[]' id='class_divisions'>
    <?php foreach ($class_divisions as $row) { ?>
 <option value= "<?= $row->id ?>"><?= $row->division ?></option>
      <?php } ?>
  </select>   
  </td></tr>

  <?php
  echo "<tr class='all_teachers_show' style='display:none;'><td><label>  Учители:*  </label></td><td>";
  ?>
 
  <?php foreach ($all_teachers_show as $row) { ?>
 
  <input type="checkbox" id='all_teachers_show' name="all_teachers_show[]"
   value="<?= $row->user_id ?>"><?= $row->username ?>
      <?php } ?>

<?php
  echo "</td></tr>";
  echo "</div>";
  echo "</table><br/>";
  $data=array(
    "name" => 'mysubmit',
    'class' => 'btn btn-success ',
    'id' => 'reg',
    'value' => 'Регистрация'
  );
  echo form_submit($data);
  ?>
  </form>
  </div>
  </body>
   
  </html>