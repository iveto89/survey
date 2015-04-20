<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>
        $(document).ready(function() {
            $('#teacher').change(function() {
                var url = "<?= base_url() ?>index.php/index/get_subjects";
                var postdata = {teacher: $('#teacher').val()};
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
 
</head>

<body>
<br/><br/>
<div class='col-md-6' id='student_surveys'>
<br/>
<?php

$survey_id = $this->uri->segment(3);
echo validation_errors();

echo form_open('index/student_surveys/' . $survey_id);
echo "<table border = '0' class='table table-striped'>";
echo "<tr><th>Учител</th><th>Предмет</th><th>Код</th>";
echo "<tr><td class='col-md-3'>";
  
echo '<select id="teacher" name="teacher">';
echo '<option>Моля изберете учител</option>';
foreach ($teachers as $row) { ?>
    <option value= "<?= $row->teacher_id ?>"><?= $row->username ?></option>
<?php } 
echo '</select>';
echo "</td><td class='col-md-3'>";
  
echo '<select id="subject" name="subject">';
echo '<option>Моля изберете учител</option>'; 
echo '</select>';
echo "</td><td class='col-md-3'>";
$code=random_string();
echo $code;
?>
<input type='hidden' name='random_code' value=<?php echo $code; ?> >
<?php
echo "</td></tr>";
echo "</table>";

?>

<input type="submit" name="submit" value="Изпрати" class="btn btn-success" id="student_surveys_submit" />

</form>

</div>
</body>
</html>