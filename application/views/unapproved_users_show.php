<html>
<head> 
</head>
<body>
<div class="col-md-7" id="unapproved_users">
<br/>
<h3>Неодобрени потребители</h3><br/><br/>
    <table border=1 id='courses' class="table table-striped">
        <tr><th>Име на курсиста</th><th>Роля</th>
        <th>Одобри</th></tr>
<?php
foreach ($unapproved_users as $row)
{
	echo "<tr>";
    echo "<div class='row'>";
    echo "<td class='col-sm-2'>";
    echo "<input type='hidden' name='approve'  value='$row->user_id'>";   
    echo "$row->username";
    echo "</td>";
    echo "<td class='col-sm-3'>";
    echo "$row->role_name</td>";
    echo "<td class='col-sm-2'>";   
    echo validation_errors();
    echo form_open('admin/approve_users');
    echo "<input type='hidden' name='approve'  value='$row->user_id'>";
    echo '<input type="submit" name="submit" value="Одобри" class="btn btn-success"
    onclick="return confirm(\'Сигурни ли сте, че искате да одобрите потребителя?\'); ">';
    echo form_close(); 
    echo "</td></tr>";   

 }
 
 ?>
 </table>
 </div>
 </body>
 </html>
